<?php

	require_once("key_config.php");

	function push_xdroid($api_key, $title, $body, $target_url) {
		$send_url = "http://xdroid.net/api/message";
		$curl = curl_init($send_url);
		curl_setopt($curl, CURLOPT_URL, $send_url);  
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
		$headers = array(
		   "Content-Type: application/x-www-form-urlencoded"
		);	
		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		$data = Array(
			"k"=>$api_key,
			"t"=>$title,
			"c"=>$body,
			"u"=>$target_url
			);

		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));


		$resp = curl_exec($curl);
		$outcome = json_decode($resp, true);
		//$outcome['query'] = http_build_query($data);
		curl_close($curl);
		if($outcome['success'] == 1){
			return 1;
		}else{
			return 0;
		}
	}

	#$message_sent = push_xdroid(KEY_XDROID, "Test Message", "Test Body", "https://google.co.uk");
	#echo "Message sent: response was $message_sent\n";

?>