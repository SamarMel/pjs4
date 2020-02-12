<?php
/**
 * Crée un tuple questionnaire pour un utilisateur
 * @param $user
 */
function createQuestionnaire($user){
    require (dirname(__FILE__) . '/./database.php');
    $sql = "INSERT INTO Questionnaire(idUser) VALUES (:idUser)";
    try {
		$cde = $database->prepare($sql);
		$cde->bindParam(':idUser1', $user);
        $b = $cde->execute();
    } catch (PDOException $e){
        echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
    }
}

/**
 * Insert une réponse d'un utilisateur pour une question et un questionnaire
 * @param $user
 * @param $idQuestion
 * @param $idReponse
 * @param $contenu
 */
function createReponseUtilisateur($user, $idQuestion, $idReponse, $contenu){
    require (dirname(__FILE__) . '/./database.php');
    $sql = "INSERT INTO ReponseUtilisateur(idReponse, idQuestion, idQuestionnaire, contenu) VALUES (:idReponse, :idQuestion, :idQuestionnaire, :contenu)";
    try {
		$cde = $database->prepare($sql);
        $cde->bindParam(':idReponse', $idReponse);
        $cde->bindParam(':idQuestion', $idQuestion);
        $cde->bindParam(':idQuestionnaire', $idQuestionnaire);
        $cde->bindParam(':contenu', $contenu);
        $b = $cde->execute();
    } catch (PDOException $e){
        echo utf8_encode("Echec du INSERT : " . $e->getMessage() . "\n");
    }
}