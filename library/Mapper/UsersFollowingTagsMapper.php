<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Phalcon\Mvc\Model\Resultset;
use Gewaer\Models\PostsLikes;

class UsersFollowingTagsMapper extends CustomMapper
{
    /**
     * @param Canvas\Models\FileSystem $file
     * @param Canvas\Dto\Files $postDto
     * @return Files
     */
    public function mapToObject($userstags, $userstagsDto, array $context = [])
    {
        $userstagsDto->users_id = $userstags->users_id;
        $userstagsDto->tags_id = $userstags->tags_id;
        $userstagsDto->tag = $userstags->getTags();
        $userstagsDto->created_at = $userstags->created_at;
        $userstagsDto->updated_at = $userstags->updated_at;
        $userstagsDto->is_deleted = $userstags->is_deleted;

        return $userstagsDto;
    }
}
