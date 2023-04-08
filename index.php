<?php

define('ROOT', __DIR__);
require_once(ROOT . '/Controller/NewsController.php');
require_once(ROOT . '/Controller/CommentController.php');

foreach (NewsController::getInstance()->listNews() as $news) {
	echo("############ NEWS " . $news->getTitle() . " ############\n");
	echo($news->getBody() . "\n");
	foreach (CommentController::getInstance()->listComments() as $comment) {
		if ($comment->getNewsId() == $news->getId()) {
			echo("Comment " . $comment->getId() . " : " . $comment->getBody() . "\n");
		}
	}
}

$commentManager = CommentController::getInstance();
$c = $commentManager->listComments();