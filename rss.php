<?php

use Gewaer\Models\Posts;
use function Canvas\Core\envValue;

header('Content-type: application/xml');

echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>\n";
echo "<channel>\n";

echo '<title>' . envValue('APP_NAME') . "</title>\n";
echo "<description>Blinked Posts</description>\n";
echo '<link>' . envValue('APP_URL') . "</link>\n";

$posts = Posts::find([
    'order' => 'id DESC',
    'limit' => 200
]);

foreach ($posts as $post) {
    $authorFullName = $post->getAuthor()->firstname . ' ' . $post->getAuthor()->lastname;
    $category = $post->getCategory()->title;

    echo "<item>\n";
    echo "<id>$post->id</id>\n";
    echo "<title>$post->title</title>\n";
    echo "<summary><![CDATA[$post->summary]]></summary>\n";
    echo "<content><![CDATA[$post->content]]></content>\n";
    echo "<link>$post->media_url</link>\n";
    echo "<author>$authorFullName</author>\n";
    echo "<category>$category</category>\n";
    echo "</item>\n";
}

echo "</channel>\n";
echo "</rss>\n";
