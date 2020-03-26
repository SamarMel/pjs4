<?php

function home() {
    require_once(dirname(__FILE__) . "/../Model/forum/forum.php");
    $topics = getLastTopics();
    $categories = getCategories();
    require_once (dirname(__FILE__) . "/../View/forum/forum.php");
}

function seeTopic() {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        require_once(dirname(__FILE__) . "/../Model/forum/forum.php");
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

        require_once(dirname(__FILE__) . "/../Model/forum/forum.php");

        $topics = getTopics($topicName, $topicCategory);
        $categories = getCategories();

        require_once (dirname(__FILE__) . "/../View/forum/search_topic.php");

    }
}

function createTopic(){
    if(isset($_GET['topicName']) && isset($_GET['topicCategory'])){

        require_once(dirname(__FILE__) . "/../Model/forum/forum.php");
        $sujet = $_GET['topicName'];
        insertTopic($name);

        require_once (dirname(__FILE__) . "/../View/forum/search_topic.php");
    }
}

function post(){
    if(isset($_GET['post'])){
        //BONUS : prendre en compte si qqn a écrit entre temps, actualiser
        //et remettre son message dans le champ
        require_once(dirname(__FILE__) . "/../Model/forum/forum.php");
        postBD($_GET['post'], $_GET['id']);
        seeTopic();
    }

}

?>