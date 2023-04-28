<?php

if (isset($_POST["cmntSubmit"])){
    
    $postID = $_POST["postID"];
    $usersID = $_POST["usersID"];
    $body = $_POST["cmntInput"];

    require_once 'dbh.inc.php';
    require_once 'functionsBlog.inc.php';

    if (emptyInputBlog($body, $body) !== false){
        header("location: ../blog.php?error=emptyInput");
        exit();
    }

    commentToPost($conn, $postID, $usersID, $body);

}
else{
    header("location: ../blog.php");
    exit();
}

    // $postID = $_POST["postID"];
    // $usersID = $_POST["usersID"];
    // $body = $_POST["cmntInput"];
    // echo "usersID: $usersID";
    // echo "postID: $postID";
    // $body = $_POST["cmntInput"];
    // echo "text: $body";
    // echo $_SESSION["isAdmin"];