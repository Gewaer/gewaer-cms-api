<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class Updatetables extends AbstractMigration
{
    public function change()
    {
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
        ->addIndex(['slug'], [
                'name' => 'slug',
                'unique' => false,
                'limit' => '191',
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
        ->changeColumn('published_at', 'datetime', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'premium',
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
        ->addIndex(['published_at'], [
                'name' => 'published_at',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
        ->addIndex(['slug'], [
                'name' => 'slug',
                'unique' => false,
                'limit' => '191',
            ])
            ->save();
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'limit' => MysqlAdapter::INT_MEDIUM,
            ])
            ->addColumn('name', 'string', [
                'null' => true,
                'default' => 'NULL',
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
                'null' => true,
                'default' => 'NULL',
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
                'null' => true,
                'default' => 'NULL',
                'limit' => 128,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'url',
            ])
            ->addColumn('is_active', 'integer', [
                'null' => false,
                'default' => '1',
                'limit' => '3',
                'after' => 'logo',
            ])
            ->addColumn('created_at', 'datetime', [
                'null' => false,
                'after' => 'is_active',
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
                'default' => 'NULL',
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
            ->addColumn('id', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_REGULAR,
                'identity' => 'enable',
            ])
            ->addColumn('stages_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
            ->addColumn('groups_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
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
            ->addColumn('start_time', 'datetime', [
                'null' => false,
                'after' => 'team_b',
            ])
            ->addColumn('end_time', 'datetime', [
                'null' => true,
                'default' => 'NULL',
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
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'is_cancelled',
            ])
            ->addColumn('match_series_id', 'integer', [
                'null' => true,
                'default' => 'NULL',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'winning_team',
            ])
            ->addColumn('created_at', 'datetime', [
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
            ->addColumn('team_a_score', 'integer', [
                'null' => false,
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'games_id',
            ])
            ->addColumn('team_b_score', 'integer', [
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
            ->addColumn('game_date', 'date', [
                'null' => true,
                'default' => 'NULL',
                'after' => 'duration',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
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
                'default' => 'NULL',
                'after' => 'created_at',
            ])
            ->addColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '3',
                'after' => 'updated_at',
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
            ->addColumn('shares_url', 'string', [
                'null' => true,
                'default' => '\' \'',
                'limit' => 100,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'is_deleted',
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
        ->changeColumn('is_deleted', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_TINY,
                'after' => 'update_at',
            ])
            ->save();
        $this->table('regions_countries')->drop()->save();
    }
}
