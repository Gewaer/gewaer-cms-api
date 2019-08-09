<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Phalcon\Mvc\Model\Resultset;
use Gewaer\Models\Comments;
use Gewaer\Models\CommentsLikes;

class PostsLikesMapper extends CustomMapper
{
    /**
     * @param Canvas\Models\FileSystem $file
     * @param Canvas\Dto\Files $postDto
     * @return Files
     */
    public function mapToObject($postsLikes, $postsLikesDto, array $context = [])
    {
        $postsLikesDto->posts_id = $postsLikes->posts_id;
        $postsLikesDto->users_id = $postsLikes->users_id;
        $postsLikesDto->posts_likes_count = $postsLikes->getPosts(['columns'=>'likes_count'])->likes_count;
        $postsLikesDto->created_at = $postsLikes->created_at;
        $postsLikesDto->updated_at = $postsLikes->updated_at;
        $postsLikesDto->is_deleted = $postsLikes->is_deleted;

        return $postsLikesDto;
    }
}
