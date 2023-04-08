<?php
require_once(ROOT.'/Model/Model.php');

class NewsModel extends Model {
    protected $title;

    public function setTitle($title)
	{
		$this->title = $title;

		return $this;
	}

	public function getTitle()
	{
		return $this->title;
	}
}