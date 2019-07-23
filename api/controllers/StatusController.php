<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Status;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class StatusController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['title'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['title'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Status();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
