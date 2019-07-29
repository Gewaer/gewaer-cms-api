<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentMatchesSources;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentMatchesSourcesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['matches_id','sources_id','url'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['matches_id','sources_id','url'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentMatchesSources();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
