<?php
/**
 * Recherche d'un topic en fonction de ce qu'à demandé le user
 * @param $sujet
 * @return bool
 */
function rechercherTopic($sujet) {
    require (dirname(__FILE__) . '/database.php');

    $sql = "SELECT titre, idAuteur, dateTopic FROM Topic WHERE Contains(titre, :s)";

    try {
        $query = $database->prepare($sql);
        $query->bindParam(":s", $sujet);
        $bool = $query->execute();
        if ($bool) {
            $resultat = $query->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION["rechercheTopic"] = $resultat;
        }
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de recherche de topic : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}

/**
 *  Créer un topic
 * @param $sujet
 * @return bool
 */
function createTopic($sujet) {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql = "INSERT INTO Topic (titre, idAuteur, dateTopic) VALUES (:titre, :idAuteur, :dateTopic)";
        $query = $database->prepare($sql);
        $query->bindParam(':titre', $sujet);
        $query->bindParam(':idAuteur', $_SESSION['idAuteur']);
        $query->bindParam(':dateTopic', SYSDATE());
        $query->execute();
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de insert : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}

/**
 * Donne les derniers topic
 */
function derniersTopic() {
    require (dirname(__FILE__) . '/database.php');
    try {
        $sql = "SELECT * FROM Topic";
        $query = $database->prepare($sql);
        $bool = $query->execute();
        if ($bool) {
            $resultat = $query->fetchAll(PDO::FETCH_ASSO);
            $_SESSION["derniersTopics"] = $resultat;
        }
    }
    catch(PDOException $e) {
        echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
        return false;
    }
    return true;
}