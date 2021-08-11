<?php
define("LOCALSERVER", "localhost");
define("USERNAME", "root");
define("PASS", "");
define("DBNAME", "together");

$connect=mysqli_connect(LOCALSERVER,USERNAME,PASS,DBNAME);

// if($connect)
// {
//    echo "ok";
// }else{
//    echo "not ok";
// }
?>