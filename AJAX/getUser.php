<?php

$id = $_GET['id'];

require (dirname(__FILE__) . "/../Model/chatbox/chatbox.php");

$user = getUser($id);

echo json_encode($user);