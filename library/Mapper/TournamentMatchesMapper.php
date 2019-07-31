<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Phalcon\Mvc\Model\Resultset;
use Gewaer\Models\TournamentMatchSeries;
use Gewaer\Models\Teams;
use Gewaer\Models\Organizations;

class TournamentMatchesMapper extends CustomMapper
{
    /**
     * @param Canvas\Models\FileSystem $file
     * @param Canvas\Dto\Files $postDto
     * @return Files
     */
    public function mapToObject($matches, $matchesDto, array $context = [])
    {
        $teamA = Teams::findFirst($matches->team_a);
        $teamB = Teams::findFirst($matches->team_b);
        $organizationA = Organizations::findFirst($teamA->organizations_id);
        $organizationB = Organizations::findFirst($teamB->organizations_id);

        $matchesDto->id = $matches->getId();
        $matchesDto->stages_id = $matches->stages_id;
        $matchesDto->groups_id = $matches->groups_id;
        $matchesDto->game_date = $matches->game_date;
        $matchesDto->start_time = $matches->start_time;
        $matchesDto->end_time = $matches->end_time;
        $matchesDto->is_tiebreaker = $matches->is_tiebreaker;
        $matchesDto->is_cancelled = $matches->is_cancelled;
        $matchesDto->match_series_id = $matches->match_series_id;
        $matchesDto->match_series = $matches->getMatchSeries();
        $matchesDto->team_a = $teamA;
        $matchesDto->team_a_score = $matches->team_a_score;
        $matchesDto->team_b = $teamB;
        $matchesDto->team_b_score = $matches->team_b_score;
        $matchesDto->organization_team_a = $organizationA;
        $matchesDto->organization_team_b = $organizationB;
        $matchesDto->winning_team = $matches->winning_team == $teamA->id ? $teamA : $teamB;
        $matchesDto->created_at = $matches->created_at;
        $matchesDto->updated_at = $matches->updated_at;
        $matchesDto->is_deleted = $matches->is_deleted;

        return $matchesDto;
    }
}