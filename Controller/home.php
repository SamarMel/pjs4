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

function who () {
	require_once (dirname(__FILE__) . "/../View/home/qui_sommes_nous.php");
}

function faq () {
	require_once (dirname(__FILE__) . "/../View/home/faq.php");
}

function legal () {
	require_once (dirname(__FILE__) . "/../View/home/mentions-legales.php");
}

function contact () {
	require_once (dirname(__FILE__) . "/../View/home/contact.php");
}

function questionnaire () {
	require_once (dirname(__FILE__) . "/../View/home/questionnaire.php");
}

function articles () {
	if (isset($_GET['idCate'])) {
		$idCate = $_GET['idCate'];
		
		require_once(dirname(__FILE__) . "/../Model/home/home.php");
		$articles = getArticles ($idCate);
		$categorie = getCategorie ($idCate);
		
		$p = 1;
		if (isset($_GET['p']))
			$p = $_GET['p'];
		
		$articles = array_splice($articles, ($p - 1) * 4, 4);
		
		require_once(dirname(__FILE__) . "/../View/home/articles.php");
	} else
		header('Location: /');
}