<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Preclarity</title>

    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/home.css">
    <link rel="stylesheet" href="/View/css/user/report.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">

    <!-- SLICK Carousel -->
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick-theme.css"/>
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../../modules/menu.tpl");?>
<style>#menu {background: var(--color-action-5-dark);}</style>

<div id="page">
    <?php
    $page_name = "SIGNALER";
    require_once(dirname(__FILE__) . "/../../modules/header.php");
    if (!$reported):
    ?>

    <form id="report" action="http://preclarity.ulyssebouchet.fr/" method="get">
        <input name="controller" value="user" type="hidden">
        <input name="action" value="report" type="hidden">

        <input name="idTopic" value="<? echo $idTopic ?? -1 ?>" type="hidden">
        <input name="idPost" value="<? echo $idPost ?? -1 ?>" type="hidden">

        <label for="userS">Utilisateur signalé</label>
        <input id="userS" type="text" disabled value="<? echo $userSignale['pseudo'] ?>">
        <input name="idSignale" value="<? echo $idSignale ?>" type="hidden">

        <label for="pageS">Origine du signalement</label>
        <input id="pageS" type="text" disabled value="<? echo $idTopic == null ? "Conversation" : "Forum" ?>">
        <input name="origine" value="<? echo $idTopic == null ? "Conversation" : "Forum" ?>" type="hidden">

        <label for="motif">Motif</label>
        <textarea id="motif" name="motif"></textarea>

        <input type="submit" value="Envoyer">
    </form>
    <? else: ?>
    <h3 id="msg">Utilisateur signalé.</h3>
    <a id="back_home" href="http://preclarity.ulyssebouchet.fr">Retour à l'accueil</a>
    <? endif; ?>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../../modules/footer.tpl"); ?>

<script src="/View/js/personal_space/report.js"></script>
</body>
</html>