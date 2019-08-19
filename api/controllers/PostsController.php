<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\Posts;
use Gewaer\Models\Status;
use Gewaer\Dto\Posts as PostDto;
use Gewaer\Mapper\PostMapper;
use Canvas\Http\Request;
use Phalcon\Mvc\ModelInterface;
use Canvas\Contracts\Controllers\ProcessOutputMapperTrait;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class PostsController extends CanvasBaseController
{
    use ProcessOutputMapperTrait;

    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = [
        'sites_id', 'post_types_id', 'category_id', 'title', 'slug', 'summary', 'content', 'media_url', 'likes_count', 'post_parent_id',
        'shares_count', 'comment_count', 'status', 'is_published', 'comment_status', 'featured', 'weight', 'premium', 'published_at', 'is_live', 'author_id', 'collaborator_id'
    ];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = [
        'sites_id', 'post_types_id', 'category_id', 'title', 'slug', 'summary', 'content', 'media_url', 'likes_count', 'post_parent_id',
        'shares_count', 'comment_count', 'status', 'is_published', 'comment_status', 'featured', 'weight', 'premium', 'published_at', 'is_live', 'author_id', 'collaborator_id'
    ];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new Posts();
        $this->dto = PostDto::class;
        $this->dtoMapper = new PostMapper();
        $this->model->users_id = $this->userData->getId();
        $this->model->companies_id = $this->userData->currentCompanyId();
        $this->model->sites_id = $this->site->getId();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0'],
            ['companies_id', ':', $this->userData->currentCompanyId()],
        ];
    }

    /**
     * Process the update request and return the object.
     *
     * @param Request $request
     * @param ModelInterface $record
     * @throws Exception
     * @return ModelInterface
     */
    protected function processEdit(Request $request, ModelInterface $record): ModelInterface
    {
        $post = parent::processEdit($request, $record);
        $request = $this->processInput($request->getPutData());
        $post->addTags($request['tags']);
        return $post;
    }

    /**
     * Process the create request and trecurd the boject.
     *
     * @return ModelInterface
     * @throws Exception
     */
    protected function processCreate(Request $request): ModelInterface
    {
        $post = parent::processCreate($request);
        $request = $this->processInput($request->getPostData());

        $post->addTags($request['tags']);
        return $post;
    }
}
