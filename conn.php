<?php

$servername = "EON-PC\SQLEXPRESS";
$database = "E-LibraryDB";

$connectionInfo = array("Database" => $database);

$conn = sqlsrv_connect($servername, $connectionInfo);
if(!$conn)
    die(print_r(sqlsrv_errors(),true));

?>