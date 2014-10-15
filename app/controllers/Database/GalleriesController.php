<?php

class GalleriesController extends \BaseController {
	
	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$product_id = $decode->{'product_id'};
		$photo_path = $decode->{'photo_path'};
		$type = $decode->{'type'};
		
		$input = array(
					'product_id' => $product_id,
					'photo_path' => $photo_path,
					'type' => $type
		);
		
		return $this->insert($input);
	}	
	public function insert($input)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Gallery::$rules);

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
	 * Display the specified gallery by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$gallery = Gallery::where('','=','')->get();
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
	*/

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
				$gallery->delete();
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

	/* copy dari hfi
	//update foto slide
	public function update_foto_gallery()
	{	
		if(Input::hasFile('filePhoto'))
		{
			
			$id_img = Input::get('id_photo');
			$id = Auth::user()->id;
			
			$img_upload = Input::file('filePhoto');
			$file_name = $img_upload->getClientOriginalName();
			$destination = 'assets/file_upload/slideshow/'.$id_img.'/';
			
			$gallery = Gallery::find($id_img);
			if($gallery != NULL){ 
				//delete foto lama
				$pathLama = $gallery -> file_path;
				File::delete($pathLama);
			}else{
				$gallery = new Gallery();
				$gallery -> type = '1';
			}
			
			$uploadSuccess = $img_upload->move($destination, $file_name);
			$gallery -> timestamps = false;
			$gallery -> tanggal_upload = Carbon::now();
			$gallery -> uploaded_by = $id;
			$gallery -> file_path = $destination.$file_name;
			try{
				$gallery->save();
				return 'success';
			} catch (Exception $e) {
				return $e;
			}
		}else
		{
			return 'failed';
		}
	}
	
	public function update_caption()
	{
		$caption = Input::get('caption');
		$id = Auth::user()->id;
		$id_caption = Input::get('idCaption');
		$gallery = Gallery::find($id_caption);
		if($gallery==NULL) return 2; //ga ad gambar
		$gallery->kapsion = $caption;
		$gallery->timestamps = false;
		$gallery -> tanggal_upload = Carbon::now();
		$gallery -> uploaded_by = $id;
		try{
			$gallery->save();
			return 1; //success
		}catch(Exception $e){
			return $e;	
		}
	}
	
	public function get_slideshow()
	{
		$gal = Gallery::where('type','=', '1')->get();
		if(count($gal) != 0)
		{
			return $gal;
			
		}else
		{
			return "Failed";
		}
	}*/

}
