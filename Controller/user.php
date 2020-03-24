<?php

function login() {
    if (isset($_SESSION['idUser']))
        header("Location: http://pjs4.ulyssebouchet.fr");
    elseif (isset($_POST['identifiant']) && isset($_POST['pwd'])) {
        require_once (dirname(__FILE__) . "/../Model/user/user.php");
        $identifiant = $_POST['identifiant'];
        $pwd = $_POST['pwd'];

        if (loginDB($identifiant, $pwd))
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
    elseif (isset($_POST['pseudo-input']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['img'])
    && !empty($_POST['pseudo-input']) && !empty($_POST['mail']) && !empty($_POST['password'])) {
        require_once (dirname(__FILE__) . "/../Model/user/user.php");
        $pseudo = $_POST['pseudo-input'];
        $mail = $_POST['mail'];
        $pwd = $_POST['password'];
        $img = $_POST['img'];

        if (registerDB($pseudo, $mail, $pwd, $img)){
            $_POST['identifiant'] = $pseudo;
            $_POST['pwd'] = $pwd;
            login();
        } else
            header("Location: http://pjs4.ulyssebouchet.fr/?controller=user&action=register");
    } else {
        require(dirname(__FILE__) . "/../View/user/login.php");
    }
}

function personalSpace () {
    if (!isset($_SESSION['idUser']))
        login();

    require_once (dirname(__FILE__) . "/../Model/queries/ajaxQueries.php");
    $user = queryUser($_SESSION['idUser']);
    $role = $user['role'];

    require(dirname(__FILE__) . "/../View/user/personal_place.php");
}