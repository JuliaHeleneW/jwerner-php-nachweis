<?php
session_start();

//Kontrolle, ob der Admin eingeloggt ist
if(!isset($_SESSION['username']))
{
    header("Location:program1.php");
    exit;
}

//Wilkommensnachricht für den eingeloggten Nutzer
function welcome()
{
    echo "Welcome ".$_SESSION['username'];
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Page</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <form action="logout.php">
            <input type="submit" value="Logout">
        </form>
        <!--Wilkommensnachricht wird hier angezeigt-->
        <h1><?=welcome()?></h1>
    </body>
</html>
