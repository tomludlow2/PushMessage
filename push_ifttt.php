<?php

	require_once("key_config.php");

	function push_ifttt($key, $event, $val1, $val2 = null, $val3 = null) {
		$url = "https://maker.ifttt.com/trigger/$event/with/key/$key";
		$data = array('value1' => $val1, 'value2' => $val2, 'value3' => $val3);

		// use key 'http' even if you send the request to https://...
		$options = array(
		    'http' => array(
		        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
		        'method'  => 'POST',
		        'content' => http_build_query($data)
		    )
		);
		$context  = stream_context_create($options);
		$result = file_get_contents($url, false, $context);
		if ($result === FALSE) {
			//echo "ERROR: Notification Failed\n";
			return 0;
		}else if( preg_match("/Congratulation/i", $result) ) {
			//echo "SUCCESS: Notification Sent Successfully\n";
			return 1;
		}else {
			return 0;
		}
	}

	

	//$message_sent = push_ifttt(KEY_IFTTT, "rpi_notify", "Test Var 1", "Test Var 2", "Test Var 3");
	//echo "Message sent: response was $message_sent\n";



?>