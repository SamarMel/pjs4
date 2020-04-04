<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Mentions légales</title>
        <link rel="stylesheet" href="/View/css/style.css">
        <link rel="stylesheet" href="/View/css/home/mentions-legales.css">
    </head>
    <body>
    
        <!-- MENU -->
        <?php require_once(dirname(__FILE__) . "/../modules/menu.tpl");?>
        <style>#menu {background: var(--color-home-1);}</style>
        
        <div id="page">
            <?php
            $page_name = "MENTIONS LÉGALES";
            require_once(dirname(__FILE__) . "/../modules/header.php");
            ?>
            <img src="/Resources/images/preclarity.png" alt="logo-preclarity"/>
            <p>Le présent site est édité par un groupe d'étudiants de l'IUT de Paris (Descartes) dont le siège est établi 143 Avenue de Versailles, 75016 Paris.</p>
            <p>Conformément aux lois « Informatiques & Liberté » et « RGPD », nous vous informons que nous ne récoltons, sous aucune forme, toute donnée dite "sensible". </p>
            <p>L’Editeur est joignable par courrier électronique à l’adresse suivante : plecaritypjs4@gmail.com.</p>
            <p>Le présent Site est hébergé par OVH GmbH dont le siège social est établi à Koßmannstr. 35, 66119 Saarbrücken, Allemagne.</p>
        </div>
        
        <!-- Chatbox -->
        <?php require_once(dirname(__FILE__) . "/../modules/chatbox.html"); ?>
        <!-- Footer -->
        <?php require_once(dirname(__FILE__) . "/../modules/footer.tpl"); ?>
    </body>
</html>