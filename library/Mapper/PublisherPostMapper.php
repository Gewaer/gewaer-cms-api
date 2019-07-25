<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Phalcon\Mvc\Model\Resultset;
use Gewaer\Models\PostsLikes;

class PublisherPostMapper extends CustomMapper
{
    /**
     * @param Canvas\Models\FileSystem $file
     * @param Canvas\Dto\Files $postDto
     * @return Files
     */
    public function mapToObject($post, $postDto, array $context = [])
    {
        $postDto->id = $post->getId();
        $postDto->companies_id = $post->companies_id;
        $user = $post->user;
        $postDto->user = [
            'id' => $user->getId(),
            'firstname' => $user->firstname,
            'lastname' => $user->lastname,
        ];
        
        $postDto->sites_id = $post->sites_id;
        $postDto->type = $post->getTypes(['columns' => 'id, title']);
        $postDto->category = $post->getCategory(['columns' => 'id, title']);
        $postDto->title = $post->title;
        $postDto->slug = $post->slug;
        $postDto->summary = $post->summary;
        $postDto->content = $post->content;
        
        $postDto->tags = $post->getTags(['columns' => 'id' , 'title']);
        $postDto->media_url = $post->media_url;
        $postDto->likes_count = $post->likes_count;
        $postDto->users_likes = PostsLikes::getCurrentUsersLike($post->getId());
        $postDto->post_parent_id = $post->post_parent_id;
        $postDto->shares_count = $post->shares_count;
        $postDto->views_count = $post->views_count;
        $postDto->comment_count = $post->comment_count;
        $postDto->status = $post->status;
        $postDto->files = $post->getFiles();
        $postDto->comment_status = $post->comment_status;
        $postDto->is_published = $post->is_published;
        $postDto->featured = $post->featured;
        $postDto->weight = $post->weight;
        $postDto->premium = $post->premium;
        $postDto->published_at = $post->published_at;
        $postDto->created_at = $post->created_at;
        $postDto->updated_at = $post->updated_at;
        $postDto->is_deleted = $post->is_deleted;

        return $postDto;
    }

    /**
     * Get the new tag list only ids
     *
     * @param array $tags
     * @return array
     */
    private function getTags($tags): array
    {
        $newTags = [];
        foreach($tags as $tag)
        {
            $newTags[] = $tag->id;
        }

        return $newTags;
    }
}
