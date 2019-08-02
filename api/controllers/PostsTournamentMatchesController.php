<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\PostsTournamentMatches;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class PostsTournamentMatchesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['posts_id','tournament_matches_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['posts_id','tournament_matches_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new PostsTournamentMatches();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
