<?php session_start();

if (isset($_GET['controller']) && isset($_GET['action'])) {
	$controller = $_GET['controller'];
	$action = $_GET['action'];

    try {
	    require (dirname(__FILE__) . "/Controller/" . $controller . ".php");
        $action();
    } catch (Error $e) {
        header('Location: /?controller=forum&action=home');
    }
} else
    header('Location: /?controller=forum&action=home');

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