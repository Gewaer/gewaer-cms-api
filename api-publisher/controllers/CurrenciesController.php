<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Currencies;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class CurrenciesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['seasons_id','name','code'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['seasons_id','name','code'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Currencies();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
