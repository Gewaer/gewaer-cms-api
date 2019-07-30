<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Organizations;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class OrganizationsController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['countries_id','name','slug','shortname','logo','icon','founded_date','is_active'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['countries_id','name','slug','shortname','logo','icon','founded_date','is_active'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Organizations();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
