<?php
declare(strict_types=1);

namespace Gewaer\Models;

class UsersFollowingTags extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $users_id;

    /**
     *
     * @var integer
     */
    public $tags_id;

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
     * @var integer
     */
    public $is_deleted;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();

        $this->hasManyToMany(
            'id',
            Users::class,
            'users_id',
            'tags_id',
            Tags::class,
            'id',
            ['alias' => 'usersTags']
        );

        $this->belongsTo(
            'tags_id',
            Tags::class,
            'id',
            ['alias' => 'tags']
        );

        $this->setSource('users_following_tags');
    }

    /**
     * Process before creating a new item
     *
     * @return void
     */
    public function beforeCreate()
    {
        $this->created_at = date('Y-m-d H:i:s');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'users_following_tags';
    }
}
