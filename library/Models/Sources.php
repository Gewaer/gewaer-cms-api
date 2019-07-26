<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Sources extends BaseModel
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
    public $url;

     /**
     * @var string
     */
    public $logo;

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
        parent::initialize();

        $this->setSource('sources');

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'sources';
    }

}
