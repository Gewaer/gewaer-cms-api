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
    public function insertAction($params)
    {
        $url = $params[0];
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
            $newPost->users_id = 0; //Get data from default user?
            $newPost->sites_id = 1;
            $newPost->companies_id = 28; //Get data from default user?
            $newPost->post_types_id = 3;
            $newPost->category_id = 1;
            $newPost->title = $podcastTitle . ': ' . $podcast->title;
            $newPost->summary = $podcast->content;
            $newPost->media_url = $podcast->enclosureUrl;
            $newPost->created_at = $podcast->date->format('Y-m-d H:i:s');
            $newPost->saveOrFail();
            echo($newPost->title . "--> Added \n");
        }

    }

}