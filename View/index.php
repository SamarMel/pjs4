<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Preclarity</title>
        <link rel="stylesheet" href="/View/css/style.css">
        <link rel="stylesheet" href="/View/css/index.css">

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
                <div><img class="carousel-img" src="/View/images/home.jpg" alt="home"><h3>Actualité</h3></div>
                <div><img class="carousel-img" src="/View/images/home.jpg" alt="home"><h3>Actualité</h3></div>
                <div><img class="carousel-img" src="/View/images/home.jpg" alt="home"><h3>Actualité</h3></div>
            </div>
        </div>

    </div>


    <!-- Chatbox -->
    <?php require_once(dirname(__FILE__) . "/modules/chatbox.html"); ?>
    <!-- Footer -->
    <?php require_once(dirname(__FILE__) . "/modules/footer.tpl"); ?>

    <!-- SLICK Carousel -->
    <script type="text/javascript" src="/View/slick/slick.min.js"></script>
    <script src="/View/js/index.js">
    </script>
    </body>
</html>