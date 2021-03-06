<?php

/* @var $this \Level14\Website2Feed\SimpleView */
/* @var $feed Level14\Website2Feed\Model\Feed */
/* @var $items \Level14\Website2Feed\Model\Item[] */

use \FeedWriter\ATOM;

$atom = new ATOM();

$atom->setTitle($feed->getTitle());
$atom->setLink($feed->getUrl());
$atom->setDate($feed->getUpdatedDate());
$atom->setChannelElement('author', array('name' => $feed->getAuthor()));

foreach($items as $dbItem) {
    $item = $atom->createNewItem();
    $item->setTitle($dbItem->getTitle());
    $item->setLink($dbItem->getUrl());
    $item->setDate($dbItem->getPublishedDate());
    $item->setAuthor($feed->getAuthor());
    $item->setDescription($dbItem->getDescription());
    $atom->addItem($item);
}

$this->app->contentType('application/atom+xml');
$atom->printFeed();
