<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Sites extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $users_id;

    /**
     * @var integer
     */
    public $companies_id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $key;

    /**
     * @var string
     */
    public $description;

    /**
     * @var string
     */
    public $domain;

    /**
     * @var integer
     */
    public $status;
    
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

        $this->setSource('sites');

        $this->belongsTo(
            'users_id',
            Users::class,
            'id',
            ['alias' => 'user']
        );
    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'sites';
    }

}
