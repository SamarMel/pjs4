<?php

function loginDB($identifiant, $pwd) {
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
        return false;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}

function registerDB($pseudo, $mail, $pwd, $img) {
    require (dirname(__FILE__) .  '/../database.php');
    if (isTaken($pseudo) && isTaken($mail))
        return false;
    else {
        $sql = "INSERT INTO Utilisateur(pseudo, mdp, mail, imageProfil) VALUES (:pseudo, :pwd, :mail, :img)";
        $pwd = hash("sha256", $pwd);
        try {
            $req = $database->prepare($sql);
            $req->bindParam(':pseudo', $pseudo);
            $req->bindParam(':pwd', $pwd);
            $req->bindParam(':mail', $mail);
            $req->bindParam(':img', $img);
            $res = $req->execute();
            if ($res)
                return true;
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}

function isTaken($ident) {
    require (dirname(__FILE__) .  '/../database.php');
    $sql = "SELECT * FROM Utilisateur WHERE UPPER(pseudo) = UPPER(:pseudo) OR UPPER(mail) = UPPER(:mail)";

    try {
        $req = $database->prepare($sql);
        $req->bindParam(':pseudo', $ident);
        $req->bindParam(':mail', $ident);
        $res = $req->execute();
        if ($res) {
            $res = $req->fetchAll(PDO::FETCH_ASSOC);
            if($res == null)
                return false;
            return true;
        }
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return true;
    }
}