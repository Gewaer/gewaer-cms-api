<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Cms\Controllers\FilesystemController as CanvasFilesystemController;

/**
 * Class BaseController
 *
 * @package Gewaer\Api\Controllers
 *
 * @property Users $userData
 * @property Request $request
 * @property Config $config
 * @property \Baka\Mail\Message $mail
 * @property Apps $app
 */
class FilesystemController extends CanvasFilesystemController
{

}
