<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddCommentsLikes extends AbstractMigration
{
    public function change()
    {
        $this->table('posts', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('likes_count', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'media_url',
            ])
        ->changeColumn('post_parent_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'likes_count',
            ])
        ->changeColumn('shares_count', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'post_parent_id',
            ])
        ->changeColumn('views_count', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'shares_count',
            ])
        ->changeColumn('comment_count', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '1',
                'after' => 'views_count',
            ])
        ->changeColumn('comment_status', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '3',
                'after' => 'status',
            ])
        ->changeColumn('featured', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'is_published',
            ])
        ->changeColumn('weight', 'decimal', [
                'null' => false,
                'default' => '0.00',
                'precision' => '10',
                'scale' => '2',
                'after' => 'featured',
            ])
        ->changeColumn('premium', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'weight',
            ])
            ->addColumn('share_url', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
            ])
        ->changeColumn('media_source', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 32,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'share_url',
            ])
            ->removeColumn('shares_url')
        ->addIndex(['featured'], [
                'name' => 'featured',
                'unique' => false,
            ])
        ->addIndex(['weight'], [
                'name' => 'weight',
                'unique' => false,
            ])
        ->addIndex(['premium'], [
                'name' => 'premium',
                'unique' => false,
            ])
        ->addIndex(['comment_status'], [
                'name' => 'comment_status',
                'unique' => false,
            ])
            ->save();
        $this->table('teams', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('regions_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'third_party_id',
            ])
            ->save();
        $this->table('sources', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
        ->changeColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
        ->changeColumn('slug', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'title',
            ])
        ->changeColumn('logo', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'url',
            ])
        ->changeColumn('is_active', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'logo',
            ])
            ->save();
        $this->table('organizations', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('icon', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'logo',
            ])
        ->changeColumn('is_active', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '3',
                'after' => 'icon',
            ])
        ->changeColumn('metadata', 'text', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
            ])
            ->save();
        $this->table('tournament_matches', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('stages_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
        ->changeColumn('groups_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'stages_id',
            ])
        ->changeColumn('game_date', 'date', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'team_b',
            ])
        ->changeColumn('start_time', 'datetime', [
                'null' => false,
                'after' => 'game_date',
            ])
        ->changeColumn('end_time', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'start_time',
            ])
        ->changeColumn('is_tiebreaker', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'end_time',
            ])
        ->changeColumn('is_cancelled', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'is_tiebreaker',
            ])
        ->changeColumn('winning_team', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'is_cancelled',
            ])
        ->changeColumn('match_series_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'winning_team',
            ])
        ->changeColumn('team_a_score', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'match_series_id',
            ])
        ->changeColumn('team_b_score', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'team_a_score',
            ])
        ->changeColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'team_b_score',
            ])
        ->changeColumn('updated_at', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'created_at',
            ])
        ->changeColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
            ])
        ->changeColumn('duration', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_SMALL,
                'after' => 'is_deleted',
            ])
        ->changeColumn('third_party_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'duration',
            ])
        ->changeColumn('games_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_MEDIUM,
                'after' => 'third_party_id',
            ])
            ->save();
        $this->table('posts_shares', [
                'id' => false,
                'primary_key' => ['posts_id', 'users_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('shares_url', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
            ])
            ->save();
        $this->table('comments_likes', [
                'id' => false,
                'primary_key' => ['posts_id', 'users_id', 'comments_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_520_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('posts_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
            ])
            ->addColumn('users_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'posts_id',
            ])
            ->addColumn('comments_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'users_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'comments_id',
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '1',
                'after' => 'updated_at',
            ])
            ->create();
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
                'default' => 'NULL',
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
                'default' => 'NULL',
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'updated_at',
            ])
            ->addColumn('likes_count', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_MEDIUM,
                'after' => 'is_deleted',
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
