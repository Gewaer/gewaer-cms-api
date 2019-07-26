<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentSeasons;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentSeasonsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['games_id','name'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['games_id','name'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentSeasons();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
