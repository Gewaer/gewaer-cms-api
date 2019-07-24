<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Posts;
use Gewaer\Dto\PublisherPosts as PostDto;
use Gewaer\Mapper\PublisherPostMapper;
use Gewaer\Models\PostsLikes;
use Phalcon\Http\Response;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class PostsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = [];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = [];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Posts();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0'],
        ];
    }

    /**
     * Format output.
     *
     * @param mixed $results
     * @return void
     */
    protected function processOutput($results)
    {
        //add a mapper
        $this->dtoConfig->registerMapping(Posts::class, PostDto::class)
            ->useCustomMapper(new PublisherPostMapper());

        if (is_array($results) && isset($results['data'])) {
            $results['data'] = $this->mapper->mapMultiple($results['data'], PostDto::class);
            return  $results;
        }

        return is_iterable($results) ?
            $this->mapper->mapMultiple($results, PostDto::class)
            : $this->mapper->map($results, PostDto::class);
    }

    /**
     * Add or Remove a like from a post
     *
     * @return Response
     * @throws Exception
     */
    public function like(int $id): Response
    {
        $post =  Posts::findFirstOrFail($id);

        //If posts like already exists then it counts as an unlike
        if ($postLike = PostsLikes::getByPostsId((int)$post->id)) {
            $post->likes_count  = $post->likes_count != 0 ? $post->likes_count - 1 : 0;
            $post->updateOrFail();

            $postLike->is_deleted = 1;
            $postLike->updateOrFail();

            return $this->response($postLike);
        }

        $postLike =  new PostsLikes();
        $postLike->posts_id = $id;
        $postLike->users_id = $this->userData->getId();
        $postLike->saveOrFail();

        $post->likes_count += 1;
        $post->updateOrFail();

        return $this->response($postLike);
    }
}
