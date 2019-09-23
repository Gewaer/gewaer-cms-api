<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class RssController extends BaseController
{
    /**
     * set objects.
     *
     * @return void
     */
    public function getRss(): void
    {
        require '../../rss.php';
    }
}
