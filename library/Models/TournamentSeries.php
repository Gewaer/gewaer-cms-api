<?php
declare(strict_types=1);

namespace Gewaer\Models;

class TournamentSeries extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $games_id;

    /**
     * @var string
     */
    public $name;

     /**
     * @var string
     */
    public $slug;

    /**
     * @var datetime
     */
    public $founded_at;

    /**
     * @var integer
     */
    public $is_active;


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

        $this->setSource('tournament_series');

        $this->hasMany(
            'id',
            TournamentVersions::class,
            'series_id',
            ['alias' => 'versions']
        );

        $this->belongsTo(
            'games_id',
            Games::class,
            'id',
            ['alias' => 'games']
        );

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tournament_series';
    }

}
