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
        $categorie = $_GET['topicCategory'];
        insertTopic($sujet, $categorie);

        require_once (dirname(__FILE__) . "/../View/forum/search_topic.php");
    }
}

        //BONUS : prendre en compte si qqn a écrit entre temps, actualiser
        //et remettre son message dans le champ
function post(){
    if(isset($_GET['post'])){
        require_once(dirname(__FILE__) . "/../Model/forum/forum.php");
        postBD($_GET['post'], $_GET['id']);
    }
    seeTopic2($_POST['id']);

}

function moderation(){
    $idSignalé = $_POST["idSignalé"];
    $idMsg = $_POST["idPost"];
    if (isset($_POST["modif"]))
        modifierPost($idSignalé, $idMsg);
    else if (isset($_POST["supp"]))
        supprimerPost($idSignalé, $idMsg);
    else if (isset($_POST["signal"]))
        signalerPost($idSignalé, $idMsg);
}

function modifierPost($idSignalé, $idMsg){
   
    require_once(dirname(__FILE__) . "/../Model/forum/forum.php");
    //Faire en sorte que le message se transforme en "textarea" modifier puis update...... LOL..... A VOIR
}

function supprimerPost($idSignalé, $idMsg){
    require_once(dirname(__FILE__) . "/../Model/forum/forum.php");
    supprimerPostBD($idMsg);
    seeTopic2($_POST['id']);
}

//ADAPTER LES NOMS -> Voir avec Ulysse
function signalerPost($idSignalé, $idMsg){
    require_once (dirname(__FILE__) . "/../View/user/report.php");
}

function seeTopic2($id) {
        require_once(dirname(__FILE__) . "/../Model/forum/forum.php");
        $topic = getTopic($id);
        $posts = getPosts($id);
        require_once(dirname(__FILE__) . "/../View/forum/topic.php");
}

?>