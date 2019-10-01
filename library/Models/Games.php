<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Games extends BaseModel
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
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $logo;

    /**
     * @var string
     */
    public $icon;

    /**
     * @var datetime
     */
    public $release_date;

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

        $this->setSource('games');

        $this->hasMany(
            'id',
            Teams::class,
            'games_id',
            ['alias' => 'teams']
        );

        $this->hasMany(
            'id',
            TournamentSeries::class,
            'games_id',
            ['alias' => 'series']
        );

        $this->hasMany(
            'id',
            Posts::class,
            'games_id',
            ['alias' => 'posts']
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'games';
    }
}
