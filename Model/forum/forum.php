<?php

/**
 * @return array|null
 */
function getLastTopics () {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql =
            "SELECT T.*, U.pseudo AS 'auteur', C.intitulé AS 'categorie', P.datePost AS 'lastPost'
            FROM Topic T, Post P, Utilisateur U, Categorie C
            WHERE T.id = P.idTopic
            AND T.idAuteur = U.id
            AND T.idCategorie = C.id
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
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql =
            "SELECT T.*, U.pseudo AS 'auteur', C.intitulé AS 'categorie', P.datePost AS 'lastPost'
            FROM Topic T, Post P, Utilisateur U, Categorie C
            WHERE T.titre LIKE :name
            AND T.idCategorie = :category
            AND T.idCategorie = C.id
            AND T.id = P.idTopic
            AND T.idAuteur = U.id
            GROUP BY T.id
            ORDER BY P.datePost DESC";

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

/**
 * @return array|null
 */
function getCategories () {
    require(dirname(__FILE__) . '/../database.php');
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
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT U.*, R.role FROM Utilisateur U, Role R WHERE U.id = :idAuteur AND U.idRole = R.id ";
        $query = $database->prepare($sql);
        $query->bindParam(':idAuteur', $idAuteur);
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
function getTopic($id) {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT T.*, C.intitulé AS 'categorie' FROM Topic T, Categorie C WHERE T.id = :id";
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
    require(dirname(__FILE__) . '/../database.php');
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

/**
 *  Créer un topic
 * @param $sujet
 * @return bool
 */
function insertTopic($sujet, $idC) {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "INSERT INTO Topic (titre, idAuteur) VALUES (:titre, :idAuteur, :idC)";
        $query = $database->prepare($sql);
        $query->bindParam(':titre', $sujet);
        $query->bindParam(':idAuteur', $_SESSION['idAuteur']);
        $query->bindParam(':idC', $idC);
        $query->execute();
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de insert : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}

/**
 * Poster un message
 * 
 */
function postBD($post, $idTopic){
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "INSERT INTO Post (idAuteur, idTopic, content, dateMsg) VALUES (:idA, :idT, :c, now())";
        $query = $database->prepare($sql);
        $query->bindParam(':idA', $_SESSION['idUser']);
        $query->bindParam(':idT', $idTopic);
        $query->bindParam(':c', $post);
        $query->execute();
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de insert : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}


/**
 * Manque un truc :
 * - Si le signalement existait déjà -->UPDATE en traité = SELECT * FROM Signalement WHERE ??? IDK (il manque l'id du message genre)
 *           puis si count == 1 UPDATE Signalement SET traité = 1; 
 * - Sinon INSERT INTO Signalement (idSignaleur, idSignalé, motif, traité) VALUES (:idT, :idU, 'Modération', 1)
 */
function  supprimerPostBD($idMsg){
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "UPDATE Post SET content='Ce message a été supprimé par un modérateur.' WHERE id=:id";
        $query = $database->prepare($sql);
        $query->bindParam(':id', $idMsg);
        $query->execute();
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de insert : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}


function saveDescription($description){
    require(dirname(__FILE__) . '/../database.php');
}