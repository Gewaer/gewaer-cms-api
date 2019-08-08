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
class PostsUsersController extends CanvasBaseController
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
            ['id', ':', implode('|', $this->getAllUsersTagsPosts())],
        ];
    }

    /**
     * Retrieve all the posts related to the tags followed by the user
     *
     * @return void
     */
    public function getAllUsersTagsPosts(): array
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

        return $postsArray;

    }
}
