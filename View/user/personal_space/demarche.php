<!DOCTYPE html>
<html lang="fr">
<head>
	<title>Démarches</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="/View/css/style.css">
	<link rel="stylesheet" type="text/css" href="/View/css/user/demarche.css">
</head>
<body>
<? require(dirname(__FILE__) . "/../../modules/menu.tpl") ?>
<style>#menu {background: var(--color-action-4);}</style>
<div id="page">
	<?
	$page_name = "DEMARCHE";
	require(dirname(__FILE__) . "/../../modules/header.php");
	?>
	
	<h2><? echo $demarche['libelle'] ?></h2>
	<div id="<? echo $demarche['id'] ?>" class="data">
		<h4>Informations : </h4>
		<span>Commencée le : <? echo $demarche['dateCrea'] ?></span>
        <span>Mise à jour le : <? echo $demarche['dateModif'] ?></span>
		<label for="remarque">Remarques :</label>
		<textarea id="remarque" disabled><? echo $demarche['rmq'] ?></textarea>
		<button id="modify">Modifier</button>
		<button id="finish">Terminer</button>
		<button id="give-up">Abandonner</button>
	</div>

    <div id="<? echo $demarche['id'] ?>" class="data">
        <h4>Pièces justificatives : </h4>
        <? foreach ($documents as $document): ?>
        <div class="doc">
            <input id="ch<? echo $document['id'] ?>" type="checkbox" <? echo $document['isRendu'] == 1 ? "checked" : ""?>>
            <label class="ch-lbl" for="ch<? echo $document['id'] ?>"><? echo $document['libelle'] ?></label>
        </div>
        <? endforeach; ?>
        <div id="add">
            <input type="checkbox">
            <input type="text" placeholder="Nom du document">
            <a id="add-doc" href="#">Ajouter</a>
        </div>
    </div>
	
</div>

<?
require(dirname(__FILE__) . "/../../modules/chatbox.html");
require(dirname(__FILE__) . "/../../modules/footer.tpl");
?>
</body>
<script src="/View/js/personal_space/demarche.js"></script>
</html>