<?php
session_start();

if(!isset($_SESSION['username']))//Kontrolle, ob der Admin eingeloggt ist
{
    header("Location:login.php");
    exit;
}

$host="eporqep6b4b8ql12.chr7pe7iynqr.eu-west-1.rds.amazonaws.com";
$dbname="ihn134ea3dzfr2py";
$username="k4jwjzer9w7qpn4t";
$password="j1pprhuike445rf7";
//Verbindung zur Datenbank herstellen (ungültig)
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Funktion, um alle Alben anzuzeigen
function getAllAlbums()
{
    global $dbConn;
    $sql= "SELECT albumId,name
           FROM albums
           ORDER BY albumId ASC";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $albums=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank
    return $albums;
}

//Funktion, um alle Bands als Dropdown Optionen anzuzeigen
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

//Funktion, um den Durchschnittspresi von Alben zu kalkulieren
function getAverage()
{
    if(isset($_POST['submitAvg']))
    {
        global $dbConn;
        $sql="SELECT AVG(price) as average,bandId FROM albums WHERE bandId=:bandId";
        $namedParameters=array();
        $namedParameters[":bandId"]=$_POST['bandAvg'];
        $stmt=$dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $avg=$stmt->fetch(PDO::FETCH_ASSOC);
        echo "Average: ".$avg['average'];
    }
}

//Funktion, um die Anzahl von Alben für bestimmte Band zu bekommen
function getNumber()
{
    //User Input für Band-Nummer
    if(isset($_POST['submitNumber']))
    {
        global $dbConn;
        $sql="SELECT COUNT(name) as number,bandId FROM albums WHERE bandId=:bandId";
        $namedParameters=array();
        $namedParameters[":bandId"]=$_POST['bandNum'];
        $stmt=$dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $num=$stmt->fetch(PDO::FETCH_ASSOC);
        echo "Number of albums: ".$num['number'];
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" href="css/style.css">
        <script>
            function confirmDelete(firstName)
            {
                return confirm("Are you sure you want to delete "+firstName+"? ");
            }
        </script>
    </head>
    <body>
        <form action="logout.php">
            <input type="submit" value="Logout">
        </form>
        <h1>Admin Page</h1>
        <form action="addAlbum.php">
            <input type="submit" value="Add New Album">
        </form>
        <form action="addGenre.php">
            <input type="submit" value="Add New Genre">
        </form>
        <form action="addBand.php">
            <input type="submit" value="Add New Band">
        </form>
        <br>
<table>       
<?php
      //jedes Album wird mit Optionen angezeigt: Hinzufügen und Löschen
      $albums=getAllAlbums();
       foreach ($albums as $album){
        echo "<tr>";
       echo "<td>".$album['name'] ."</td>";
       echo "<td> <strong><a href='updateAlbum.php?albumId=".$album['albumId']."'> Edit </a> </strong> </td>";
       echo "<td> 
       <form action='deleteAlbum.php' onsubmit='return confirmDelete(\"".$album['name']."\")'>
         <input type='hidden' name='albumId' value='".$album['albumId']."'>
         <input type='submit' value='Delete'>
       </form>
       </td>";
       echo "</tr>";
   }
   ?>
</table> 
    <h2>Statistics</h2>
    <form method="post">
        Average price per album of a band:<br>
        <select name="bandAvg">
           <?=getBands()?>
        </select><br>
        <input type="submit" name="submitAvg" value="Check Average">
    </form>
    <?=getAverage()?><br><br>
    <form method="post">
        Number of albums of a band:<br>
        <select name="bandNum">
            <?=getBands()?>
        </select name="bandNum"><br>
        <input type="submit" name="submitNumber" value="Check Number of albums">
    </form>
    <?=getNumber()?><br>
    </body>
</html>