<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "thomas_annexbios";

$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
$con->set_charset('utf8'); // Fixed question mark for characters like "ë"
if ($con -> connect_errno) {
    echo "Failed to connect to MySQL: " . $con -> connect_error;
    exit();
}

?>