<?php
require_once(ROOT.'/Model/Model.php');

class CommentModel extends Model {
    protected $newsId;

    
	public function getNewsId()
	{
		return $this->newsId;
	}

	public function setNewsId($newsId)
	{
		$this->newsId = $newsId;

		return $this;
	}
}