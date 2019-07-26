<?php
declare(strict_types=1);

namespace Gewaer\Models;

class TournamentMatches extends BaseModel
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
    public $team_b;

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

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();

        $this->setSource('tournament_matches');

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tournament_matches';
    }

}
