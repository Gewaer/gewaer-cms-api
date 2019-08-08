<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddComments extends AbstractMigration
{
    public function change()
    {
        $this->table('comments', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_520_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'identity' => 'enable',
            ])
            ->addColumn('posts_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'id',
            ])
            ->addColumn('sites_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'posts_id',
            ])
            ->addColumn('users_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'sites_id',
            ])
            ->addColumn('content', 'text', [
                'null' => false,
                'limit' => 65535,
                'collation' => 'utf8mb4_unicode_520_ci',
                'encoding' => 'utf8mb4',
                'after' => 'users_id',
            ])
            ->addColumn('approved', 'boolean', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'content',
            ])
            ->addColumn('comment_parent_id', 'biginteger', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'approved',
            ])
            ->addColumn('users_ip', 'string', [
                'null' => true,
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_520_ci',
                'encoding' => 'utf8mb4',
                'after' => 'comment_parent_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'users_ip',
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true,
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'updated_at',
            ])
        ->addIndex(['posts_id'], [
                'name' => 'posts_id',
                'unique' => false,
            ])
        ->addIndex(['users_id'], [
                'name' => 'users_id',
                'unique' => false,
            ])
        ->addIndex(['created_at'], [
                'name' => 'created_at',
                'unique' => false,
            ])
        ->addIndex(['is_deleted'], [
                'name' => 'is_deleted',
                'unique' => false,
            ])
        ->addIndex(['approved'], [
                'name' => 'approved',
                'unique' => false,
            ])
        ->addIndex(['posts_id', 'sites_id'], [
                'name' => 'posts_id_sites_id',
                'unique' => false,
            ])
        ->addIndex(['sites_id'], [
                'name' => 'sites_id',
                'unique' => false,
            ])
            ->create();
    }
}
