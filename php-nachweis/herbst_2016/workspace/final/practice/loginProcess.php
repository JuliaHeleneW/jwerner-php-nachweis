<?php
//Session starten
session_start();

//Verbindung zur Datenbank herstellen
$host="localhost";
$dbname="final";
$username="web_user";
$password="s3cr3t";
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Nutzername und Passwort von Input der Login Page
$nusername=$_POST['username'];
$password=sha1($_POST['password']);

//nach Nutzer mit Nutzernamen und Password suchen, hierbei SQL Injection vermeiden
$sql="SELECT * 
      FROM fp_login 
      WHERE username=:username
      AND password=:password";
$namedParameters=array();
$namedParameters[':username']=$nusername;
$namedParameters[':password']=$password;
$statement=$conn->prepare($sql);
$statement->execute($namedParameters);
$record=$statement->fetch(PDO::FETCH_ASSOC);

//Login und Status in Datenbank Eintragen: U (ungültig), S (success/Erfolg)
if(empty($record))
{
    global $conn;
    $sql="UPDATE fp_login
    SET lastLogin=:lastLogin,
        lastLoginStatus='U'
      WHERE username=:username";
$namedParameters=array();
$namedParameters[':username']=$nusername;
$namedParameters[':lastLogin']=date('Y-m-d H:i:s');
$statement=$conn->prepare($sql);
$statement->execute($namedParameters);
    header("Location:program1.php");
}
else
{
    $_SESSION['username']=$_POST['username'];
    global $conn;
    $sql="UPDATE fp_login
    SET lastLogin=:lastLogin,
        lastLoginStatus='S'
      WHERE username=:username";
$namedParameters=array();
$namedParameters[':username']=$nusername;
$namedParameters[':lastLogin']=date('Y-m-d H:i:s');
$statement=$conn->prepare($sql);
$statement->execute($namedParameters);
    header("Location:welcome.php");
}
?>