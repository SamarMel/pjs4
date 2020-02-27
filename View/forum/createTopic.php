<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Forum</title>
    <link rel="stylesheet" href="/View/css/forum.css">
    <link rel="stylesheet" href="/View/css/style.css">
</head>
<body>

<!-- Menu -->
<?php require_once (dirname(__FILE__) . "/../modules/menu.tpl"); ?>
<style>#menu {background: var(--color-forum-2);}</style>

<div id="page">
    <?php
    $page_name = "FORUM";
    require (dirname(__FILE__) . "/../modules/header.php") ;
    ?>
    <div id="create-topic">
        <h2>Sujet : <?php $sujet?></h2>
        <div id="description">
            <form method="post" action="./saveDescription">
                <textarea id="txt-description" name="description"></textarea>
                <input type="submit" value="Publier">
            </form>

        </div>

<!-- Chatbox -->
<?php require_once (dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once (dirname(__FILE__) . "/../modules/footer.tpl"); ?>
</body>
</html>