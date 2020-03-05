<?php

function login() {
    if (isset($_SESSION['idUser']))
        header("Location: http://pjs4.ulyssebouchet.fr");
    elseif (isset($_POST['identifiant']) && isset($_POST['pwd'])) {
        require (dirname(__FILE__) . "/../Model/user/user.php");
        $identifiant = $_POST['identifiant'];
        $pwd = $_POST['pwd'];

        if (loginBD($identifiant, $pwd))
            header("Location: http://pjs4.ulyssebouchet.fr");
        else
            header("Location: http://pjs4.ulyssebouchet.fr/?controller=user&action=login");
    } else {
        require(dirname(__FILE__) . "/../View/user/login.php");
    }
}

function register() {
    if (isset($_SESSION['idUser']))
        header("Location: http://pjs4.ulyssebouchet.fr");
    elseif (isset($_POST['identifiant']) && isset($_POST['pwd'])) {
        require (dirname(__FILE__) . "/../Model/user/user.php");
        $identifiant = $_POST['identifiant'];
        $pwd = $_POST['pwd'];

        if (loginBD($identifiant, $pwd))
            header("Location: http://pjs4.ulyssebouchet.fr");
        else
            header("Location: http://pjs4.ulyssebouchet.fr/?controller=user&action=register");
    } else {
        require(dirname(__FILE__) . "/../View/user/login.php");
    }
}