<?php
declare(strict_types=1);

namespace Gewaer\Models;

class TournamentMatchSeries extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var date
     */
    public $game_date;

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

        $this->setSource('tournament_match_series');

        $this->hasMany(
            'id',
            TournamentMatches::class,
            'match_series_id',
            ['alias' => 'matches']
        );

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tournament_match_series';
    }

}
