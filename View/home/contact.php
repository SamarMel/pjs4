<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Nous contacter</title>
    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/contact.css">
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-home-1);}</style>

<div id="page">
	<?php
	$page_name = "Nous contacter";
	require_once(dirname(__FILE__) . "/../modules/header.php");
	?>
    <form enctype="multipart/form-data" id="frmemail">
        <label for="form_name">Pseudo</label>
        <input id="form_name" name="form_name" type="text" readonly value="<? echo $_SESSION['user']['pseudo'] ?>">
        
        <label for="form_email">Email</label>
        <input id="form_email" name="form_email" type="email" readonly value="<? echo $_SESSION['user']['mail'] ?>">
        
        <label for="form_subject">Sujet</label>
        <input id="form_subject" name="form_subject" type="text" value="" required autofocus >
        
        <label for="form_msg">Message</label>
        <textarea id="form_msg" name="form_msg"></textarea>
        
        <input type="submit" name="submit" id="submit" value="Envoyer">
    </form>
</div>

<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>
</body>
<script src="/View/js/home/contact.js"></script>
</html>