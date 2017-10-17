<?php
include 'db_connect.php';

$postedDiv = "";
    if(isset($_POST['codeData'])){
        $postedDiv = "You saved:" . $_POST['codeData'];
    }

// if (isset($_POST)) {
//
// $favTitle=$_POST['favTitle'];  //access data like this
// $favTitle=mysql_real_escape_string($favTitle);
// $favCode=$_POST['favCode'];
// $favCode=mysql_real_escape_string($favCode);
//
// $favQuery = $DBcon->query("INSERT INTO favourites(fav_text, fav_title) VALUES('$favTitle','$favCode')");
// $userRow=$favQuery->fetch_array();
// $DBcon->close();
// }
?>
