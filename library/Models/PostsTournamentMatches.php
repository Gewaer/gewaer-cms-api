<?php
declare(strict_types=1);

namespace Gewaer\Models;

class PostsTournamentMatches extends BaseModel
{
    /**
     *
     * @var integer
     */
    public $posts_id;

    /**
     *
     * @var integer
     */
    public $tournament_matches_id;

    /**
     *
     * @var string
     */
    public $created_at;

    /**
     *
     * @var string
     */
    public $updated_at;

    /**
     *
     * @var integer
     */
    public $is_deleted;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        parent::initialize();

        $this->belongsTo(
            'posts_id',
            Posts::class,
            'id',
            ['alias' => 'posts']
        );

        $this->belongsTo(
            'tournament_matches_id',
            TournamentMatches::class,
            'id',
            ['alias' => 'matches']
        );

        $this->setSource('posts_tournament_matches');
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource(): string
    {
        return 'posts_tournament_matches';
    }
}
