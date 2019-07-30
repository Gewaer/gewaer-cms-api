<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Teams;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TeamsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['games_id','organizations_id','leagues_id','name','founded_date','is_active'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['games_id','organizations_id','leagues_id','name','founded_date','is_active'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Teams();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
