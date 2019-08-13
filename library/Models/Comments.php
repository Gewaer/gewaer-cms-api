<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Gewaer\Models\Posts;

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
            Posts::class,
            'id',
            ['alias' => 'posts']
        );

        $this->belongsTo(
            'comment_parent_id',
            Comments::class,
            'id',
            ['alias' => 'parent']
        );

        $this->belongsTo(
            'users_id',
            Users::class,
            'id',
            ['alias' => 'users']
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

    /**
     * Events after save.
     *
     * @return void
     */
    public function afterCreate()
    {
        $post = Posts::findFirst($this->posts_id);
        if ($post) {
            $post->comment_count += 1;
            $post->update();
        }
    }

}
