<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Canvas\Models\Currencies;

class TournamentVersions extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $series_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var date
     */
    public $start_date;

    /**
     * @var date
     */
    public $end_date;

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
    public $types_id;

    /**
     * @var decimal
     */
    public $prize_pool;

    /**
     * @var integer
     */
    public $currencies_id;

    /**
     * @var integer
     */
    public $total_teams;

    /**
     * @var integer
     */
    public $is_cancelled;

    /**
     * @var integer
     */
    public $is_published;

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

        $this->setSource('tournament_versions');

        $this->hasMany(
            'id',
            TournamentStages::class,
            'versions_id',
            ['alias' => 'stages']
        );

        $this->hasMany(
            'id',
            TournamentGroups::class,
            'versions_id',
            ['alias' => 'groups']
        );

        $this->hasManyToMany(
            'id',
            TournamentTeams::class,
            'versions_id',
            'teams_id',
            Teams::class,
            'id',
            ['alias' => 'tournamentTeams']
        );

        $this->belongsTo(
            'types_id',
            TournamentTypes::class,
            'id',
            ['alias' => 'types']
        );

        $this->belongsTo(
            'series_id',
            TournamentSeries::class,
            'id',
            ['alias' => 'series']
        );

        $this->belongsTo(
            'currencies_id',
            Currencies::class,
            'id',
            ['alias' => 'currencies']
        );

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tournament_versions';
    }

}
