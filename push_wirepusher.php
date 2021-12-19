<?php

	require_once("key_config.php");

	function push_wirepusher($api_key, $title, $body, $target_url, $image_url = null, $message_id = null ) {
		$send_url = "https://wirepusher.com/send";
		$curl = curl_init($send_url);
		curl_setopt($curl, CURLOPT_URL, $send_url);  
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$headers = array(
		   "Content-Type: application/x-www-form-urlencoded"
		);	
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$data = Array(
			"id"=>$api_key,
			"title"=>$title,
			"message"=>$body,
			"action"=>$target_url,
			"image_url"=>$image_url,
			"message_id" => $message_id
			);

		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));


		$resp = curl_exec($curl);
		$outcome = json_decode($resp, true);
		curl_close($curl);

		//print_r($outcome);
		$success = 0;
		if( isset($outcome['errors'])){
			if( $outcome['errors'] == 0) {
				$success = 1;
			}
		}
		return $success;
	}

	#$message_sent = push_wirepusher(KEY_WIREPUSHER, "Test Message Body1", "Test Body 1", "https://google.co.uk");
	#echo "Message sent: response was $message_sent\n";

?>