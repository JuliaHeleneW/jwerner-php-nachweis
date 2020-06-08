<?php
//Session starten
session_start();

$host="localhost";
$dbname="project";
$username="web_user";
$password="s3cr3t";
//Verbindung zur Datenbank herstellen (ungültig)
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//User Input
$username=$_POST['username'];
$password=sha1($_POST['password']);

//Vorbereiten, Ausführen, Daten holen
$sql="SELECT * 
      FROM users 
      WHERE username=:username
      AND password=:password";
$namedParameters=array();
$namedParameters[':username']=$username;
$namedParameters[':password']=$password;
$statement=$conn->prepare($sql);
$statement->execute($namedParameters);
$record=$statement->fetch(PDO::FETCH_ASSOC);

//wenn Input ungültig: Fehlermeldung wird angezeigt, ansonsten zur Admin Seite weiterleiten
if(empty($record))
{
    echo "Wrong username or password<br>";
    echo "<a href='login.php'>Try again</a>";
}
else
{
    $_SESSION['username']=$record['username'];
    $_SESSION['adminFullName']=$record['firstName']." ".$record['lastName'];
    header("Location:adminScreen.php");
}

?>