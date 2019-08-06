<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentMatches;
use Gewaer\Dto\TournamentMatches as TournamentMatchesDto;
use Gewaer\Mapper\TournamentMatchesMapper;
use Phalcon\Mvc\ModelInterface;
use Canvas\Http\Request;
use Gewaer\Models\Teams;
use Phalcon\Http\Response;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentMatchesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['third_party_id','games_id','stages_id','groups_id','team_a','team_b','team_a_score','team_b_score','game_date','start_time','end_time','is_tiebreaker','is_cancelled','winning_team','match_series_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['third_party_id','games_id','stages_id','groups_id','team_a','team_b','team_a_score','team_b_score','game_date','start_time','end_time','is_tiebreaker','is_cancelled','winning_team','match_series_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentMatches();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
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
        $this->dtoConfig->registerMapping(TournamentMatches::class, TournamentMatchesDto::class)
            ->useCustomMapper(new TournamentMatchesMapper());

        if (is_array($results) && isset($results['data'])) {
            $results['data'] = $this->mapper->mapMultiple($results['data'], TournamentMatchesDto::class);
            return  $results;
        }

        return is_iterable($results) ?
            $this->mapper->mapMultiple($results, TournamentMatchesDto::class)
            : $this->mapper->map($results, TournamentMatchesDto::class);
    }

    /**
     * Update a record.
     *
     * @param mixed $id
     * @return Response
     */
    public function edit($id): Response
    {
        $record = $this->model::findFirstOrFail([
            'conditions' => $this->model->getPrimaryKey() . '= ?0',
            'bind' => [$id]
        ]);

        //process the input
        $result = $this->processEdit($this->request, $record);

        return $this->response($this->processOutput($result));
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
        $request = $this->processInput($request->getPutData());

        $teamA = Teams::findFirst([
            'conditions'=> 'third_party_id = ?0 and games_id = ?1 and is_deleted = 0',
            'bind'=>[$request['team_a'],$request['games_id']]
        ]);

        $teamB = Teams::findFirst([
            'conditions'=> 'third_party_id = ?0 and games_id = ?1 and is_deleted = 0',
            'bind'=>[$request['team_b'],$request['games_id']]
        ]);

        if ($teamA) {
            $request['team_a'] = $teamA->id;
        }

        if ($teamB) {
            $request['team_b'] = $teamB->id;
        }

        if (!strpos($request['start_time'], ':')) {
            $request['start_time'] = date('Y-m-d H:m:s', (int)$request['start_time']);
        }

        if (!strpos($request['end_time'], ':')) {
            $request['end_time'] = date('Y-m-d H:m:s', (int)$request['end_time']);
        }

        $record->updateOrFail($request, $this->updateFields);

        return $record;
    }

    /**
     * Process the create request and trecurd the boject.
     *
     * @return ModelInterface
     * @throws Exception
     */
    protected function processCreate(Request $request): ModelInterface
    {
        date_default_timezone_set('UTC');
        $request = $this->processInput($request->getPostData());

        //find internal team on our database based on the team_a

        $teamA = Teams::findFirst([
            'conditions'=> 'third_party_id = ?0 and games_id = ?1 and is_deleted = 0',
            'bind'=>[$request['team_a'],$request['games_id']]
        ]);

        $teamB = Teams::findFirst([
            'conditions'=> 'third_party_id = ?0 and games_id = ?1 and is_deleted = 0',
            'bind'=>[$request['team_b'],$request['games_id']]
        ]);

        if ($teamA) {
            $request['team_a'] = $teamA->id;
        }

        if ($teamB) {
            $request['team_b'] = $teamB->id;
        }

        if (!strpos($request['start_time'], ':')) {
            $request['start_time'] = date('Y-m-d H:m:s', (int)$request['start_time']);
        }

        if (!strpos($request['end_time'], ':')) {
            $request['end_time'] = date('Y-m-d H:m:s', (int)$request['end_time']);
        }

        $this->model->saveOrFail($request, $this->createFields);

        return $this->model;
    }
}
