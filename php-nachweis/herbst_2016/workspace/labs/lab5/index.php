<?php
 $host="localhost";
 $dbname="quotes";
 $username="web_user";
 $password="s3cr3t";
//Verbindung zur Datenbank herstellen (ungültig)
 $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
 //Errorhandling als Ausnahme/Exception festlegen
 $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Funktion, um ein zufälliges Zitat auszuwählen und anzuzeigen
function displayRandomQuote()
{
    global $dbConn; //globale Datenbankverbindung für gesamte Seite

    //Vorbereiten, Ausführen, Daten holen
    $sql="SELECT COUNT(1) AS totalQuotes FROM quote";
    $stmt=$dbConn->prepare($sql);
    $stmt->execute();
    $result=$stmt->fetch(PDO::FETCH_ASSOC);
    $randomIndex=rand(0,18);
    
    //Vorbereiten, Ausführen, Daten holen
    $sql="SELECT * FROM quote NATURAL JOIN author LIMIT $randomIndex,1";
    $stmt=$dbConn->prepare($sql);
    $stmt->execute();
    $results=$stmt->fetch(PDO::FETCH_ASSOC);
    
    //Ergebnisse anzeigen
    echo '<em style="color:red;">"'.$results['quote'].'"</em><br><br>';
    echo "<em><a target='author_iframe' href='authorInfo.php?authorId=".$results['authorId'] ."'>".$results['firstName']." ".$results['lastName']."</a></em>";
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 5: Random Quote Generator</title>
    </head>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body{background-image:url("img/bg.jpg")}
    </style>
    <body>
        <h1>Random Quote Generator</h1>
        <!--zufälliges Zitat wird angezeigt-->
        <?=displayRandomQuote()?>
        <br>
        <iframe name='author_iframe' height="200" width="700" ></iframe>
    </body>
</html>