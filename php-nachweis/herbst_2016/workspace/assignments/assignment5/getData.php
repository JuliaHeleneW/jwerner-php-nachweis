<?php
    $host="localhost";
    $dbname="c9";
    $username="web_user";
    $password="s3cr3t";
    //Verbindung zur Datenbank herstellen (ungültig)
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //Errorhandling als Ausnahme/Exception festlegen
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="SELECT username,COUNT(1) as times,AVG(score) as average FROM quiz WHERE username=:username";
    $namedParameters=array();
    $namedParameters[':username']=$_GET['username'];
    //Vorbereiten, Ausführen, Daten holen
    $stmt=$dbConn->prepare($sql);
    $stmt->execute($namedParameters);
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    //Ergebnisse als JSON-Daten
    echo json_encode($result);
?>