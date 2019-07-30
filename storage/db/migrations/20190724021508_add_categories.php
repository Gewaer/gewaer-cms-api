<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddCategories extends AbstractMigration
{
    public function change()
    {
      
        $this->execute("ALTER TABLE `posts_tags`
        DROP COLUMN `id`,
        DROP PRIMARY KEY,
        ADD PRIMARY KEY (`posts_id`, `tags_id`);");

        $this->execute("ALTER TABLE `posts_shares`
        DROP COLUMN `id`,
        DROP PRIMARY KEY,
        ADD PRIMARY KEY (`posts_id`, `users_id`);");

        $this->execute("ALTER TABLE `posts_likes`
        DROP COLUMN `id`,
        DROP PRIMARY KEY,
        ADD PRIMARY KEY (`posts_id`, `users_id`);");

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
