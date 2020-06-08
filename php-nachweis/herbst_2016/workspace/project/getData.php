<?php
//Genre wird hier zur Datenbank hinzugefügt
$host="eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$dbname="ihn134ea3dzfr2py";
$username="k4jwjzer9w7qpn4t";
$password="j1pprhuike445rf7";
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