<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\UsersController as CanvasUsersController;
use Gewaer\Models\Users;
use Gewaer\Dto\User as UserDto;
use Gewaer\Mapper\UserMapper;
use Phalcon\Http\Response;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Publisher\Controllers
 *
 */
class UsersController extends CanvasUsersController
{
    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Users();
        $this->dto = UserDto::class;
        $this->dtoMapper = new UserMapper();

        //if you are not a admin you cant see all the users
        if (!$this->userData->hasRole('Defaults.Admins')) {
            $this->additionalSearchFields = [
                ['id', ':', $this->userData->getId()],
            ];
        } else {
            //admin get all the users for this company
            $this->additionalSearchFields = [
                ['id', ':', implode('|', $this->userData->getDefaultCompany()->getAssociatedUsersByApp())],
            ];
        }
    }

    /**
     * Get Uer.
     *
     * @param mixed $id
     *
     * @method GET
     * @url /v1/users/{id}
     *
     * @return Response
     */
    public function getById($id) : Response
    {
        //none admin users can only edit themselves
        if (!$this->userData->hasRole('Default.Admins') || (int) $id === 0) {
            $id = $this->userData->getId();
        }

        /**
         * @todo filter only by user from this app / company
         */
        $user = $this->model->findFirstOrFail([
            'id = ?0 AND is_deleted = 0',
            'bind' => [$id],
        ]);
        $userObject = $user;

        //get the results and append its relationships
        $user = $this->appendRelationshipsToResult($this->request, $user);

        return $this->response($this->processOutput($user));
    }

}