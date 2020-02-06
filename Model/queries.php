<?php

function queryConversations ($id) {
    require(dirname(__FILE__) . "/database.php");
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

function queryMessages($idConv) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT * FROM `MessageConv` WHERE idConv = :id ORDER BY id";

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
    require (dirname(__FILE__) . "/database.php");
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