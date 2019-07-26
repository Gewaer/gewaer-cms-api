<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentVersions;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentVersionsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['series_id','name','slug','start_date','end_date','start_time','end_time','types_id','prize_pool','currencies_id','total_teams','is_cancelled','is_published'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['series_id','name','slug','start_date','end_date','start_time','end_time','types_id','prize_pool','currencies_id','total_teams','is_cancelled','is_published'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentVersions();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
