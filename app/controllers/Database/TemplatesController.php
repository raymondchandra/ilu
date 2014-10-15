<?php

class TemplatesController extends \BaseController {

	/**
	 * Insert a newly created template in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$input = json_decode(Input::all());
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Template::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Template::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the template.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$template = Template::all();
		if (count($template) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$template);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified template.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$template = Template::find($id);
		if (count($template) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$template);
		}
		return Response::json($respond);
	}


	/**
	 * Display the specified template by title, subject.
	 *
	 * @param  
	 * @return Response
	 */
	
	public function getByTitleSubject()
	{
		$title = Input::get('title');
		$subject = Input::get('subject');

		$respond = array();
		$template = Template::where('title','LIKE','%'.$title.'%')->where('subject','LIKE','%'.$subject.'%')->get();
		if (count($template) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$template);
		}
		return Response::json($respond);
	}
	

	/**
	 * Update all value of the specified template in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$template = Template::find($id);
		if ($template == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Template::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$template->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	public function changeCurrent($type)
	{


	}
	
	/**
	 * Update {name} value of the specified template in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$template = Template::find($id);
		if ($template == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$template-> = ;
			try {
				$template->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified template from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$template = Template::find($id);
		if ($template == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$template->delete();
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
		$template = Template::where('','=','')->get();
		if (count($template) >= 0)
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

	/**
	 * Send newsletter by template
	 *
	 * @param  
	 * @return Response
	 */
	
	public function sendNewsletter(){
		$input = json_decode(Input::all());
		$template_id = $input['template_id'];
		$type = $input['type']; // products : manual/autopromo/autotop
		

		$respond = array();
		$template = Template::find($template_id);
		if ($template == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			if($type == 'manual'){
				$productArr = $input['product']; //kalo manual
			}else if($type == 'autopromo'){
				//cari products promo
				//$productArr = ;
			}else if($type == 'autotop'){
				//cari top products
				//$productArr = ;
			}else{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}

			try {
				//send mail
				$this->createEmail($template,$productArr);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);

	}

	public function createEmail($template,$productArr)
	{
		
		$data = array(
			'header' => $template->header,
			'products'=>$productArr,
			'footer' => $template->footer
		);
		$address = array(
			'email'=>$template->email,
			'subject'=>$type." ".$template->subject
			//,'attachment'=>$attachment
		);

		Mail::queue('emails.newsletter', $data, function($message) use($address)
		{
			$message->to($address['email'])->subject($address['subject']);
			/*if($address['attachment'] === "empty")
			{
				
			}
			else
			{
				$message->attach($address['attachment'] );
			}*/
		});
			
	}
}
