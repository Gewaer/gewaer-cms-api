<?php

namespace Gewaer\Dto;

class Comments
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
    public $users;

    /**
     * @var integer
     */
    public $users_likes;

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

}