<?php
$host="eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$dbname="ihn134ea3dzfr2py";
$username="k4jwjzer9w7qpn4t";
$password="j1pprhuike445rf7";
//Verbindung zur Datenbank herstellen (ungültig)
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_GET['albumId'])){
  //Album löschen
  deleteAlbum();
}

//Funktion, um Album zu löschen, Schutz vor SQL Injection
function deleteAlbum(){
  global $dbConn;
  $sql = "DELETE FROM albums WHERE albumId= :albumId";
  $namedParameters=array();
  $namedParameters[":albumId"]=$_GET['albumId'];
  $stmt=$dbConn->prepare($sql);
  $stmt->execute($namedParameters);
  header("Location:adminScreen.php");
}
?>