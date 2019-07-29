<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentGroups;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentGroupsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['versions_id','stages_id','name'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['versions_id','stages_id','name'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentGroups();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
