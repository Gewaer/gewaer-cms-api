<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Rss extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $site;
    
     /**
     * @var string
     */
    public $url;

     /**
     * @var string
     */
    public $rss_url;

    /**
     * @var string
     */
    public $format;

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

        $this->setSource('rss');

    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'rss';
    }

}
