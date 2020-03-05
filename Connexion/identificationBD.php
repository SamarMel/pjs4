<?php

/**
 * Création d'un nouvel utilisateur, LOGIN UNIQUE
 */
function createUserBD($mail, $pseudo, $password){
    require (dirname(__FILE__) .  '/database.php');
    if (estPris($pseudo))
        return false;
    else {
        $sql = "INSERT INTO Utilisateur(pseudo, mdp, role, mail) VALUES (:pseudo, :mdp, :role, :mail)";
        $password = hash("sha256", $password);
        $role = "default";
        try {
            $cde = $database->prepare($sql);
            $cde->bindParam(':pseudo', $pseudo);
            $cde->bindParam(':mdp', $password);
            $cde->bindParam(':role', $role);
            $cde->bindParam(':mail', $mail);
            $b = $cde->execute();
        } catch (PDOExecption $e){
            echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
        }
        return true;
    }
}

/**
 * Verifie si un user est présent dans la BD (pseudo ou mail)
 */
function estPrisBD($login){
    require (dirname(__FILE__) .  '/database.php');
    $sql_pseudo = "SELECT pseudo FROM Utilisateur where Upper(pseudo) = Upper(:pseudo)";
    $res_pseudo = array();

    $sql_mail = "SELECT pseudo FROM Utilisateur where mail = :mail";
    $res_mail = array();

    $pseudo = false;
    $mail = false;

    try {
        $cde_pseudo = $database->prepare($sql_pseudo);
        $cde_pseudo->bindParam(':pseudo', $login);
        $b_pseudo = $cde_pseudo->execute();
        if ($b_pseudo){
            if (count($res_pseudo) > 0)
                $pseudo = true;
        }

        $cde_mail = $database->prepare($sql_mail);
        $cde_mail->bindParam(':mail', $login);
        $b_mail = $cde_mail->execute();
        if ($b_mail){
            if (count($res_mail) > 0)
                $pseudo = true;
        }

        return $pseudo || $mail;

    } catch (PDOExecption $e){
        echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
    }

}



/**
 * Modifie le rôle d'un utilisateur
 */
function modificationRole($login, $role){
    require (dirname(__FILE__) .  '/database.php');
    $sql = "UPDATE Utilisateur set role=:role WHERE user=:pseudo";
    try {
        $cde = $database->prepare($sql);
        $cde->bindParam(':pseudo', $login);
        $cde->bindParam(':role', $role);
        $b = $cde->execute();
    } catch (PDOExecption $e){
        echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
    }
}

?>