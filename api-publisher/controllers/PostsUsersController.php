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
            ['id', ':', implode('|', Posts::getAllUsersTagsPosts())],
        ];
    }

     /**
     * body of the index function to simply extending methods.
     *
     * @return void
     */
    protected function processIndex()
    {
        //conver the request to sql
        $processedRequest = $this->processRequest($this->request);
        $records = $this->getRecords($processedRequest);

        //get the results and append its relationships
        $results = $this->appendRelationshipsToResult($this->request, $records['results']);

        //this means the want the response in a vuejs format
        if ($this->request->hasQuery('format')) {
            $limit = (int) $this->request->getQuery('limit', 'int', 25);

            $results = [
                'data' => $results,
                'limit' => $limit,
                'page' => $this->request->getQuery('page', 'int', 1),
                'total_pages' => ceil($records['total'] / $limit),
            ];
        }

        return empty(implode('|', Posts::getAllUsersTagsPosts())) ? [] : $this->processOutput($results);
    }
}
