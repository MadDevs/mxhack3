<?php
 
function con_start() {
     
    $host = "http://104.236.217.175:3306";
    $user = "root";
    $pass = "mxhacks3";
    $db = "mxhacks";
     
    $mysqli = new mysqli($host, $user, $pass, $db);
    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connection failed: %s\n", mysqli_connect_error());
        exit();
    }
    /* change character set to utf8 */
    $mysqli->set_charset("utf8_spanish_ci");
    return $mysqli;
} 
?>