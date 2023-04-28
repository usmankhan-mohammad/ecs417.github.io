<?php

if (isset($_POST["post"])){
    $title = $_POST["title"];
    $body = $_POST["body"];


    require_once 'dbh.inc.php';
    require_once 'functionsBlog.inc.php';

    if (emptyInputBlog($title, $body) !== false){
        header("location: ../addEntry.php?error=emptyInput");
        exit();
    }

    addToBlog($conn, $title, $body);

}
else{
    header("location: ../addEntry.php");
    exit();
}


