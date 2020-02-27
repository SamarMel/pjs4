<?php

function saveDescription(){
    if(isset($_POST['description'])){
        $description = $_POST['description'];
        require_once (dirname(__FILE__) . "/../Model/forum.php");
        saveDescription($description);
    }
   

}

