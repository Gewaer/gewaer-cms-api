<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\UsersFollowingTags;
use Gewaer\Dto\UsersFollowingTags as UsersFollowingTagsDto;
use Gewaer\Mapper\UsersFollowingTagsMapper;
use Phalcon\Http\Response;
use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class UsersFollowingTagsController extends CanvasBaseController
{
    use ProcessOutputMapperTrait;
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['users_id', 'tags_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['users_id', 'tags_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new UsersFollowingTags();
        $this->model->created_at = date('Y-m-d H:i:s');
        $this->model->is_deleted = 0;
        $this->dto = UsersFollowingTagsDto::class;
        $this->dtoMapper = new UsersFollowingTagsMapper();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }

    /**
     * Delete by users_id and tags_id.
     *
     * @param int $usersId
     * @param int $tagsId
     * @return void
     */
    public function delete(int $usersId, int $tagsId): Response
    {
        $userTag = $this->model::findFirstOrFail([
            'conditions' => 'users_id = ?0 and tags_id = ?1 and is_deleted = 0',
            'bind' => [$usersId, $tagsId]
        ]);

        $userTag->delete();

        return $this->response('Users Tag Removed');
    }
}
