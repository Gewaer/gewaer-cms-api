<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddCategories extends AbstractMigration
{
    public function change()
    {
        $this->table('posts_shares', [
            'id' => false,
            'primary_key' => ['posts_id', 'users_id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '',
            'row_format' => 'DYNAMIC',
        ])
        ->changeColumn('posts_id', 'integer', [
            'null' => false,
            'limit' => MysqlAdapter::INT_REGULAR,
        ])
        ->changeColumn('users_id', 'integer', [
            'null' => false,
            'limit' => MysqlAdapter::INT_REGULAR,
            'after' => 'posts_id',
        ])
        ->changeColumn('created_at', 'datetime', [
            'null' => false,
            'after' => 'users_id',
        ])
        ->changeColumn('updated_at', 'datetime', [
            'null' => true,
            'after' => 'created_at',
        ])
        ->changeColumn('is_deleted', 'integer', [
            'null' => false,
            'default' => '0',
            'limit' => '3',
            'after' => 'updated_at',
        ])
            ->removeColumn('id')
            ->save();

        $this->table('posts_tags', [
            'id' => false,
            'primary_key' => ['posts_id', 'tags_id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '',
            'row_format' => 'DYNAMIC',
        ])
        ->changeColumn('posts_id', 'integer', [
            'null' => false,
            'limit' => MysqlAdapter::INT_REGULAR,
        ])
        ->changeColumn('tags_id', 'integer', [
            'null' => false,
            'limit' => MysqlAdapter::INT_REGULAR,
            'after' => 'posts_id',
        ])
        ->changeColumn('created_at', 'datetime', [
            'null' => false,
            'after' => 'tags_id',
        ])
        ->changeColumn('updated_at', 'datetime', [
            'null' => true,
            'after' => 'created_at',
        ])
        ->changeColumn('is_deleted', 'integer', [
            'null' => false,
            'default' => '0',
            'limit' => '3',
            'after' => 'updated_at',
        ])
            ->removeColumn('id')
            ->save();
        $this->table('categories', [
            'id' => false,
            'primary_key' => ['id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '',
            'row_format' => 'DYNAMIC',
        ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('title', 'string', [
                'null' => false,
                'limit' => 200,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->addColumn('sites_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'title',
            ])
            ->addColumn('slug', 'string', [
                'null' => false,
                'limit' => 200,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'sites_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'slug',
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true,

                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
            ])
        ->addIndex(['slug'], [
            'name' => 'slug',
            'unique' => false,
        ])
        ->addIndex(['sites_id'], [
            'name' => 'sites_id',
            'unique' => false,
        ])
            ->create();

        $this->table('posts', [
            'id' => false,
            'primary_key' => ['id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '',
            'row_format' => 'DYNAMIC',
        ])
        ->changeColumn('id', 'biginteger', [
            'null' => false,
            'limit' => MysqlAdapter::INT_BIG,
            'identity' => 'enable',
        ])
        ->changeColumn('slug', 'string', [
            'null' => false,
            'limit' => 255,
            'collation' => 'utf8mb4_unicode_ci',
            'encoding' => 'utf8mb4',
            'after' => 'title',
        ])
        ->changeColumn('post_parent_id', 'biginteger', [
            'null' => false,
            'default' => '0',
            'limit' => MysqlAdapter::INT_BIG,
            'after' => 'likes_count',
        ])
        ->addIndex(['sites_id', 'slug'], [
            'name' => 'sluguniq',
            'unique' => true,
        ])
            ->removeIndexByName('slug')
            ->save();
        $this->table('posts_likes', [
            'id' => false,
            'primary_key' => ['posts_id', 'users_id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'comment' => '',
            'row_format' => 'DYNAMIC',
        ])
        ->changeColumn('posts_id', 'integer', [
            'null' => false,
            'limit' => MysqlAdapter::INT_REGULAR,
        ])
        ->changeColumn('users_id', 'integer', [
            'null' => false,
            'limit' => MysqlAdapter::INT_REGULAR,
            'after' => 'posts_id',
        ])
        ->changeColumn('created_at', 'datetime', [
            'null' => false,
            'after' => 'users_id',
        ])
        ->changeColumn('updated_at', 'datetime', [
            'null' => true,
            'after' => 'created_at',
        ])
        ->changeColumn('is_deleted', 'integer', [
            'null' => false,
            'default' => '0',
            'limit' => '3',
            'after' => 'updated_at',
        ])
            ->removeColumn('id')
            ->save();

        $this->table('status', [
            'id' => false,
            'primary_key' => ['id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_520_ci',
            'comment' => '',
            'row_format' => 'DYNAMIC',
        ])
        ->changeColumn('title', 'string', [
            'null' => false,
            'limit' => 50,
            'collation' => 'utf8mb4_unicode_520_ci',
            'encoding' => 'utf8mb4',
            'after' => 'id',
        ])
            ->save();
        $this->table('sites', [
            'id' => false,
            'primary_key' => ['id'],
            'engine' => 'InnoDB',
            'encoding' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_520_ci',
            'comment' => '',
            'row_format' => 'DYNAMIC',
        ])
        ->changeColumn('title', 'string', [
            'null' => false,
            'limit' => 200,
            'collation' => 'utf8mb4_unicode_520_ci',
            'encoding' => 'utf8mb4',
            'after' => 'companies_id',
        ])
        ->changeColumn('description', 'text', [
            'null' => true,
            'limit' => 65535,
            'collation' => 'utf8mb4_unicode_520_ci',
            'encoding' => 'utf8mb4',
            'after' => 'key',
        ])
        ->changeColumn('domain', 'string', [
            'null' => true,
            'limit' => 200,
            'collation' => 'utf8mb4_unicode_520_ci',
            'encoding' => 'utf8mb4',
            'after' => 'description',
        ])
        ->changeColumn('updated_at', 'datetime', [
            'null' => true,
            'after' => 'created_at',
        ])
            ->save();
    }
}
