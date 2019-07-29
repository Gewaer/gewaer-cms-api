<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentStages;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentStagesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['versions_id','name','best_of'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['versions_id','name','best_of'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentStages();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
