<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="/View/css/style.css">
    <link rel="stylesheet" type="text/css" href="/View/css/user/login.css">
</head>
<body>
<? require(dirname(__FILE__) . "/../modules/menu.tpl") ?>
<style>#menu {background: var(--color-dark);}</style>
    <div id="page">
        <?
        $page_name = "CONNEXION";
        require(dirname(__FILE__) . "/../modules/header.php");
        ?>
        <div id="forms">
            <form id="connexion" method="post" action="/?controller=user&action=login">
                <h1>Connexion</h1>
                <label for="identifiant">Identifiant</label>
                <input name="identifiant" type="text" id="identifiant" placeholder="pseudo / email">
                
                <label for="pwd">Mot de passe</label>
                <input name="pwd" type="password" id="pwd" placeholder="●●●●●●●●">

                <input type="submit" value="Se connecter">
            </form>

            <div id="bar"></div>

            <form method="post" action="/?controller=user&action=register">
                <h1>Inscription</h1>
                <label for="pseudo-input">Pseudo</label>
                <input name="pseudo-input" type="text" id="pseudo-input" placeholder="Prénom" 
                required pattern= "^[A-Za-z '-]+$"  maxlength="20">

                <label for="mail">Mail</label>
                <input name="mail" type="text" id="mail" placeholder="exemple@gmail.com"
                required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">

                <label for="password">Mot de passe</label>
                <input name="password" type="password" id="password" placeholder="●●●●●●●●">

                <h6>Photo de profil : </h6>

                <div id="images">
                    <input type="radio" id="default1" name="img"
                           value="https://freesvg.org/img/smiling_teen_face.png" checked>
                    <label class="img" for="default1"><img src="https://freesvg.org/img/smiling_teen_face.png" alt="avatar garçon"></label>

                    <input type="radio" id="default2" name="img"
                           value="https://freesvg.org/img/Caricatura_de_una_chica_soriendo.png">
                    <label class="img" for="default2"><img src="https://freesvg.org/img/Caricatura_de_una_chica_soriendo.png" alt="avatar fille"></label>

                    <input type="radio" id="default3" name="img"
                           value="https://freesvg.org/img/Dog_01_Face_Cartoon_Grey.png">
                    <label class="img" for="default3"><img src="https://freesvg.org/img/Dog_01_Face_Cartoon_Grey.png" alt="avatar chien"></label>

                    <input type="radio" id="default4" name="img"
                           value="https://freesvg.org/img/Cat_001_Face_Cartoon.png">
                    <label class="img" for="default4"><img src="https://freesvg.org/img/Cat_001_Face_Cartoon.png" alt="avatar chat"></label>
                </div>
                <input type="submit" value="S'inscrire">
            </form>
        </div>
    </div>

    <?
    require(dirname(__FILE__) . "/../modules/chatbox.html");
    require(dirname(__FILE__) . "/../modules/footer.tpl");
    ?>
</body>
<script src="/View/js/login.js"></script>
</html>