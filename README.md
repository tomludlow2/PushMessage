# PushMessage

## Introduction
This is a PHP library to enable you to push notifications to a variety of *mainly* android push notification providers
The general usage:
```
<?php
  require("push_message.php")
  $msg = ["provider" => "message_provider", "title" => "Message Title", "body" => "The message body content for the notification"];
  $result = push_message($msg); 
?>
```
