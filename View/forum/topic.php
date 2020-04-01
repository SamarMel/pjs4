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
            <p><? echo $posts[0]['content'] ?></p>
            <span class="post-info"><? echo $topic['categorie'] . " | " . $topic['dateTopic']?></span>
        </div>

        <form id="buttons" action="/?controller=forum&action=moderation" method="POST" name="moderation">
            <input type="hidden" name="idSignale" value="<?php echo $topic['idAuteur'] ?>">
            <input type='hidden' name='idTopic' value="<?php echo $id ?>">
            <input type="hidden" name="idPost" value="<?php echo $posts[0]['id'] ?>">

            <? if($_SESSION["user"]["idRole"] == 3 || $_SESSION["user"]["idRole"] == 4): ?>
                <input type='submit' name='modif' value='Modifier'>
                <input type='submit' name='supp' value='Supprimer'>
            <? elseif ($_SESSION["user"]["idRole"] == 1 || $_SESSION["user"]["idRole"] == 2): ?>
                <input type='submit' name='signal' value='Signaler'>
            <? endif; ?>
            <? if ($_SESSION["idUser"] != $posts[0]['idAuteur']): ?>
                <button type="button" class='contact-person' id="b<? echo $topic['idAuteur'] ?>">Contacter</button>
            <? endif; ?>
        </form>
    </div>
    <div id="posts">
        <?php
        $passed = false;
        foreach ($posts as $post):
            if(!$passed) {
                $passed = true;
                continue;
            }
            $author = getAuthor($post['idAuteur']);
            ?>
            <div id="post-<? echo $post['id'] ?>" class="post">
                <div class="user-info">
                    <img src="<? echo $author['imageProfil'] ?>" alt="image de profil">
                    <h4><? echo $author['pseudo'] ?></h4>
                    <h5><? echo $author['role'] ?></h5>
                </div>
                <div class="post-content">
                    <p><? echo $post['content'] ?></p>
                    <span class="post-info"><? echo ($post['modifie'] == 1 ? "Modifié | " : "") . $post['datePost']?></span>
                </div>

                <form id="buttons" action="/?controller=forum&action=moderation" method="POST" name="moderation">
                    <input type="hidden" name="idSignale" value="<?php echo $post['idAuteur'] ?>">
                    <input type='hidden' name='idTopic' value="<?php echo $id ?>">
                    <input type="hidden" name="idPost" value="<?php echo $post['id'] ?>">

                    <? if($_SESSION["user"]["idRole"] == 3 || $_SESSION["user"]["idRole"] == 4): ?>
                        <input type='submit' name='modif' value='Modifier'>
                        <input type='submit' name='supp' value='Supprimer'>
                    <? elseif ($_SESSION["user"]["idRole"] == 1 || $_SESSION["user"]["idRole"] == 2): ?>
                        <input type='submit' name='signal' value='Signaler'>
                    <? endif; ?>
                    <? if ($_SESSION["idUser"] != $post['idAuteur']): ?>
                        <button type="button" class='contact-person' id="b<? echo $post['idAuteur'] ?>">Contacter</button>
                    <? endif; ?>
                </form>
            </div>
        <?
        endforeach;
        ?>
    </div>
    <?php if ($_SESSION['idUser'] == null): ?>
        <p>Vous devez être connecté pour pouvoir participer à la conversation.</p>
    <? else: ?>
        <form id="send-response" action='/' name='msg' method='get'>
            <input type='hidden' name='controller' value="forum">
            <input type='hidden' name='action' value="post">

            <input type='hidden' name='id' value="<? echo $id ?>">
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

<!-- OLD -->

<!--
<html lang="fr">
    <head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../css/topic.css" media="screen" type="text/css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<title><? //echo $sujet ?></title>
	</head>

	<body class="col-md-9 offset-md-2">
		<?php  //require (dirname(__FILE__) . "/menu.tpl"); ?>
		<h1>FORUM</h1>
		<h2 class="sujet">SUJET : <?php //echo($sujet);?></h2>

		<div class="posts">
			<?php //echo afficherPosts($idTopic);?>
			<input type="text" class="col-md-12">
			<button class="btnDark offset-11 col-md-1">Envoyer</button>
		</div>


		<?php //require (dirname(__FILE__) . "/chatbox.html"); ?>
		<?php //require (dirname(__FILE__) . "/footer.tpl"); ?>
	</body>

</html>-->