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

        $this->hasManyToMany(
            'id',
            TournamentMatchesSources::class,
            'matches_id',
            'sources_id',
            Sources::class,
            'id',
            ['alias' => 'matchSources']
        );

        $this->belongsTo(
            'stages_id',
            TournamentStages::class,
            'id',
            ['alias' => 'stages']
        );

        $this->belongsTo(
            'groups_id',
            TournamentGroups::class,
            'id',
            ['alias' => 'groups']
        );

        $this->belongsTo(
            'match_series_id',
            TournamentMatchSeries::class,
            'id',
            ['alias' => 'matchSeries']
        );

        $this->belongsTo(
            'team_a',
            Teams::class,
            'id',
            ['alias' => 'teamA']
        );

        $this->belongsTo(
            'team_b',
            Teams::class,
            'id',
            ['alias' => 'teamB']
        );

        $this->belongsTo(
            'winning_team',
            Teams::class,
            'id',
            ['alias' => 'winningTeam']
        );

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
