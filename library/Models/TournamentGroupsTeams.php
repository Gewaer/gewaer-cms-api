<?php
declare(strict_types=1);

namespace Gewaer\Models;

class TournamentGroupsTeams extends BaseModel
{
    /**
     * @var integer
     */
    public $groups_id;

    /**
     * @var integer
     */
    public $teams_id;

    /**
     * @var integer
     */
    public $wins;

    /**
     * @var integer
     */
    public $losses;

    /**
     * @var integer
     */
    public $draws;

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

        $this->setSource('tournament_groups_teams');

        $this->belongsTo(
            'groups_id',
            TournamentGroups::class,
            'id',
            ['alias' => 'groups']
        );

        $this->belongsTo(
            'teams_id',
            Teams::class,
            'id',
            ['alias' => 'teams']
        );

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tournament_groups_teams';
    }

}
