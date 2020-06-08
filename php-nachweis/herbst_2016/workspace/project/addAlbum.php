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
    addAlbum();
}
$host="eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$dbname="ihn134ea3dzfr2py";
$username="k4jwjzer9w7qpn4t";
$password="j1pprhuike445rf7";
//Verbindung zur Datenbank herstellen (ungültig)
$conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Funktion, um Album zur Datenbank hinzuzufügen
function addAlbum()
{
    global $conn;

    //Daten für Album werden von User Input bestimmt, Schutz vor SQL Injection
    $sql="INSERT INTO albums (name,description,bandId,genreId,price,cover,releaseDate) VALUES (:name,:description,:bandId,:genreId,:price,:cover,:releaseDate)";
    $namedParameters=array();
    $namedParameters[":name"]=$_POST['name'];
    $namedParameters[":description"]=$_POST['description'];
    $namedParameters[":bandId"]=$_POST['band'];
    $rdate=date('Y-m-d',strtotime($_POST['releaseDate']));
    $namedParameters[":releaseDate"]=$rdate;
    $namedParameters[":genreId"]=$_POST['genre'];
    $namedParameters[":price"]=$_POST['price'];
    $namedParameters[":cover"]=$_POST['cover'];
    //Vorbereiten und Ausführen
    $stmt=$conn->prepare($sql);
    $stmt->execute($namedParameters);
    //kein Fetch, weil nichts zurückgegeben wird
    echo "Album was added!";
}

//Funktion, um alle Genres von der Datenbank zu bekommen
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

//Funktion, um alle Bands von der Datenbank zu bekommen
function getBands()
{
    global $conn;
    $sql="SELECT name,bandId FROM bands";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $bands=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($bands as $band)
    {
        echo "<option value='".$band['bandId']."'>".$band['name']."</option>";
    }
}

//picture demo link: https://upload.wikimedia.org/wikipedia/en/thumb/6/64/HailToTheKingVinyl.jpeg/220px-HailToTheKingVinyl.jpeg
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Section</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form action="adminScreen.php">
            <input type="submit" value="Admin Page">
        </form>
        <span id="album"></span>
        <h1>Add a new Album</h1>
        <form method="post">
            Album name: <input type="text" name="name"><br>
            Description:<br>
            <textarea rows="10" cols="50" name="description">
            </textarea><br>
            Price: <input type="number" name="price" step="0.01"><br>
            Genre: 
            <!--dropdown benutzt nur gültige Genres-->
            <select name="genre">
                <?=getGenres()?>
            </select><br>
            Band: 
            <!--dropdown benutzt nur gültige Bands-->
            <select name="band">
                <?=getBands()?>
            </select><br>
            Picture URL: <input type="text" name="cover"><br>
            Release date: <input type="date" name="releaseDate"><br>
            <input type="submit" value="Add Album" name="submit">
        </form>
    </body>
</html>