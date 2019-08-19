<?php
declare(strict_types=1);

namespace Gewaer\Models;

use Canvas\Models\Users as CanvasUsers;

/**
 * Class Users.
 *
 * @package Canvas\Models
 *
 * @property Users $user
 * @property Config $config
 * @property Apps $app
 * @property Companies $defaultCompany
 * @property \Phalcon\Di $di
 */
class Users extends CanvasUsers
{
    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();

        $this->hasMany(
            'id',
            UsersFollowingTags::class,
            'users_id',
            ['alias' => 'userFollowingTags']
        );

        $this->hasMany(
            'id',
            Comments::class,
            'users_id',
            ['alias' => 'comments']
        );

        $this->hasManyToMany(
            'id',
            UsersFollowingTags::class,
            'users_id',
            'tags_id',
            Tags::class,
            'id',
            ['alias' => 'tags']
        );

        $this->hasMany(
            'id',
            Posts::class,
            'author_id',
            ['alias' => 'authorPosts']
        );

        $this->hasMany(
            'id',
            Posts::class,
            'collaborator_id',
            ['alias' => 'collaboratorPosts']
        );
    }
}
