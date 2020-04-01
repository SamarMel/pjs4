<?php
//Pour Tableau de Bord Démarche
function getEnCours($idU){
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT * FROM Demarche WHERE idUser=:idU AND isTermine=false;";
        $query = $database->prepare($sql);
        $query->bindParam(':idU', $idU);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}
function getFinies($idU){
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT * FROM Demarche WHERE idUser=:idU AND isTermine=true;";
        $query = $database->prepare($sql);
        $query->bindParam(':idU', $idU);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}

function newDemarcheBD($libelle, $idU, $rmq){
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "INSERT INTO Demarche (libelle, idUser, Rmq) VALUES (:l, :i, :r)";
        $query = $database->prepare($sql);
        $query->bindParam(':l', $libelle);
        $query->bindParam(':i', $idU);
        $query->bindParam(':r', $rmq);
        $query->execute();
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de insert : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}

function getDocsBD($id){
   
}

function supprimerBD($id){

}

//Pour mettre à jour une démarche
function finirBD($id){
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "INSERT INTO Demarche (libelle, idUser, Rmq) VALUES (:l, :i, :r)";
        $query = $database->prepare($sql);
        $query->bindParam(':l', $libelle);
        $query->bindParam(':i', $idU);
        $query->bindParam(':r', $rmq);
        $query->execute();
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de insert : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}

function abandonnerBD($id){
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "INSERT INTO Demarche (libelle, idUser, Rmq) VALUES (:l, :i, :r)";
        $query = $database->prepare($sql);
        $query->bindParam(':l', $libelle);
        $query->bindParam(':i', $idU);
        $query->bindParam(':r', $rmq);
        $query->execute();
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de insert : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}

function ajouterDocBD($id, $libelle, $isRendu){

}

function changerRmq($id, $rmq){
   
}


?>