<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Signalements</title>

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
<?php require_once(dirname(__FILE__) . "/../../modules/menu.tpl");?>
<style>#menu {background: var(--color-action-5);}</style>

<div id="page">
    <?php
    $page_name = "SIGNALEMENTS";
    require_once(dirname(__FILE__) . "/../../modules/header.php");
    ?>

    <div id="reports-nav">
        <? if ($p > 1): ?>
            <a class="reports-nav-link"
               href="/?controller=user&action=gerer&s=<? echo $s ?>&filter=<? echo $filter ?>">
                Première page
            </a>
            <a class="reports-nav-link"
               href="/?controller=user&action=gerer&s=<? echo $s ?>&p=<? echo ($p - 1) ?>&filter=<? echo $filter ?>">
                Page précédente
            </a>
        <? else: ?>
            <a class="reports-nav-link">Première page</a>
            <a class="reports-nav-link">Page précédente</a>
        <? endif; ?>
        <? if (count($reports) == 10): ?>
            <a class="reports-nav-link"
               href="/?controller=user&action=gerer&s=<? echo $s ?>&p=<? echo ($p + 1) ?>&filter=<? echo $filter ?>">
                Page suivante
            </a>
        <? else: ?>
            <a class="reports-nav-link">Page suivante</a>
        <? endif; ?>
        <div id="filter-div">
            <label class="reports-nav-link" for="filter">Afficher uniquement les cas non traités</label>
            <input id="filter" type="checkbox" <? if ($filter == 0 && $filter != "") echo "checked" ?>>
        </div>
    </div>
    <div id="reports-list">
        <div id="reports-list-header" class="report">
            <span>Signalé</span>
            <span>Signalé par</span>
            <span>Origine</span>
            <span class="motif">Motif</span>
            <span>Date</span>
            <span>Action</span>
            <span class="traité">Traité</span>
        </div>
        <? if (count($reports) == 0): ?>
        <span id="no-found">Aucun signalement trouvé</span>
        <? endif; ?>
    <? foreach ($reports as $report): ?>
        <div class="report">
            <span><? echo $report['reported'] ?></span>
            <span><? echo $report['reporter'] ?></span>
            <span><? echo $report['origine'] ?></span>
            <span class="motif"><? echo $report['motif'] ?></span>
            <span><? echo $report['date'] ?></span>
            <span>
                <? if ($report['reportedRole'] == "Banni"): ?>
                <span>Utilisateur banni</span>
                <? else: ?>
                <a class="ban" href="#" id="ban<? echo $report['idSignalé'] ?>">Bannir cet utilisateur</a>
                <? endif; ?>
                <br>
                <? if ($report['origine'] != "Conversation"): ?>
                    <a class="see" href="#" id='{"id":<? echo $report['idTopic'] ?>, "idPost":<? echo $report['idPost'] ?>}'>
                        Aller voir
                    </a>
                <? endif; ?>
            </span>
            <span class="traité">
            <input id="filter<? echo $report['id'] ?>" type="checkbox" <? echo $report['traité'] == 1 ? "checked" : "" ?>>
            </span>
        </div>
    <? endforeach; ?>
    </div>
</div>


<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../../modules/footer.tpl"); ?>

<!-- SLICK Carousel -->
<script type="text/javascript" src="/Resources/lib/slick/slick.min.js"></script>
<script src="/View/js/home/index.js"></script>
<script src="/View/js/personal_space/reports.js"></script>
</body>
</html>