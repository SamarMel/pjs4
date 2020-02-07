<?php>

/**
 * Recherche d'un topic en fonction de ce qu'à demandé le user
 */
function rechercherTopic($sujetRechercher){
    require('./connectSQL.php'); 
    
    $sql = "SELECT titre, idAuteur, dateTopic FROM Topic WHERE Contains(titre, :s)";

    try{
        $query = $pdo->prepare($sql);
        $query->bindParam(":s", $sujetRechercher);
        $bool = $query->execute();
        if($bool){
            $resultat=$query->fetchAll(PDO::FETCH_ASSO);
            $_SESSION["rechercheTopic"] = $resultat;
            
        }
    }catch(PDOException $e){
        echo utf8_encode("Echec de recherche de topic : " $e->getMessage(). "\n");
        //LANCER UNE ERREUR 404
        return false;
    }

return true;


}

/*
 *  Créer un topic
 */

 function creerTopic($titreSujet){
     require('./connectSQL.php');
     try{
         $sql="INSERT INTO Topic (titre, idAuteur, dateTopic) VALUES (:titre,:idAuteur,:dateTopic)";
         $query = $dpo->prepare($sql);
         $query->bindParam(':titre', $titreSujet);
         $query->bindParam(':idAuteur', $_SESSION['idAuteur']);
         $query->bindParam(':dateTopic', SYSDATE();

         $bool = $query->execute();
         if($bool){
            $resultat=$query->fetchAll(PDO::FETCH_ASSO);
            $_SESSION["creationTopic"] = $resultat;
           
        }
         

     }catch(PDOException $e){
         echo utf8_encode("Echec de insert : " . $e->collator_get_error_message() . "\n");
         return false;
     }

     return $bool;

 }

 /**
  * Donne les derniers topic
  */

  function derniersTopic(){
      require("./Model/connectSQL.php"); 
      try{
          $sql="SELECT * FROM Topic";
          $query= $pdo->prepare($sql);
          $bool=$query->execute();
          if($bool){
              $resultat=$query->fetchAll(PDO::FETCH_ASSO);
              $_SESSION["derniersTopics"] = $resultat;
             
          }
        }catch(PDOException $e){
              echo utf8_encode("Echec de select : " .$e->getMessage() . "\n");
              return false;
          }
        return true;
      
  }