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
$msg = ["provider"=>"alertzy", "title"=>"Alertzy Test", "body"=>"This is a test message for Alertzy"];
$alertzy_test = push_message($msg);
```
- You can also supply a "priority" property to the message array ```$msg['priorty']=(0|1|2)``` as per alertzy documentation

### Sending Buttons
- This is particularly useful for giving users options, e.g. for a 2FA interface
- Pass a Buttons array, which consists of ("Button Title", "Button URL", "color")
- The colours are the bootstrap colours (primary, success, warning, danger, info, light, dark)
```
$buttons = Array();
$buttons[0] = ["Allow Login", "https://your_url.test/allow", "success"];
$buttons[1] = ["Secure Account", "https://your_url.test/reject", "danger"];
$msg = ["provider"=>"alertzy", "title"=>"Access Attempt", "body"=>"Someone is trying to login to your account, is this you?", "buttons"=>$buttons, "priority"=>1];
$alertzy_test_buttons = push_message($msg);
```

## IFTTT
[IFTTT Webhooks](https://ifttt.com/maker_webhooks)
- Once signed up to IFTTT follow the above tutorial for setting up the IFTTT notifications
- Your key is found by clicking *Documentation* on that page
- The below example assumes your recipe is:
- If *Receive a web request*  -> Then -> Send a notification from the IFTTT app
- I use Message =
- ```Raspberry Pi Status Update:
- Value1
- Value2
- Value3
- ``` 
