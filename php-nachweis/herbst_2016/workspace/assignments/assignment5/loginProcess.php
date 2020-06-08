<?php

//Session starten
session_start();

//Verbindung zur Datenbank herstellen
$host="localhost";
$dbname="c9";
$username="web_user";
$password="s3cr3t";
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Nutzername und Passwort von Input der Login Page
$username=$_POST['username'];
$password=sha1($_POST['password']);

//nach Nutzer mit Nutzernamen und Password suchen, hierbei SQL Injection vermeiden
$sql="SELECT * 
      FROM quizusers 
      WHERE username=:username
      AND password=:password";
$namedParameters=array();
$namedParameters[':username']=$username;
$namedParameters[':password']=$password;
$statement=$conn->prepare($sql);
$statement->execute($namedParameters);
$record=$statement->fetch(PDO::FETCH_ASSOC);

//wenn Input ungültig: Fehlermeldung wird angezeigt, ansonsten zum Quiz weiterleiten
if(empty($record))
{
    echo "Wrong username or password<br>";
    echo "<a href='login.php'>Try again</a>";
}
else
{
    $_SESSION['username']=$record['username'];
    header("Location:quiz.php");
}
?>