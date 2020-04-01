<?php

function getConversations ()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require_once (dirname(__FILE__) . "/../Model/queries.php");

        $conversations = queryConversations($id);

        echo json_encode($conversations);
    }
}

function getConversation ()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require_once (dirname(__FILE__) . "/../Model/queries.php");

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

        require_once (dirname(__FILE__) . "/../Model/queries.php");

        insertMessage($idUser, $idConv, $msg);
    }
}

function getMessages()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require_once (dirname(__FILE__) . "/../Model/queries.php");

        $messages = queryMessages($id);

        echo json_encode($messages);
    }
}

function getUser()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require_once (dirname(__FILE__) . "/../Model/queries.php");

        $user = queryUser($id);

        echo json_encode($user);
    }
}

function getBotQuestion ()
{
    if (isset ($_GET['id'])) {
        $id = $_GET['id'];

        require_once (dirname(__FILE__) . "/../Model/queries.php");

        $question = queryBotQuestion($id);

        echo json_encode($question);
    }
}

function changeRole ()
{
    if (isset ($_GET['idUser']) && isset ($_GET['idRole'])) {
        $idUser = $_GET['idUser'];
        $idRole = $_GET['idRole'];

        require_once (dirname(__FILE__) . "/../Model/queries.php");

        updateRole($idUser, $idRole);
    }
}

function newConv()
{
    if (isset ($_GET['idPerson'])) {
        $idPerson = $_GET['idPerson'];
        $idUser = $_SESSION['idUser'];

        require_once(dirname(__FILE__) . "/../Model/queries.php");

        echo json_encode(createConv($idUser, $idPerson));
    }
}

function traiter () {
    if (isset ($_GET ['id']) && isset ($_GET ['t'])) {
    	$id = $_GET ['id'];
	    $t = $_GET ['t'];
    	
    	require_once (dirname (__FILE__) . "/../Model/queries.php");
    	
    	setAsTraite ($id, $t);
    }
}

function ban () {
	if (isset ($_GET ['id'])) {
		$id = $_GET ['id'];
		
		require_once (dirname (__FILE__) . "/../Model/queries.php");
		
		banUser ($id);
	}
}

if (isset ($_GET['query'])) {
    $_GET['query'] ();
}