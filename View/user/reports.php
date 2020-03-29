<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Preclarity</title>

    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/home.css">
    <link rel="stylesheet" href="/View/css/user/reports.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/loadingio/loading.css@v2.0.0/dist/loading.min.css">

    <!-- SLICK Carousel -->
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick-theme.css"/>
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-action-5);}</style>

<div id="page">
    <?php
    $page_name = "SIGNALEMENTS";
    require_once (dirname(__FILE__) . "/../modules/header.php");
    ?>

    <div id="reports-nav">
        <? if ($p > 1): ?>
            <a class="reports-nav-link"
               href="http://pjs4.ulyssebouchet.fr/?controller=user&action=gerer&s=<? echo $s ?>">
                Première page
            </a>
            <a class="reports-nav-link"
               href="http://pjs4.ulyssebouchet.fr/?controller=user&action=gerer&s=<? echo $s ?>&p=<? echo ($p - 1) ?>">
                Page précédente
            </a>
        <? else: ?>
            <a class="reports-nav-link">Première page</a>
            <a class="reports-nav-link">Page précédente</a>
        <? endif; ?>
        <? if (count($reports) == 10): ?>
            <a class="reports-nav-link"
               href="http://pjs4.ulyssebouchet.fr/?controller=user&action=gerer&s=<? echo $s ?>&p=<? echo ($p + 1) ?>">
                Page suivante
            </a>
        <? else: ?>
            <a class="reports-nav-link">Page suivante</a>
        <? endif; ?>
        <div id="filter-div">
            <label class="reports-nav-link" for="filter">Afficher uniquement les cas non traités</label>
            <input id="filter" type="checkbox" value="0">
        </div>
    </div>
    <div id="reports-list">
        <div id="reports-list-header" class="report">
            <span>Utilisateur signalé</span>
            <span>Signalé par</span>
            <span>Date</span>
            <span class="motif">Motif</span>
            <span>Statut</span>
            <span>Action</span>
        </div>
    <? foreach ($reports as $report): ?>
        <div class="report">
            <span><? echo $report['reported'] ?></span>
            <span><? echo $report['reporter'] ?></span>
            <span><? echo $report['date'] ?></span>
            <span class="motif">
                Origine : <? echo $report['origine'] ?>
                <br>
                Motif : <? echo $report['motif'] ?>
            </span>
            <span>
            <label for="filter<? echo $report['id'] ?>">Traité</label>
            <input id="filter<? echo $report['id'] ?>" type="checkbox" <? echo $report['traité'] == 1 ? "checked" : "" ?>>
            </span>
            <span>
                <a href="#">Bannir cet utilisateur</a>
                <br>
                <? if ($report['origine'] != "Conversation"): ?>
                <a href="#">Aller voir</a>
                <? endif; ?>
            </span>
        </div>
    <? endforeach; ?>
    </div>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>

<!-- SLICK Carousel -->
<script type="text/javascript" src="/Resources/lib/slick/slick.min.js"></script>
<script src="/View/js/index.js"></script>
<script src="/View/js/reports.js"></script>
</body>
</html>