<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Phalcon\Mvc\Model\Resultset;
use Gewaer\Models\Comments;
use Gewaer\Models\CommentsLikes;
use Gewaer\Models\Posts;

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
        $commentsDto->users = $comments->getUsers(['columns' => 'id,displayname']);
        $commentsDto->users_avatar = $comments->getUsers()->profile_image ?: 'https://blink-cms-upload.s3.amazonaws.com/media/q5crnI.png';
        $commentsDto->content = $comments->content;
        $commentsDto->comment_parent_id = $comments->comment_parent_id;
        $commentsDto->users_ip = $comments->users_ip;
        $commentsDto->likes_count = $comments->likes_count;
        $commentsDto->users_likes = CommentsLikes::getCurrentUsersCommentsLike($comments->getId());
        $commentsDto->content = $comments->content;
        $commentsDto->posts_comment_count = $comments->getPosts()->comment_count;
        $commentsDto->created_at = $comments->created_at;
        $commentsDto->updated_at = $comments->updated_at;
        $commentsDto->is_deleted = $comments->is_deleted;

        return $commentsDto;
    }
}
