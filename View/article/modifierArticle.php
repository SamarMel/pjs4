<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Article</title>
    <link rel="stylesheet" href="/View/css/style.css">
    <link rel="stylesheet" href="/View/css/home/article.css">

    <!-- SLICK Carousel -->
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="/Resources/lib/slick/slick-theme.css"/>
    <script type="text/javascript">
        window.onload = function(){
            document.getElementById("newImage").style.display = "none";
        document.getElementById("newImage").value = document.getElementById("article-illus").src;

            document.getElementById("newTitre").style.display = "none";
        document.getElementById("newTitre").value = document.getElementById("article-titre").innerHTML;

            document.getElementById("newTexte").style.display = "none";
        document.getElementById("newTexte").value = document.getElementById("article-texte").innerHTML;

            document.getElementById("newAccroche").style.display = "none";
        document.getElementById("newAccroche").value = document.getElementById("article-accroche").innerHTML;

        }
        function modifierImage(){
           if(document.getElementById("article-illus").style.display === "none"){
                document.getElementById("article-illus").style.display = "block";
                document.getElementById("article-illus").src = document.getElementById("newImage").value;
                document.getElementById("newImage").style.display = "none";
            }
            else{
                document.getElementById("newImage").focus();
                document.getElementById("newImage").value = document.getElementById("article-illus").src;
                document.getElementById("article-illus").style.display = "none";
                document.getElementById("newImage").style.display = "block";
            }
        }

        function modifierTitre(){
            if(document.getElementById("article-titre").style.display === "none"){
                document.getElementById("article-titre").style.display = "block";
                document.getElementById("article-titre").innerHTML = document.getElementById("newTitre").value;
                document.getElementById("newTitre").style.display = "none";
            }
            else{
                document.getElementById("newTitre").focus();
                document.getElementById("newTitre").value = document.getElementById("article-titre").innerHTML;
                document.getElementById("article-titre").style.display = "none";
                document.getElementById("newTitre").style.display = "block";
            }

        }

        function modifierTexte(){
            if(document.getElementById("article-texte").style.display === "none"){
                document.getElementById("article-texte").style.display = "block";
                document.getElementById("article-texte").innerHTML = document.getElementById("newTexte").value;
                document.getElementById("newTexte").style.display = "none";
            }
            else{
                document.getElementById("newTexte").focus();
                document.getElementById("newTexte").value = document.getElementById("article-texte").innerHTML;
                document.getElementById("article-texte").style.display = "none";
                document.getElementById("newTexte").style.display = "block";
            }

        }

        function modifierAccroche(){
            if(document.getElementById("article-accroche").style.display == "none"){
                document.getElementById("article-accroche").style.display = "block";
                document.getElementById("article-accroche").innerHTML = document.getElementById("newAccroche").value;
                document.getElementById("newAccroche").style.display = "none";
            }
            else{
                document.getElementById("newAccroche").focus();
                document.getElementById("newAccroche").value = document.getElementById("article-accroche").innerHTML;
                document.getElementById("article-accroche").style.display = "none";
                document.getElementById("newAccroche").style.display = "block";
            }

        }
    </script>
</head>
<body>

<!-- MENU -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
<style>#menu {background: var(--color-home-1);}</style>

<div id="page">
    <?php
    $page_name = "MODIFIER ARTICLE";
    require_once(dirname(__FILE__) . "/../modules/header.php");
    ?>
    <div id="article">
         <form id="modificationArticle" method="post" action="/?controller=article&action=modifierArticle&id=<? echo $article["id"]?>">
        </form>
            <span id="article-titre"><? echo $article['titre'] ?></span>
            <textarea form="modificationArticle" name="newTitre" id="newTitre"></textarea>
            <button id="modifierTitre" onClick="modifierTitre()">Modifier</button>

            <span id="article-infos">
                [<? echo $article['categorie'] ?>] Par <? echo $article['auteur'] ?>, le <? echo $article['datePubli'] ?>
                (dernière modification le <? echo $article['dateMaj']?>)
            </span>
            <span id="article-accroche"><? echo $article['accroche'] ?></span>
             <textarea form="modificationArticle" name="newAccroche" id="newAccroche"></textarea>
            <button id="modifierAccroche" onClick="modifierAccroche()">Modifier</button>

            <img id="article-illus" src="<? echo $article['imageIllustration'] ?>" alt="image d'illustration">
            <textarea form="modificationArticle" name="newImage" id="newImage"></textarea>
            <button id="modifierImage" onClick="modifierImage()">Modifier</button>
            
            <span id="article-texte"><? echo $article['texte'] ?></span>
             <textarea form="modificationArticle" name="newTexte" id="newTexte"></textarea>
            <button id="modifierTexte" onClick="modifierTexte()">Modifier</button>
       
            <button type="submit" id="modifierArticle" form="modificationArticle">Modifier l'article</button>
        <form method="post" action="/?controller=article&action=supprimerArticle&id=<? echo $article["id"]?>">
            <input type="submit" id="supprimerArticle" value="Supprimer Article">
        </form>
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