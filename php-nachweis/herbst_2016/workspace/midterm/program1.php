<?php

//Validierung des User Inputs
function isFormValid()
{
    //Werte von Zeile und Spalte werden auf Gültigkeit geprüft
    if((empty($_GET['rows'])||$_GET['rows']==0)&&isset($_GET['submitted'])){
        echo "<div class='error'>Number of rows must not be empty</div>";
        return false;
    }
    if((empty($_GET['columns'])||$_GET['columns']==0)&&isset($_GET['submitted'])){
        echo "<div class='error'>Number of columns must not be empty</div>";
        return false;
    }
    if($_GET['rows']>4){
        echo "<div class='error'>Number of rows must not exceed 4</div>";
        return false;
    }
    if($_GET['columns']>4){
        echo "<div class='error'>Number of columns must not exceed 4</div>";
        return false;
    }
    return true;
}

//User Input
$rows=$_GET['rows'];
$cols=$_GET['columns'];


function displayBilliards()
{
    $points=0;
    //wenn noch keine Angaben gemacht wurden, werden 3 Zeilen und 3 Spalten gezeigt, andernfalls richtet sich die Angezieg nach dem User Input
    if(isset($_GET['submitted']))
    {
        global $rows,$cols,$order;
    }
    else
    {
        $rows=3;
        $cols=3;
    }
    //Nummern.Array wird geshuffelt, um eine zufällige Reihenfolge zu erhalten
    $numbers=array("0","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15");
    shuffle($numbers);
    for ($i = 0; $i < $rows; $i++) {//Zeilen
		echo "<tr>";
		for ($j = 0; $j < $cols; $j++) {//Spalten
            echo "<td>";
            //zufälliges Element wird vom Array genommen
            $randomIndex[i][j]=array_pop($numbers);
            //8 wird aus dem Array genommen, wenn 8 nicht benutzt werden soll nach User Input
            if(!isset($_GET['displayEight']))
            {
                while($randomIndex[i][j]==8)
                {
                    $randomIndex[i][j]=array_pop($numbers);
                }
            }
            //die Punkte aller angezeigten Bälle werden zusammen gezählt
            $points=$points+$randomIndex[i][j];
            //das entsprechende Bild wird angezeigt
            echo "<img src='img/billiards/".$randomIndex[i][j].".png'>";
            echo "</td>";
        }
    //Abschluss der Tabelle
	echo "</tr><br>";
    }
    echo "</table>";
    echo "<br>";
    echo "Total points: ".$points;
    
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Billiards!</title>
    </head>
    <style>
        .error
        {
            color:red;
        }
        td
        {
            background-color:<?=$color?>;
        }
    </style>
    <body>
        <h1>Billiards!</h1>
        <div>
        <?php
        if(isFormValid()){
            displayBilliards();
        }
        ?>
        </div>
        <hr>
        <form method="get">
            Rows: <input type="number" name="rows">
            Columns: <input type="number" name="columns"> (input between 1 and 4)<br><br>
            <input type="checkbox" name="displayEight">Include 8 ball<br><br>
            <input type="submit" value="Display" name="submitted">
        </form>

    </body>
</html>