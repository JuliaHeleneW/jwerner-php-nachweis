<?php
if(isset($_GET['albumId'])){
  $host="localhost";
  $dbname="project";
  $username="web_user";
  $password="s3cr3t";
  //Verbindung zur Datenbank herstellen (ungültig)
  $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  //Errorhandling als Ausnahme/Exception festlegen
  $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //Album löschen
  deleteAlbum();
}

//Funktion, um Album zu löschen, Schutz vor SQL Injection
function deleteAlbum(){
  global $conn;
  $sql = "DELETE FROM albums WHERE albumId= :albumId";
  $namedParameters=array();
  $namedParameters[":albumId"]=$_GET['albumId'];
  $stmt=$conn->prepare($sql);
  $stmt->execute($namedParameters);
  header("Location:adminScreen.php");
}
?>