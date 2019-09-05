<?php

namespace Gewaer\Cli\Tasks;

use Phalcon\Cli\Task as PhTask;
use PicoFeed\Reader\Reader;
use Gewaer\Models\Posts;
use Gewaer\Models\Rss;
use Gewaer\Models\Status;
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
        $rssRecords = Rss::findOrFail();

        foreach ($rssRecords as $rssRecord) {
            $this->addPodcastEpisode($rssRecord);
        }
    }

    /**
     * Add new Podcasts from Rss URL
     * @param Rss $rss
     * @return void
     */
    private function addPodcastEpisode(Rss $rss): void
    {

        $reader = new Reader;
        $resource = $reader->download($rss->rss_url);

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

            //Check if podcast episode already exists in our database
            $savedPodcast =  Posts::findFirst([
                'conditions'=>'third_party_media_id = ?0 and users_id = ?1 and companies_id = ?2 and sites_id = ?3 and is_deleted = 0',
                'bind'=>[$podcast->id,$rss->users_id,$rss->companies_id,$rss->sites_id]
            ]);

            if (!empty($podcast->enclosureUrl) && !$savedPodcast) {
                $newPost =  new Posts();
                $newPost->users_id = $rss->users_id;
                $newPost->sites_id = $rss->sites_id;
                $newPost->companies_id = $rss->companies_id;
                $newPost->post_types_id = 3;
                $newPost->category_id = 1;
                $newPost->title = $podcastTitle . ': ' . $podcast->title;
                $newPost->summary = $podcast->content ?: 'No Summary Available';
                $newPost->media_url = $podcast->enclosureUrl;
                $newPost->status = Status::PUBLISHED;
                $newPost->third_party_media_id = $podcast->id;
                $newPost->saveOrFail();
                echo($newPost->title . "--> Added \n");
            } else {
                echo($podcast->title . "--> Not added because media url is empty or podcast episode already exists on database  \n");
            }
        }
    }
}