<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Preclarity</title>

    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/home.css">
    <link rel="stylesheet" href="/View/css/user/users.css">

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
    $page_name = "UTILISATEURS";
    require_once (dirname(__FILE__) . "/../modules/header.php");
    ?>

    <ul id="users-list">
        <li class="user-list" id="list-header">
            <span class="pseudo">Pseudo</span>
            <span class="mail">Mail</span>
            <span class="date">Date d'inscription</span>
            <span class="role">Rôle</span>
        </li>
        <?php
        foreach ($users as $u):
            if ($u['role'] != "Administrateur"):
        ?>
            <li class="user-list" id="person-<? echo $u['id'] ?>">
                <span class="pseudo"><? echo $u['pseudo'] ?></span>
                <span class="mail"><? echo $u['mail'] ?></span>
                <span class="date"><? echo $u['dateInscription'] ?></span>
                <select class="role">
                    <option value="<? echo $u['idRole'] ?>"><? echo $u['role'] ?></option>
                    <?
                    if ($u['role'] != "Étudiant"):
                    ?>
                    <option value="1">Étudiant</option>
                    <?
                    endif;
                    if ($u['role'] != "Rédacteur"):
                    ?>
                    <option value="2">Rédacteur</option>
                    <?
                    endif;
                    if ($u['role'] != "Modérateur"):
                    ?>
                    <option value="3">Modérateur</option>
                    <? endif; ?>
                </select>
            </li>

        <? endif;
        endforeach; ?>
    </ul>

</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>

<!-- SLICK Carousel -->
<script type="text/javascript" src="/Resources/lib/slick/slick.min.js"></script>
<script src="/View/js/index.js"></script>
<script src="/View/js/users.js"></script>
</body>
</html>