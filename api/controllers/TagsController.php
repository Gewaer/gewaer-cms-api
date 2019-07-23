<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

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
    protected $createFields = [
        'title', 'slug', 'metadata'
    ];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = [
        'title', 'slug', 'metadata'
    ];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Tags();

        $site =  Sites::findFirstOrFail([
            'conditions' => 'key = ?0 and is_deleted = 0',
            'bind' => [$this->request->getHeader('SITE-KEY')]
        ]);
        $this->model->sites_id = $site->id;

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
