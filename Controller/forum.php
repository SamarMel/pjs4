<?php

function home() {
    require_once (dirname(__FILE__) . "/../Model/forum.php");
    $topics = getLastTopics();
    $categories = getCategories();
    require_once (dirname(__FILE__) . "/../View/forum/forum.php");
}

function seeTopic() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        require_once (dirname(__FILE__) . "/../Model/forum.php");
        $topic = getTopic($id);
        $posts = getPosts($id);
        require_once (dirname(__FILE__) . "/../View/modules/topic.php");
    } else
        header('Location: /Controller/?controller=forum&action=home');
}