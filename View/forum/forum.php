<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <title>Forum</title>
        <link rel="stylesheet" href="/View/css/forum.css">
        <link rel="stylesheet" href="/View/css/style.css">
    </head>
    <body>

        <!-- Menu -->
        <?php require_once (dirname(__FILE__) . "/../modules/menu.tpl"); ?>
        <style>#menu {background: var(--color-forum-2);}</style>

        <div id="page">
            <?php
            $page_name = "FORUM";
            require (dirname(__FILE__) . "/../modules/header.php") ;
            ?>
            <div id="derniers-topics">
                <h2>Derniers Topics</h2>
                <table id="topics">
                    <tr class="row">
                        <th class="sujet">Sujet</th>
                        <th class="auteur">Auteur</th>
                        <th class="categorie">Catégorie</th>
                        <th class="last_post">Dernier post</th>
                    </tr>
                    <?php
                    require_once(dirname(__FILE__) . "/../../Model/forum/forum.php");
                    require_once(dirname(__FILE__) . "/../../Model/queries/names.php");
                    foreach ($topics as $topic):
                    ?>
                        <tr class="row topic">
                            <td class="sujet">
                                <a href="/?controller=forum&action=seeTopic&id=<? echo $topic['id']?>">
                                    <? echo (strlen($topic['titre']) > 64)
                                        ? substr($topic['titre'], 0, 64) . "..."
                                        : $topic['titre']
                                    ?>
                                </a>
                            </td>
                            <td class="auteur"><? echo getUserName ($topic['idAuteur']) ?></td>
                            <td class="categorie"><? echo getCategorieName ($topic['idCategorie']) ?></td>
                            <td class="last_post"><? echo getLastPostDate($topic['id']) ?></td>
                        </tr>
                    <?
                    endforeach;
                    ?>
                </table>
            </div>

            <div id="rechercher-topic">
                <h2>Rechercher un topic</h2>
                <form class="forum-form" action="/" method="get">
                    <input type="hidden" name="controller" value="forum">
                    <input type="hidden" name="action" value="searchTopic">
                    <input type="text" placeholder="Nom du topic" id="rechercherTopicName" name="topicName">
                    <select name="topicCategory" id="rechercherTopicCategorie">
                        <?php
                        foreach ($categories as $category):
                        ?>
                            <option value="<? echo $category['id'] ?>"><? echo $category['intitulé']?></option>
                        <?
                        endforeach;
                        ?>
                    </select>
                    <input type="submit" value="Rechercher">
                </form>
            </div>

            <div id="creer-topic">
                <h2>Créer un topic</h2>
                <form class="forum-form" action="???" method="get">
                    <input type="text" placeholder="Nom du topic" id="creerTopicName" name="topicName">
                    <select name="topicCategory" id="creerTopicCategorie">
                        <?php
                        foreach ($categories as $category):
                        ?>
                            <option value="<? echo $category['id'] ?>"><? echo $category['intitulé']?></option>
                        <?
                        endforeach;
                        ?>
                    </select>
                    <input type="submit" value="Créer">
                </form>
            </div>
        </div>

        <!-- Chatbox -->
        <?php require_once (dirname(__FILE__) . "/../modules/chatbox.html"); ?>
        <!-- Footer -->
        <?php require_once (dirname(__FILE__) . "/../modules/footer.tpl"); ?>
    </body>
</html>