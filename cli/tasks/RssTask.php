<?php

namespace Gewaer\Cli\Tasks;

use Phalcon\Cli\Task as PhTask;
use PicoFeed\Reader\Reader;
use Gewaer\Models\Posts;
use Phalcon\Di;

/**
 * CLI to handle RSS feeds
 *
 * @package Gewaer\Cli\Tasks
 *
 * @property Config $config
 * @property \Monolog\Logger $log
 *
 */
class RssTask extends PhTask
{
    /**
     * Insert podcasts episodes by given rss link
     *
     * @param array $params
     * @return void
     */
    public function insertAction($params): void
    {
        $usersId = $params[0];
        $companiesId = $params[1];
        $sitesId = $params[2];
        $url = $params[3];
        $reader = new Reader;
        $resource = $reader->download($url);

        $parser = $reader->getParser(
            $resource->getUrl(),
            $resource->getContent(),
            $resource->getEncoding()
        );
    
        $feed = $parser->execute();

        //Get feed title
        $podcastTitle = $feed->getTitle();

        $podcasts = $feed->getItems();

        // Lets get each episode of the feed
        foreach ($podcasts as $podcast) {
            
            $newPost =  new Posts();
            $newPost->users_id = $usersId;
            $newPost->sites_id = $sitesId;
            $newPost->companies_id = $companiesId;
            $newPost->post_types_id = 3;
            $newPost->category_id = 1;
            $newPost->title = $podcastTitle . ': ' . $podcast->title;
            $newPost->summary = $podcast->content ?: 'No Summary Available';
            $newPost->media_url = $podcast->enclosureUrl ?: 'Podcast not Available';
            $newPost->created_at = $podcast->date->format('Y-m-d H:i:s');
            $newPost->saveOrFail();
            echo($newPost->title . "--> Added \n");
        }

    }

}