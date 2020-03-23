<?php



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