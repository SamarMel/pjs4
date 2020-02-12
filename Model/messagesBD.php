<?php

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

    $sql = "SELECT idConv FROM Conversation where idUser1 = :idUser1 and idUser2 = :idUser2";
    $res = array();
    try {
		$cde = $database->prepare($sql);
		$cde->bindParam(':idUser1', $user1);
		$cde->bindParam(':idUser2', $user2);
        $b = $cde->execute();
        if ($b){
            $res = $cde->fetchAll(PDO::FETCH_ASSOC);
            if (count($res) < 0)
                return createConv($user1, $user2);
            else
                return $res['idConv'][0];        
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec du SELECT : " . $e->getMessage() . "\n");
    }
    return -1;
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