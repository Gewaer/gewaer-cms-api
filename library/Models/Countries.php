<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Countries extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $regions_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $flag;

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
        $this->setSource('countries');

        $this->hasMany(
            'id',
            'Gewaer\Models\Organizations',
            'countries_id',
            ['alias' => 'organizations']
        );

        $this->belongsTo(
            'regions_id',
            'Canvas\Models\Regions',
            'id',
            ['alias' => 'regions']
        );
    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'countries';
    }

}
