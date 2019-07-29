<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Sources;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class SourcesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['name','title','slug','url','logo','is_active'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['name','title','slug','url','logo','is_active'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Sources();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
