<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\UsersFollowingTags;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class UsersFollowingTagsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['users_id','tags_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['users_id','tags_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new UsersFollowingTags();
        $this->model->created_at = date('Y-m-d H:i:s');

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
