<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Tags;
use Gewaer\Models\Sites;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TagsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = [];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = [];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Tags();
        $this->model->sites_id = $this->site->getId();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
