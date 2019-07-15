<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Tags extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $slug;

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
        $this->setSource('tags');

        $this->hasMany(
            'id',
            'Gewaer\Models\PostsTags',
            'tags_id',
            ['alias' => 'postsTags']
        );
    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'tags';
    }

}
