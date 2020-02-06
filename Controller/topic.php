<?php
function afficher($idTopic){
	require("./modele/topicBD.php");
	$topic = getTopic($idTopic);
	$sujet = $topic['titre'];
	
	require("./vue/forum/topic.tpl");
}

function afficherPosts($idTopic){
	$posts = getPostsBD($idTopic);
	$html = "";
	
	foreach($posts as $p){
		$user=getUser($p['idAuteur']);
		$color=( $user['role'] == "ETU")? "success" : "warning" ;
		$html = $html .'<div class="post col-md-12">';
		
			$html=$html .'<div class="col-md-3">';
				$html=$html .'<span class="badge badge-' . $color .'">'. $user['role']. '</span>';
				$html=$html ."<p>". $user['pseudo'] . "</p>";
				$html=$html ."IMAGE A VENIR";
			$html=$html .'</div>';
			
			$html=$html .'<div class="col-md-10">';
				$html=$html ."<p>" . $p["content"] . "</p>";
			$html=$html .'</div>';
			
			$html=$html . "<p>" . "BOOL modifié " . $p["dateMsg"] . " à heure" . "</p>";
			
		$html=$html .'</div><br/>';
		
	}
	
	return $html;
}
?>	