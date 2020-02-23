<?php

function home() {
    require_once (dirname(__FILE__) . "/../Model/home.php");
    $articles = getRecentArticles();
    require_once(dirname(__FILE__) . "/../View/home.php");
}

function seeArticle() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        require_once (dirname(__FILE__) . "/../Model/home.php");
        $article = getArticle($id);
        require_once(dirname(__FILE__) . "/../View/article.php");
    } else
        header('Location: /');
}