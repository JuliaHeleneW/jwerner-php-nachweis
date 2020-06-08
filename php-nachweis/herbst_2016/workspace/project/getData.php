<?php
//Genre wird hier zur Datenbank hinzugefügt
$host="localhost";
$dbname="project";
$username="web_user";
$password="s3cr3t";
//Verbindung zur Datenbank herstellen (ungültig)
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql="INSERT INTO genres (name) VALUES (:name)";
    $namedParameters=array();
    $namedParameters[":name"]=$_GET['name'];
    $stmt=$conn->prepare($sql);
    $stmt->execute($namedParameters);
    //kein Fetch, weil nichts zurückgegeben wird
?>