<?php

class InformationManagementController extends \BaseController {
	
	public function get_information(){
		$info = new InformationController();
		return $info->getAll();
	}
	
	public function insert_information(){
		$info = new InformationController();
		return $info->insert();
	}
	
	
	public function delete($id){
		$info = new InformationController();
		return $info->delete($id);
	}
}
	