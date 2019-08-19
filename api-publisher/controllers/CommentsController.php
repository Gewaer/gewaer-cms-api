<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Comments;
use Gewaer\Models\CommentsLikes;
use Phalcon\Http\Response;
use Gewaer\Models\Posts;
use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;
use Gewaer\Dto\Comments as CommentsDto;
use Gewaer\Mapper\CommentsMapper;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class CommentsController extends CanvasBaseController
{
    use ProcessOutputMapperTrait;

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
        $this->dto = CommentsDto::class;
        $this->dtoMapper = new CommentsMapper();

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
        $request['content'] = trim($request['content']);
        $this->model->posts_id = $post->getId();
        $this->model->users_id = $this->userData->getId();
        $this->model->sites_id = $this->site->getId();
        $this->model->users_ip = $this->request->getClientAddress();

        $this->model->saveOrFail($request, $this->createFields);

        return $this->response($this->processOutput($this->model));
    }

    /**
     * Delete a Record.
     * @throws Exception
     * @return Response
     */
    public function delete($id): Response
    {
        $record = $this->model::findFirstOrFail([
            'conditions' => 'id = ?0 and users_id = ?1 and is_deleted = 0',
            'bind' => [$id, $this->userData->getId()]
        ]);

        if ($record->softDelete()) {
            $post = Posts::findFirstOrFail($record->posts_id);
            $post->comment_count -= 1;
            $post->update();
        }

        return $this->response(['Delete Successfully']);
    }

        /**
     * Add or Remove a like from a post.
     *
     * @return Response
     * @throws Exception
     */
    public function like(int $id): Response
    {
        $comment = Comments::findFirstOrFail($id);

        $commentLike = CommentsLikes::findFirst([
            'conditions' => 'posts_id = ?0 and users_id = ?1 and comments_id = ?2 and is_deleted = 0',
            'bind' => [(int)$comment->posts_id, $this->userData->getId(),(int)$comment->id]
        ]);

        //If comments like already exists then it counts as an unlike
        if ($commentLike) {
            $comment->likes_count = $comment->likes_count != 0 ? $comment->likes_count - 1 : 0;
            $comment->updateOrFail();

            $commentLike->is_deleted = 1;
            $commentLike->updated_at = date('Y-m-d H:m:s');
            $commentLike->updateOrFail();

            return $this->response($commentLike);
        }

        $commentLike = new CommentsLikes();
        $commentLike->comments_id = $id;
        $commentLike->posts_id = $id;
        $commentLike->users_id = $this->userData->getId();
        $commentLike->created_at = date('Y-m-d H:m:s');
        $commentLike->is_deleted = 0;
        $commentLike->saveOrFail();

        $comment->likes_count += 1;
        $comment->updateOrFail();

        return $this->response($commentLike);
    }
}
