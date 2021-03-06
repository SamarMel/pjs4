<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Article</title>
    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/article.css">

    <!-- SLICK Carousel -->
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick-theme.css"/>
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-home-1);}</style>

<div id="page">
    <?php
    $page_name = "ARTICLE";
    require_once(dirname(__FILE__) . "/../modules/header.php");
    ?>
    <div id="article">
        <span id="article-titre"><? echo $article['titre'] ?></span>
        <span id="article-infos">
            [<? echo $article['categorie'] ?>] Par <? echo $article['auteur'] ?>, le <? echo $article['datePubli'] ?>
            (dernière modification le <? echo $article['dateMaj']?>)
        </span>
        <span id="article-accroche"><? echo $article['accroche'] ?></span>
        <span id="article-texte">
            <img id="article-illus" src="<? echo $article['imageIllustration'] ?>" alt="image d'illustration">
            <? echo $article['texte'] ?>
        </span>
    </div>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>

<!-- SLICK Carousel -->
<script type="text/javascript" src="/Resources/lib/slick/slick.min.js"></script>
<script src="/View/js/home/index.js">
</script>
</body>
</html>