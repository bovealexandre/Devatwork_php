<?php
require_once(ROOT . '/Controller/Controller.php');

class NewsController extends Controller
{
	protected function __construct()
	{
		require_once(ROOT . '/utils/DB.php');
		require_once(ROOT . '/Controller/CommentController.php');
		require_once(ROOT . '/Model/NewsModel.php');
	}

	/**
	* list all news
	*/
	public function listNews()
	{
		$db = DB::getInstance();
		$rows = $db->select('SELECT * FROM `news`');

		$news = [];
		foreach($rows as $row) {
			$n = new NewsModel();
			$news[] = $n->setId($row['id'])
			  ->setTitle($row['title'])
			  ->setBody($row['body'])
			  ->setCreatedAt($row['created_at']);
		}

		return $news;
	}

	/**
	* add a record in news table
	*/
	public function addNews($title, $body)
	{
		$db = DB::getInstance();
		$sql = "INSERT INTO `news` (`title`, `body`, `created_at`) VALUES('". $title . "','" . $body . "','" . date('Y-m-d') . "')";
		$db->exec($sql);
		return $db->lastInsertId($sql);
	}

	/**
	* deletes a news, and also linked comments
	*/
	public function deleteNews($id)
	{
		$comments = CommentController::getInstance()->listComments();
		$idsToDelete = [];

		foreach ($comments as $comment) {
			if ($comment->getNewsId() == $id) {
				$idsToDelete[] = $comment->getId();
			}
		}

		foreach($idsToDelete as $id) {
			CommentController::getInstance()->deleteComment($id);
		}

		$db = DB::getInstance();
		$sql = "DELETE FROM `news` WHERE `id`=" . $id;
		return $db->exec($sql);
	}
}