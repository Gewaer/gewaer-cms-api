<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Regions extends BaseModel
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
    public $shortname;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $icon;

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
        $this->setSource('regions');

        $this->hasMany(
            'id',
            'Gewaer\Models\Countries',
            'regions_id',
            ['alias' => 'countries']
        );

        $this->hasMany(
            'id',
            'Gewaer\Models\Leagues',
            'regions_id',
            ['alias' => 'leagues']
        );

        $this->hasOne(
            'id',
            'Canvas\Models\Organizations',
            'regions_id',
            ['alias' => 'organizations']
        );
    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'regions';
    }

}
