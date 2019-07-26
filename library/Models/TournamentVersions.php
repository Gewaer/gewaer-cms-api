<?php
declare(strict_types=1);

namespace Gewaer\Models;

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
