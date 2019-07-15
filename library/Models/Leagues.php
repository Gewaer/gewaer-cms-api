<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Leagues extends BaseModel
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
    public $shortname;

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
        $this->setSource('leagues');

        $this->hasMany(
            'id',
            'Gewaer\Models\Teams',
            'leagues_id',
            ['alias' => 'leagues']
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
        return 'leagues';
    }

}
