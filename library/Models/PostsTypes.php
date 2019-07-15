<?php
declare(strict_types=1);

namespace Gewaer\Models;

class PostsTypes extends BaseModel
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
        $this->setSource('posts_types');

        $this->hasMany(
            'id',
            'Gewaer\Models\Posts',
            'post_types_id',
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
        return 'posts_types';
    }

}
