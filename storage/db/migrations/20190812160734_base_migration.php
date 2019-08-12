<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class BaseMigration extends AbstractMigration
{
    public function change()
    {
        $this->execute("ALTER DATABASE CHARACTER SET 'utf8mb4';");
        $this->execute("ALTER DATABASE COLLATE='utf8mb4_unicode_520_ci';");
        $this->table('tournament_groups_teams', [
                'id' => false,
                'primary_key' => ['groups_id', 'teams_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('groups_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('teams_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'groups_id',
            ])
            ->addColumn('wins', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'teams_id',
            ])
            ->addColumn('losses', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'wins',
            ])
            ->addColumn('draws', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'losses',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'draws',
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
        $this->table('games', [
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
            ->addColumn('name', 'string', [
                'null' => true,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->addColumn('title', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('slug', 'string', [
                'null' => true,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'title',
            ])
            ->addColumn('logo', 'string', [
                'null' => true,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'slug',
            ])
            ->addColumn('icon', 'string', [
                'null' => true,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'logo',
            ])
            ->addColumn('release_date', 'date', [
                'null' => true,
                'after' => 'icon',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'release_date',
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
        $this->table('tournament_seasons', [
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
            ->addColumn('games_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'games_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'name',
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
        $this->table('tags', [
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
                'limit' => '191',
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
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('sites_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'users_id',
            ])
            ->addColumn('companies_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'sites_id',
            ])
            ->addColumn('post_types_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'companies_id',
            ])
            ->addColumn('category_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'post_types_id',
            ])
            ->addColumn('title', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'category_id',
            ])
            ->addColumn('slug', 'string', [
                'null' => false,
                'limit' => 255,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'title',
            ])
            ->addColumn('summary', 'text', [
                'null' => false,
                'limit' => 65535,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'slug',
            ])
            ->addColumn('content', 'text', [
                'null' => false,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'summary',
            ])
            ->addColumn('media_url', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'content',
            ])
            ->addColumn('likes_count', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'media_url',
            ])
            ->addColumn('post_parent_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'likes_count',
            ])
            ->addColumn('shares_count', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'post_parent_id',
            ])
            ->addColumn('views_count', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'shares_count',
            ])
            ->addColumn('comment_count', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '1',
                'after' => 'views_count',
            ])
            ->addColumn('status', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '1',
                'after' => 'comment_count',
            ])
            ->addColumn('comment_status', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '3',
                'after' => 'status',
            ])
            ->addColumn('is_published', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'comment_status',
            ])
            ->addColumn('featured', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'is_published',
            ])
            ->addColumn('weight', 'decimal', [
                'null' => false,
                'default' => '0.00',
                'precision' => '10',
                'scale' => '2',
                'after' => 'featured',
            ])
            ->addColumn('premium', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'weight',
            ])
            ->addColumn('published_at', 'datetime', [
                'null' => true,
                'after' => 'premium',
            ])
            ->addColumn('is_live', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => '3',
                'after' => 'published_at',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'is_live',
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
            ->addColumn('share_url', 'string', [
                'null' => true,
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
            ])
            ->addColumn('media_source', 'string', [
                'null' => true,
                'limit' => 32,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'share_url',
            ])
            ->addColumn('author_name', 'string', [
                'null' => true,
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'media_source',
            ])
        ->addIndex(['is_published'], [
                'name' => 'is_published',
                'unique' => false,
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
        ->addIndex(['published_at'], [
                'name' => 'published_at',
                'unique' => false,
            ])
        ->addIndex(['is_deleted'], [
                'name' => 'is_deleted',
                'unique' => false,
            ])
        ->addIndex(['post_types_id'], [
                'name' => 'post_types_id',
                'unique' => false,
            ])
        ->addIndex(['category_id'], [
                'name' => 'category_id',
                'unique' => false,
            ])
        ->addIndex(['status'], [
                'name' => 'status',
                'unique' => false,
            ])
        ->addIndex(['comment_status'], [
                'name' => 'comment_status',
                'unique' => false,
            ])
        ->addIndex(['companies_id'], [
                'name' => 'companies_id',
                'unique' => false,
            ])
        ->addIndex(['companies_id', 'slug'], [
                'name' => 'companies_id_slug',
                'unique' => false,
            ])
        ->addIndex(['sites_id'], [
                'name' => 'sites_id',
                'unique' => false,
            ])
        ->addIndex(['sites_id', 'slug'], [
                'name' => 'sites_id_slug',
                'unique' => false,
            ])
            ->create();
        $this->table('tournament_seasons_versions', [
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
            ->addColumn('seasons_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('versions_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'seasons_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'versions_id',
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
        $this->table('regions', [
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
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->addColumn('slug', 'string', [
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
            ->addColumn('icon', 'string', [
                'null' => true,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'shortname',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'icon',
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
        $this->table('tournament_groups', [
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
            ->addColumn('versions_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('stages_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'versions_id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'stages_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'name',
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
        $this->table('tournament_match_series', [
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
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 32,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->addColumn('game_date', 'datetime', [
                'null' => false,
                'after' => 'name',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'game_date',
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
        $this->table('countries', [
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
            ->addColumn('regions_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'regions_id',
            ])
            ->addColumn('flag', 'string', [
                'null' => true,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'flag',
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
                'limit' => '191',
            ])
        ->addIndex(['sites_id'], [
                'name' => 'sites_id',
                'unique' => false,
            ])
            ->create();
        $this->table('tournament_teams', [
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
            ->addColumn('versions_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('teams_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'versions_id',
            ])
            ->addColumn('is_invited', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'teams_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'is_invited',
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
        $this->table('teams', [
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
            ->addColumn('games_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('organizations_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'games_id',
            ])
            ->addColumn('leagues_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'organizations_id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'leagues_id',
            ])
            ->addColumn('is_active', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '3',
                'after' => 'name',
            ])
            ->addColumn('founded_date', 'date', [
                'null' => true,
                'after' => 'is_active',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'founded_date',
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
            ->addColumn('third_party_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'is_deleted',
            ])
            ->addColumn('regions_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'third_party_id',
            ])
            ->create();
        $this->table('posts_tournament_matches', [
                'id' => false,
                'primary_key' => ['posts_id', 'tournament_matches_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('posts_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('tournament_matches_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'posts_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'tournament_matches_id',
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
        $this->table('posts_types', [
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
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'title',
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
        $this->table('tournament_types', [
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
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 32,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'name',
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
        $this->table('sources', [
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
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->addColumn('title', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('slug', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'title',
            ])
            ->addColumn('url', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'slug',
            ])
            ->addColumn('logo', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'url',
            ])
            ->addColumn('is_active', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'logo',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'is_active',
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
        $this->table('users_following_tags', [
                'id' => false,
                'primary_key' => ['users_id', 'tags_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('tags_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'users_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'tags_id',
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
        $this->table('organizations', [
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
            ->addColumn('countries_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'countries_id',
            ])
            ->addColumn('slug', 'string', [
                'null' => true,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('shortname', 'string', [
                'null' => true,
                'limit' => 16,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'slug',
            ])
            ->addColumn('logo', 'string', [
                'null' => true,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'shortname',
            ])
            ->addColumn('icon', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'logo',
            ])
            ->addColumn('is_active', 'integer', [
                'null' => true,
                'default' => '1',
                'limit' => '3',
                'after' => 'icon',
            ])
            ->addColumn('founded_date', 'date', [
                'null' => true,
                'after' => 'is_active',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'founded_date',
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
            ->addColumn('metadata', 'text', [
                'null' => true,
                'limit' => MysqlAdapter::TEXT_LONG,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
            ])
            ->create();
        $this->table('leagues', [
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
            ->addColumn('regions_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'regions_id',
            ])
            ->addColumn('shortname', 'string', [
                'null' => false,
                'limit' => 8,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('is_active', 'integer', [
                'null' => false,
                'limit' => '3',
                'after' => 'shortname',
            ])
            ->addColumn('founded_date', 'date', [
                'null' => false,
                'after' => 'is_active',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'founded_date',
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
        $this->table('tournament_matches', [
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
            ->addColumn('stages_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('groups_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'stages_id',
            ])
            ->addColumn('team_a', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'groups_id',
            ])
            ->addColumn('team_b', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'team_a',
            ])
            ->addColumn('game_date', 'date', [
                'null' => true,
                'after' => 'team_b',
            ])
            ->addColumn('start_time', 'datetime', [
                'null' => false,
                'after' => 'game_date',
            ])
            ->addColumn('end_time', 'datetime', [
                'null' => true,
                'after' => 'start_time',
            ])
            ->addColumn('is_tiebreaker', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'end_time',
            ])
            ->addColumn('is_cancelled', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'is_tiebreaker',
            ])
            ->addColumn('winning_team', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'is_cancelled',
            ])
            ->addColumn('match_series_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'winning_team',
            ])
            ->addColumn('team_a_score', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'match_series_id',
            ])
            ->addColumn('team_b_score', 'integer', [
                'null' => true,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'team_a_score',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'team_b_score',
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
            ->addColumn('duration', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_SMALL,
                'after' => 'is_deleted',
            ])
            ->addColumn('third_party_id', 'biginteger', [
                'null' => false,
                'limit' => MysqlAdapter::INT_BIG,
                'after' => 'duration',
            ])
            ->addColumn('games_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_MEDIUM,
                'after' => 'third_party_id',
            ])
            ->create();
        $this->table('currencies', [
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
            ->addColumn('seasons_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'seasons_id',
            ])
            ->addColumn('code', 'string', [
                'null' => true,
                'limit' => 8,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'code',
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
        $this->table('tournament_versions', [
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
            ->addColumn('series_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'series_id',
            ])
            ->addColumn('slug', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('start_date', 'date', [
                'null' => false,
                'after' => 'slug',
            ])
            ->addColumn('end_date', 'date', [
                'null' => false,
                'after' => 'start_date',
            ])
            ->addColumn('start_time', 'time', [
                'null' => false,
                'after' => 'end_date',
            ])
            ->addColumn('end_time', 'time', [
                'null' => false,
                'after' => 'start_time',
            ])
            ->addColumn('types_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'end_time',
            ])
            ->addColumn('prize_pool', 'decimal', [
                'null' => false,
                'precision' => '14',
                'scale' => '2',
                'after' => 'types_id',
            ])
            ->addColumn('currencies_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'prize_pool',
            ])
            ->addColumn('total_teams', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'currencies_id',
            ])
            ->addColumn('is_cancelled', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'total_teams',
            ])
            ->addColumn('is_published', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'is_cancelled',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'is_published',
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
        $this->table('users_following_teams', [
                'id' => false,
                'primary_key' => ['users_id', 'teams_id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('teams_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'users_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'teams_id',
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
        $this->table('tournament_series', [
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
            ->addColumn('games_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'games_id',
            ])
            ->addColumn('slug', 'string', [
                'null' => true,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'name',
            ])
            ->addColumn('founded_at', 'datetime', [
                'null' => false,
                'after' => 'slug',
            ])
            ->addColumn('is_active', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'founded_at',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'is_active',
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
        $this->table('tournament_stages', [
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
            ->addColumn('versions_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('name', 'string', [
                'null' => false,
                'limit' => 64,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'versions_id',
            ])
            ->addColumn('best_of', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'name',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'best_of',
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
        $this->table('tournament_matches_sources', [
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
            ->addColumn('matches_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('sources_id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'matches_id',
            ])
            ->addColumn('url', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'sources_id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'url',
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
        $this->table('posts_likes', [
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
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
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
                'after' => 'comments_id',
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true,
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '1',
                'after' => 'updated_at',
            ])
            ->create();
        $this->table('status', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_520_ci',
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
                'limit' => 50,
                'collation' => 'utf8mb4_unicode_520_ci',
                'encoding' => 'utf8mb4',
                'after' => 'id',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'title',
            ])
            ->addColumn('update_at', 'datetime', [
                'null' => true,
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'update_at',
            ])
            ->create();
        $this->table('sites', [
                'id' => false,
                'primary_key' => ['id'],
                'engine' => 'InnoDB',
                'encoding' => 'utf8mb4',
                'collation' => 'utf8mb4_unicode_520_ci',
                'comment' => '',
                'row_format' => 'DYNAMIC',
            ])
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('users_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('companies_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'users_id',
            ])
            ->addColumn('title', 'string', [
                'null' => false,
                'limit' => 200,
                'collation' => 'utf8mb4_unicode_520_ci',
                'encoding' => 'utf8mb4',
                'after' => 'companies_id',
            ])
            ->addColumn('key', 'string', [
                'null' => false,
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_520_ci',
                'encoding' => 'utf8mb4',
                'after' => 'title',
            ])
            ->addColumn('description', 'text', [
                'null' => true,
                'limit' => 65535,
                'collation' => 'utf8mb4_unicode_520_ci',
                'encoding' => 'utf8mb4',
                'after' => 'key',
            ])
            ->addColumn('domain', 'string', [
                'null' => true,
                'limit' => 200,
                'collation' => 'utf8mb4_unicode_520_ci',
                'encoding' => 'utf8mb4',
                'after' => 'description',
            ])
            ->addColumn('status', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'domain',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'status',
            ])
            ->addColumn('updated_at', 'datetime', [
                'null' => true,
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'boolean', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'updated_at',
            ])
        ->addIndex(['key'], [
                'name' => 'siteuuid',
                'unique' => true,
            ])
        ->addIndex(['companies_id'], [
                'name' => 'companies_id',
                'unique' => false,
            ])
        ->addIndex(['users_id'], [
                'name' => 'users_id',
                'unique' => false,
            ])
        ->addIndex(['status'], [
                'name' => 'status',
                'unique' => false,
            ])
        ->addIndex(['key'], [
                'name' => 'key',
                'unique' => false,
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
