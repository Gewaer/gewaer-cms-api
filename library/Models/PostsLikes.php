<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Phalcon\Di;

class PostsLikes extends BaseModel
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

        $this->setSource('posts_likes');

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
        return 'posts_likes';
    }

    /**
     * Get Posts Like by posts id
     * @param int $postsId
     */
    public static function getByPostsId(int $postsId)
    {
        return PostsLikes::findFirst([
            'conditions'=>'posts_id = ?0 and users_id = ?1 and is_deleted = 0',
            'bind'=>[$postsId,Di::getDefault()->get('userData')->getId()]
        ]);
    }

    /**
     * Get a group of records by posts_id
     * @param int $postsId
     * @return array
     */
    public static function getAllByPostId(int $postsId): array
    {
        $postLikes = PostsLikes::find([
            'conditions'=>'posts_id = ?0 and is_deleted = 0',
            'bind'=>[$postsId]
        ]);

        return $postLikes ? $postLikes->toArray() : [];
    }
}
