<?php
declare(strict_types=1);

namespace Gewaer\Models;

class TournamentTeams extends BaseModel
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
    public $teams_id;

    /**
     * @var integer
     */
    public $is_invited;


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

        $this->setSource('tournament_teams');

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tournament_teams';
    }

}
