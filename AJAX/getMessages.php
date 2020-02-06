<?php

$id = $_GET['id'];

require (dirname(__FILE__) . "/../Model/chatbox/chatbox.php");

$messages = getMessages($id);

echo json_encode($messages);