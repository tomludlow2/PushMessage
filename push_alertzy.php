<?php
	
	require_once("key_config.php");
	
	//Push an Alertzy Message
	function push_alertzy($api_key, $title, $body, $buttons = null, $priority = 0 ) {
		$send_url = "https://alertzy.app/send";	
		$curl = curl_init($send_url);
		curl_setopt($curl, CURLOPT_URL, $send_url); 
		curl_setopt($curl, CURLOPT_POST, true);   
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  
		$headers = array(
		   "Content-Type: application/x-www-form-urlencoded"
		);	
		
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$data = Array(
			"accountKey"=>$api_key,
			"title"=>$title,
			"message"=>$body
			);
		
		if( $priority != 0 && is_numeric($priority)) {
			$data['priority'] = intval($priority);			
		}

		
		if( $buttons == null ) {
			
		}else if( is_array($buttons) ) {
			$data['buttons'] = json_encode($buttons);
		}
		
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		$resp = curl_exec($curl);
		$outcome = json_decode($resp, true);		
		curl_close($curl);
		if($outcome['response'] == "success") {
			return 1;
		}else {
			return 0;
		}
	}

	function generate_button($text, $link, $color) {
		//Returns a button
		$button = Array(
			"text"=>$text,
			"link"=>$link,
			"color"=>$color);
		return $button;	
	}
	
	#$buttons = [generate_button("Test Button 1", "http://google.co.uk", "success"), generate_button("Test Button 2", "http://bbc.co.uk", "warning")];
	#$message_sent = push_alertzy(KEY_ALERTZY, "Test Message", "Body", $buttons, 1);
	#echo "Message sent: response was $message_sent\n";

?>