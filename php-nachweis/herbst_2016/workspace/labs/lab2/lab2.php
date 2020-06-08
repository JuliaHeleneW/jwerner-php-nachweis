<?php

//Extra-Skript zum Display von LED-Buchstaben
include 'ledboard/ledLetters.php';

//Funktion, um eine Nachricht in LED Buchstaben anzuzeigen
function LEDBoard($message,$color)
{
    //jeden Buchstaben mit der drawLetter() Funktion malen
    for($i=0;$i<strlen($message);$i++){
        //Farbe kann zufällig ausgewählt oder spezifiziert sein
        if($color=="random"){
				
			   $colorToDisplay = "rgb(" . rand(0,255) . ", " . rand(0,255) . ", " . rand(0,255) .")";
			   drawLetter($message[$i],$colorToDisplay);
				
			}else{
                drawLetter($message[$i],$color);
			}
    }
    
}



?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 2:LED Board </title>
        <link rel="stylesheet" href="css/Rules.css">
    </head>
    <body>
        
        <h1>LED Board</h1>
        <!--Nachricht für Display-->
        <?=LEDBoard("Avenged","red")?>
        <br />
        <?=LEDBoard("Sevenfold","black")?>
        <br />
        <?=LEDBoard("rocks","random")?>
        <br />

    </body>
</html>