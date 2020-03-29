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

function queryConversation ($id) {
    require(dirname(__FILE__) . "/database.php");
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
    require(dirname(__FILE__) . "/database.php");
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

function getAllUsers($s) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT U.*, R.role 
            FROM Utilisateur U, Role R 
            WHERE U.idRole = R.id 
            AND (U.pseudo LIKE :s
            OR U.mail LIKE :s)
            GROUP BY U.id 
            ORDER BY U.pseudo";

    $s = "%$s%";
    try {
        $result = $database->prepare($sql);
        $result->bindParam(':s', $s);
        $result->execute();
        $user = $result->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo $e->getMessage();
        return null;
    }

    return $user;
}

function queryUser($id) {
    require(dirname(__FILE__) . "/database.php");
    $sql = "SELECT U.*, R.role FROM Utilisateur U, Role R WHERE U.id = :id AND U.idRole = R.id GROUP BY U.id";

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
    require(dirname(__FILE__) . '/database.php');
    $sql = "INSERT INTO MessageConv(idAuteur, idConv, content) VALUES (:idAuteur, :idConv, :msg)";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idConv', $idConv);
        $cde->bindParam(':msg', $message);
        $cde->bindParam(':idAuteur', $idUser);
        $cde->execute();
    } catch (PDOException $e) {
        echo utf8_encode("Echec d'INSERT : " . $e->getMessage() . "\n");
        die();
    }
}

function insertReport ($idUser, $idReported, $page, $motif){
    require(dirname(__FILE__) . '/database.php');
    $sql = "INSERT INTO `Signalement`(`idSignaleur`, `idSignalé`, `motif`) VALUES (:idUser, :idReported, :motif)";
    $motif = "Origine du signalement : $page <br> Motif : $motif";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idUser', $idUser);
        $cde->bindParam(':idReported', $idReported);
        $cde->bindParam(':motif', $motif);
        $cde->execute();
    } catch (PDOException $e) {
        echo utf8_encode("Echec d'INSERT : " . $e->getMessage() . "\n");
        die();
    }
}

function updateRole($idUser, $idRole){
    require(dirname(__FILE__) . '/database.php');
    $sql = "UPDATE Utilisateur SET idRole = :idRole WHERE id = :id";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idRole', $idRole);
        $cde->bindParam(':id', $idUser);
        $cde->execute();
    } catch (PDOException $e) {
        echo utf8_encode("Echec d'UPDATE : " . $e->getMessage() . "\n");
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


/**
 * Return la conversation associée à deux personnes et la crée si elle n'existe pas
 * @param $user1
 * @param $user2
 * @return mixed
 */
function getIdConv($user1, $user2){
    require(dirname(__FILE__) . '/./database.php');
    if ($user1 > $user2){
        $user1 += $user2;
        $user2 = $user1 - $user2;
        $user1 -= $user2;
    }

    $sql = "SELECT id FROM Conversation WHERE idUser1 = :idUser1 AND idUser2 = :idUser2";
    $res = array();
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idUser1', $user1);
        $cde->bindParam(':idUser2', $user2);
        $cde->execute();
        $res = $cde->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e){
        echo utf8_encode("Echec du SELECT : " . $e->getMessage() . "\n");
    }
    return $res;
}

/**
 * Crée une conversation entre deux utilisateurs
 * @param $user1
 * @param $user2
 * @return mixed
 */
function createConv($user1, $user2){
    require(dirname(__FILE__) . '/./database.php');
    if ($user1 > $user2){
        $user1 += $user2;
        $user2 = $user1 - $user2;
        $user1 -= $user2;
    }
    $sql = "INSERT INTO Conversation(idUser1, idUser2) VALUES (:idUser1, :idUser2)";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':idUser1', $user1);
        $cde->bindParam(':idUser2', $user2);
        $b = $cde->execute();
    } catch (PDOException $e){
        echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
    }
    return getIdConv($user1, $user2);
}