<?php

declare(strict_types=1);

namespace Gewaer\Models;

class Status extends BaseModel
{
    const DRAFT = 1;
    const SCHEDULED = 2;
    const PUBLISHED = 3;
    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var datetime
     */
    public $created_at;

    /**
     *
     * @var datetime
     */
    public $updated_at;

    /**
     *
     * @var integer
     */
    public $is_deleted;

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'status';
    }

}