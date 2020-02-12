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

function getConversation ()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require(dirname(__FILE__) . "/../Model/queries.php");

        $conversation = queryConversation($id);

        echo json_encode($conversation);
    }
}

function sendMessage ()
{
    if (isset ($_GET['idConv']) && isset ($_GET['idUser']) && isset ($_GET['msg'])) {
        $idConv = $_GET['idConv'];
        $idUser = $_GET['idUser'];
        $msg = $_GET['msg'];

        require(dirname(__FILE__) . "/../Model/queries.php");

         insertMessage($idUser, $idConv, $msg);
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