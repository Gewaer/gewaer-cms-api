<?php
use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddUsersFollowing extends AbstractMigration
{
    public function change()
    {
        /**
         * Users Following Tags
         */
        $table = $this->table('users_following_tags', ['id' => false, 'primary_key' => ['users_id','tags_id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('users_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('tags_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'users_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'tags_id'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();

        /**
         * Users Following Teams
         */
        $table = $this->table('users_following_teams', ['id' => false, 'primary_key' => ['users_id','teams_id'], 'engine' => 'InnoDB', 'encoding' => 'utf8mb4', 'collation' => 'utf8mb4_unicode_ci', 'comment' => '', 'row_format' => 'Dynamic']);
        $table->addColumn('users_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'identity' => 'enable'])
            ->addColumn('teams_id', 'integer', ['null' => false, 'limit' => MysqlAdapter::INT_REGULAR, 'precision' => 11, 'after' => 'users_id'])
            ->addColumn('created_at', 'datetime', ['null' => false, 'after' => 'teams_id'])
            ->addColumn('updated_at', 'datetime', ['null' => true, 'after' => 'created_at'])
            ->addColumn('is_deleted', 'integer', ['null' => false, 'default' => '0', 'limit' => MysqlAdapter::INT_TINY, 'precision' => 3, 'after' => 'updated_at'])
            ->create();
        
    }
}
