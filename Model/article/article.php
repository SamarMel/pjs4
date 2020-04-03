<?php
/**
 * @param $id
 * @return array|null
 */
function getArticlesByAuthor($id) {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "SELECT * FROM Article WHERE idAuteur = :idAuteur ORDER BY datePubli DESC";
        $query = $database->prepare($sql);
        $query->bindParam(':idAuteur', $id);
        $query->execute();
	    //$result = array_slice($result, 0, 4);
        return $query->fetchAll(PDO::FETCH_ASSOC);
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
 * @param $id
 * @param $titre
 * @param $accroche
 * @param $texte
 * @param $image
 */
function updateArticle($id, $titre, $accroche, $texte, $image){
	require(dirname(__FILE__) . '/../database.php');
	try {
	    $sql = "UPDATE ARTICLE SET titre = :titre, accroche = :accroche, texte = :texte, image = :image WHERE id = :id";
	    $query = $database->prepare($sql);
	    $query->bindParam(':id', $id);
	    $query->bindParam(':titre', $titre);
	    $query->bindParam(':accroche', $accroche);
	    $query->bindParam(':texte', $texte);
	    $query->bindParam(':image', $image);
	    $query->execute();
	} catch(PDOException $e) {
	}
}

/**
 * @param $id
 */
function deleteArticle($id) {
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "DELETE FROM ARTICLE WHERE id = :id";
        $query = $database->prepare($sql);
        $query->bindParam(':id', $id);
        $query->execute();
    } catch(PDOException $e) {
    }
}

/**
 * @param $idAuteur
 * @param $idCat
 * @param $id
 * @param $titre
 * @param $accroche
 * @param $texte
 * @param $image
 */
function createArticle($idAuteur,$idCat, $titre, $accroche, $texte, $image){
    require(dirname(__FILE__) . '/../database.php');
    try {
        $sql = "INSERT INTO ARTICLE(idAuteur,idCategorie, titre, accroche, texte, imageIllustration) VALUES (:idAuteur,:idCat, :titre, :accroche, :texte, :image)";
        $query = $database->prepare($sql);
        $query->bindParam(':idAuteur', $idAuteur);
        $query->bindParam(':idCat', $idCat);
        $query->bindParam(':titre', $titre);
        $query->bindParam(':accroche', $accroche);
        $query->bindParam(':texte', $texte);
        $query->bindParam(':image', $image);
        $query->execute();
    } catch(PDOException $e) {
    }
}