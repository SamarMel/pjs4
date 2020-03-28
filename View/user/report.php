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
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-action-5-dark);}</style>

<div id="page">
    <?php
    $page_name = "SIGNALER";
    require_once (dirname(__FILE__) . "/../modules/header.php");
    ?>

    <form id="report" action="" method="get">
        <label for="userS">Utilisateur signalé</label>
        <input id="userS" type="text" disabled value="<? echo $userS['pseudo'] ?>">
        <input name="userS" value="<? echo $idS ?>" type="hidden">

        <label for="pageS">Origine du signalement</label>
        <input id="pageS" name="pageS" type="text" disabled value="<? echo $pageS ?>">

        <label for="motif">Motif</label>
        <textarea id="motif" name="motif"></textarea>

        <input type="submit" value="Envoyer">
    </form>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>

<!-- SLICK Carousel -->
<script type="text/javascript" src="/Resources/lib/slick/slick.min.js"></script>
<script src="/View/js/index.js"></script>
<script src="/View/js/report.js"></script>
</body>
</html>