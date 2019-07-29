<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentMatchSeries;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentMatchSeriesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['name','game_date'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['name','game_date'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentMatchSeries();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
