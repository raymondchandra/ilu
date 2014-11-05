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
	
	public function postNews(){
		$news = new NewsController();
		return $news->insert();
	}
	
	public function updateNews($id){
		$news = new NewsController();
		return $news->updateFull($id);
	}
}