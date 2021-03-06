<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Forum</title>
    <link rel="stylesheet" href="/View/css/forum/topic.css">
    <link rel="stylesheet" href="/View/css/style.css">
</head>
<body>

<!-- Menu -->
<?php require_once(dirname(__FILE__) . "/../modules/menu.tpl"); ?>
<style>#menu {background: var(--color-forum-2);}</style>

<div id="page">
    <?php
    $page_name = "FORUM";
    require_once(dirname(__FILE__) . "/../modules/header.php");
    require_once(dirname(__FILE__) . "/../../Model/forum/forum.php");
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
            <textarea id="modify-<? echo $first_post['id'] ?>" disabled><? echo $first_post['content'] ?></textarea>
            <span class="post-info"><? echo $topic['categorie'] . " | " . $topic['dateTopic']?></span>
        </div>

        <form id="buttons" action="/?controller=forum&action=moderation" method="POST" name="moderation">
            <input type="hidden" name="idSignale" value="<?php echo $topic['idAuteur'] ?>">
            <input type='hidden' name='idTopic' value="<?php echo $id ?>">
            <input type="hidden" name="idPost" value="<?php echo $first_post['id'] ?>">

            <? if($_SESSION["user"]["idRole"] == 3 || $_SESSION["user"]["idRole"] == 4): ?>
                <button class="edit" id="<? echo $first_post['id'] ?>" type="button" name='modif'>Modifier</button>
                <input type='submit' name='supp' value='Supprimer'>
            <? elseif ($_SESSION["user"]["idRole"] == 1 || $_SESSION["user"]["idRole"] == 2|| $_SESSION["user"]["idRole"] == 6): ?>
                <input type='submit' name='signal' value='Signaler'>
            <? endif; ?>
            <? if ($_SESSION["idUser"] != $first_post['idAuteur'] && isset($_SESSION['idUser'])): ?>
                <button type="button" class='contact-person' id="b<? echo $topic['idAuteur'] ?>">Contacter</button>
            <? endif; ?>
        </form>
    </div>
	<? if (count($posts) == 0): ?>
    <p>Aucun post trouvé.</p>
    <? endif; ?>
    <div id="posts">
        <?php
        foreach ($posts as $post):
            $author = getAuthor($post['idAuteur']);
            ?>
            <div id="post-<? echo $post['id'] ?>" class="post">
                <div class="user-info">
                    <img src="<? echo $author['imageProfil'] ?>" alt="image de profil">
                    <h4><? echo $author['pseudo'] ?></h4>
                    <h5><? echo $author['role'] ?></h5>
                </div>
                <div class="post-content">
                    <textarea id="modify-<? echo $post['id'] ?>" disabled><? echo $post['content'] ?></textarea>
                    <span class="post-info"><? echo ($post['modifie'] == 1 ? "Modifié | " : "") . $post['datePost']?></span>
                </div>

                <form class="buttons" action="/?controller=forum&action=moderation" method="POST" name="moderation">
                    <input type="hidden" name="idSignale" value="<?php echo $post['idAuteur'] ?>">
                    <input type='hidden' name='idTopic' value="<?php echo $id ?>">
                    <input type="hidden" name="idPost" value="<?php echo $post['id'] ?>">

                    <? if($_SESSION["user"]["idRole"] == 3 || $_SESSION["user"]["idRole"] == 4): ?>
                        <button class="edit" id="<? echo $post['id'] ?>" type="button" name='modif'>Modifier</button>
                        <input type='submit' name='supp' value='Supprimer'>
                    <? elseif ($_SESSION["user"]["idRole"] == 1 || $_SESSION["user"]["idRole"] == 2|| $_SESSION["user"]["idRole"] == 6): ?>
                        <input type='submit' name='signal' value='Signaler'>
                    <? endif; ?>
                    <? if ($_SESSION["idUser"] != $post['idAuteur'] && isset($_SESSION['idUser'])): ?>
                        <button type="button" class='contact-person' id="b<? echo $post['idAuteur'] ?>">Contacter</button>
                    <? endif; ?>
                </form>
            </div>
        <?
        endforeach;
        ?>
    </div>

    <div id="topic-nav">
		 <? if ($p > 1): ?>
           <a class="topic-nav-link"
              href="/?controller=forum&action=seeTopic&id=<? echo $topic['id'] ?>">
               Première page
           </a>
           <a class="topic-nav-link"
              href="?controller=forum&action=seeTopic&id=<? echo $topic['id'] ?>&p=<? echo ($p - 1) ?>">
               Page précédente
           </a>
		 <? else: ?>
           <a class="topic-nav-link">Première page</a>
           <a class="topic-nav-link">Page précédente</a>
		 <? endif; ?>
		 <? if (count($posts) == 9): ?>
           <a class="topic-nav-link"
              href="?controller=forum&action=seeTopic&id=<? echo $topic['id'] ?>&p=<? echo ($p + 1) ?>">
               Page suivante
           </a>
		 <? else: ?>
           <a class="topic-nav-link">Page suivante</a>
		 <? endif; ?>
    </div>
    <?php if ($_SESSION['idUser'] == null): ?>
        <p>Vous devez être connecté pour pouvoir participer à la conversation.</p>
    <? else: ?>
        <form id="send-response" action='/' name='msg' method='get'>
            <input type='hidden' name='controller' value="forum">
            <input type='hidden' name='action' value="post">

            <input type='hidden' name='id' value="<? echo $id ?>">
            <input type='hidden' name='p' value="<? echo $p ?>">
            <textarea name='post' placeholder='Entrez ici votre message...'></textarea>
            <input type='submit' value='Répondre'>
        </form>
    <? endif; ?>
</div>

<!-- Chatbox -->
<?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
<!-- Footer -->
<?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>
</body>
<script src="/View/js/topic.js"></script>
</html>