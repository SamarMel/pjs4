<?php

function accueilForum(){

    require("./Model/accueilForum.php");
    $ok=derniersTopics();
    if($ok){
        require("./View/forum/AccueilForum.html");
    }else{
        require("./View/forum/anomalieDerniersTopics.html");
    }

}

function rechercheTopic($sujetRecherche){
    require("./Model/accueilForum.php");
    $ok=rechercherTopic($sujetRecherche);
    if($ok){
        require("./View/forum/" .  $sujetRecherche .".html");
    }else{
        require("./View/forum/anomalieRechercheTopic.html");
    }
    

}

function creationTopic($titreSujet){
    require("./Model/accueilForum.php");
    $ok=creerTopic($titreSujet);
    if($ok){
        require("./View/forum/" .  $titreSujet .".html");
    }else{
        require("./View/forum/anomalieCrationTopic.html");

    }

}