<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddGamesIdColumnToPostsTable extends AbstractMigration
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
            ->addColumn('games_id', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'third_party_media_id',
            ])
            ->save();
    }
}
