<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Phalcon\Di;

class CommentsLikes extends BaseModel
{
    /**
     * @var integer
     */
    public $comments_id;

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

        $this->setSource('comments_likes');

        $this->belongsTo(
            'posts_id',
            Posts::class,
            'id',
            ['alias' => 'posts']
        );

        $this->belongsTo(
            'comments_id',
            Comments::class,
            'id',
            ['alias' => 'comments']
        );

        $this->belongsTo(
            'users_id',
            Users::class,
            'id',
            ['alias' => 'users']
        );
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'comments_likes';
    }

    /**
     * Get the currents user's post like if it exists
     * @param int $commentsId
     * @return array
     */
    public static function getCurrentUsersCommentsLike(int $commentsId): array
    {
        $userPostLike = CommentsLikes::findFirst([
            'conditions'=>'comments_id = ?0 and users_id = ?1',
            'bind'=>[$commentsId,Di::getDefault()->get('userData')->getId()]
        ]);

        return $userPostLike ? $userPostLike->toArray() : [];
    }
}
