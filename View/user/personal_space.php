<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Espace Personnel</title>

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
    ?>

    <table id="actions">
        <tr>
            <td rowspan="3" id="cell-infos">
                <table>
                    <tr>
                        <td rowspan="3">
                            <img src="<? echo $user['imageProfil'] ?>" alt="image de profil" id="img-infos">
                        </td>
                        <td>
                            <? echo $user['pseudo'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <? echo $user['mail'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <? echo $user['role'] ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            Inscrit le : <? echo $user['dateInscription'] ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td id="action_2" class="action">
                <a href="http://preclarity.ulyssebouchet.fr/?controller=user&action=events">
                    <div class="cell">
                        Évènements
                    </div>
                </a>
            </td>
        </tr>
        <tr>
            <td id="action_3" class="action">
                <a href="http://preclarity.ulyssebouchet.fr/?controller=user&action=account">
                    <div class="cell">
                        Mon Compte
                    </div>
                </a>
            </td>
        </tr>
        <tr>
            <td id="action_4" class="action">
                <a href="http://preclarity.ulyssebouchet.fr/?controller=user&action=demarches">
                    <div class="cell">
                        Mes démarches
                    </div>
                </a>
            </td>
        </tr>
        <tr>
            <td colspan="2" id="action_5" class="action">
                <a href="http://preclarity.ulyssebouchet.fr/?controller=user&action=gerer">
                    <?
                    if ($role == "Étudiant") :
                    ?>
                    <div id="map">
                        Azy Samar tu gèreras ça
                    </div>
                    <? else: ?>
                    <div class="cell">
                        Gérer
                        <?
                        if ($role == "Administrateur" || $role == "Modérateur")
                            echo " les signalements";
                        else
                            echo " les articles";
                        ?>
                    </div>
                    <? endif; ?>
                </a>
            </td>
        </tr>
        <?
        if ($role == "Administrateur"):
        ?>
        <tr>
            <td colspan="2" id="action_6" class="action">
                <a href="http://preclarity.ulyssebouchet.fr/?controller=user&action=users">
                    <div class="cell">
                        Gérer les utilisateurs
                    </div>
                </a>
            </td>
        </tr>
        <? endif; ?>
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