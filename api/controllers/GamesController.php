<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Games;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class GamesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['name','title','slug','logo','icon','release_date'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['name','title','slug','logo','icon','release_date'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Games();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
