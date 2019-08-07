<?php

namespace Gewaer\Dto;

class Posts
{
    /**
     *
     * @var int
     */
    public $id;

    /**
     *
     * @var int
     */
    public $companies_id;

    /**
     *
     * @var object
     */
    public $user;

    /**
     *
     * @var string
     */
    public $sites_id;

    /**
     *
     * @var object
     */
    public $post_types_id;

    /**
     *
     * @var
     */
    public $category_id;

    /**
     *
     * @var string
     */
    public $title;

    /**
     *
     * @var string
     */
    public $slug;

    /**
     *
     * @var string
     */
    public $summary;

    /**
     *
     * @var string
     */
    public $content;

    /**
     *
     * @var array
     */
    public $tags;

    /**
     *
     * @var array
     */
    public $files;

    /**
     *
     * @var string
     */
    public $media_url;

    /**
     * @var string
     */
    public $media_source;

    /**
     *
     * @var int
     */
    public $likes_count;

    /**
     *
     * @var array
     */
    public $users_likes;

    /**
     *
     * @var int
     */
    public $post_parent_id;

    /**
     *
     * @var int
     */
    public $shares_count;

    /**
     *
     * @var int
     */
    public $shares_url;


    /**
     *
     * @var int
     */
    public $views_count;

    /**
     *
     * @var int
     */
    public $comment_count;

    /**
     *
     * @var int
     */
    public $status;

    /**
     *
     * @var int
     */
    public $comment_status;

    /**
     *
     * @var int
     */
    public $is_published;

    /**
     *
     * @var int
     */
    public $featured;

    /**
     *
     * @var int
     */
    public $weight;

    /**
     *
     * @var int
     */
    public $premium;

    /**
     *
     * @var string
     */
    public $published_at;

    /**
     *
     * @var int
     */
    public $is_live;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     *
     * @var string
     */
    public $is_deleted;
}
