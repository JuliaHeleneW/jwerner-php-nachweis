<?php

$host="localhost";
$dbname="quotes";
$username="web_user";
$password="s3cr3t";
//Verbindung zur Datenbank herstellen (ungültig)
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Funktion, um Informationen über den Autor von der Datenbank zu bekommen per ID
function getAuthorInfo($authorId)
{
    global $dbConn;
    //Vorbereiten, Ausführen, Daten holen
    $sql="SELECT * 
          FROM author 
          WHERE authorId=$authorId";
    $stmt=$dbConn->prepare($sql);
    $stmt->execute();
    $author=$stmt->fetch(PDO::FETCH_ASSOC);
    
    return $author;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 5: Author's Info</title>
    </head>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{background-image:none transparent;}
    </style>
    <body>
        
        <?php

        //wenn eine ID vorhanden ist, wird Autor-Info angezeigt
        if(isset($_GET['authorId']))
        {
            echo"<h1>Author's Info</h1>";
           $authorId=$_GET['authorId'];
           //Autor-Info kommt von Funktion
           $author=getAuthorInfo($authorId);
           //Anzeige der Autor-Info
           echo $author['firstName']." ".$author['lastName']."<br>";
           echo "Day of birth: ".$author['dob']."<br>";
           echo "Day of death: ".$author['dod']."<br>";
           echo "Country of birth: ".$author['country']."<br>";
           echo "<img src = '".$author['picture'] . "' alt = '".$author['firstName'] ." ".$author['lastName']."' width = '250' />";
        }
        
        
        ?>
    </body>
</html>