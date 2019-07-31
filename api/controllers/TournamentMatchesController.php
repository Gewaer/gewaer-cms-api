<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentMatches;
use Gewaer\Dto\TournamentMatches as TournamentMatchesDto;
use Gewaer\Mapper\TournamentMatchesMapper;

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
    protected $createFields = ['stages_id','groups_id','team_a','team_b','team_a_score','team_b_score','game_date','start_time','end_time','is_tiebreaker','is_cancelled','winning_team','match_series'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['stages_id','groups_id','team_a','team_b','team_a_score','team_b_score','game_date','start_time','end_time','is_tiebreaker','is_cancelled','winning_team','match_series'];

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
}
