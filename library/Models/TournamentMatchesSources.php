<?php
declare(strict_types=1);

namespace Gewaer\Models;

class TournamentMatchesSources extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $matches_id;

    /**
     * @var integer
     */
    public $sources_id;

    /**
     * @var string
     */
    public $url;

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

        $this->setSource('tournament_matches_sources');

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tournament_matches_sources';
    }

}
