<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Gewaer\Models\Rss;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class RssController extends BaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['site', 'url', 'rss_url', 'format'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['site', 'url', 'rss_url', 'format'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Rss();
        $this->model->users_id = $this->userData->getId();
        $this->model->companies_id = $this->userData->currentCompanyId();
        $this->model->sites_id = $this->site->getId();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
        ];
    }
}
