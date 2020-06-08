<?php
session_start();

if(!isset($_SESSION['username']))//checks whether the admin has logged in
{
    header("Location:login.php");
    exit;
}
$host="localhost";
$dbname="project";
$username="web_user";
$password="s3cr3t";
//Verbindung zur Datenbank herstellen (ungültig)
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Funktion, um die bestehenden Daten eines Albums zu finden
function getAlbumInfo()
{
  global $conn;
  $sql = "SELECT * FROM albums WHERE albumId = :albumId";
  $namedParameters = array();
  $namedParameters[":albumId"] = $_GET['albumId'];
  $stmt = $conn->prepare($sql);
  $stmt->execute($namedParameters);
  $record = $stmt->fetch(PDO::FETCH_ASSOC);
  
  return $record;
}

//wenn ein Album ausgewählt ist, werden die Daten des Albums gespeichert
if(isset($_GET['albumId']))
{
    $album=getAlbumInfo();
}

//Funktion, um die Daten des Albums zu updaten mit User Input, Schutz vor SQL Injection
function updateAlbum()
{
    global $conn;
    $sql="UPDATE albums 
         SET name= :name,
             description= :description,
             bandId= :bandId,
             genreId= :genreId,
             price= :price,
             cover= :cover,
             releaseDate= :releaseDate
        WHERE albumId= :albumId";
    $namedParameters=array();
    $namedParameters[":name"]=$_POST['name'];
    $namedParameters[":description"]=$_POST['description'];
    $namedParameters[":bandId"]=$_POST['band'];
    $rdate=date('Y-m-d',strtotime($_POST['releaseDate']));
    $namedParameters[":releaseDate"]=$rdate;
    $namedParameters[":genreId"]=$_POST['genre'];
    $namedParameters[":price"]=$_POST['price'];
    $namedParameters[":cover"]=$_POST['cover'];
    $namedParameters[":albumId"] = $_POST['albumId'];
    $stmt=$conn->prepare($sql);
    $stmt->execute($namedParameters);
}

if(isset($_POST['submit']))
{
    updateAlbum();
    $album=getAlbumInfo($_GET['albumId']);
    echo "Album was updated!";
}

//Funktion, um das richtige Genre zu finden
function selectGenre($genre)
{
    global $album;
    if($album['genreId']==$genre)
    {
        return "selected";
    }
}

//Funktion, um die richtige Band zu finden
function selectBand($aband)
{
    global $album;
    if($album['bandId']==$aband)
    {
        return "selected";
    }
}

//Funktion, um die vorhandenen Genres zu bekommen
function getGenres()
{
    global $conn;
    $sql="SELECT name,genreId FROM genres";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $genres=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($genres as $agenre)
    {
        echo "<option value='".$agenre['genreId']."'<?=selectGenre('".$agenre['genreId']."')?>".$agenre['name']."</option>";
    }
}

//Funktion, um die vorhandenen Bands zu bekommen
function getBands()
{
    global $conn;
    $sql="SELECT name,bandId FROM bands";
    $stmt=$conn->prepare($sql);
    $stmt->execute();
    $bands=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($bands as $band)
    {
        echo "<option value='".$band['bandId']."' <?=selectGenre(".$band['bandId'].")?  >".$band['name']."</option>";
    }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin: Update Authors</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form action="adminScreen.php">
            <input type="submit" value="Admin Page">
        </form>
        <h1>Updating Album</h1>
        <form method="post">
            Album name: <input type="text" name="name" value="<?=$album['name']?>"><br>
            Description:<br>
            <textarea rows="10" cols="50" name="description">
                 <?=$album['description']?>
            </textarea><br>
            Price: <input type="number" name="price" value="<?=$album['price']?>"><br>
            Genre: 
            <select name="genre">
                <?=getGenres()?>
            </select><br>
            Band: 
            <select name="band">
                <?=getBands()?>
            </select><br>
            Picture URL: <input type="text" name="cover" value=<?=$album['cover']?>><br>
            Release date: <input type="date" name="releaseDate" value="<?=$album['releaseDate']?>"><br>
            <input type="hidden" name="albumId" value="<?=$_GET['albumId']?>"><br>
            <input type="submit" value="Update Album" name="submit">
        </form>
    </body>
</html>