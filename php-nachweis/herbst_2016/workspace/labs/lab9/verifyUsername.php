<?php
    $host="localhost";
    $dbname="c9";
    $username="web_user";
    $password="s3cr3t";
    //Verbindung zur Datenbank herstellen (ungültig)
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //Errorhandling als Ausnahme/Exception festlegen
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Vorbereiten, Ausführen, Daten holen
    $sql="SELECT username FROM users WHERE username=:username";
    $stmt=$dbConn->prepare($sql);
    $stmt->execute(array(":username"=>$_GET['username']));
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    
    //Ergebnis in JSON-Format
    echo json_encode($result);
?>