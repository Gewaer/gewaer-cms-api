<?php

declare(strict_types=1);

namespace Gewaer\Middleware;

use Phalcon\Mvc\Micro\MiddlewareInterface;
use Phalcon\Mvc\Micro;
use Canvas\Exception\PermissionException;
use Gewaer\Models\Sites;
use Canvas\Traits\TokenTrait;
use Baka\Auth\Models\Sessions;
use Canvas\Models\Users;
use Canvas\Constants\Flags;

/**
 * Class AclMiddleware.
 *
 * @package Canvas\Middleware
 */
class SiteMiddleware implements MiddlewareInterface
{
    use TokenTrait;

    /**
     * Validate if we are accessing a correct site content.
     *
     * @param Micro $api
     * @todo need to check section for auth here
     * @return bool
     */
    public function call(Micro $api)
    {
        $request = $api->getService('request');
        $config = $api->getService('config');

        if (!$request->hasHeader('SITE-KEY')) {
            throw new PermissionException('No Site Found');
        }

        //get site
        $site = Sites::findFirstOrFail([
            'conditions' => 'key = ?0 and is_deleted = 0',
            'bind' => [$request->getHeader('SITE-KEY')]
        ]);

        /**
        * @todo Add Admin verification. If an Admin user wants to acccess the api it does not need to provide a game id on call Header
        */
        $api->getDI()->setShared(
            'site',
            function () use ($site) {
                return $site;
            }
        );

        $api->getDI()->setShared(
            'userData',
            function () use ($site) {
                return $site->user;
            }
        );

        if ($request->getBearerTokenFromHeader()) {
            /**
            * This is where we will find if the user exists based on
            * the token passed using Bearer Authentication.
            */
            $token = $this->getToken($request->getBearerTokenFromHeader());

            $api->getDI()->setShared(
                'userData',
                function () use ($config, $token, $request) {
                    $session = new Sessions();
                    //all is empty and is dev, ok take use the first user
                    if (empty($token->getClaim('sessionId')) || strtolower($config->app->env) == Flags::DEVELOPMENT) {
                        return Users::findFirst(1);
                    }
                    if (!empty($token->getClaim('sessionId'))) {
                        //user
                        if (!$user = Users::getByEmail($token->getClaim('email'))) {
                            throw new UnauthorizedHttpException('User not found');
                        }
                        $ip = !defined('API_TESTS') ? $request->getClientAddress() : '127.0.0.1';
                        return $session->check($user, $token->getClaim('sessionId'), (string) $ip, 1);
                    } else {
                        throw new UnauthorizedHttpException('User not found');
                    }
                }
            );
        }

        return true;
    }
}
