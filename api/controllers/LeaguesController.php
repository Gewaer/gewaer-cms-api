<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Leagues;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class LeaguesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['regions_id','name','shortname','founded_date','is_active'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['regions_id','name','shortname','founded_date','is_active'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Leagues();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
