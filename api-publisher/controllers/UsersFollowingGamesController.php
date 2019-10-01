<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\UsersFollowingGames;
use Gewaer\Dto\UsersFollowingGames as UsersFollowingGamesDto;
use Gewaer\Mapper\UsersFollowingGamesMapper;
use Phalcon\Http\Response;
use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class UsersFollowingGamesController extends CanvasBaseController
{
    use ProcessOutputMapperTrait;
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['users_id', 'games_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['users_id', 'games_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new UsersFollowingGames();
        $this->dto = UsersFollowingGamesDto::class;
        $this->dtoMapper = new UsersFollowingGamesMapper();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }

    /**
     * Delete by users_id and games_id.
     *
     * @param int $usersId
     * @param int $gamesId
     * @return void
     */
    public function delete(int $usersId, int $gamesId): Response
    {
        $userTag = $this->model::findFirstOrFail([
            'conditions' => 'users_id = ?0 and games_id = ?1 and is_deleted = 0',
            'bind' => [$usersId, $gamesId]
        ]);

        $userTag->delete();

        return $this->response('Users Game Removed');
    }
}
