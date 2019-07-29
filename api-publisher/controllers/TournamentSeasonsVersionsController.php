<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentSeasonsVersions;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentSeasonsVersionsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['seasons_id','versions_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['seasons_id','versions_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentSeasonsVersions();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
