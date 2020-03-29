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
    if (!isset($_SESSION['idUser'])) {
        login();
        return;
    }

    require_once(dirname(__FILE__) . "/../Model/queries.php");
    $user = $_SESSION['user'];
    $role = $user['role'];

    require(dirname(__FILE__) . "/../View/user/personal_space.php");
}

function gerer () {
    if (!isset($_SESSION['idUser'])) {
        login();
        return;
    }

    require_once(dirname(__FILE__) . "/../Model/queries.php");
    $user = $_SESSION['user'];
    $role = $user['role'];

    switch ($role):
        case "Administrateur":
        case "Modérateur":

            $filter = "";
            if (isset($_GET['filter']))
                $filter = $_GET['filter'];

            $reports = getReports($filter);

            $p = 1;
            if (isset($_GET['p']))
                $p = $_GET['p'];

            $reports = array_splice($reports, ($p - 1) * 10, 10);

            require (dirname(__FILE__) . "/../View/user/reports.php");
            break;
        case "Rédacteur":
            break;
        case "Étudiant":
            header("Location: http://pjs4.ulyssebouchet.fr");
            return;
    endswitch;
}

function users() {
    if (!isset($_SESSION['idUser'])) {
        login();
        return;
    }

    require_once(dirname(__FILE__) . "/../Model/queries.php");
    $user = $_SESSION['user'];
    $role = $user['role'];

    if ($role != "Administrateur") {
        header("Location: http://pjs4.ulyssebouchet.fr");
        return;
    }

    $s = "";
    if (isset($_GET['s']))
        $s = $_GET['s'];

    $users = getAllUsers($s);
    foreach ($users as $k => $u)
        if ($u['role'] == "Administrateur")
            unset($users[$k]);

    $p = 1;
    if (isset($_GET['p']))
        $p = $_GET['p'];


    $users = array_splice($users, ($p - 1) * 10, 10);

    require (dirname(__FILE__) . "/../View/user/users.php");
}

function report() {
    if (!isset($_SESSION['idUser'])){
        login();
        return;
    }

    require_once(dirname(__FILE__) . "/../Model/queries.php");
    $user = $_SESSION['user'];

    if (isset($_GET['userS']) && isset($_GET['pageS']) && isset($_GET['motif'])) {
        insertReport($user['id'], $_GET['userS'], $_GET['pageS'], $_GET['motif']);

        $reported = true;
        require (dirname(__FILE__) . "/../View/user/report.php");
        return;
    }

    if (!isset($_GET['idSignale']) || !isset($_GET['page'])){
        header("Location: http://pjs4.ulyssebouchet.fr");
        return;
    }

    $reported = false;

    $idS = $_GET['idSignale'];
    $userS = queryUser($idS);
    $pageS = $_GET['page'];

    require (dirname(__FILE__) . "/../View/user/report.php");
}