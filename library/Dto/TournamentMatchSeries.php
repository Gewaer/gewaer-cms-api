<?php

namespace Gewaer\Dto;

class TournamentMatchSeries
{
     /**
     * @var integer
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var date
     */
    public $game_date;

    /**
     * @var datetime
     */
    public $created_at;

    /**
     * @var datetime
     */
    public $updated_at;

    /**
     * @var integer
     */
    public $is_deleted;

    /**
     * @var array
     */
    public $matches = [];



}