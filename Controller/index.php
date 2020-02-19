<?php

if (isset($_GET['controller']) && isset($_GET['action'])) {
    $controller = $_GET['controller'];
    $action = $_GET['action'];

    require (dirname(__FILE__) . "/" . $controller . ".php");

    $action();
}