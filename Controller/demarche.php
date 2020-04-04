<?php
//Pour Tableau de Bord Démarche------------------------------------------------

function afficher(){
    require_once (dirname(__FILE__) . "/../Model/user/demarcheBD.php");
    $enCours = getEnCours($_SESSION["idUser"]);
    $finies = getFinies($_SESSION["idUser"]);
    require_once (dirname(__FILE__) . "/../View/user/demarche.php");
}

function newDemarche(){
    require_once (dirname(__FILE__) . "/../Model/user/demarcheBD.php");
    newDemarcheBD($_POST["libelle"], $_SESSION["idUser"], $_POST["rmq"]);
    afficher();
}

function plusInfo(){
    require_once (dirname(__FILE__) . "/../Model/user/demarcheBD.php");
    $id = $_SESSION["id"];
    $docs = getDocsBD($id);
    require_once (dirname(__FILE__) . "/../View/user/maj_demarche.php");
}

function supprimer(){
    require_once (dirname(__FILE__) . "/../Model/user/demarcheBD.php");
    supprimerBD($_POST["id"]);
    afficher();
}

//Pour mettre à jour une démarche---------------------------------------------
function maj(){
    if (isset($_POST["doc"]))
        ajouterDoc();
    else if (isset($_POST["rmq"]))
        changerRmq();
    else if (isset($_POST["abandonner"]))
        abandonner();
    else if(isset($_POST["finir"]))
        finir();
}

function finir(){
    require_once (dirname(__FILE__) . "/../Model/user/demarcheBD.php");
    finirBD($_POST['id']);
    plusInfo();
}

function abandonner(){
    require_once (dirname(__FILE__) . "/../Model/user/demarcheBD.php");
    abandonnerBD($_POS["id"]);
    plusInfo();
}

function ajouterDoc(){
    require_once (dirname(__FILE__) . "/../Model/user/demarcheBD.php");
    ajouterDocBD($_POST["newDoc"]);
    plusInfo();
}

function changerRmq(){
    require_once (dirname(__FILE__) . "/../Model/user/demarcheBD.php");
    plusInfo();
}


?>