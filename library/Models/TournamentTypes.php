<?php
declare(strict_types=1);

namespace Gewaer\Models;

class TournamentTypes extends BaseModel
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

        $this->setSource('tournament_types');

        $this->hasMany(
            'id',
            TournamentVersions::class,
            'types_id',
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
        return 'tournament_types';
    }

}
