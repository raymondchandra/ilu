<?php

class SeosManagementController extends \BaseController {
	
	public function view_seos_management(){
		
	}
	
	public function get_all_seos(){
		$seo = new SeosController();
		return $seo->getAll();
	}
	
	public function get_one_seos($name){
		//$name = Input::get('name');
		$seo = new SeosController();
		return $seo->getByName($name);
	}
	
	public function insert(){
		$seo = new SeosController();
		return $seo->insert();
	}
	
	public function edit_seos($id){
		$seo = new SeosController();
		return $seo->updateFull($id);
	}
	
	public function delete($id){
		$seo = new SeosController();
		return $seo->delete($id);
	}
	
}