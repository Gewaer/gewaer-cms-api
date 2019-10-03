<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;

class UsersFollowingGamesMapper extends CustomMapper
{
    /**
     * @param Canvas\Models\FileSystem $file
     * @param Canvas\Dto\Files $postDto
     * @return Files
     */
    public function mapToObject($usersgames, $usersgamesDto, array $context = [])
    {
        $usersgamesDto->users_id = $usersgames->users_id;
        $usersgamesDto->games_id = $usersgames->games_id;
        $usersgamesDto->game = $usersgames->getGames();
        $usersgamesDto->created_at = $usersgames->created_at;
        $usersgamesDto->updated_at = $usersgames->updated_at;
        $usersgamesDto->is_deleted = $usersgames->is_deleted;

        return $usersgamesDto;
    }
}
