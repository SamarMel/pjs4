<?php



    //Aller sur la page de prÃ©sentation de tous les articles d'un auteur

    function gererArticles() {

    require_once(dirname(__FILE__) . "/../Model/article/article.php");

    $articles = getArticlesByAuthor($_SESSION["idUser"]);
    var_dump($articles);
    //require_once(dirname(__FILE__) . "/../View/article/gererArticles.php");

    }



    //Aller sur la page de modification d'un article

    function seeArticle() {

        if (isset($_GET['id'])) {

            $id = $_GET['id'];



            require_once(dirname(__FILE__) . "/../Model/article/article.php");

            $article = getArticle($id);

            require_once(dirname(__FILE__) . "/../View/article/modifierArticle.php");

        } else

            header('Location: /');

    }



    //Supprimer un article de la base

    function supprimerArticle(){

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            require_once(dirname(__FILE__) . "/../Model/article/article.php");

           deleteArticle($id);

           gererArticles();

        } else

            header('Location: /');

    }

    //Pour insert le nouvel article dans la base

    function creerArticle(){

        $idAuteur = $_SESSION['idUser'];

        $idCat = $_POST['idCategorie'];

        $titre = $_POST['titre'];

        $accroche = $_POST['accroche'];

        $texte = $_POST['textArticle'];

        $image = $_POST['image'];
    require_once(dirname(__FILE__) . "/../Model/article/article.php");

        createArticle($idAuteur,$idCat, $titre, $accroche, $texte, $image);

        gererArticles();

    }

    //Pour changer l'article dans la base

    function modifierArticle(){

        if (isset($_GET['id'])) {

            $id = $_GET['id'];

            $titre = $_POST['newTitre'];

            $accroche = $_POST['newAccroche'];

            $texte = $_POST['newTexte'];

            $image = $_POST['newImage'];
            require_once(dirname(__FILE__) . "/../Model/article/article.php");

            updateArticle($id, $titre, $accroche, $texte, $image);

            gererArticles();

        } else

            header('Location: /');

    }

    //Pour aller sur la page de crÃ©ation d'un nouvel article

    function nouvelArticle(){

        require_once(dirname(__FILE__) . "/../View/article/article.php");

    }

?>