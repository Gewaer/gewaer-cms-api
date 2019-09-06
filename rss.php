<?php

require 'api/public/index.php';

use Gewaer\Models\Posts;

header('Content-type: application/xml');

echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
echo "<channel>\n";

echo "<title>Blinked</title>\n";
echo "<description>Blinked Posts</description>\n";
echo "<link>https://blinked.gg</link>\n";

$posts = Posts::find(['order'=> 'id DESC']);

foreach ($posts as $post) {

    $authorFullName = $post->getAuthor()->firstname . ' ' . $post->getAuthor()->lastname;
    $category = $post->getCategory()->title;

    echo "<item>\n";
    echo "<id>$post->id</id>\n";
    echo "<title>$post->title</title>\n";
    echo "<summary>$post->summary</summary>\n";
    echo "<content>$post->content</content>\n";
    echo "<link>$post->media_url</link>\n";
    echo "<author>$authorFullName</author>\n";
    echo "<category>$category</category>\n";
    echo "</item>\n";
}

echo "</channel>\n";
echo "</rss>\n";