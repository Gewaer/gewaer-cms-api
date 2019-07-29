<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentMatches;

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
    protected $createFields = ['stages_id','groups_id','team_a','team_b','game_date','start_time','end_time','is_tiebreaker','is_cancelled','winning_team','match_series'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['stages_id','groups_id','team_a','team_b','game_date','start_time','end_time','is_tiebreaker','is_cancelled','winning_team','match_series'];

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
}
