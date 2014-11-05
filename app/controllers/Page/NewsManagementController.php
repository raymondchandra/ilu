<?php

class NewsManagementController extends \BaseController
{
	public function getNews(){
		$news = new NewsController();
		return $news->getAll();
	}
	
	public function getOneNews($id){
		$news = new NewsController();
		return $news->getById($id);
	}
}