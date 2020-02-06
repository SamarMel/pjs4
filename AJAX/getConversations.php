<?php

$id = $_GET['id'];

require (dirname(__FILE__) . "/../Model/chatbox/chatbox.php");

$conversations = getConversations($id);

echo json_encode($conversations);