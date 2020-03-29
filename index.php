<?php session_start();

if (isset($_COOKIE['idUser'])) {
    $_SESSION['idUser'] = $_COOKIE['idUser'];
    require_once (dirname(__FILE__) . "/Model/queries.php");
    $_SESSION['user'] = queryUser($_SESSION['idUser']);
}

if ($_SESSION['user']['role'] == "Banni")
    header("Location: http://pjs4.ulyssebouchet.fr/banned.html");

if (isset($_GET['controller']) && isset($_GET['action'])) {
	$controller = $_GET['controller'];
	$action = $_GET['action'];

    try {
	    require (dirname(__FILE__) . "/Controller/" . $controller . ".php");
        $action();
    } catch (Error $e) {
        echo $e;
        //header('Location: /');
    }
} else {
    require (dirname(__FILE__) . "/Controller/home.php");
    home();
}

/*
session_start();

//MAL des Valeurs Controle Action Arg
if (isset($_GET['arg'])) {
 	$controle = $_GET['controle'];
	$action= $_GET['action'];
	$arg=$_GET['arg'];
}
else if (isset($_GET['controle']) & isset($_GET['action'])) {
 	$controle = $_GET['controle'];
	$action = $_GET['action'];
}
else {
	$controle="topic";
	$action="afficher";
	$arg=1;
}

if (isset($arg)){
	//echo($controle . " > " . $action . "(" . $arg . ") || ");
	require ('./controle/' . $controle . '.php');   
	$action ($arg); 

}

else {
	//echo($controle . " > " . $action . " || ");
	require ('./controle/' . $controle . '.php');   
	$action (); 	
}
*/