<?php
declare(strict_types=1);

namespace Gewaer\Models;

class Comments extends BaseModel
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $posts_id;

    /**
     * @var integer
     */
    public $users_id;

    /**
     * @var string
     */
    public $content;

    /**
     * @var integer
     */
    public $approved;

    /**
     * @var integer
     */
    public $comment_parent_id;

    /**
     * @var string
     */
    public $users_ip;

    /**
     * @var integer
     */
    public $likes_count;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var string
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

        $this->setSource('comments');

        $this->belongsTo(
            'posts_id',
            Comments::class,
            'id',
            ['alias' => 'post']
        );

        $this->belongsTo(
            'comment_parent_id',
            Comments::class,
            'id',
            ['alias' => 'parent']
        );

        $this->hasMany(
            'id',
            Comments::class,
            'comment_parent_id',
            ['alias' => 'childs']
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'comments';
    }
}
