<?php

class SlideshowManagementController extends \BaseController {
	
	public function view_slideshow_management(){
		
	}
	
	public function get_all_slideshow(){
		$slide = new GalleriesController();
		return $slide->get_slideshow();
	}
	
	public function insert(){
		$slide = new GalleriesController();
		return $slide->w_insert();
	}
	
	/*public function get_one_seos($name){
		//$name = Input::get('name');
		$seo = new SeosController();
		return $seo->getByName($name);
	}*/
	
	public function edit($id){
		$slide = new GalleriesController();
		return $slide->updateFull($id);
	}
	
	public function delete($id){
		$slide = new GalleriesController();
		return $slide->delete($id);
	}
	
}