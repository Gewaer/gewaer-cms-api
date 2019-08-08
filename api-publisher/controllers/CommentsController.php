<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Comments;
use Phalcon\Http\Response;
use Gewaer\Models\Posts;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class CommentsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = [
        'users_id',
        'posts_id',
        'content',
        'comment_parent_id'
    ];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = [
        'users_id',
        'posts_id',
        'content',
        'comment_parent_id'
    ];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Comments();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0'],
        ];
    }

    /**
     * Add a new comment to a post.
     *
     * @param integer $id
     * @return void
     */
    public function add(int $id): Response
    {
        $post = Posts::findFirstOrFail($id);

        $request = $this->request->getPostData();
        $request['posts_id'] = $post->getId();
        $request['users_id'] = $this->userData->getId();

        $this->model->saveOrFail($request, $this->createFields);

        return $this->response($this->processOutput($this->model));
    }
}
