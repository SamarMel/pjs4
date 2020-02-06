<?php

function getConversations ()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require(dirname(__FILE__) . "/../Model/queries.php");

        $conversations = queryConversations($id);

        echo json_encode($conversations);
    }
}

function getMessages()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require(dirname(__FILE__) . "/../Model/queries.php");

        $messages = queryMessages($id);

        echo json_encode($messages);
    }
}

function getUser()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require(dirname(__FILE__) . "/../Model/queries.php");

        $user = queryUser($id);

        echo json_encode($user);
    }
}

if (isset ($_GET['query'])) {
    $query = $_GET['query'];

    $query ();
}