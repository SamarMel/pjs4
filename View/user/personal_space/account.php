<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Mon Compte</title>
	
	<link rel="stylesheet" href="/View/css/style.css">
	<link rel="stylesheet" href="/View/css/home/home.css">
	<link rel="stylesheet" href="/View/css/user/account.css">
	
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../../modules/menu.tpl");?>
<style>#menu {background: var(--color-action-3);}</style>

<div id="page">
	<?php
	$page_name = "MON COMPTE";
	require_once(dirname(__FILE__) . "/../../modules/header.php");
	?>
	
	<div class="form" id="id-<? echo $user['id'] ?>">
		<label for="pseudo-input">Pseudo</label>
		<input name="pseudo-input" type="text" id="pseudo-input" placeholder="Prénom" value="<? echo $user['pseudo'] ?>"
				 required pattern= "^[A-Za-z '-]+$"  maxlength="20" disabled>
		<button class="edit" id="edit-pseudo">Modifier le pseudo</button>
		
		<label for="mail">Mail</label>
		<input name="mail" type="text" id="mail" placeholder="exemple@gmail.com" value="<? echo $user['mail'] ?>"
				 required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" disabled>
        <button class="edit" id="edit-mail">Modifier le mail</button>
		
		<label for="password">Nouveau mot de passe</label>
		<input name="password" type="password" id="password" placeholder="●●●●●●●●" disabled>
        <button class="edit" id="edit-pwd">Modifier le mot de passe</button>
		
        <? if ($user['role'] == "Étudiant"): ?>
            <h6>Photo de profil : </h6>
            
            <div id="images">
                <input type="radio" id="default1" name="img"
                         value="https://freesvg.org/img/smiling_teen_face.png">
                <label class="img" for="default1"><img src="https://freesvg.org/img/smiling_teen_face.png" alt="avatar garçon"></label>
                
                <input type="radio" id="default2" name="img"
                         value="https://freesvg.org/img/Caricatura_de_una_chica_soriendo.png">
                <label class="img" for="default2"><img src="https://freesvg.org/img/Caricatura_de_una_chica_soriendo.png" alt="avatar fille"></label>
                
                <input type="radio" id="default3" name="img"
                         value="https://freesvg.org/img/Dog_01_Face_Cartoon_Grey.png">
                <label class="img" for="default3"><img src="https://freesvg.org/img/Dog_01_Face_Cartoon_Grey.png" alt="avatar chien"></label>
                
                <input type="radio" id="default4" name="img"
                         value="https://freesvg.org/img/Cat_001_Face_Cartoon.png">
                <label class="img" for="default4"><img src="https://freesvg.org/img/Cat_001_Face_Cartoon.png" alt="avatar chat"></label>
            </div>
        <? endif; ?>
        <button id="delete">Supprimer mon compte</button>
	</div>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../../modules/footer.tpl"); ?>

<script src="/View/js/personal_space/account.js"></script>
</body>
</html>