<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Utilisateurs</title>

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
<?php require_once(dirname(__FILE__) . "/../../modules/menu.tpl");?>
<style>#menu {background: var(--color-action-5);}</style>

<div id="page">
    <?php
    $page_name = "UTILISATEURS";
    require_once(dirname(__FILE__) . "/../../modules/header.php");
    ?>

    <div id="users-nav">
        <? if ($p > 1): ?>
            <a class="users-nav-link"
               href="http://preclarity.ulyssebouchet.fr/?controller=user&action=users&s=<? echo $s ?>">
                Première page
            </a>
            <a class="users-nav-link"
               href="http://preclarity.ulyssebouchet.fr/?controller=user&action=users&s=<? echo $s ?>&p=<? echo ($p - 1) ?>">
                Page précédente
            </a>
        <? else: ?>
            <a class="users-nav-link">Première page</a>
            <a class="users-nav-link">Page précédente</a>
        <? endif; ?>
        <? if (count($users) == 10): ?>
            <a class="users-nav-link"
               href="http://preclarity.ulyssebouchet.fr/?controller=user&action=users&s=<? echo $s ?>&p=<? echo ($p + 1) ?>">
                Page suivante
            </a>
        <? else: ?>
            <a class="users-nav-link">Page suivante</a>
        <? endif; ?>
        <div>
            <input type="text" id="search-user">
            <button id="search-user-btn">Rechercher</button>
        </div>
    </div>

    <ul id="users-list">
        <li class="user-list" id="list-header">
            <span class="pseudo">Pseudo</span>
            <span class="mail">Mail</span>
            <span class="date">Date d'inscription</span>
            <span class="role">Rôle</span>
        </li>
        <? if (count($users) == 0): ?>
            <br>
            <span class="error-msg">Aucun utilisateur n'a été trouvé.</span>
            <br>
            <span class="error-msg">
                <a href="http://preclarity.ulyssebouchet.fr/?controller=user&action=users">Revenir à la liste</a>
            </span>
        <? else:
            foreach ($users as $u):
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

        <?
            endforeach;
        endif;
        ?>
    </ul>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../../modules/footer.tpl"); ?>

<!-- SLICK Carousel -->
<script type="text/javascript" src="/Resources/lib/slick/slick.min.js"></script>
<script src="/View/js/home/index.js"></script>
<script src="/View/js/personal_space/users.js"></script>
</body>
</html>