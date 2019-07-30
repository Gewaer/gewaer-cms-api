<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Regions;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class RegionsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['name','shortname','slug','icon'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['name','shortname','slug','icon'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Regions();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
