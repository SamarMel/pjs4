<!DOCTYPE html>
<html>
	<head>
		<title>Création d'un article</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./article.css">
	</head>

	<body>
		<!-- Menu -->
		<?php require_once (dirname(__FILE__) . "/../modules/menu.tpl"); ?>
		<style>#menu {background: var(--color-forum-2);}</style>
		<div id="formulaire">
			<h1> NOUVEL ARTICLE</h1>
			<form id="formArticle" method="post" action="/?Controller=article&action=nouvelArticle">
				
				<div id="choixCat">
					<label for="idCategorie">Catégorie</label>
					<SELECT name="idCategorie">
						<option value="1">Santé</option>
						<option value="2">Aides</option>
						<option value="3">Logement</option>
						<option value="4">Études</option>
						<option value="5">Divers</option>
					</SELECT>
				</div>
				<div id="titreArticle">
					<label for="titre">Titre</label>
					<textarea name="titre" id="titre" placeholder="Titre de l'article ..."  required></textarea>
				</div>
				<div id="accrocheArticle">
					<label for="accroche">Accroche</label>
					<textarea name="accroche" id="accroche" placeholder="Phrase d'accroche ..." required></textarea>
				</div>
				<div id="texteArticle">
					<label for="textArticle">Article</label>
					<textarea name="textArticle" id="textArticle" placeholder="Écrivez votre article ..." required></textarea>
				</div>
				<div id="imgArticle">
					<label for="image">Image d'illustration</label>
					<textarea name="image" id="image" placeholder="Image d'illustration ..." required></textarea>
				</div>
				
			</form>
			<button form="formArticle" id="btnCreation" type="submit" >CRÉER</button>
		</div>
		<!-- Chatbox -->
		<?php require_once (dirname(__FILE__) . "/../modules/chatbox.html"); ?>
		<!-- Footer -->
		<?php require_once (dirname(__FILE__) . "/../modules/footer.tpl"); ?>
	</body>
</html>