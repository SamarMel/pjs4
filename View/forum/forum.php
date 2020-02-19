<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Forum</title>
        <link rel="stylesheet" href="../css/forum.css">
        <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../js/accueil_forum.js">
    </head>
    <body>

        <!-- Menu -->
        <?php require (dirname(__FILE__) . "/../modules/menu.tpl"); ?>
        <style>#menu {background: var(--color-forum-2);}</style>

        <!-- Surement mettre tout ça dans une div pour pas que l'affichage prenne toute la page-->
        <!-- Entete de la page mettre dans header?-->
        <div id="page">
            <div id="header">
                <h1>FORUM</h1>
                <div id="user">
                    <img src="https://i.ytimg.com/vi/vbm3EXpUUcM/maxresdefault.jpg" alt="photo de profil">
                    <span id="pseudo">Pseudo</span>
                </div>
            </div>
            <div id="derniers-topics">
                <h2>Derniers Topics</h2>
                <table id="topics">
                    <tr class="row">
                        <th class="sujet">Sujet</th>
                        <th class="auteur">Auteur</th>
                        <th class="categorie">Catégorie</th>
                        <th class="last_post">Dernier post</th>
                    </tr>
                    <tr class="row topic">
                        <td class="sujet">Je cherche une meuf, mineure de préférence.</td>
                        <td class="auteur">Anoup</td>
                        <td class="categorie">Pédophilie</td>
                        <td class="last_post">17/02/2020</td>
                    </tr>
                    <tr class="row topic">
                        <td class="sujet">Je fais des pavés sur Whatsapp, comment arrêter ?</td>
                        <td class="auteur">Samar</td>
                        <td class="categorie">Conversations</td>
                        <td class="last_post">17/02/2020</td>
                    </tr>
                    <tr class="row topic">
                        <td class="sujet">L'autre jour, j'ai mangé un nem au porc.</td>
                        <td class="auteur">Bintou</td>
                        <td class="categorie">Haram</td>
                        <td class="last_post">24/01/2020</td>
                    </tr>
                    <tr class="row topic">
                        <td class="sujet">Je suis trop bg et je n'arrête pas de me faire aborder quand je joue au ping-pong</td>
                        <td class="auteur">Albé</td>
                        <td class="categorie">SEXE</td>
                        <td class="last_post">26/12/2019</td>
                    </tr>
                </table>
            </div>

            <div id="rechercher-topic">
                <h2>Rechercher un topic</h2>
                <form class="forum-form" action="???" method="???">
                    <input type="text" placeholder="Nom du topic" id="rechercherTopicName" name="topicName">
                    <select name="categories" id="rechercherTopicCategorie">
                        <option value="pedophilie">pedophilie</option>
                        <option value="conversations">conversations</option>
                        <option value="haram">haram</option>
                        <option value="sexe">sexe</option>
                    </select>
                    <input type="submit" value="Rechercher">
                </form>
            </div>

            <div id="creer-topic">
                <h2>Créer un topic</h2>
                <form class="forum-form" action="???" method="???">
                    <input type="text" placeholder="Nom du topic" id="creerTopicName" name="topicName">
                    <select name="categories" id="creerTopicCategorie">
                        <option value="pedophilie">Pédophilie</option>
                        <option value="conversations">Conversations</option>
                        <option value="haram">Haram</option>
                        <option value="sexe">Sexe</option>
                    </select>
                    <input type="submit" value="Créer">
                </form>
            </div>
        </div>

        <!-- Chatbox -->
        <?php require (dirname(__FILE__) . "/../modules/chatbox.html"); ?>
        <!-- Footer -->
        <?php require (dirname(__FILE__) . "/../modules/footer.tpl"); ?>
    </body>
</html>