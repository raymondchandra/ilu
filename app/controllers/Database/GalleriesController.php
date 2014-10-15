<?php

class GalleriesController extends \BaseController {

	/**
	 * Insert a newly created gallery in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Gallery::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Gallery::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the gallery.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$gallery = Gallery::all();
		if (count($gallery) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$gallery);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified gallery.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$gallery = Gallery::find($id);
		if (count($gallery) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$gallery);
		}
		return Response::json($respond);
	}

	/**
	 * Display the slideshow gallery.
	 *
	 * @param  
	 * @return Response
	 */
	
	public function get_slideshow($type)
	{
		return $this->getByType('slideshow');
	}

	/**
	 * Display the specified gallery by type.
	 *
	 * @param  
	 * @return Response
	 */
	
	public function getByType($type)
	{
		$respond = array();
		$gallery = Gallery::where('type','=',$type)->get();
		if (count($gallery) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$gallery);
		}
		return Response::json($respond);
	}
	


	/**
	 * Update all value of the specified gallery in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$gallery = Gallery::find($id);
		if ($gallery == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Gallery::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$gallery->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified gallery in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$gallery = Gallery::find($id);
		if ($gallery == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$gallery-> = ;
			try {
				$gallery->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified gallery from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$gallery = Gallery::find($id);
		if ($gallery == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$pathLama = $gallery -> photo_path;
				$gallery->delete();
				
				File::delete($pathLama);

				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Check if row exist in database.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function exist()
	{
		$respond = array();
		$gallery = Gallery::where('','=','')->get();
		if (count($gallery) >= 0)
		{
			$respond = array('code'=>'200','status' => 'OK');
		}
		else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		return Response::json($respond);
	}
	*/
	public function upload_slideshow()
	{
		$respond = array();
		
		if(Input::hasFile('photo'))
		{
			$input = json_decode(Input::all());
			
			$img_upload = Input::file('photo');
			$file_name = $img_upload->getClientOriginalName();
			
			
			$gallery = new Gallery();
			$gallery->type = 'slideshow';
			
			try{
				$gallery->save();
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
				return Response::json($respond);
			}
			$destination = 'assets/file_upload/slideshow/'.$gallery->id.'/';
			$uploadSuccess = $img_upload->move($destination, $file_name);
			$gallery -> photo_path = $destination.$file_name;
			
			try{
				$gallery->save();
				$respond = array('code'=>'201','status' => 'Created');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
		}else
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			
		}
		return Response::json($respond);
	}

	//update foto slide
	public function update_slideshow()
	{	
		$respond = array();
		
		if(Input::hasFile('photo'))
		{
			$input = json_decode(Input::all());
			$id_img = $input['id'];
			
			$img_upload = Input::file('filePhoto');
			$file_name = $img_upload->getClientOriginalName();
			
			
			$gallery = Gallery::find($id_img);
			if($gallery != NULL){ 
				//delete foto lama
				$pathLama = $gallery -> photo_path;
				File::delete($pathLama);

				$destination = 'assets/file_upload/slideshow/'.$id_img.'/';

				$uploadSuccess = $img_upload->move($destination, $file_name);
				$gallery -> photo_path = $destination.$file_name;
				try{
					$gallery->save();
					
					$respond = array('code'=>'201','status' => 'Created');
				} catch (Exception $e) {
					$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
				}
			}else{
				$respond = array('code'=>'404','status' => 'Not Found');
			}
			
		}else
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			
		}
		return Response::json($respond);
	}
	

}
