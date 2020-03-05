<?php

function loginBD($identifiant, $pwd) {
    require (dirname(__FILE__) .  '/../database.php');

    $sql =
        "SELECT * 
        FROM Utilisateur 
        WHERE (UPPER(pseudo) = UPPER(:pseudo) 
        OR UPPER(mail) = UPPER(:mail))
        AND mdp = :pwd
        ";
    $pwd = hash("sha256", $pwd);

    try {
        $req = $database->prepare($sql);
        $req->bindParam(':pseudo', $identifiant);
        $req->bindParam(':mail', $identifiant);
        $req->bindParam(':pwd', $pwd);
        $res = $req->execute();
        if ($res) {
            $res = $req->fetch(PDO::FETCH_ASSOC)['id'];
            if ($res == null)
                return false;
            $_SESSION['idUser'] = $res;
            setcookie("idUser", $res);
            return true;
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
    return false;
}

function inscription(){
    $mail = isset($_POST['mail'])?($_POST['mail']):'';
    $pseudo = isset($_POST['pseudo'])?($_POST['pseudo']):'';
    $pass = isset($_POST['pass'])?($_POST['pass']):'';
    $acces = false;
    if  (count($_POST) < 3)
        require ("./vue/utilisateur/ident.tpl") ;
    else {
        $acces = createUser($login, $password);
        if  (!$acces) {
            $_SESSION['profil']=array();
            require ("./vue/utilisateur/ident.tpl") ;
        }
        else {
            $_SESSION['profil']= $profil;
            $url = "index.php?controller=utilisateur&action=accueil";
            header ("Location:" .$url) ;
        }
    }
}

function createUser($mail, $pseudo, $password){
    require ('./modele/utilisateurBD.php');
    return createUserBD($mail, $pseudo, $password);
}

?>