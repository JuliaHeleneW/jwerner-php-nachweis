<?php
//Session starten
session_start();

if(!isset($_SESSION['username']))//Kontrolle, ob Admin eingeloggt ist
{
    header("Location:login.php");
    exit;
}
if(isset($_POST['submit']))
{
    $host="eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
    $dbname="ihn134ea3dzfr2py";
    $username="k4jwjzer9w7qpn4t";
    $password="j1pprhuike445rf7";
    //Verbindung zur Datenbank herstellen (ungültig)
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //Errorhandling als Ausnahme/Exception festlegen
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    addBand();
}
$host="eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$dbname="ihn134ea3dzfr2py";
$username="k4jwjzer9w7qpn4t";
$password="j1pprhuike445rf7";
//Verbindung zur Datenbank herstellen (ungültig)
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Funktion, um eine Band zur Datenbank hinzuzufügen
function addBand()
{
    global $conn;
    //Daten für Band werden von User Input bestimmt, Schutz vor SQL Injection
    $sql="INSERT INTO bands (name,genreId) VALUES (:name,:genreId)";
    $namedParameters=array();
    $namedParameters[":name"]=$_POST['name'];
    $namedParameters[":genreId"]=$_POST['genre'];
    //Vorbereiten und Ausführen
    $stmt=$conn->prepare($sql);
    $stmt->execute($namedParameters);
    //kein Fetch, weil nichts zurückgegeben wird
    echo "Band was added!";
}

//Funktion, um alle vorhandenen Genres zu bekommen
function getGenres()
{
    global $conn;
    $sql="SELECT name,genreId FROM genres";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $genres=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($genres as $agenre)
    {
        echo "<option value='".$agenre['genreId']."'>".$agenre['name']."</option>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Add a new band</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form action="adminScreen.php">
            <input type="submit" value="Admin Page">
        </form>
        <span id="album"></span>
        <h1>Add a new Band</h1>
        <form method="post">
            Band name: <input type="text" name="name"><br>
            Genre: 
            <!--dropdown benutzt nur gültige Genres-->
            <select name="genre">
                <?=getGenres()?>
            </select><br>
            <input type="submit" value="Add Band" name="submit">
        </form>
    </body>
</html>