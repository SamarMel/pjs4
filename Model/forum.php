<?php

/**
 * @return array|null
 */
function getLastTopics () {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql =
            "SELECT T.* 
            FROM Topic T, Post P
            WHERE T.id = P.idTopic
            GROUP BY T.id
            ORDER BY P.datePost DESC";
        $query = $database->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = array_slice($result, 0, 3);
        return $result;
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @param $name
 * @param $category
 * @return null
 */
function getTopics ($name, $category) {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql = "SELECT * FROM Topic WHERE titre LIKE :name AND idCategorie = :category ORDER BY dateTopic DESC";

        $name = "%$name%";
        $query = $database->prepare($sql);
        $query->bindParam(':name', $name);
        $query->bindParam(':category', $category);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}

function getLastPostDate($id) {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql = "SELECT P.* FROM Post P, Topic T WHERE P.idTopic = T.id AND T.id = :id ORDER BY P.datePost DESC";

        $query = $database->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC)['datePost'];
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @return array|null
 */
function getCategories () {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql = "SELECT * FROM Categorie ORDER BY intitulé";
        $query = $database->prepare($sql);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @param $idAuteur
 * @return null
 */
function getAuthor($idAuteur) {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql = "SELECT * FROM Utilisateur WHERE id = :idAuteur";
        $query = $database->prepare($sql);
        $query->bindParam(':idAuteur', $idAuteur);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @param $idAuteur
 * @return mixed|null
 */
function getAuthorName ($idAuteur) {
    require (dirname(__FILE__) . '/database.php');
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

/**
 * @param $idCategorie
 * @return mixed|null
 */
function getCategorieName ($idCategorie) {
    require (dirname(__FILE__) . '/database.php');
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
 * @param $id
 * @return null
 */
function getTopic($id) {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql = "SELECT * FROM Topic WHERE id = :id";
        $query = $database->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @param $id
 * @return null
 */
function getPosts($id) {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql = "SELECT * FROM Post WHERE idTopic = :id ORDER BY datePost";
        $query = $database->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}