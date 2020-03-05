<?php
function afficher($idTopic){
	require(dirname(__FILE__) . "/../Model/forum/topicBD.php");
	$topic = getTopic($idTopic);
	$sujet = $topic['titre'];
	
	require(dirname(__FILE__) . "/../View/modules/topic.php");
}

function afficherPosts($idTopic){
	$posts = getPostsBD($idTopic);
	$html = "";
	
	foreach($posts as $p){
		$user=getUser($p['idAuteur']);
		$color=( $user['role'] == "ETU")? "success" : "warning" ;
		$html .= '<div class="post col-md-12">';
			$html .= '<div class="col-md-3">';
				$html .= '<span class="badge badge-' . $color .'">'. $user['role']. '</span>';
				$html .= "<p>". $user['pseudo'] . "</p>";
				$html .= "IMAGE A VENIR";
			$html .= '</div>';
			$html .= '<div class="col-md-10">';
				$html .= "<p>" . $p["content"] . "</p>";
			$html .= '</div>';
			$html .=  "<p>" . "BOOL modifié " . $p["dateMsg"] . " à heure" . "</p>";
		$html .= '</div><br/>';
	}
	return $html;
}