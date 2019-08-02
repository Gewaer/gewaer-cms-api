<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Posts;
use Gewaer\Models\Teams;
use Gewaer\Models\Organizations;
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
        $request = $this->processInput($this->request->getPostData());
        $post =  Posts::findFirstOrFail($id);

        $postLike = PostsLikes::findFirst([
            'conditions' => 'posts_id = ?0 and users_id = ?1 and is_deleted = 0',
            'bind'=>[(int)$post->id,$this->userData->getId()]
        ]);

        //If posts like already exists then it counts as an unlike
        if ($postLike) {
            $post->likes_count  = $post->likes_count != 0 ? $post->likes_count - 1 : 0;
            $post->updateOrFail();

            $postLike->is_deleted = 1;
            $postLike->updateOrFail();

            return $this->response($postLike);
        }

        $postLike =  new PostsLikes();
        $postLike->posts_id = $id;
        $postLike->users_id = 2;
        $postLike->saveOrFail();

        $post->likes_count += 1;
        $post->updateOrFail();

        return $this->response($postLike);
    }

    /**
     * Get the current live post
     * @return Response
     */
    public function getCurrentLivePost(): Response
    {
        $livePostArray = [];

        $livePost = $this->model::findFirst([
            'conditions'=> 'is_live = 1',
            'order'=>'is_live DESC'
        ]);

        $livePostArray['post'] = $livePost;

        $postMatch = $livePost->getPostsMatches();

        if ($postMatch) {
            $livePostArray['team_a'] = Teams::findFirst($postMatch->team_a);
            $livePostArray['team_b'] = Teams::findFirst($postMatch->team_b);
            $livePostArray['team_a_organization'] = Organizations::findFirst($livePostArray['team_a']->organizations_id);
            $livePostArray['team_b_organization'] = Organizations::findFirst($livePostArray['team_b']->organizations_id);
        };

        $livePostArray['match'] = $postMatch;

        return $this->response($livePostArray);
    }
}
