<?php


require_once 'dbh.inc.php';
require_once 'functionsBlog.inc.php';
$month = 0;
if(isset($_POST["months"])){
    $month=$_POST["months"];
    
}

if ($month > 0){
    $dateObj   = DateTime::createFromFormat('!m', $month);
    $monthName = $dateObj->format('F'); 
    echo "The selected month is: ".$monthName;
    findEntryByMonth($conn, $month);   
}
else{
    findEntry($conn);
}


// if (isset($_POST["submitMonth"])){
    
//     $month = $_POST["months"];
//     findEntryByMonth($conn, $month);

// }
// else{
//     findEntry($conn);
// }

// if(isset($_POST["submit"]) )
// {
//   $month = $_POST["months"];
//   echo $month;
//   $errorMessage = "";
    
//   $sql = "SELECT * FROM `posts` WHERE ".$month."\n"
//   . "ORDER BY postDate DESC;";

//   $result = $conn->query($sql);

// }
// else{
//     $sql = "SELECT * FROM `posts` \n"
//     . "ORDER BY postDate DESC;"; //sort database by date

//     $result = $conn->query($sql);
// }