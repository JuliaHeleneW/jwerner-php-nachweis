<?php

include 'ledboard/ledLetters.php';

//Validierung des User Inputs
function isFormValid()
{
    //es muss eine Nachricht vorhanden sein, nicht länger als 15, welches mit maxlength gewährt ist (HTML)
    if(empty($_GET['message'])){
        echo "<div class='error'>Message must not be empty</div>";
        return false;
    }
    
    //es muss einen Input für Farbe per Zelle geben
    if(!isset($_GET['colorPerCell'])){
        echo "<div class='error'>Color per cell must be checked!</div>";
        return false;
    }
    return true;
}

//User Input
$message=$_GET['message'];
$color=$_GET['color'];
$colorPerCell=$_GET['colorPerCell'];
$colorPerWordArray=$_GET['colorPerWord'];

function LEDBoard()
{
    //globale Variablen benutzen
    global $message,$color,$colorPerCell,$colorPerWordArray;
    $j=0;
    //wenn colorPerCell ausgewählt ist, bekommt jeder Buchstabe eine zufällige Farbe
    if($colorPerCell=="yes")
    {
       $color = "rainbow"; 
    }
    $j=0;
    //alle verschiedenen Fälle von Farben pro Wort, alle benutzen die drawLetter() Funktion
    if(!empty($colorPerWordArray[0])&&empty($colorPerWordArray[1])){
           $color=$colorPerWordArray[0];
           for($i=0;$i<strlen($message);$i++){
            if($message[$i]==" ")
            {
			    echo "<br>";
            }
            else
            {
                drawLetter($message[$i],$color);
	        }
        }
    }
    else if(!empty($colorPerWordArray[0])&&!empty($colorPerWordArray[1])&&empty($colorPerWordArray[2])){
        $counter=0;
        for($i=0;$i<strlen($message);$i++)
        {
            if($counter==0&&$message[$i]!=" ")
            {
                $color=$colorPerWordArray[0];
                drawLetter($message[$i],$color);
            }
            elseif($counter==0&&$message[$i]==" ")
            {
                echo "<br>";
                $counter++;
            }
            else if($counter==1)
            {
                $color=$colorPerWordArray[1];
                drawLetter($message[$i],$color);	  
            }

        }
    }
    else if(!empty($colorPerWordArray[0])&&!empty($colorPerWordArray[1])&&!empty($colorPerWordArray[2])){
        $counter=0;
        for($i=0;$i<strlen($message);$i++)
        {
            if($counter==0&&$message[$i]!=" ")
            {
                $color=$colorPerWordArray[0];
                drawLetter($message[$i],$color);
            }
            else if($counter==0&&$message[$i]==" ")
            {
                echo "<br>";
                $counter++;
            }
            else if($counter==1&&$message[$i]!=" ")
            {
                $color=$colorPerWordArray[1];
                drawLetter($message[$i],$color);
            }
            else if($counter==1&&$message[$i]==" ")
            {
                echo "<br>";
                $counter++;
            }
            else if($counter==2)
            {
                $color=$colorPerWordArray[2];
                drawLetter($message[$i],$color);	  
            }
        }
    }
    else{    
        for($i=0;$i<strlen($message);$i++){
            if($message[$i]==" ")
            {
			    echo "<br>";
            }
            else
            {
                drawLetter($message[$i],$color);
	        }
        }
    }
    
}
$count=0;

//Funktion, um das Formular anzuzeigen oder zu verstecken
function displayOrHideForm()
{
    if (!isset($_GET['displayForm']))
    {
        echo 'block';
    }
    if (isset($_GET['displayForm']))
    {
        echo 'none';
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 4: Custom LED Board</title>
    </head>
    <link rel="stylesheet" href="css/style.css">
    <style>
    form
    {
        display:  <?=displayOrHideForm()?>;
    }
    </style>
    <body>
        <h1>Custom LED Board</h1>
        <form method="get" action="https://cst352-wern4701.c9users.io/labs/lab4/index.php?displayForm=on">
            Message: <input type="text" name="message" maxlength="15" value="Hello World"/><br>
            Select a color: <select name="color">
                <option value="yellow">Yellow</option>
                <option value="red">Red</option>
                <option value="green">Green</option>
                <option value="blue">Blue</option>
                </select>
                <br>
            Display different colors per cell?
            <input type="radio" name="colorPerCell" value="yes" id="cellYes">
            <label for="cellYes">Yes</label>
            <input type="radio"  name="colorPerCell" value="no" id="cellYes">
            <label for="cellNo">No</label><br>
            Display custom colors per word:<br><br>
            (Enter color names or hexadecimal values)<br><br>
            <input type="text" name="colorPerWord[]" />
            <input type="text" name="colorPerWord[]" />
            <input type="text" name="colorPerWord[]" /><br><br>
            <input type="checkbox" name="displayForm">Don't display Form again<br><br>
            <input type="submit" value="Submit" name="formSubmitted" />
            
            
        </form>
        
        <hr>
        
        <div>
        <!--LED Board wird angezeigt bei gültigen Angaben-->
        <?php
        if(isFormValid()){
            LEDBoard();
        }
        ?></div>

    </body>
</html>