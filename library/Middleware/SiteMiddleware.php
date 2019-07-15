<?php

declare(strict_types=1);

namespace Gewaer\Middleware;

use Phalcon\Mvc\Micro\MiddlewareInterface;
use Phalcon\Mvc\Micro;
use Canvas\Exception\PermissionException;
use Gewaer\Models\Sites;

/**
 * Class AclMiddleware.
 *
 * @package Canvas\Middleware
 */
class SiteMiddleware implements MiddlewareInterface
{
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

        if (!$request->hasHeader('SITE-KEY')) {
            throw new PermissionException('No Site Found');
        }

        //get site
        $site =  Sites::findFirstOrFail([
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

        return true;
    }
}
