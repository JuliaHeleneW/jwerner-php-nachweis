<?php

function getDBConnection($dbName){
    $host="localhost";
    $dbname=$dbname;
    $username="web_user";
    $password="s3cr3t";
    //Establishing a connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //Setting Errorhandling to Exception
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

?>