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
                <input type="hidden" name="controller" value="user">
                <input type="hidden" name="action" value="createDemande">
                
                <input type="text" id="input-text" name="input-text" placeholder="Nom de la demande">
                <select name="input-select" id="input-select">
                    <option>Option 1</option>
                    <option>Option 2</option>
                    <option>Option 3</option>
                    <option>Option 4</option>
                    <option>Option 5</option>
                </select>
                <input type="submit" value="Ajouter">
            </form>
        </div>

        <h2>Démarches en cours</h2>
        <div class="horizontal-scroll-wrapper">
        <? foreach ($demarches as $demarche):
	        if ($demarche['isArchivée'] == 0):?>
            <div class="demarche uncomplete">
                <h3><? echo $demarche['libelle'] ?></h3>
                <span>Commencée le : <? echo $demarche['dateCrea'] ?></span>
                <span>Mise à jour le : <? echo $demarche['dateModif'] ?></span>
                <span class="status">Pièces justificatives <? echo $demarche['manquants'] == 0 ? "complètes" : "manquantes" ?></span>
                <a href="/?controller=user&action=seeDemarche&id=<? echo $demarche['id'] ?>">Voir en détail</a>
            </div>
        <? endif;
        endforeach; ?>
        </div>

        <h2>Démarches archivées</h2>
        <div class="horizontal-scroll-wrapper">
        <? foreach ($demarches as $demarche):
            if ($demarche['isArchivée'] == 1):?>
            <div class="demarche complete">
                <h3><? echo $demarche['libelle'] ?></h3>
                <span>Commencée le : <? echo $demarche['dateCrea'] ?></span>
                <span>Mise à jour le : <? echo $demarche['dateModif'] ?></span>
                <span class="status">
                <?
                if ($demarche['isAcceptée'] == 1):
                    echo "Acceptée";
                elseif ($demarche['isFinie'] == 0):
                    echo "Abandonnée";
                else:
	                echo "Refusée";
                endif; ?>
                </span>
                <a href="#" id="del-<? echo $demarche['id'] ?>">Supprimer</a>
            </div>
        <? endif;
        endforeach; ?>
        </div>
    </div>

    <?
    require(dirname(__FILE__) . "/../../modules/chatbox.html");
    require(dirname(__FILE__) . "/../../modules/footer.tpl");
    ?>
</body>
<script src="/View/js/personal_space/demarches.js"></script>
</html>