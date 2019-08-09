<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Phalcon\Mvc\Model\Resultset;
use Gewaer\Models\Comments;
use Gewaer\Models\CommentsLikes;

class CommentsMapper extends CustomMapper
{
    /**
     * @param Canvas\Models\FileSystem $file
     * @param Canvas\Dto\Files $postDto
     * @return Files
     */
    public function mapToObject($comments, $commentsDto, array $context = [])
    {
        $commentsDto->id = $comments->id;
        $commentsDto->posts_id = $comments->posts_id;
        $commentsDto->users_id = $comments->users_id;
        $commentsDto->users = $comments->getUsers(['columns' => 'displayname,profile_image']);
        $commentsDto->content = $comments->content;
        $commentsDto->comment_parent_id = $comments->comment_parent_id;
        $commentsDto->users_ip = $comments->users_ip;
        $commentsDto->likes_count = $comments->likes_count;
        $commentsDto->users_likes = CommentsLikes::getCurrentUsersCommentsLike($comments->getId());
        $commentsDto->content = $comments->content;
        $commentsDto->created_at = $comments->created_at;
        $commentsDto->updated_at = $comments->updated_at;
        $commentsDto->is_deleted = $comments->is_deleted;

        return $commentsDto;
    }
}
