<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Démarches</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/View/css/style.css">
    <link rel="stylesheet" type="text/css" href="/View/css/user/demarches.css">
</head>
<body>
<? require(dirname(__FILE__) . "/../../modules/menu.tpl") ?>
<style>#menu {background: var(--color-action-4);}</style>
    <div id="page">
        <?
        $page_name = "DEMARCHES";
        require(dirname(__FILE__) . "/../../modules/header.php");
        ?>

        <div id="ajouter-demande">
            <h2>Ajouter une nouvelle demande</h2>
            <form class="demarch-form" action="/" method="get">
                <input type="hidden" name="controller" value="forum">
                <input type="hidden" name="action" value="createDemand">
                
                <input type="text" placeholder="Nom de la demande" id="rechercherTopicName" name="topicName">
                <select name="topicCategory" id="rechercherTopicCategorie">
				    <?php
				    foreach ($categories as $category):
					    ?>
                        <option value="<? echo $category['id'] ?>"><? echo $category['intitulé']?></option>
				    <?
				    endforeach;
				    ?>
                </select>
                <input type="submit" value="Ajouter">
            </form>
        </div>

        <h2>Démarches en cours</h2>
        <div class="horizontal-scroll-wrapper">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        
    </div>

    <?
    require(dirname(__FILE__) . "/../../modules/chatbox.html");
    require(dirname(__FILE__) . "/../../modules/footer.tpl");
    ?>
</body>
</html>