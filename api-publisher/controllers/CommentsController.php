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
        'content',
        'approved',
        'comment_parent_id'
    ];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = [
        'content',
        'approved',
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
            ['sites_id', ':', $this->site->getId()],
        ];
    }

    /**
     * Add a new comment to a post.
     *
     * @throws Exception
     * @param integer $id
     * @return void
     */
    public function add(int $id): Response
    {
        $post = Posts::findFirstOrFail($id);

        $request = $this->request->getPostData();
        $this->model->posts_id = $post->getId();
        $this->model->users_id = $this->userData->getId();
        $this->model->sites_id = $this->site->getId();
        $this->model->users_ip = $this->request->getClientAddress();

        $this->model->saveOrFail($request, $this->createFields);

        return $this->response($this->processOutput($this->model));
    }

    /**
     * Delete a Record.
     *
     * @throws Exception
     * @return Response
     */
    public function delete($id): Response
    {
        $record = $this->model::findFirstOrFail([
            'conditions' => 'id = ?0 and users_id = ?1',
            'bind' => [$id, $this->userData->getId()]
        ]);

        $record->softDelete();

        return $this->response(['Delete Successfully']);
    }
}
