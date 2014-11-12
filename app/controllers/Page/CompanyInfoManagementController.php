<?php

class CompanyInfoManagementController extends \BaseController {
	
	public function get_company_info(){
		try{
			$str=file_get_contents(asset("assets/company_profile.xml"));
			$xml = simplexml_load_string($str);
			$json = json_encode($xml);
			$array = json_decode($json,TRUE);
			return $array;
		}
		catch(Exception $e){
			return null;
		}
	}
	
	public function insert(){
		if(Input::hasFile('image')){
			$image = Input::file('image');
			$image->move('assets','company_logo.jpeg');
		}
		
		$inputData = Input::get('data');
		if($inputData!= ""){
			parse_str($inputData, $formFields);
		
			//return $formFields['phone'];
			
			$xml = new SimpleXMLElement('<xml/>');
			
			$xml->addChild('company_name',$formFields['name']);
			$xml->addChild('company_address',$formFields['address']);
			$xml->addChild('company_city',$formFields['city']);
			
			//email
			//$xml->addChild('company email',$formFields['email']);
			foreach($formFields['email'] as $value){
				$email = $xml->addChild('emails');
				$email->addChild('email', $value);
			}
			
			foreach($formFields['phone'] as $value){
				$email = $xml->addChild('phones');
				$email->addChild('phone', $value);
			}
			
			foreach($formFields['fax'] as $value){
				$email = $xml->addChild('faxs');
				$email->addChild('fax', $value);
			}
			$xml->addChild('company_description',$formFields['desc']);
			
			$destination = 'assets/company_profile.xml';
			
			File::put($destination,$xml->asXML());
		}
		return 'Success';
		
	}
}
	