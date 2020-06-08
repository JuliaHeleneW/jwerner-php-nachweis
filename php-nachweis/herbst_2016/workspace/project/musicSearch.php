<?php

$host="localhost";
$dbname="project";
$username="web_user";
$password="s3cr3t";
//Establishing a connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Setting Errorhandling to Exception
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Funktion, um Alben nach Auswahlkriterien zu suchen
function displayAlbums()
{
    global $dbConn;
    $sql="SELECT albums.name AS album,description,bands.name AS band,genres.name AS genre,price,releaseDate,cover FROM albums,bands,genres WHERE albums.genreId=genres.genreId AND albums.bandId=bands.bandId";
    $namedParameters=array();
    //ein ausgefülltes Feld wird zum SQL statement hinzugefügt
    if(($_GET['band'])!="select"){
        $sql=$sql." AND albums.bandId= :bandId";
        $namedParameters[':bandId']=$_GET['band'];
    }
    if(($_GET['genre'])!="select"){
        $sql=$sql." AND albums.genreId= :genreId";
        $namedParameters[':genreId']=$_GET['genre'];
    }
    if(($_GET['price'])!="select"){
        if(($_GET['price'])==1)
        {
        $sql=$sql." AND price<10";
        }
        else if(($_GET['price'])==2)
        {
        $sql=$sql." AND price>10 AND price<20";
        }
        else if(($_GET['price'])==3)
        {
           $sql=$sql." AND price>20"; 
        }
    }
    if(($_GET['releaseDate'])!="select"){
        if(($_GET['releaseDate'])==1)
        {
        $sql=$sql." AND releaseDate <  '2000'";
        }
        else if(($_GET['releaseDate'])==2)
        {
        $sql=$sql." AND releaseDate >  '2000' AND releaseDate <  '2010'";
        }
        else if(($_GET['releaseDate'])==3)
        {
        $sql=$sql." AND releaseDate >  '2010'";
        }
    }
    //Vorbereiten, Ausführen, Daten holen
    $stmt=$dbConn->prepare($sql);
    $stmt->execute($namedParameters);
    $albums=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    foreach ($albums as $album) {
        echo "Album name: ".$album['album']."<br>Description: ".$album['description']."<br>Band: ".$album['band']."<br>Genre: ".$album['genre']."<br>Price: $".$album['price']."<br>Release date: ".$album['releaseDate']."<br>Cover:<br><img src='".$album['cover']."' class='myImg'><br><br>";
    }
}

//Funktion, um die vorhandenen Genres zu bekommen
function getGenres()
{
    global $dbConn;
    $sql="SELECT name,genreId FROM genres";
    $stmt=$dbConn->prepare($sql);
    $stmt->execute();
    $genres=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($genres as $agenre)
    {
        echo "<option value='".$agenre['genreId']."'>".$agenre['name']."</option>";
    }
}

//Funktion, um die vorhandenen Bands zu bekommen
function getBands()
{
    global $dbConn;
    $sql="SELECT name,bandId FROM bands";
    $stmt=$dbConn->prepare($sql);
    $stmt->execute();
    $bands=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($bands as $band)
    {
        echo "<option value='".$band['bandId']."'>".$band['name']."</option>";
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Music Search</title>
    </head>
    <link rel="stylesheet" href="css/style.css">
    <body>
        <form action="login.php">
            <input type="submit" value="Admin Login">
        </form>
        <h1>Search for the best music for you</h1>
        <form method="get">
        
        <strong>Band:</strong>
        <select name="band">
            <option value="select">Select one</option>
            <?=getBands()?>
        </select><br>
        <strong>Genre:</strong>
        <select name="genre">
            <option value="select">Select one</option>
            <?=getGenres()?>
        </select><span id="genspan" class="error"></span><br>
        <strong>Price:</strong>
        <select name="price">
            <option value="select">Select one</option>
            <option value="1">Less than $10</option>
            <option value="2">$10-$20</option>
            <option value="3">More than $20</option>
        </select><br>
        <strong>Release time:</strong>
        <select name="releaseDate">
            <option value="select">Select one</option>
            <option value="1">Before 2000</option>
            <option value="2">2000-2010</option>
            <option value="3">2010 or later</option>
        </select><br>
        <input type="submit" value="Find your music" name="submit">
        </form>
        <br><hr><br>
        <?=displayAlbums()?>
    </body>
</html>