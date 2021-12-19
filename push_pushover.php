<?php

	require_once("key_config.php");

	function push_pushover($api_key, $title, $body, $target_url = null ) {
		$send_url = "https://tenta.me/$api_key";
		$curl = curl_init($send_url);
		curl_setopt($curl, CURLOPT_URL, $send_url);  
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$headers = array(
		   "Content-Type: application/x-www-form-urlencoded"
		);	
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$data = Array(
			"title"=>$title,
			"description"=>$body
			);

		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));


		$resp = curl_exec($curl);
		$outcome = json_decode($resp, true);
		#$outcome['query'] = http_build_query($data);
		curl_close($curl);
		return $outcome;
	}

	#$message_sent = push_pushover(KEY_PUSHOVER, "Title of Notification", "Body of Notification", "http://google.co.uk");
	#echo "Message sent: response was $message_sent\n";


?>