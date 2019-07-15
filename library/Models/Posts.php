<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Baka\Support\Arr;
use Canvas\Traits\FileSystemModelTrait;

class Posts extends BaseModel
{
    use FileSystemModelTrait;

    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $sites_id;

    /**
     * @var integer
     */
    public $companies_id;

    /**
     * @var integer
     */
    public $users_id;

    /**
     * @var integer
     */
    public $post_types_id;

    /**
     * @var integer
     */
    public $category_id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $summary;

    /**
     * @var string
     */
    public $content;

    /**
     * @var string
     */
    public $media_url;

    /**
     * @var integer
     */
    public $likes_count;

    /**
     * @var integer
     */
    public $shares_count;

    /**
     * @var integer
     */
    public $post_parent_id;

    /**
     * @var integer
     */
    public $views_count;

    /**
     * @var integer
     */
    public $comment_count;

    /**
     * @var integer
     */
    public $status;

    /**
     * @var integer
     */
    public $featured;

    /**
     * @var integer
     */
    public $weight;

    /**
     * @var integer
     */
    public $premium;

    /**
     * @var integer
     */
    public $is_published;

    /**
     * @var datetime
     */
    public $published_at;

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
        
        $this->setSource('posts');

        $this->hasMany(
            'id',
            'Gewaer\Models\PostsTags',
            'posts_id',
            ['alias' => 'postsTags']
        );

        $this->hasMany(
            'id',
            'Gewaer\Models\PostsShares',
            'posts_id',
            ['alias' => 'postsShares']
        );

        $this->hasMany(
            'id',
            'Gewaer\Models\PostsLikes',
            'posts_id',
            ['alias' => 'postsLikes']
        );

        $this->belongsTo(
            'post_types_id',
            'Canvas\Models\PostsTypes',
            'id',
            ['alias' => 'postsTypes']
        );
    }
    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'posts';
    }
    
    /**
     *
     *
     * @return bool
     */
    public function publish(): bool
    {
        $this->status = Status::PUBLISHED;
        $this->published_at = date('Y-m-d H:i:s');

        return $this->updateOrFail();
    }

    /**
     * Events after save
     * 
     * @return void
     */
    public function afterSave()
    {
        $this->associateFileSystem();
    }

}
