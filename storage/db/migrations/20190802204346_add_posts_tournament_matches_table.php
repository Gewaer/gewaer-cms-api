<?php
use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddPostsTournamentMatchesTable extends AbstractMigration
{
    public function change()
    {
        /**
         * Posts Tournament Matches
         */
        $table = $this->table('posts_tournament_matches', ['id' => false, 'primary_key' => ['posts_id','tournament_matches_id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('posts_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('tournament_matches_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'posts_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'tournament_matches_id'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
        
    }
}
