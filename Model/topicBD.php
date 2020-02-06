<?php 


/****************Pour la page Test : Traitement du test ****************/

//Récupération des posts du Topic
function getPostsBD($idTopic){
	require('./modele/connectSQL.php');
	$sql="SELECT * FROM post WHERE idTopic=:id";
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id', $idTopic);
		$bool = $commande->execute();
		if ($bool) {
			$posts = $commande->fetchAll(PDO::FETCH_ASSOC);
			return $posts;
		}
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); 
	}
}

//Récupération des infos sur le Topic
function getTopic($idTopic){
	require('./modele/connectSQL.php');
	$sql="SELECT * FROM topic WHERE id=:id";
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id', $idTopic);
		$bool = $commande->execute();
		if ($bool) {
			$res = $commande->fetchAll(PDO::FETCH_ASSOC);
			return $res[0];
		}
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); 
	}
}

function getUser($idUsr){
	require('./modele/connectSQL.php');
	$sql="SELECT * FROM utilisateur WHERE id=:id";
	try {
		$commande = $pdo->prepare($sql);
		$commande->bindParam(':id', $idUsr);
		$bool = $commande->execute();
		if ($bool) {
			$res = $commande->fetchAll(PDO::FETCH_ASSOC);
			return $res[0];
		}
	}
	catch (PDOException $e) {
		echo utf8_encode("Echec de select : " . $e->getMessage() . "\n");
		die(); 
	}
}



?>
