<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Categories;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class CategoriesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['title', 'slug'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['title', 'slug'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Categories();
        $this->model->sites_id = $this->site->getId();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
