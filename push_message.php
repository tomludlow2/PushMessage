<?php

	#Push a message to a variety of android app push-notification providers

	function push_message($opts) {
		//Opts:
		/*
			Array(
				"provider" => "alertzy",
				"title" => "body"....)
		*/

		$provider = $opts['provider'];
		if( isset($opts['title']) ) {
			$title = $opts['title'];
		}else {
			$title = "Notification from PushMessage";
		}

		if( isset($opts['body']) ) {
			$body = $opts['body'];
		}else {
			$body = "This is a notification from PushMessage, there isn't any body yet.";
		}

			
		$link = $buttons = $image = $event = $var_3 = $priority = null;
		if( isset($opts['link']) ) $link = $opts['link'];
		if( isset($opts['buttons']) ) $buttons = $opts['buttons'];
		if( isset($opts['image']) ) $image = $opts['image'];
		if( isset($opts['event']) )$event = $opts['event'];	
		if( isset($opts['var_3']) )$var_3 = $opts['var_3'];
		if( isset($opts['priority']) )$priority = $opts['priority'];
		if( isset($opts['var_1']) )$title = $opts['var_1'];
		if( isset($opts['var_2']) )$body = $opts['var_2'];
	
		switch($provider){
			case "alertzy":
				require_once("push_alertzy.php");
				$btn_list = null;
				if(is_array($buttons)) {
					$btn_list = [];
					foreach( $buttons as $btn ) {
						if( count($btn) == 3) {
							$button = Array(
								"text"=>$btn[0],
								"link"=>$btn[1],
								"color"=>$btn[2]
								);
							array_push($btn_list, $button);
						}
					}
					if(count($btn_list) == 0) $btn_list = null;
				}
				$message_outcome = push_alertzy(KEY_ALERTZY, $title, $body, $btn_list, $priority);
				return $message_outcome;
				break;
			case "ifttt":
				require_once("push_ifttt.php");
				$message_outcome = push_ifttt(KEY_IFTTT, $event, $title, $body, $var_3);
				return $message_outcome;
				break;
			case "pushover":
				require_once("push_pushover.php");
				$message_outcome = push_pushover(KEY_PUSHOVER, $title, $body, $target_url=$link);
				return $message_outcome;
				break;
			case "tenta":
				require_once("push_tenta.php");
				$message_outcome = push_tenta(KEY_TENTA, $title, $body, $link);
				return $message_outcome;
				break;
			case "wirepusher":
				require_once("push_wirepusher.php");
				$message_outcome = push_wirepusher(KEY_WIREPUSHER, $title, $body, $link);
				return $message_outcome;
				break;
			case "xdroid":
				require_once("push_xdroid.php");
				$message_outcome =  push_xdroid(KEY_XDROID, $title, $body, $link);
				return $message_outcome;
				break;
			default:
				echo "No provider given";
				$message_outcome = 0;
				return $message_outcome;
				break;
		}
	}

	print("Running Test\n");

	#Alertzy:
	echo "Testing Alertzy Basic:\n";
	$msg = ["provider"=>"alertzy", "title"=>"Alertzy Test", "body"=>"This is a test message for Alertzy"];
	#$alertzy_test = push_message($msg);
	#print("\tAlertzy Test: $alertzy_test\n");

	#Alertzy buttons:
	echo "Testing Alertzy Buttons:\n";
	$buttons = Array();
	$buttons[0] = ["Google", "https://google.co.uk", "success"];
	$buttons[1] = ["BBC", "https://bbc.co.uk", "danger"];
	$msg = ["provider"=>"alertzy", "title"=>"Alertzy Test BTN", "body"=>"This is a test message for Alertzy with Buttons", "buttons"=>$buttons, "priority"=>1];
	#$alertzy_test_buttons = push_message($msg);
	#print("\tAlertzy Buttons Test: $alertzy_test_buttons\n");

	#IFTTT:
	echo "Testing IFTTT:\n";
	$msg = ["provider"=>"ifttt", "title"=>"IFTTT (Equivalent to var_1)", "var_2"=>"This is a test message for IFTTT (Equivalent to var_2", "event"=>"rpi_notify"];
	#$ifttt_test = push_message($msg);
	#print("\tIFTTT Test: $ifttt_test\n");

	#Pushover:
	echo "Testing Pushover:\n";
	$msg = ["provider"=>"pushover", "title"=>"Pushover Test", "body"=>"This is a test message for Pushover"]; 
	#$pushover_test = push_message($msg);
	#print("\tPushover Test: $pushover_test\n");

	#Tenta:
	echo "Testing Tenta:\n";
	$msg = ["provider"=>"tenta", "title"=>"Tenta Test", "body"=>"This is a test message for Tenta", "link"=>"https://google.co.uk"]; 
	#$tenta_test = push_message($msg);
	#print("\tTenta Test: $tenta_test\n");

	#WirePusher
	echo "Testing WirePusher\n";
	$msg = ["provider"=>"wirepusher", "title"=>"WirePusher Test", "body"=>"This is a  message for WirePusher", "link"=>"https://google.co.uk"]; 
	#$wirepusher_test = push_message($msg);
	#print("\tWirePusher Test: $wirepusher_test\n");

	#XDroid
	echo "Testing XDroid\n";
	$msg = ["provider"=>"xdroid", "title"=>"XDroid Test", "body"=>"This is a  message for XDroid", "link"=>"https://google.co.uk"]; 
	#$xdroid_test = push_message($msg);
	#print("\tXDroid Test: $xdroid_test\n");


?>