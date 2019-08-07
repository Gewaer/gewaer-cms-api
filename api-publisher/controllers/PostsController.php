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
use Gewaer\Models\PostsTournamentMatches;
use Gewaer\Models\TournamentMatches;
use Gewaer\Models\Status;

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

        /**
         * @todo Find out why many to many relationships information does not work
         */
        $postMatch = PostsTournamentMatches::findFirst($livePost->id);

        if ($postMatch) {
            $tournamentMatch = TournamentMatches::findFirst($postMatch->id);
            if ($tournamentMatch) {
                $livePostArray['team_a'] = Teams::findFirst($tournamentMatch->team_a);
                $livePostArray['team_b'] = Teams::findFirst($tournamentMatch->team_b);
                $livePostArray['team_a_organization'] = Organizations::findFirst($livePostArray['team_a']->organizations_id);
                $livePostArray['team_b_organization'] = Organizations::findFirst($livePostArray['team_b']->organizations_id);
            };
    
            $livePostArray['match'] = $tournamentMatch;
        }
        return $this->response($livePostArray);
    }

    /**
     * Process the update request and return the object.
     *
     * @param Request $request
     * @param ModelInterface $record
     * @throws Exception
     * @return ModelInterface
     */
    protected function processEdit(Request $request, ModelInterface $record): ModelInterface
    {
        $post = parent::processEdit($request, $record);

        if ($post->status == Status::PUBLISHED) {
            $post->publish();
        }
        $request = $this->processInput($request->getPutData());

        $post->addTags($request['tags']);

        return $post;
    }

    /**
     * Process the create request and trecurd the boject.
     *
     * @return ModelInterface
     * @throws Exception
     */
    protected function processCreate(Request $request): ModelInterface
    {
        $post = parent::processCreate($request);

        if ($post->status == Status::PUBLISHED) {
            $post->publish();
        }
        $request = $this->processInput($request->getPostData());
        
        $post->addTags($request['tags']);

        return $post;
    }
}
