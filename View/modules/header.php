<div id="header">
    <h1><? echo $page_name ?></h1>
    <?php
    if (!isset($_SESSION['idUser'])):
    ?>
    <a id="user-login" href="/?controller=user&action=login">
        <div id="user">
            <img src="http://vancouvercircusschool.ca/wp-content/uploads/bfi_thumb/gender-neutral-user-o0j5ehmcv3q8ilg1tq92m10izukxkhy184rqpoenf0.png" alt="photo de profil">
            <span id="pseudo">Se connecter</span>
        </div>
    </a>
    <? else: ?>
        <a id="user-login" href="/?controller=user&action=personalSpace">
            <div id="user">
                <img src="<? echo $_SESSION['user']['imageProfil'] ?>" alt="photo de profil">
                <span id="pseudo"><? echo $_SESSION['user']['pseudo'] ?></span>
            </div>
        </a>
    <? endif; ?>
</div>