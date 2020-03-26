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
            <form action="/index?controller=forum&action=post">
                <input type="hidden" name="id" value=<?php $id ?>>
                <textarea name="post"></textarea>
                <input type="submit" value="Répondre">
            </form>
        </div>

        <!-- Chatbox -->
        <?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
        <!-- Footer -->
        <?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>
    </body>
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