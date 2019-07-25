<?php
use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddTournaments extends AbstractMigration
{
    public function change()
    {
        /**
         * Tournament Types
         */
        $table = $this->table('tournament_types', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 32, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'name'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Teams
         */
        $table = $this->table('tournament_teams', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('versions_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 11, 'after' => 'id'])
            ->addColumn('teams_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 11, 'after' => 'versions_id'])
            ->addColumn('is_invited', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'teams_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'is_invited'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Series
         */
        $table = $this->table('tournament_series', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('games_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_MEDIUM, 'precision' => 11, 'after' => 'id'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'games_id'])
            ->addColumn('slug', 'string', ['null' => true, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'name'])
            ->addColumn('founded_at', 'datetime', ['null' => false, 'after' => 'slug'])
            ->addColumn('is_active', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'founded_at'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'is_active'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Seasons
         */
        $table = $this->table('tournament_seasons', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('games_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_MEDIUM, 'precision' => 11, 'after' => 'id'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'games_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'name'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Seasons Versions
         */
        $table = $this->table('tournament_seasons_versions', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('seasons_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 11, 'after' => 'id'])
            ->addColumn('versions_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 11, 'after' => 'seasons_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'versions_id'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Currencies
         */
        $table = $this->table('currencies', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('seasons_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 11, 'after' => 'id'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 64, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'seasons_id'])
            ->addColumn('code', 'string', ['null' => true, 'limit' => 8, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'name'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'code'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Stages
         */
        $table = $this->table('tournament_stages', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('versions_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'id'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 64, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'versions_id'])
            ->addColumn('best_of', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'name'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'best_of'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Groups
         */
        $table = $this->table('tournament_groups', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('versions_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'id'])
            ->addColumn('stages_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'versions_id'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 64, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'stages_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'name'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
        
        /**
         * Tournament Groups Teams
         */
        $table = $this->table('tournament_groups_teams', ['id' => false, 'primary_key' => ['groups_id','teams_id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('groups_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('teams_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'groups_id'])
            ->addColumn('wins', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_TINY, 'precision' => 11, 'after' => 'teams_id'])
            ->addColumn('losses', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_TINY, 'precision' => 11, 'after' => 'wins'])
            ->addColumn('draws', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_TINY, 'precision' => 11, 'after' => 'losses'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'draws'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Versions
         */
        $table = $this->table('tournament_versions', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('series_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'id'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'series_id'])
            ->addColumn('slug', 'string', ['null' => false, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'name'])
            ->addColumn('start_date', 'date', ['null' => false, 'after' => 'slug'])
            ->addColumn('end_date', 'date', ['null' => false, 'after' => 'start_date'])
            ->addColumn('start_time', 'time', ['null' => false, 'after' => 'end_date'])
            ->addColumn('end_time', 'time', ['null' => false, 'after' => 'start_time'])
            ->addColumn('types_id', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'end_time'])
            ->addColumn('prize_pool', 'decimal', ['null' => false, 'precision' => 14,'scale'=>2, 'after' => 'types_id'])
            ->addColumn('currencies_id', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 3, 'after' => 'prize_pool'])
            ->addColumn('total_teams', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_SMALL, 'precision' => 3, 'after' => 'currencies_id'])
            ->addColumn('is_cancelled', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'total_teams'])
            ->addColumn('is_published', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'is_cancelled'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'is_published'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Matches
         */
        $table = $this->table('tournament_matches', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_BIG, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('stages_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'id'])
            ->addColumn('groups_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'stages_id'])
            ->addColumn('team_a', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'groups_id'])
            ->addColumn('team_b', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'team_a'])
            ->addColumn('game_date', 'date', ['null' => false, 'after' => 'team_b'])
            ->addColumn('start_time', 'time', ['null' => false, 'after' => 'game_date'])
            ->addColumn('end_time', 'time', ['null' => false, 'after' => 'start_time'])
            ->addColumn('is_tiebreaker', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'end_time'])
            ->addColumn('is_cancelled', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'is_tiebreaker'])
            ->addColumn('winning_team', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'is_cancelled'])
            ->addColumn('match_series', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'winning_team'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'match_series'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Match Series
         */
        $table = $this->table('tournament_match_series', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 32, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'id'])
            ->addColumn('game_date', 'datetime', ['null' => false, 'after' => 'name'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'game_date'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Sources
         */
        $table = $this->table('sources', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_MEDIUM, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('name', 'string', ['null' => false, 'limit' => 64, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'id'])
            ->addColumn('title', 'string', ['null' => false, 'limit' => 64, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'name'])
            ->addColumn('slug', 'string', ['null' => false, 'limit' => 64, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'title'])
            ->addColumn('url', 'string', ['null' => false, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'slug'])
            ->addColumn('logo', 'string', ['null' => false, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'url'])
            ->addColumn('is_active', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'logo'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'is_active'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Tournament Matches Sources
         */
        $table = $this->table('tournament_matches_sources', ['id' => false, 'primary_key' => ['id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_BIG, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('matches_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_BIG, 'precision' => 11, 'after' => 'id'])
            ->addColumn('sources_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_MEDIUM, 'precision' => 11, 'after' => 'matches_id'])
            ->addColumn('url', 'string', ['null' => false, 'limit' => 128, 'collation' => 'utf8mb4_unicode_ci', 'encoding' => 'utf8mb4', 'after' => 'sources_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'url'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
        
    }
}
