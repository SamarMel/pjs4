<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Preclarity</title>
    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">

    <!-- SLICK Carousel -->
    <link rel="stylesheet" type="text/css" href="/View/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/View/slick/slick-theme.css"/>
</head>
<body>

<!-- MENU -->
<?php require_once (dirname(__FILE__) . "/modules/menu.tpl");?>
<style>#menu {background: var(--color-home-1);}</style>

<div id="page">
    <?php
    $page_name = "ACCUEIL";
    require_once (dirname(__FILE__) . "/modules/header.php");
    ?>

    <div class='container'>
        <div class='single-item'>
            <?php
            foreach ($articles as $article):
                ?>
                <div>
                    <img class="carousel-img" src="<? echo $article['imageIllustration'] ?>" alt="home">
                    <a href="/?controller=home&action=seeArticle&id=<? echo $article['id'] ?>">
                        <? echo (strlen($article['titre']) > 32)
                            ? substr($article['titre'], 0, 32) . "..."
                            : $article['titre']
                        ?>
                    </a>
                </div>
            <?
            endforeach;
            ?>
        </div>
    </div>

    <div id="body">
        <video width="600" height="300" controls>
            <source src="/View/images/kx3ib-s5to6.webm" type="video/mp4">
        </video>
        <div id="vid-invite">
            <span>Voulez-vous être accompagné vous aussi ?</span>
            <a href="#">Par ici !</a>
        </div>
        <div id="need-help">
            <h3>Besoin d'aide ?</h3>
            <p>Répondez à notre <a href="#">Questionnaire</a> ou participez au <a href="/?controller=forum&action=home">Forum</a>!</p>
            <img src="/View/images/help.png" alt="?">
        </div>
    </div>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/modules/footer.tpl"); ?>

<!-- SLICK Carousel -->
<script type="text/javascript" src="/View/slick/slick.min.js"></script>
<script src="/View/js/index.js"></script>
</body>
</html>