# PushMessage

## Introduction
This is a PHP library to enable you to push notifications to a variety of *mainly* android push notification providers
The general usage:
```
<?php
  require("push_message.php")
  $msg = [
    "provider" => "message_provider", 
    "title" => "Message Title", 
    "body" => "The message body content for the notification"
  ];
  $result = push_message($msg); 
?>
```

## Setup
1. Copy ```key_config.php.default``` to ```key_config.php```
2. Edit key_config.php and paste your API keys for the apps you would like to use
3. See above for how to send a notification or below for specifics for each app

## Alertzy
[Alertzy App](https://alertzy.app/)
- This is my most-used app, the limits are generous and it's quite well documented online. 
- It suports either simple messages or messages with buttons:
### Simple Messages
```
$msg = [
  "provider"=>"alertzy", 
  "title"=>"Alertzy Test", 
  "body"=>"This is a test message for Alertzy"
];
$alertzy_test = push_message($msg);
```
- You can also supply a "priority" property to the message array ```$msg['priorty']=(0|1|2)``` as per alertzy documentation
- For further customisation see ```push_alertzy.php```

### Sending Buttons
- This is particularly useful for giving users options, e.g. for a 2FA interface
- Pass a Buttons array, which consists of ("Button Title", "Button URL", "color")
- The colours are the bootstrap colours (primary, success, warning, danger, info, light, dark)
```
$buttons = Array();
$buttons[0] = ["Allow Login", "https://your_url.test/allow", "success"];
$buttons[1] = ["Secure Account", "https://your_url.test/reject", "danger"];
$msg = [
  "provider"=>"alertzy", 
  "title"=>"Access Attempt", 
  "body"=>"Someone is trying to login to your account, is this you?", 
  "buttons"=>$buttons, 
  "priority"=>1
];
$alertzy_test_buttons = push_message($msg);
```
- For further customisation see ```push_alertzy.php```

## IFTTT
[IFTTT Webhooks](https://ifttt.com/maker_webhooks)
- Once signed up to IFTTT follow the above tutorial for setting up the IFTTT notifications
- Your key is found by clicking *Documentation* on that page
- The below example assumes your recipe is:
- If *Receive a web request*  -> Then -> Send a notification from the IFTTT app
- I use Message =
```
Raspberry Pi Status Update:
Value1
Value2
Value3
``` 
PushMessage usage:
```
$msg = [
  "provider"=>"ifttt", 
  "event"="rpi_notify"
  "title"=>"IP Address Change", 
  "body"=>"The IP Address of the Raspberry Pi has changed"
  "var_3"=> "127.0.0.1" ];
	#$ifttt_test = push_message($msg);
```
- For the sake of uniformity ```$msg['var_1']``` is handled the same as ```$msg['title']``` and ```$msg['var_2'] == $msg['body`]``` so you can use either. 
- (title and body) are kept in case you wanted to send multiple messages (which you can do by simply chaning ```$msg['provider']``` each iteration
- For further customisation see ```push_ifttt.php```


## Pushover
[Pushover](https://pushover.net/)
- This one has a 30 day trial but seems to have loads of providers and other things you can do with the notifications
- Usage:
```
$msg = [
  "provider"=>"pushover", 
  "title"=>"Pushover Test", 
  "body"=>"This is a test message for Pushover",
  "image"=>"https://an_image_of_choice.jpg"
  "
 ]; 
$pushover_test = push_message($msg);
```
- For further customisation see ```push_pushover.php```

## Tenta
[Tenta](https://tenta.me/)
- Basic GUI but nice clean notifications
- Main limiting factor is 10 notifications per day
- Usage:
```
$msg = [
  "provider"=>"tenta", 
  "title"=>"Tenta Test", 
  "body"=>"Clicking this link will send you to Google", 
  "link"=>"https://google.co.uk"
]; 
$tenta_test = push_message($msg);
```
- For further customisation see ```push_tenta.php```

## WirePusher
[WirePusher](https://wirepusher.com/)
- This has short API Keys which are easier for users to copy
- Notifications can be deleted per "day / 7 days / etc"
- The app also supports different notification *types* ie controlling ringing / buzzing / lights on phone (not yet supported in PushMessage but should be easy for you to add at deployment, just edit ```push_wirepusher.php```
- Usage:
```
$msg = [
  "provider"=>"wirepusher", 
  "title"=>"WirePusher Test", 
  "body"=>"This is a  message for WirePusher", 
  "link"=>"https://google.co.uk"
]; 
$wirepusher_test = push_message($msg);
```
- For further customisation see ```push_wirepusher.php```

## XDroid
[XDroid](https://play.google.com/store/apps/details?id=net.xdroid.pn&hl=en&gl=US)
- I've called it XDroid as there's no memorable name, and the domain they use is xdroid.net
- The app itself is called Push Notification API *Supported by ads*
- Usage:
```
$msg = [
  "provider"=>"xdroid", 
  "title"=>"XDroid Test", 
  "body"=>"This is a  message for XDroid", 
  "link"=>"https://google.co.uk"
]; 
$xdroid_test = push_message($msg);
```
- For further customisation see ```push_xdroid.php```


## Other Apps
- Please let me know if there are any other app providers that would be good. 
- I end up with different notification apps for different reasons, and having a single function is useful for that purpose, hope it's useful for you too

## Planned Further Adapations
- Make images work more uniformally with the providers that can do images
- Python Library of equivalence

