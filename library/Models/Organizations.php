<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Organizations extends BaseModel
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
     * @var integer
     */
    public $countries_id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $shortname;

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
        $this->setSource('organizations');

        $this->hasOne(
            'id',
            Teams::class,
            'organizations_id',
            ['alias' => 'teams']
        );

        $this->belongsTo(
            'countries_id',
            Countries::class,
            'id',
            ['alias' => 'countries']
        );

        $this->belongsTo(
            'regions_id',
            Regions::class,
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
        return 'organizations';
    }

}
