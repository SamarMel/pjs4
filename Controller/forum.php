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
        require_once(dirname(__FILE__) . "/../View/forum/topic.php");
    } else
        header('Location: /?controller=forum&action=home');
}

function searchTopic() {
    if (isset($_GET['topicCategory'])) {
        $topicName = isset($_GET['topicName']) ? $_GET['topicName'] : "";
        $topicCategory = $_GET['topicCategory'];

        require_once (dirname(__FILE__) . "/../Model/forum.php");

        $topics = getTopics($topicName, $topicCategory);
        $categories = getCategories();

        require_once (dirname(__FILE__) . "/../View/forum/search_topic.php");

    }
}