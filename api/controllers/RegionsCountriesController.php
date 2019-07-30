<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\RegionsCountries;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class RegionsCountriesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['regions_id','countries_id'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['regions_id','countries_id'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new RegionsCountries();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
