<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class RemoveNotNullFromStagesAndGroupsIdAndAddIsCheduled extends AbstractMigration
{
    public function change()
    {
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
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'id',
            ])
        ->changeColumn('groups_id', 'integer', [
                'null' => true,
                'limit' => MysqlAdapter::INT_REGULAR,
                'after' => 'stages_id',
            ])
            ->addColumn('is_scheduled', 'integer', [
                'null' => false,
                'default' => '0',
                'limit' => '1',
                'after' => 'games_id',
            ])
            ->save();
    }
}
