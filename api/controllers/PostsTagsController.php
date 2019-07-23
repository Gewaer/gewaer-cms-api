<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\PostsTags;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class PostsTagsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['posts_id','tags_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['posts_id','tags_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new PostsTags();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
