<?php

    //Aller sur la page de présentation de tous les articles d'un auteur
    function gererArticles() {
    require_once(dirname(__FILE__) . "/../Model/article/article.php");
    $articles = getArticlesByAuthor($_SESSION["idUser"]);
    require_once(dirname(__FILE__) . "/../View/article/gererArticles.php");
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
            require_once(dirname(__FILE__) . "/../View/article/gererArticles.php");
        } else
            header('Location: /');
    }
    //Pour insert le nouvel article dans la base
    function creerArticle(){
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $idAuteur = $_SESSION['idUser'];
            $titre = $_POST['titre'];
            $accroche = $_POST['accroche'];
            $texte = $_POST['texet'];
            $image = $_POST['image'];
            require_once(dirname(__FILE__) . "/../Model/article/article.php");
	        createArticle($id, $idAuteur, $titre, $accroche, $texte, $image);
            require_once(dirname(__FILE__) . "/../View/article/gererArticles.php");
        } else
            header('Location: /');
    }
    //Pour changer l'article dans la base
    function modifierArticle(){
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $titre = $_POST['titre'];
            $accroche = $_POST['accroche'];
            $texte = $_POST['texte'];
            $image = $_POST['image'];
            require_once(dirname(__FILE__) . "/../Model/article/article.php");
	        updateArticle($id, $titre, $accroche, $texte, $image);
            require_once(dirname(__FILE__) . "/../View/article/gererArticles.php");
        } else
            header('Location: /');
    }
    //Pour aller sur la page de création d'un nouvel article
    function nouvelArticle(){
        require_once(dirname(__FILE__) . "/../View/article/article.php");
    }
?>