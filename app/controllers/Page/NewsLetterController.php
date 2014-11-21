<?php

class NewsLetterController extends \BaseController
{
	public function view_newsletter(){
		
	}
	
	public function send_news_letter()
	{
		$body = Input::get('body');
		
		$profileController = new ProfilesController();
		$profilesJson = $profileController->getAll();
		/*
		$json = json_decode($profilesJson->getContent());
		$paginator = $json->{'messages'};
		foreach($paginator as $prof)
		{
			$data = array(
				'body'=>$body
			);
			$address = array(
				'email'=>$prof->email,
				'subject'=>'newsletter'
			);
			
			Mail::queue('emails.newsletter', $data, function($message) use($address)
			{
				$message->to($address['email'])->subject($address['subject']);
			});
			
		}
		*/
		
		$data = array(
				'body'=>$body
		);
		$address = array(
			'email'=>'davidsenjayagm@gmail.com',
			'subject'=>'newsletter'
		);
		
		Mail::queue('emails.newsletter', $data, function($message) use($address)
		{
			$message->to($address['email'])->subject($address['subject']);
		});
		return $respond = array('code'=>'200','status' => 'OK');
	}
}