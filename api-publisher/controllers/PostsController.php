<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Posts;
use Gewaer\Models\Teams;
use Gewaer\Models\UsersFollowingTags;
use Gewaer\Models\Organizations;
use Gewaer\Dto\PublisherPosts as PostDto;
use Gewaer\Mapper\PublisherPostMapper;
use Gewaer\Models\PostsLikes;
use Phalcon\Http\Response;
use Gewaer\Models\PostsTournamentMatches;
use Gewaer\Models\TournamentMatches;
use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class PostsController extends CanvasBaseController
{
    use ProcessOutputMapperTrait;
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
        $this->dto = PostDto::class;
        $this->dtoMapper = new PublisherPostMapper();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0'],
        ];
    }

    /**
     * Add or Remove a like from a post.
     *
     * @return Response
     * @throws Exception
     */
    public function like(int $id): Response
    {
        $request = $this->processInput($this->request->getPostData());
        $post = Posts::findFirstOrFail($id);

        $postLike = PostsLikes::findFirst([
            'conditions' => 'posts_id = ?0 and users_id = ?1 and is_deleted = 0',
            'bind' => [(int)$post->id, $this->userData->getId()]
        ]);

        //If posts like already exists then it counts as an unlike
        if ($postLike) {
            $post->likes_count = $post->likes_count != 0 ? $post->likes_count - 1 : 0;
            $post->updateOrFail();

            $postLike->is_deleted = 1;
            $postLike->updateOrFail();

            return $this->response($postLike);
        }

        $postLike = new PostsLikes();
        $postLike->posts_id = $id;
        $postLike->users_id = $this->userData->getId();
        $postLike->saveOrFail();

        $post->likes_count += 1;
        $post->updateOrFail();

        return $this->response($postLike);
    }

    /**
     * Get the current live post.
     * @return Response
     */
    public function getCurrentLivePost(): Response
    {
        $livePostArray = [];

        $livePost = $this->model::findFirst([
            'conditions' => 'is_live = 1',
            'order' => 'is_live DESC'
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
     * Process the input data.
     *
     * @param array $request
     * @return array
     */
    protected function processInput(array $request): array
    {
        //encode the attribute field from #teamfrontend
        if (!empty($request['attributes']) && is_array($request['attributes'])) {
            $request['attributes'] = json_encode($request['attributes']);
        }

        return $request;
    }

    /**
     * Retrieve all the posts related to the tags followed by the user
     *
     * @return void
     */
    public function getAllUsersTagsPosts(): Response
    {
        $postsArray = [];
        // Current user tags
        $userTags = UsersFollowingTags::findOrFail([
            'conditions'=> 'users_id = ?0',
            'bind'=>[$this->userData->getId()]
        ]);

        foreach ($userTags as $userTag) {
            $posts = Posts::getPostsByTagsId((int)$userTag->tags_id);
            foreach ($posts as $post) {
                $postsArray[] = $post;
            }
        }

        return $this->response($this->processOutput($postsArray));

    }
}
