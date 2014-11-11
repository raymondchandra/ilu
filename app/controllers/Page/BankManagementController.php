<?php

class BankManagementController extends \BaseController
{
	public function insert(){
		$bank = new BanksController();
		return $bank->insert();
	}
	
	public function get_all(){
		$bank = new BanksController();
		return $bank->getAll();
	}
	
	public function update($id){
		$bank = new BanksController();
		return $bank->updateFull($id);
	}
	
	public function delete($id){
		$bank = new BanksController();
		return $bank->delete($id);
	}
	
	
}