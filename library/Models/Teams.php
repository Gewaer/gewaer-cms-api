<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Teams extends BaseModel
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
     * @var integer
     */
    public $organizations_id;

        /**
     * @var integer
     */
    public $leagues_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var datetime
     */
    public $founded_date;

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
        
        $this->setSource('teams');

        $this->belongsTo(
            'games_id',
            Games::class,
            'id',
            ['alias' => 'games']
        );

        $this->hasMany(
            'id',
            TournamentMatches::class,
            'team_a',
            ['alias' => 'matchesA']
        );

        $this->hasMany(
            'id',
            TournamentMatches::class,
            'team_b',
            ['alias' => 'matchesB']
        );

        $this->hasMany(
            'id',
            TournamentMatches::class,
            'winning_team',
            ['alias' => 'matchesWin']
        );



    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'teams';
    }

}
