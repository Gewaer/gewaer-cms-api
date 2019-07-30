<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\AuthController as CanvasAuthController;

use Baka\Auth\Models\UserLinkedSources;
use Baka\Auth\Models\Users;
use Exception;
use Phalcon\Http\Response;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Confirmation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Baka\Http\Api\BaseController;
use Baka\Auth\Models\Sessions;
use Canvas\Models\Sources;
use Canvas\Exception\ServerErrorHttpException;
use Canvas\Exception\ModelException;
use Baka\Auth\Models\Users as BakaUsers;
use Canvas\Traits\AuthTrait;
use Canvas\Traits\SocialLoginTrait;

/**
 * Class AuthController.
 *
 * @package Gewaer\Api\Controllers
 *
 * @property Users $userData
 * @property Request $request
 * @property Config $config
 * @property \Baka\Mail\Message $mail
 * @property Apps $app
 */
class AuthController extends CanvasAuthController
{
        /**
     * Reset the user password.
     * @method PUT
     * @url /v1/reset
     *
     * @return Response
     */
    public function reset(string $key) : Response
    {
        //is the key empty or does it existe?
        if (empty($key) || !$userData = Users::findFirst(['user_activation_forgot = :key:', 'bind' => ['key' => $key]])) {
            throw new Exception(_('This Key to reset password doesn\'t exist'));
        }

        // Get the new password and the verify
        $newPassword = trim($this->request->getPost('new_password', 'string'));
        $verifyPassword = trim($this->request->getPost('verify_password', 'string'));

        //Ok let validate user password
        $validation = new Validation();
        $validation->add('new_password', new PresenceOf(['message' => _('The password is required.')]));
        $validation->add('new_password', new StringLength(['min' => 8, 'messageMinimum' => _('Password is too short. Minimum 8 characters.')]));

        $validation->add('new_password', new Confirmation([
            'message' => _('Passwords do not match.'),
            'with' => 'verify_password',
        ]));

        //validate this form for password
        $messages = $validation->validate($this->request->getPost());
        if (count($messages)) {
            foreach ($messages as $message) {
                throw new Exception($message);
            }
        }

        // Check that they are the same
        if ($newPassword == $verifyPassword) {

            // Has the password and set it
            // $userData->user_activation_forgot = '';
            $userData->user_active = 1;
            $userData->password = Users::passwordHash($newPassword);

            // Update
            if ($userData->update()) {

                //log the user out of the site from all devices
                $session = new Sessions();
                $session->end($userData);

                $this->sendEmail($userData, 'reset');

                return $this->response(_('Congratulations! You\'ve successfully changed your password.'));
            } else {
                throw new Exception(current($userData->getMessages()));
            }
        } else {
            throw new Exception(_('Password are not the same'));
        }
    }

        /**
    * Set the email config array we are going to be sending.
    *
    * @param String $emailAction
    * @param Users  $user
    * @return void
    */
    protected function sendEmail(BakaUsers $user, string $type): void
    {
        $send = true;
        $subject = null;
        $body = null;
        switch ($type) {
            case 'recover':
                $recoveryLink = $this->config->app->frontEndUrl . '/users/reset-password/' . $user->user_activation_forgot;
                $subject = _('Password Recovery');
                $body = sprintf(_('Click %shere%s to set a new password for your account.'), '<a href="' . $recoveryLink . '" target="_blank">', '</a>');
                // send email to recover password
                break;
            case 'reset':
                $activationUrl = $this->config->app->frontEndUrl . '/user/activate/' . $user->user_activation_key;
                $subject = _('Reset Password');
                $body = sprintf(_('Hey '.$user->displayname .",\n".
                                  "Follow the link below to reset your password: %sReset Password%s." . PHP_EOL ."If you didn't request to reset your password, ignore and delete this email."), '<a href="' . $activationUrl . '">', '</a>');
                // send email that password was update
                break;
            case 'email-change':
                $emailChangeUrl = $this->config->app->frontEndUrl . '/user/' . $user->user_activation_email . '/email';
                $subject = _('Email Change Request');
                $body = sprintf(_('Click %shere%s to set a new email for your account.'), '<a href="' . $emailChangeUrl . '">', '</a>');
                break;
            default:
                $send = false;
                break;
        }

        if ($send) {
            $this->mail
            ->to('rwhite@mctekk.com')
            ->subject($subject)
            ->content($body)
            ->sendNow();
        }
    }
}
