<?php

class InformationManagementController extends \BaseController {
	
	public function view_detail($id){
		$informations = InformationContent::where('id_information','=',$id)->orderBy('created_at','desc')->get();
		return View::make('pages.admin.cms.edit_informasi_detail',compact('informations'));
	}
	
	public function get_information(){
		$info = new InformationController();
		return $info->getAll();
	}
	
	
	
	public function insert_information(){
		$info = new InformationController();
		return $info->insert();
	}
	
	public function insert_information_content($id){
		$informations = new InformationContent;

		$title = Input::get('title');
		if($title!=''){
			$informations->id_information = $id;
			$informations->sub_title = $title;
			$informations->save();
			if(Input::hasFile('image')){
				$image = Input::file('image');
				$destination = 'assets/file_upload/information/'.$id.'/'.$informations->id;
				$destination2 = asset('assets/file_upload/information/'.$id.'/'.$informations->id.'/');
				File::makeDirectory($destination,0777,true);
				$image->move($destination,$image->getClientOriginalName());
				$content = "<img src='".$destination2.'/'.$image->getClientOriginalName()."' />";
			}
			else{
				$content = Input::get('content');
			}
			
			$informations->content = $content;
			try{
				$informations->save();
				return 200;
			}
			catch(Exception $e){
				return 500;
			}
		}
		else{
			return 400;
		}
		
	}
	
	
	public function update_article($id){
		$content = Input::get('content');
		$informations = InformationContent::find($id);
		$informations->content = $content;
		try{
			$informations->save();
			return 200;
		}
		catch(Exception $e){
			return 500;
		}
	}
	
	public function delete_information_content($id){
		$informations = InformationContent::find($id);
		try{
			$destination = 'assets/file_upload/information/'.$informations->id_information.'/'.$id;
			try{
				File::deleteDirectory($destination);
			}
			catch(Exception $e){
				
			}
			$informations->delete();
			return 200;
		}
		catch(Exception $e){
			return 500;
		}
	}
	
	
	public function delete($id){
		$info = new InformationController();
		return $info->delete($id);
	}
}
	