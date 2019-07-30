<?php

declare(strict_types=1);

namespace Gewaer\Mapper;

use AutoMapperPlus\CustomMapper\CustomMapper;
use Phalcon\Mvc\Model\Resultset;
use Gewaer\Models\TournamentMatchSeries;
use Gewaer\Models\Teams;
use Gewaer\Models\Organizations;

class TournamentMatchSeriesMapper extends CustomMapper
{
    /**
     * @param Canvas\Models\FileSystem $file
     * @param Canvas\Dto\Files $postDto
     * @return Files
     */
    public function mapToObject($matchSeries, $matchSeriesDto, array $context = [])
    {
        $matchSeriesDto->id = $matchSeries->getId();
        $matchSeriesDto->name = $matchSeries->name;
        $matchSeriesDto->game_date = $matchSeries->game_date;
        $matchSeriesDto->created_at = $matchSeries->created_at;
        $matchSeriesDto->updated_at = $matchSeries->updated_at;
        $matchSeriesDto->is_deleted = $matchSeries->is_deleted;

        $matchesArray = [];

        foreach ($matchSeries->getMatches() as $match) {
            $matchArray = [];
            $teamA = Teams::findFirst($match->team_a);
            $teamB = Teams::findFirst($match->team_b);
            $organizationA = Organizations::findFirst($teamA->organizations_id);
            $organizationB = Organizations::findFirst($teamB->organizations_id);

            foreach ($match as $key => $value) {
                $matchArray[$key] = $value;
                $matchArray['team_a'] = $teamA;
                $matchArray['organization_team_a'] = $organizationA;
                $matchArray['team_b'] = $teamB;
                $matchArray['organization_team_b'] = $organizationB;
                $matchArray['winning_team'] = $match->winning_team == $teamA->id ? $teamA : $teamB;
            }

            $matchesArray[] = $matchArray;
        }

        $matchSeriesDto->matches = $matchesArray;

        return $matchSeriesDto;
    }
}