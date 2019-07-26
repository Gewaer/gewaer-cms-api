<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentSeries;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentSeriesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['games_id','name','slug','founded_at','is_active'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['games_id','name','slug','founded_at','is_active'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentSeries();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
