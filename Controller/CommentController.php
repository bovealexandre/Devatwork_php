<?php
require_once(ROOT . '/Controller/Controller.php');

class CommentController extends Controller
{


	protected function __construct()
	{
		require_once(ROOT . '/utils/DB.php');
		require_once(ROOT . '/Model/CommentModel.php');
	}

	public function listComments()
	{
		$db = DB::getInstance();
		$rows = $db->select('SELECT * FROM `comment`');

		$comments = [];
		foreach ($rows as $row) {
			$n = new CommentModel();
			$comments[] = $n->setId($row['id'])
				->setBody($row['body'])
				->setCreatedAt($row['created_at'])
				->setNewsId($row['news_id']);
		}

		return $comments;
	}

	public function addCommentForNews($body, $newsId)
	{
		$db = DB::getInstance();
		$sql = "INSERT INTO `comment` (`body`, `created_at`, `news_id`) VALUES('" . $body . "','" . date('Y-m-d') . "','" . $newsId . "')";
		$db->exec($sql);
		return $db->lastInsertId($sql);
	}

	public function deleteComment($id)
	{
		$db = DB::getInstance();
		$sql = "DELETE FROM `comment` WHERE `id`=" . $id;
		return $db->exec($sql);
	}
}