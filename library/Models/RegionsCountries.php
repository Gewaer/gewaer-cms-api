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
     * @var integer
     */
    public $regions_id;

    /**
     * @var integer
     */
    public $countries_id;

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
        
        $this->setSource('regions_countries');

        $this->belongsTo(
            'regions_id',
            Regions::class,
            'id',
            ['alias' => 'posts']
        );

        $this->belongsTo(
            'countries_id',
            Countries::class,
            'id',
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
        return 'regions_countries';
    }

}
