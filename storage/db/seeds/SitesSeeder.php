<?php

use Phinx\Seed\AbstractSeed;

class SitesSeeder extends AbstractSeed
{
    public function run()
    {
        $data = [
            [
                'users_id' => 1,
                'companies_id' => 1,
                'title' => 'CMS',
                'key' => 'd86fd822-e769-44e5-978e-0c7b5438f23d',
                'description' => 'CMS',
                'domain' => 'gewaer',
                'status' => 1,
                'created_at' => date('Y-m-d H:m:s'),
                'is_deleted'=>0
            ]
        ];
        $posts = $this->table('sites');
        $posts->insert($data)
              ->save();
    }
}