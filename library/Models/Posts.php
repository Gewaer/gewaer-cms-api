<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Baka\Support\Arr;
use Canvas\Traits\FileSystemModelTrait;
use Gewaer\Models\PostsTypes;
use Phalcon\Di;

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
     * @var string
     */
    public $media_source;

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
    public $shares_url;

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
     * @var json
     */
    public $metadata;

    /**
     * @var integer
     */
    public $is_published;

    /**
     * @var datetime
     */
    public $published_at;

    /**
     *
     * @var int
     */
    public $is_live;

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
            PostsTags::class,
            'posts_id',
            ['alias' => 'tags']
        );

        $this->hasMany(
            'id',
            PostsShares::class,
            'posts_id',
            ['alias' => 'shares']
        );

        $this->hasMany(
            'id',
            PostsLikes::class,
            'posts_id',
            ['alias' => 'likes']
        );

        $this->belongsTo(
            'post_types_id',
            PostsTypes::class,
            'id',
            ['alias' => 'types']
        );

        $this->hasManyToMany(
            'id',
            PostsTags::class,
            'posts_id',
            'tags_id',
            Tags::class,
            'id',
            ['alias' => 'tags']
        );

        $this->hasManyToMany(
            'id',
            PostsTournamentMatches::class,
            'posts_id',
            'tournament_matches_id',
            TournamentMatches::class,
            'id',
            ['alias' => 'postsMatches']
        );

        $this->hasMany(
            'id',
            PostsTags::class,
            'posts_id',
            ['alias' => 'postTags']
        );

        $this->hasMany(
            'id',
            Comments::class,
            'posts_id',
            ['alias' => 'comments']
        );

        $this->belongsTo(
            'users_id',
            Users::class,
            'id',
            ['alias' => 'user']
        );

        $this->belongsTo(
            'category_id',
            Categories::class,
            'id',
            ['alias' => 'category']
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
    public function publish(): void
    {
        $this->published_at = date('Y-m-d H:i:s');
        $this->is_published = 1;
    }

    /**
     * Get Media Source from Media Url.
     *
     * @param string $mediaUrl
     * @return void
     */
    public function setMediaSource(string $mediaUrl): void
    {
        $this->media_source = strpos($mediaUrl, 'youtube') ? 'youtube' : 'twitch';
    }

    /**
     * Events after save.
     *
     * @return void
     */
    public function afterCreate()
    {
        $this->associateFileSystem();
        $this->shares_url = Di::getDefault()->getConfig()->app->frontEndUrl . '/posts/' . $this->id;
        $this->update();
    }

    /**
     * Events after save.
     *
     * @return void
     */
    public function beforeSave()
    {
        if ($this->status == Status::PUBLISHED) {
            $this->publish();
        }

        if ($this->post_types_id == PostsTypes::VIDEO && isset($this->media_url)) {
            $this->setMediaSource($this->media_url);
        }
    }

    /**
     * Given an array of tags, add it to the specific post.
     *
     * @param array $tags
     * @return bool
     */
    public function addTags(array $tags): bool
    {
        if ($this->postTags) {
            $this->postTags->delete();
        }

        foreach ($tags as $tag) {
            /**
             * @todo check they exist
             */
            $postTag = new PostsTags();
            $postTag->posts_id = $this->getId();
            $postTag->tags_id = $tag;
            $postTag->saveOrFail();
        }

        return true;
    }
}
