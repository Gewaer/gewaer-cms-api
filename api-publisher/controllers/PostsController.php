<?php

declare(strict_types=1);

namespace Gewaer\Api\Publisher\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Posts;
use Gewaer\Dto\Posts as PostDto;
use Gewaer\Mapper\PostMapper;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class PostsController extends CanvasBaseController
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
        $this->model = new Posts();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0'],
        ];
    }

    /**
     * Format output.
     *
     * @param mixed $results
     * @return void
     */
    protected function processOutput($results)
    {
        //add a mapper
        $this->dtoConfig->registerMapping(Posts::class, PostDto::class)
            ->useCustomMapper(new PostMapper());

        return $results instanceof \Phalcon\Mvc\Model\Resultset\Simple ?
            $this->mapper->mapMultiple(iterator_to_array($results), PostDto::class)
            : $this->mapper->map($results, PostDto::class);
    }
}
