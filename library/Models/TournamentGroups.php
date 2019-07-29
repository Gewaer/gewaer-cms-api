<?php
declare(strict_types=1);

namespace Gewaer\Models;

class TournamentGroups extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $versions_id;

    /**
     * @var integer
     */
    public $stages_id;

    /**
     * @var string
     */
    public $name;

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

        $this->setSource('tournament_groups');

        $this->hasMany(
            'id',
            TournamentMatches::class,
            'groups_id',
            ['alias' => 'matches']
        );

        $this->hasMany(
            'id',
            TournamentGroupsTeams::class,
            'groups_id',
            ['alias' => 'groupsTeams']
        );

        $this->belongsTo(
            'versions_id',
            TournamentVersions::class,
            'id',
            ['alias' => 'versions']
        );

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tournament_groups';
    }

}
