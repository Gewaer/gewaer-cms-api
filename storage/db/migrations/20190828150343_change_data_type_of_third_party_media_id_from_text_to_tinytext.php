<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class ChangeDataTypeOfThirdPartyMediaIdFromTextToTinytext extends AbstractMigration
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
        ->changeColumn('third_party_media_id', 'text', [
                'null' => true,
                'limit' => MysqlAdapter::TEXT_TINY,
                'collation' => 'utf8mb4_unicode_ci',
                'encoding' => 'utf8mb4',
                'after' => 'collaborator_id',
            ])
            ->save();
    }
}
