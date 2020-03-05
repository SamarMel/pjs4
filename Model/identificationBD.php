<?php

/**
 * Création d'un nouvel utilisateur, LOGIN UNIQUE
 * @param $login
 * @param $password
 * @param $mail
 * @return bool
 */
function createUserBD($login, $password, $mail){
    require(dirname(__FILE__) . '/database.php');
    if (estPrisBD($login))
        return false;
    else {
        $sql = "INSERT INTO Utilisateur(pseudo, mdp, role, mail) VALUES (:pseudo, :mdp, :role, :mail)";
        $password = hash("sha256", $password);
        $role = "default";
        try {
            $cde = $database->prepare($sql);
            $cde->bindParam(':pseudo', $login);
            $cde->bindParam(':mdp', $password);
            $cde->bindParam(':rolee', $role);
            $cde->bindParam(':mail', $mail);
            $b = $cde->execute();
        } catch (PDOException $e){
            echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
        }
        return true;
    }
}

/**
 * Verifie si un user est présent dans la BD
 * @param $login
 * @return bool
 */
function estPrisBD($login){
    require(dirname(__FILE__) . '/./database.php');
    $sql = "SELECT pseudo FROM Utilisateur where Upper(pseudo) = Upper(:pseudo)";
    $res = array();
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':pseudo', $login);
        $b = $cde->execute();
        if ($b){
            if (count($res) > 0)
                return true;
            else
                return false;
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
    }
    return false;
}


/**
 * Vérification des identifiants d'un utilisateur
 * @param $login
 * @param $password
 * @return bool
 */
function verificationLoginPasswordBD($login, $password){
    require(dirname(__FILE__) . '/./database.php');
    $sql = "SELECT idUser FROM Utilisateur where Upper(pseudo) = Upper(:pseudo) and mdp = :pass";
    $res = array();
    $password = hash("sha256", $password);
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':pseudo', $login);
        $cde->bindParam(':pass', $password);
        $b = $cde->execute();
        if ($b){
            if (count($res) > 0)
                return true;
            else
                return false;
        }
    } catch (PDOException $e){
        echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
    }
    return false;
}