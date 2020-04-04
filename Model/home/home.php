<?php

/**
 * @return array|null
 */
function getRecentArticles() {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT * FROM Article ORDER BY datePubli DESC";
        $query = $database->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $result = array_slice($result, 0, 4);
        return $result;
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @param $id
 * @return null
 */
function getArticle($id) {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT A.*, U.pseudo AS 'auteur', C.intitulé AS 'categorie'
                FROM Article A, Utilisateur U, Categorie C 
                WHERE A.id = :id
                AND U.id = A.idAuteur
                AND C.id = A.idCategorie";
        $query = $database->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        return null;
    }
}

/**
 * @param $idCate
 * @return null
 */
function getArticles($idCate) {
	require(dirname(__FILE__) . '/../database.php');
	try {
		$sql = "SELECT A.*, U.pseudo AS 'auteur', C.intitulé AS 'categorie'
                FROM Article A, Utilisateur U, Categorie C
                WHERE C.id = :id
                AND C.id = A.idCategorie
                AND U.id = A.idAuteur
             	ORDER BY A.datePubli DESC";
		$query = $database->prepare($sql);
		$query->bindParam(':id', $idCate);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);
	} catch(PDOException $e) {
		return null;
	}
}

function getCategorie($id) {
	require(dirname(__FILE__) . '/../database.php');
	try {
		$sql = "SELECT intitulé
                FROM Categorie
                WHERE id = :id";
		$query = $database->prepare($sql);
		$query->bindParam(':id', $id);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC)['intitulé'];
	} catch(PDOException $e) {
		return null;
	}
}