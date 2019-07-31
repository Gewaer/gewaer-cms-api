<?php

namespace Gewaer\Dto;

class TournamentMatches
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $stages_id;

    /**
     * @var integer
     */
    public $groups_id;

    /**
     * @var integer
     */
    public $team_a;

    /**
     * @var integer
     */
    public $team_a_score;

    /**
     * @var integer
     */
    public $organization_team_a;

    /**
     * @var integer
     */
    public $team_b;

    /**
     * @var integer
     */
    public $team_b_score;

    /**
     * @var integer
     */
    public $organization_team_b;

        /**
     * @var date
     */
    public $game_date;

    /**
     * @var time
     */
    public $start_time;

    /**
     * @var time
     */
    public $end_time;

    /**
     * @var integer
     */
    public $is_tiebreaker;

    /**
     * @var integer
     */
    public $is_cancelled;

    /**
     * @var integer
     */
    public $winning_team;

    /**
     * @var integer
     */
    public $match_series_id;

    /**
     * @var integer
     */
    public $match_series;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $updated_at;

    /**
     * @var integer
     */
    public $is_deleted;

}