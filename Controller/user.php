<?php

function login() {
    if (isset($_SESSION['idUser']))
        header("Location: http://preclarity.ulyssebouchet.fr");
    elseif (isset($_POST['identifiant']) && isset($_POST['pwd'])) {
        require_once (dirname(__FILE__) . "/../Model/user/user.php");
        $identifiant = $_POST['identifiant'];
        $pwd = $_POST['pwd'];

        if (loginDB($identifiant, $pwd))
            header("Location: http://preclarity.ulyssebouchet.fr");
        else
            header("Location: http://preclarity.ulyssebouchet.fr/?controller=user&action=login");
    } else {
        require(dirname(__FILE__) . "/../View/user/login.php");
    }
}

function register() {
    if (isset($_SESSION['idUser']))
        header("Location: http://preclarity.ulyssebouchet.fr");
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
            header("Location: http://preclarity.ulyssebouchet.fr/?controller=user&action=register");
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

            require(dirname(__FILE__) . "/../View/user/personal_space/reports.php");
            break;
        case "Rédacteur":
            header("Location: /?controller=article&action=gererArticles");
            break;
        case "Étudiant":
            header("Location: http://preclarity.ulyssebouchet.fr");
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
        header("Location: http://preclarity.ulyssebouchet.fr");
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

    require(dirname(__FILE__) . "/../View/user/personal_space/users.php");
}

function report() {
    if (!isset($_SESSION['idUser'])) {
        login();
        return;
    }

    require_once(dirname(__FILE__) . "/../Model/queries.php");
    $user = $_SESSION['user'];

    if (isset($_GET['idSignale']) && isset($_GET['origine']) && isset($_GET['motif'])) {
        $idSignaleur = $user['id'];
        $idSignale = $_GET['idSignale'];
        $origine = $_GET['origine'];
        $motif = $_GET['motif'];
        $idTopic = $_GET['idTopic'];
        $idPost = $_GET['idPost'];

        insertReport($idSignaleur, $idSignale, $origine, $motif, $idTopic, $idPost);

        $reported = true;
        require(dirname(__FILE__) . "/../View/user/personal_space/report.php");
        return;
    }

    if (!isset($_GET['idSignale']) || !isset($_GET['origine'])) {
        header("Location: http://preclarity.ulyssebouchet.fr");
        return;
    }

    $reported = false;

    $idSignale = $_GET['idSignale'];
    $userSignale = queryUser($idSignale);
    $origine = $_GET['origine'];

    require (dirname(__FILE__) . "/../View/user/personal_space/report.php");
}

function demarches () {
	if (!isset($_SESSION['idUser'])) {
		login();
		return;
	}
	
	require_once(dirname(__FILE__) . "/../Model/queries.php");
	$user = $_SESSION['user'];
	
	$demarches = getDemarches($user['id']);
	
	require (dirname(__FILE__) . "/../View/user/personal_space/demarches.php");
}

function seeDemarche () {
	if (!isset($_SESSION['idUser']) || !isset ($_GET['id'])) {
		login();
		return;
	}
	
	require_once (dirname(__FILE__) . "/../Model/queries.php");
	$user = $_SESSION['user'];
	$id = $_GET['id'];
	
	$demarche = getDemarche ($id);
	$documents = getDocuments ($id);
	
	require (dirname(__FILE__) . "/../View/user/personal_space/demarche.php");
}