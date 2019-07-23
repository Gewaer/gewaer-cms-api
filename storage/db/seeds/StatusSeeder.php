<?php

use Phinx\Seed\AbstractSeed;

class StatusSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'title' => 'Draft',
                'created_at' => date('Y-m-d H:m:s'),
                'is_deleted'=>0
            ],
            [
                'title' => 'Published',
                'created_at' => date('Y-m-d H:m:s'),
                'is_deleted'=>0
            ],
            [
                'title' => 'Scheduled',
                'created_at' => date('Y-m-d H:m:s'),
                'is_deleted'=>0
            ]
        ];
        $posts = $this->table('status');
        $posts->insert($data)
              ->save();
    }
}