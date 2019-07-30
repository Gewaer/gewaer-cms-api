<?php

declare(strict_types=1);

namespace Gewaer\Api\Controllers;

use Canvas\Api\Controllers\BaseController as CanvasBaseController;
use Gewaer\Models\TournamentMatchSeries;
use Gewaer\Dto\TournamentMatchSeries as TournamentMatchSeriesDto;
use Gewaer\Mapper\TournamentMatchSeriesMapper;

/**
 * Class BaseController.
 *
 * @package Gewaer\Api\Controllers
 *
 */
class TournamentMatchSeriesController extends CanvasBaseController
{
    /*
       * fields we accept to create
       *
       * @var array
       */
    protected $createFields = ['name','game_date'];

    /*
     * fields we accept to create
     *
     * @var array
     */
    protected $updateFields = ['name','game_date'];

    /**
     * set objects.
     *
     * @return void
     */
    public function onConstruct()
    {
        $this->model = new TournamentMatchSeries();

        $this->additionalSearchFields = [
            ['is_deleted', ':', '0']
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
        $this->dtoConfig->registerMapping(TournamentMatchSeries::class, TournamentMatchSeriesDto::class)
            ->useCustomMapper(new TournamentMatchSeriesMapper());

        if (is_array($results) && isset($results['data'])) {
            $results['data'] = $this->mapper->mapMultiple($results['data'], TournamentMatchSeriesDto::class);
            return  $results;
        }

        return is_iterable($results) ?
            $this->mapper->mapMultiple($results, TournamentMatchSeriesDto::class)
            : $this->mapper->map($results, TournamentMatchSeriesDto::class);
    }
}
