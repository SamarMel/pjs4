<?php

function queryConversations ($id) {
    require(dirname(__FILE__) . "/../database.php");
    $sql = "SELECT * FROM `Conversation` WHERE idUser1 = :id1 OR idUser2 = :id2 ORDER BY id";

    $convs = array();

    try {
        $result = $database->prepare($sql);
        $result->bindParam(':id1', $id);
        $result->bindParam(':id2', $id);
        $result->execute();
        $convs = $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $convs;
}

function queryConversation ($id) {
    require(dirname(__FILE__) . "/../database.php");
    $sql = "SELECT * FROM `Conversation` WHERE id = :id";

    try {
        $result = $database->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        $conv = $result->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        $conv = null;
    }

    return $conv;
}

function queryMessages($idConv) {
    require(dirname(__FILE__) . "/../database.php");
    $sql = "SELECT * FROM `MessageConv` WHERE idConv = :id ORDER BY dateMsg";

    $messages = array();

    try {
        $result = $database->prepare($sql);
        $result->bindParam(':id', $idConv);
        $result->execute();
        $messages = $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    return $messages;
}

function queryUser($id) {
    require(dirname(__FILE__) . "/../database.php");
    $sql = "SELECT * FROM `Utilisateur` WHERE id = :id";

    try {
        $result = $database->prepare($sql);
        $result->bindParam(':id', $id);
        $result->execute();
        $user = $result->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
    }

    return $user;
}

/**
 * Insère dans la BD le message d'une conversation entre 2 personnes
 * @param $idUser
 * @param $idConv
 * @param $message
 */
function insertMessage($idUser, $idConv, $message){
    require(dirname(__FILE__) . '/../database.php');
    $sql = "INSERT INTO MessageConv(idAuteur, idConv, content) VALUES (:idAuteur, :idConv, :msg)";
    echo("bite");
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idConv', $idConv);
        $cde->bindParam(':msg', $message);
        $cde->bindParam(':idAuteur', $idUser);
        $cde->execute();
        echo("bite");
    } catch (PDOException $e) {
        echo utf8_encode("Echec d'INSERT : " . $e->getMessage() . "\n");
        die();
    }
}

function queryBotQuestion($id) {
    $string = file_get_contents("http://pjs4.ulyssebouchet.fr/Model/bot/bot.json");

    $json_a = json_decode($string, true);

    foreach ($json_a as $question) {
        if ($question['id'] == $id)
            return $question;
    }
    return null;
}