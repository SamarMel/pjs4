<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Forum</title>
        <link rel="stylesheet" href="/View/css/home/articles.css">
        <link rel="stylesheet" href="/View/css/style.css">
    </head>
    <body>

        <!-- Menu -->
        <?php require_once (dirname(__FILE__) . "/../modules/menu.tpl"); ?>
        <style>#menu {background: var(--color-home-1);}</style>

        <div id="page">
            <?php
            $page_name = $categorie;
            require (dirname(__FILE__) . "/../modules/header.php");
            ?>
            
            <div id="article-list">
            <? if (count($articles) == 0): ?>
                <p>Aucun article trouvé.</p>
            <? endif;
            foreach ($articles as $article): ?>
                <div class="article">
                    <img class="article-img" src="<? echo $article['imageIllustration'] ?>" alt="image d'illustration" />
                    <div class="article-content">
                        <h3 class="article-titre"><? echo $article['titre'] ?></h3>
                        <p class="article-accroche"><? echo $article['accroche'] ?></p>
                        <div class="bottom">
                            <span class="article-date"><? echo $article['datePubli'] ?></span>
                            <a class="read-article" href="/?controller=home&action=seeArticle&id=<? echo $article['id'] ?>">Lire l'article</a>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
            </div>

            <div id="articles-nav">
		        <? if ($p > 1): ?>
                    <a class="articles-nav-link"
                       href="/?controller=home&action=articles&idCate=<? echo $idCate ?>">
                        Première page
                    </a>
                    <a class="articles-nav-link"
                       href="/?controller=home&action=articles&idCate=<? echo $idCate ?>&p=<? echo ($p - 1) ?>">
                        Page précédente
                    </a>
		        <? else: ?>
                    <a class="articles-nav-link">Première page</a>
                    <a class="articles-nav-link">Page précédente</a>
		        <? endif; ?>
		        <? if (count($articles) == 4): ?>
                    <a class="articles-nav-link"
                       href="/?controller=home&action=articles&idCate=<? echo $idCate ?>&p=<? echo ($p + 1) ?>">
                        Page suivante
                    </a>
		        <? else: ?>
                    <a class="articles-nav-link">Page suivante</a>
		        <? endif; ?>
            </div>
        </div>

        <!-- Chatbox -->
        <?php require_once (dirname(__FILE__) . "/../modules/chatbox.html"); ?>
        <!-- Footer -->
        <?php require_once (dirname(__FILE__) . "/../modules/footer.tpl"); ?>
    </body>
</html>