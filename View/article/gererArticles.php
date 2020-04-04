<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Article</title>
    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/article.css">
    <link rel="stylesheet" href="/View/css/article/gererArticle.css">

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
    $page_name = "GESTION ARTICLES";
    require_once(dirname(__FILE__) . "/../modules/header.php");
    ?>
     <form id="formCreationArticle" method="post" action="/?controller=article&action=nouvelArticle">
        <input id="btnCreationArticle" type="submit" value="Créer un nouvel Article">
    </form>
    <div id="derniers-topics">
                <table id="topics">
                    <tr class="row">
                        <th class="titre">Titre</th>
                        <th class="categorie">Catégorie</th>
                        <th class="date_publication">Date de Publication</th>
                        <th class="last_modification">Derniere Modification</th>
                    </tr>
                    <?php
                    require_once(dirname(__FILE__) . "/../../Model/article/article.php");
                    foreach ($articles as $article):
                    ?>
                        <tr class="row topic">
                            <td class="sujet">
                                <a href="/?controller=article&action=seeArticle&id=<? echo $article['id']?>">
                                    <? echo (strlen($article['titre']) > 64)
                                        ? substr($article['titre'], 0, 64) . "..."
                                        : $article['titre']
                                    ?>
                                </a>
                            </td>
                            <td class="categorie"><? echo $article['categorie'] ?></td>
                            <td class="date_publication"><? echo $article['datePubli'] ?></td>
                            <td class="last_modification"><? echo $article['dateMaj']?></td>
                        </tr>
                    <?
                    endforeach;
                    ?>
                </table>
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