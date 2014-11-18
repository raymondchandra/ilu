<?php

class MessagesManagementController extends \BaseController {
	
	public function view_messages_management(){
		
	}
	
	public function get_all_messages(){
		$messages = new MessagesController();
		return $messages->getAll();
	}
	
	public function get_all_ticket_messages(){
		$messages = new SupportTicketsController();
		return $messages->getAll();
	}
	
	public function get_ticket_messages($id){
		$messages = new SupportMsgsController();
		return $messages->getByTicket($id);
	}
	
	public function update_solve($id){
		$messages = new SupportTicketsController();
		return $messages->updateFull($id);
	}
	
	public function get_one_message($id){
		$messages = new MessagesController();
		return $messages->getById($id);
	}
	
	public function insert_message(){
		
	}
	
	public function send_email(){
		return 'Email! from: '.Session::get('company_name');
	}
	
	/*public function edit($id){
		$slide = new GalleriesController();
		return $slide->updateFull($id);
	}
	
	public function delete($id){
		$slide = new GalleriesController();
		return $slide->delete($id);
	}*/
	
}