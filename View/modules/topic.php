<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Forum</title>
        <link rel="stylesheet" href="/View/css/topic.css">
        <link rel="stylesheet" href="/View/css/style.css">
        <link rel="stylesheet" href="/View/js/accueil_forum.js">
    </head>
    <body>

        <!-- Menu -->
        <?php require_once (dirname(__FILE__) . "/../modules/menu.tpl"); ?>
        <style>#menu {background: var(--color-forum-2);}</style>

        <div id="page">
            <?php
            $page_name = "FORUM";
            require_once (dirname(__FILE__) . "/header.php") ;
            require_once (dirname(__FILE__) . "/../../Model/forum.php");
            ?>
            <h2>Sujet : <? echo $topic['titre'] ?></h2>
            <div id="first-post" class="post">
                <div class="user-info">
                    <? $author = getAuthor($topic['idAuteur']);?>
                    <img src="<? echo $author['imageProfil'] ?>" alt="image de profil">
                    <h4><? echo $author['pseudo'] ?></h4>
                    <h5><? echo $author['role'] ?></h5>
                </div>
                <div class="post-content">
                    <p><? echo $topic['question'] ?></p>
                    <span class="post-info"><? echo getCategorieName($topic['idCategorie'])." | ".$topic['dateTopic']?></span>
                </div>
            </div>
            <div id="posts">
                <?php
                foreach ($posts as $post):
                    $author = getAuthor($post['idAuteur']);
                ?>
                    <div class="post">
                        <div class="user-info">
                            <img src="<? echo $author['imageProfil'] ?>" alt="image de profil">
                            <h4><? echo $author['pseudo'] ?></h4>
                            <h5><? echo $author['role'] ?></h5>
                        </div>
                        <div class="post-content">
                            <p><? echo $post['content'] ?></p>
                            <span class="post-info"><? echo ($post['modifie'] == 1 ? "Modifié | " : "") . $post['datePost']?></span>
                        </div>
                    </div>
                <?
                endforeach;
                ?>
            </div>
            <form>
                <textarea></textarea>
                <input type="submit" value="Répondre">
            </form>
        </div>

        <!-- Chatbox -->
        <?php require_once (dirname(__FILE__) . "/../modules/chatbox.html"); ?>
        <!-- Footer -->
        <?php require_once (dirname(__FILE__) . "/../modules/footer.tpl"); ?>
    </body>
</html>