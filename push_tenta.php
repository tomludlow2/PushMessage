<?php

	require_once("key_config.php");

	function push_tenta($api_key, $title, $body, $target_url ) {
		$url = "https://tenta.me/$api_key";
		$send_url = $url;
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
		curl_close($curl);
		if(isset($outcome['identifier']) ){
			$success = 1;
		}else {
			$success = 0;
		}
		return $success;
	}

	#$message_sent = push_tenta(KEY_TENTA, "Test Message", "Test Body", "https://google.co.uk");
	#echo "Message sent: response was $message_sent\n";
?>