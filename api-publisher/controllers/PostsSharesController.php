<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\PostsShares;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class PostsSharesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['posts_id','users_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['posts_id','users_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new PostsShares();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
