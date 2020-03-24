<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Preclarity</title>

    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/home.css">
    <link rel="stylesheet" href="/View/css/user/personal_space.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">

    <!-- SLICK Carousel -->
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick-theme.css"/>
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-light-2);}</style>

<div id="page">
    <?php
    $page_name = "ESPACE PERSONNEL";
    require_once (dirname(__FILE__) . "/../modules/header.php");
    echo $role;
    ?>

    <table id="actions">
        <tr>
            <td rowspan="3">
                Personne
            </td>
            <td>
                Evenements
            </td>
        </tr>
        <tr>
            <td>
                Mon compte
            </td>
        </tr>
        <tr>
            <td>
                mes démarches
            </td>
        </tr>
        <tr>
            <td rowspan="3" colspan="2">
                Gérer...
            </td>
        </tr>
    </table>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>

<!-- SLICK Carousel -->
<script type="text/javascript" src="/Resources/lib/slick/slick.min.js"></script>
<script src="/View/js/index.js"></script>
</body>
</html>