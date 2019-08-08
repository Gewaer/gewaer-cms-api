<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Updatetablesagain extends AbstractMigration
{
    public function change()
    {
        $this->table('games', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('name', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
        ->changeColumn('slug', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'title',
            ])
        ->changeColumn('release_date', 'date', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'icon',
            ])
            ->save();
        $this->table('posts', [
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
        ->changeColumn('likes_count', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'media_url',
            ])
        ->changeColumn('post_parent_id', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'likes_count',
            ])
        ->changeColumn('shares_count', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'post_parent_id',
            ])
        ->changeColumn('views_count', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'shares_count',
            ])
        ->changeColumn('comment_count', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '1',
                'after' => 'views_count',
            ])
        ->changeColumn('comment_status', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '3',
                'after' => 'status',
            ])
        ->changeColumn('featured', 'boolean', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'is_published',
            ])
        ->changeColumn('weight', 'decimal', [
                'null' => true,
                'default' => '0.00',
                'precision' => '10',
                'scale' => '2',
                'after' => 'featured',
            ])
        ->changeColumn('premium', 'boolean', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'weight',
            ])
            ->addColumn('is_live', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '3',
                'after' => 'published_at',
            ])
        ->changeColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'is_live',
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
            ->addColumn('media_source', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 32,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
            ])
            ->addColumn('shares_url', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'media_source',
            ])
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
        ->addIndex(['companies_id', 'slug'], [
                'name' => 'companies_id_slug',
                'unique' => false,
            ])
        ->addIndex(['sites_id', 'slug'], [
                'name' => 'sites_id_slug',
                'unique' => false,
            ])
            ->removeIndexByName("sluguniq")
            ->save();
        $this->table('regions', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('slug', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('shortname', 'string', [
                'null' => false,
                'limit' => 8,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'slug',
            ])
        ->changeColumn('icon', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'shortname',
            ])
        ->changeColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'icon',
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
            ->removeColumn('logo')
            ->removeColumn('release_date')
            ->save();
        $this->table('tournament_groups', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('versions_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
        ->changeColumn('stages_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'versions_id',
            ])
            ->save();
        $this->table('countries', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('regions_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
        ->changeColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'regions_id',
            ])
        ->changeColumn('flag', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
        ->changeColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'flag',
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
        ->changeColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
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
                'default' => 'NULL',
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
            ])
            ->removeColumn('summary')
            ->removeColumn('post_parent_id')
            ->removeColumn('shares_count')
            ->removeColumn('views_count')
        ->addIndex(['slug'], [
                'name' => 'slug',
                'unique' => false,
                'limit' => '191',
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
        ->changeColumn('organizations_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'games_id',
            ])
        ->changeColumn('leagues_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'organizations_id',
            ])
        ->changeColumn('is_active', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '3',
                'after' => 'name',
            ])
        ->changeColumn('founded_date', 'date', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'is_active',
            ])
            ->addColumn('third_party_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'is_deleted',
            ])
            ->addColumn('regions_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_SMALL,
                'after' => 'third_party_id',
            ])
            ->save();
        $this->table('tournament_types', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
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
                'limit' => MysqlAdapter::INT_MEDIUM,
            ])
        ->changeColumn('name', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
        ->changeColumn('slug', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'title',
            ])
        ->changeColumn('is_active', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '3',
                'after' => 'logo',
            ])
        ->changeColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'is_active',
            ])
        ->changeColumn('updated_at', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
            ])
            ->removeColumn('types_id')
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
        ->changeColumn('countries_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
        ->changeColumn('name', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'countries_id',
            ])
        ->changeColumn('slug', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
        ->changeColumn('shortname', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 16,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'slug',
            ])
        ->changeColumn('logo', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'shortname',
            ])
        ->changeColumn('icon', 'string', [
                'null' => false,
                'default' => '\'\'',
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'logo',
            ])
        ->changeColumn('is_active', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '3',
                'after' => 'icon',
            ])
        ->changeColumn('founded_date', 'date', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'is_active',
            ])
        ->changeColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'founded_date',
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
            ->addColumn('metadata', 'text', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8mb4_bin',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
            ])
            ->removeColumn('regions_id')
            ->removeIndexByName("posts_id")
            ->removeIndexByName("tags_id")
            ->removeIndexByName("posts_id_tags_id")
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
        ->changeColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
        ->changeColumn('stages_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
        ->changeColumn('team_b', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'team_a',
            ])
        ->changeColumn('start_time', 'datetime', [
                'null' => false,
                'after' => 'team_b',
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
        ->changeColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'match_series_id',
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
            ])
            ->addColumn('third_party_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'is_deleted',
            ])
            ->addColumn('games_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_MEDIUM,
                'after' => 'third_party_id',
            ])
        ->changeColumn('team_a_score', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'games_id',
            ])
        ->changeColumn('team_b_score', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'team_a_score',
            ])
            ->addColumn('duration', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_SMALL,
                'after' => 'team_b_score',
            ])
        ->changeColumn('game_date', 'date', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'duration',
            ])
            ->removeColumn('published_at')
            ->removeColumn('is_live')
            ->save();
        $this->table('currencies', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('code', 'string', [
                'null' => true,
                'default' => 'NULL',
                'limit' => 8,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->save();
        $this->table('tournament_versions', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('end_date', 'date', [
                'null' => false,
                'after' => 'start_date',
            ])
        ->changeColumn('end_time', 'time', [
                'null' => false,
                'after' => 'start_time',
            ])
        ->changeColumn('prize_pool', 'decimal', [
                'null' => false,
                'precision' => '14',
                'scale' => '2',
                'after' => 'types_id',
            ])
        ->changeColumn('total_teams', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'currencies_id',
            ])
            ->save();
        $this->table('tournament_series', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
        ->changeColumn('founded_at', 'datetime', [
                'null' => false,
                'after' => 'slug',
            ])
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
            ->addColumn('posts_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
            ])
            ->addColumn('tags_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'posts_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'tags_id',
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
            ])
        ->addIndex(['posts_id'], [
                'name' => 'posts_id',
                'unique' => false,
            ])
        ->addIndex(['tags_id'], [
                'name' => 'tags_id',
                'unique' => false,
            ])
        ->addIndex(['posts_id', 'tags_id'], [
                'name' => 'posts_id_tags_id',
                'unique' => false,
            ])
            ->create();
        $this->table('posts_shares', [
                'id' => false,
                'primary_key' => ['posts_id', 'users_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
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
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'users_id',
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
            ])
            ->addColumn('shares_url', 'string', [
                'null' => true,
                'default' => '\' \'',
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
            ])
        ->addIndex(['posts_id', 'users_id'], [
                'name' => 'posts_id_users_id',
                'unique' => false,
            ])
        ->addIndex(['posts_id'], [
                'name' => 'posts_id',
                'unique' => false,
            ])
        ->addIndex(['users_id'], [
                'name' => 'users_id',
                'unique' => false,
            ])
            ->create();
        $this->table('regions_countries')->drop()->save();
        $this->table('comments')->drop()->save();
    }
}
