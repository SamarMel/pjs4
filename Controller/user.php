<?php

function login() {
    if (isset($_SESSION['idUser']))
        header("Location: /");
    elseif (isset($_POST['identifiant']) && isset($_POST['pwd'])) {
        require_once (dirname(__FILE__) . "/../Model/user/user.php");
        $identifiant = $_POST['identifiant'];
        $pwd = $_POST['pwd'];

        if (loginDB($identifiant, $pwd))
            header("Location: /");
        else
            header("Location: /?controller=user&action=login");
    } else {
        require(dirname(__FILE__) . "/../View/user/login.php");
    }
}

function logout() {
	// unset cookies
	if (isset($_SERVER['HTTP_COOKIE'])) {
		$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
		foreach($cookies as $cookie) {
			$parts = explode('=', $cookie);
			$name = trim($parts[0]);
			setcookie($name, '', time() - 1000);
			setcookie($name, '', time() - 1000, '/');
		}
	}
	session_destroy ();
	header ("Location: /");
}

function register() {
    if (isset($_SESSION['idUser']))
        header("Location: /");
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
            header("Location: /?controller=user&action=register");
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
            if (isset($_GET['filter']))
                $filter = $_GET['filter'];
            else
	            $filter = "0";

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
	    case "Étudiant Expert":
	        require(dirname(__FILE__) . "/../View/map/map.php");
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
        header("Location: /");
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
        header("Location: /");
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

function createDemande () {
	if (!isset($_SESSION['idUser'])) {
		login();
		return;
	}
	
	require_once(dirname(__FILE__) . "/../Model/queries.php");
	$user = $_SESSION['user'];
	
	if (isset($_GET['name']) && isset($_GET['rmq'])) {
		$id = $user['id'];
		$name = $_GET['name'];
		$rmq = $_GET['rmq'];
		
		createDemarche($id, $name, $rmq);
		
		$_GET['id'] = getDemarcheId($id, $name, $rmq);
		
		seeDemarche();
		return;
	}
	demarches();
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

function deleteUser(){
    require_once (dirname(__FILE__) . "/../Model/user/user.php");
    deleteUserBD($_SESSION["idUser"]);
    require (dirname(__FILE__) . "/../View/home/home.php");
}

function account() {
	if (!isset($_SESSION['idUser'])) {
		login();
		return;
	}
	require_once(dirname(__FILE__) . "/../Model/queries.php");
	$user = $_SESSION['user'];
	
	require(dirname(__FILE__) . "/../View/user/personal_space/account.php");
}
