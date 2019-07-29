<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentGroupsTeams;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentGroupsTeamsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['groups_id','teams_id','wins','losses','draws'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['groups_id','teams_id','wins','losses','draws'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentGroupsTeams();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
