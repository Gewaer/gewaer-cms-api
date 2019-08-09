<?php

namespace Gewaer\Dto;

class PostsLikes
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
     * @var integer
     */
    public $posts_likes_count;

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

}