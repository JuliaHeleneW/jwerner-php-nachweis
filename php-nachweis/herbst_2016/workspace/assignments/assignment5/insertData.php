<?php
    session_start();
    $host="localhost";
    $dbname="c9";
    $username="web_user";
    $password="s3cr3t";
    //Verbindung zur Datenbank herstellen (ungültig)
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //Errorhandling als Ausnahme/Exception festlegen
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Vorbereiten und Ausführen, Daten zu Datenbank hinzufügen
    $sql="INSERT INTO quiz(username,score,date) VALUES (:username,:score,:date)";
    $namedParameters=array();
    $namedParameters[':username']=$_GET['username'];
    $namedParameters[':score']=$_GET['score'];
    $namedParameters[':date']=date('Y-m-d H:i:s');
    $stmt=$dbConn->prepare($sql);
    $stmt->execute($namedParameters);
?>