<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Countries;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class CountriesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['name','flag'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['name','flag'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Countries();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
