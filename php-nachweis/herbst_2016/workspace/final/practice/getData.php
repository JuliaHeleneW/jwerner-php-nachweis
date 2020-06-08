<?php
    $host="localhost";
    $dbname="final";
    $username="web_user";
    $password="s3cr3t";
    //Verbindung zur Datenbank herstellen (ungültig)
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //Errorhandling als Ausnahme/Exception festlegen
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT username,lastLogin,lastLoginStatus FROM fp_login WHERE username=:username";
    $namedParameters=array();
    $namedParameters[':username']=$_GET['username'];
    $stmt=$dbConn->prepare($sql);
    $stmt->execute($namedParameters);
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    
    //Ergebnis in JSON-Format
    echo json_encode($result);
?>