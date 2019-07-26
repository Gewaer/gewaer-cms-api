<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentTeams;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentTeamsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['versions_id','teams_id','is_invited'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['versions_id','teams_id','is_invited'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentTeams();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
