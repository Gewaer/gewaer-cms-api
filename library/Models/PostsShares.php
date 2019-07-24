<?php
declare(strict_types=1);

namespace Gewaer\Models;

class PostsShares extends BaseModel
{
    /**
     * @var integer
     */
    public $posts_id;

    /**
     * @var integer
     */
    public $users_id;

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

        $this->setSource('posts_shares');

        $this->belongsTo(
            'posts_id',
            Posts::class,
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
        return 'posts_shares';
    }
}
