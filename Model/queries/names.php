<?php

/**
 * @param $idCategorie
 * @return mixed|null
 */
function getCategorieName ($idCategorie) {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT * FROM Categorie WHERE id = :idCategorie";
        $query = $database->prepare($sql);
        $query->bindParam(':idCategorie', $idCategorie);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['intitulé'];
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @param $idAuteur
 * @return mixed|null
 */
function getUserName ($idAuteur) {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT * FROM Utilisateur WHERE id = :idAuteur";
        $query = $database->prepare($sql);
        $query->bindParam(':idAuteur', $idAuteur);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['pseudo'];
    } catch(PDOException $e) {
        return null;
    }
}