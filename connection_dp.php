<?php
define("LOCALSERVER", "gsgxprocom.ipagemysql.com");
define("USERNAME", "together");
define("PASS", "2getherGP");
define("DBNAME", "together");

$connect=mysqli_connect(LOCALSERVER,USERNAME,PASS,DBNAME);

// if($connect)
// {
//    echo "ok";
// }else{
//    echo "not ok";
// }
?>