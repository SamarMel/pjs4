<?php

function home() {
    require_once(dirname(__FILE__) . "/../Model/home/home.php");
    $articles = getRecentArticles();
    require_once(dirname(__FILE__) . "/../View/home/home.php");
}

function seeArticle() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        require_once(dirname(__FILE__) . "/../Model/home/home.php");
        $article = getArticle($id);
        require_once(dirname(__FILE__) . "/../View/home/article.php");
    } else
        header('Location: /');
}