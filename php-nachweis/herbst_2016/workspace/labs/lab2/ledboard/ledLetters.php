<?php
function drawLetter($letter, $color) {
	//Buchstaben zu großgeschriebenem Buchstaben konvertieren
	$letter = strtoupper($letter);
	//Tabelle erstellen
	echo "<table border = 1>";
	for ($i = 0; $i < 8; $i++) {//Zeilen
		echo "<tr>";
		for ($j = 0; $j < 8; $j++) {//Spalten
            $colorToDisplay = "white";//Farbe des Hintergrunds ist weiß
			$letterToDisplay = "";//noch kein Buchstabe
			//je nach Buchstabe werden bestimmte Quadrate mit dem Buchstaben und Farbe versehen
			switch($letter) {
				case "A" :
					if ($i < 2 || $j < 2 || $j > 5 || $i == 4)  {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "B" :
					if ($i<2&&$j<6||$j<2||$i>5&&$j<6||$i==3&&$j<6||$i==4&&$j<6||$i==2&&$j>6||$i<3&&$i>0&&$j>5||$i>4&&$i<7&&$j>5||$i==4&&$j==6||$i==7&&$j==6||$i==3&&$j==6||$i==0&&$j==6) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "C" :
					if (($i==0 && $j>1 && $j<7) || ($i==1 && $j>0) || 
					$i>1&&$j<2&&$i<6 || ($i==7 && $j>1 && $j<7) || ($i==6 && $j>0 ))
					 {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}					
					break;
				case "D" :
					if (!($i > 6 && $j > 6) && !($i == 0 && $j > 6) && ($i < 2 || $i > 5 || $j < 2 || $j > 5)) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "E" :
					if ($i < 1 || $j < 1 || $i > 6 || $i < 4 && $i > 2) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}					
					break;
				case "F" :
					if ($i < 2 || $j < 2 || $j > 7 || $i == 3 || $i == 4) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}	
					break;
				case "G" :
					if ($i<2||$i>5||$j<2||$j>5&&$i>3||$i==3&&$j>3||$i==4&&$j>3) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "H" :
					if ($j<2||$j>5||$i==3||$i==4) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "I" :
					if ($i <2 || $i > 5 || $j == 3 || $j == 4) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "J" :
					if ($i < 2 || ($j > 3 && $j < 6) || ($j < 4 && $i > 5) || ($i == 5 && $j < 2)) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}					
					break;
				case "K" :
					if ($j== 0 || $j==1 || $j==2 && $i == 3 || $j==2 && $i == 4 || $j==3 && $i == 4 || $j==3 && $i ==3  || $j==5 && $i == 2  || $j==4 && $i == 2  || $j==5 && $i == 1  || $j==6 && $i == 1 ||  $j==7 && $i == 0 ||  $j==6 && $i == 0
					|| $j==4 && $i == 5 || $j==5 & $i == 5 || $j==6 & $i == 6 || $j==5 & $i == 6 || $j==7 & $i == 7 || $j==6 & $i == 7)  {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "L" :
					if ($i>5||$j<3) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "M" :
					if (!($i == 0 && $j == 3) && !($i == 0 && $j == 4) && !($i > 2 && $j > 1) 
					&& !($i == 2 && $j == 2) && !($i == 2 && $j == 5) || ($i > 2 && $j > 5) 
					|| ($i == 3 && $j == 3) || ($i == 3 && $j == 4)) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "N" :
					if ($j<1||$j>6||$i==1&&$j<2||$i==2&&$j==2||$i==3&&$j==3||$i==4&&$j==4||$i==5&&$j==5||$i==6&&$j==6) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "O" :
						if (($i < 2 || $i > 5 || $j < 2 || $j > 5)) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "P" :
					if ($j == 0 || 
					$i == 0 && $j < 7 ||
					$i == 3 && $j < 7 ||
					$j == 7 && ($i > 0 && $i < 3)
					) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}					
					break;
				case "Q" :
					if ($i < 1 && $j < 7 || $j < 1 && $i< 7 || $i == 6 && $j<7 || $j == 6 && $i<7 ||$i==7 && $j==7) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "R" :
					if ($i<2||$j<2 || $j==6&&$i<=4||$j==6&&$i>5&& $j==6&&$i<=6||$j==7&&$i<4||$i>6&&$j==7 || $i==4 && $j<7 || $i==5&&$j==5) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "S" :
					if (1) {
							if (($i == 0 || $i == 1) && $j >= 1)  {//top bar
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					if ($i == 1  || $i == 2)  {//middle
						if($j == 0){
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
						}
					}
					if (($i == 3 || $i == 4) && $j > 0 && $j < 7)  {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
						if ($i == 4  || $i == 5)  {
							if($j == 7){
							$colorToDisplay = $color;
							$letterToDisplay = $letter;
							}
					}
						if (($i == 6   || $i == 7)&& $j >= 0 && $j < 7)  {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					}
					break;
				case "T" :
					if ($i == 0 || $i ==1 || $j == 4 || $j == 3)  {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "U" :
					if ($j == 0 && $i < 6 || $j == 1 && $i < 6 || $i == 6 || $i == 7 && $j < 7 && $j > 0 || $j == 6 || $j == 7 && $i < 7) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "V" : //j is horizontal,,,, i is vertical. by Hans.
					if (($j == 0 || $j == 7) && $i < 4) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					if (($j == 1 || $j == 6) && $i < 6) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					if (($j == 2 || $j == 5) && ($i > 3 && $i < 7)) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					if (($j == 3 || $j == 4) && ($i == 6 || $i == 7)) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}					
					break;
				case "W" :
					if ($j<2||$j>5||$i>5||$j==3&&$i>2||$j==4&&$i>2) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "X" :
					if ($i==0&&$j==0||$i==7&&$j==0||$i==1&&$j==1||$i==6&&$j==1||$i==2&&$j==2||$i==5&&$j==2||$i==3&&$j==3||$i==4&&$j==3||$i==4&&$j==4||$i==5&&$j==5||$i==2&&$j==5||$i==6&&$j==6||$i==1&&$j==6||$i==7&&$j==7||$i==0&&$j==7){
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "Y" :
					if (
						$j==3 && $i > 2 || $j ==4 && $i > 2 || $j == 2 && $i == 3 || $j == 1 && $i == 2 ||$j == 0 && $i == 1
					||$j == 0 && $i == 0 ||$j == 1 && $i == 1 || $j == 2 && $i == 2	|| $j == 1 && $i == 1 || $j == 5 && $i == 3 ||
					$j == 5 && $i == 2 || $j == 1 && $i == 1 || $j == 6 && $i == 2 || $j == 6  && $i == 1 || $j == 7 && $i == 1
					|| $j == 7 && $i == 0) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "Z" :
					if ($i<2||$i>5||$i==6&&$j==1||$i==6&&$j==2||$i==5&&$j==2||$i==5&&$j==3||$i==4&&$j==3||$i==4&&$j==4||$i==3&&$j==4||$i==3&&$j==5||$i==2&&$j==5||$i==2&&$j==6) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;					
				case "!" :
					if ($j==3&&$i<5||$j==3&&$i>5||$j==4&&$i<5||$j==4&&$i>5) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "?" :
					if ($j==3&&$i>6||$j==4&&$i>6||$i==5&&$j==3||$i==5&&$j==4||$i==4&&$j>2||$i==3&&$j>2||$i==2&&$j>5||$i==1&&$j>2||$i==0&&$j>2) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}					
					break;
				case "1" :
					if ( $i < 1 && j>2 && j<5 ||$i == 1 && $j < 5 || $j>2 && $j<5 || $i>6) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "2" :
					if (($j > 0 && $i == 0) && ($j < 7 && $i == 0) || ($i == 1 && $j <= 1) || ($i == 1 && $j > 5) || ($i == 2 && $j > 5) || ($i == 3 && $j > 3 && $j < 6) || ($i == 4 && $j > 1 && $j < 4) || ($i >= 5 && $j <= 1 && $j < 3) || ($i == 7)) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}					
					break;
				case "3" :
					if ($i < 1 || $i >5 || $j > 5 || $i == 3) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "4" :
					if ($i==5||$j==5||$i==4&&$j==1||$i==3&&$j==2||$i==2&&$j==3||$i==1&&$j==4) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "5" :
					if ($i == 0 || $j == 0 && $i < 3 || $i == 3 || $j == 7 && $i > 3 || $i == 7){
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}		
					break;
				case "6" :
					if ($i<2||$i>5||$j<2||$j>5&&$i>2||$i==3||$i==4) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "7" :
					if ($i<2||$j>5) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}					
					break;
				case "8" :
					if ($i<2||$i>5||$j<2||$j>5||$i==3||$i==4) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;
				case "9" :
					if ($i<2||$i>5||$j<2&&$i<5||$j>5||$i==3||$i==4) {
						$colorToDisplay = $color;
						$letterToDisplay = $letter;
					}
					break;					
			}  //ende des Switch
			
			//wenn die Farbe "rainbow" ist, wird eine zufällige Farbe ausgewählt
			if ($colorToDisplay == "rainbow") {
				
			   $colorToDisplay = "rgb(" . rand(0,255) . ", " . rand(0,255) . ", " . rand(0,255) .")";	
				
			}
			
			//Abschluss der Tabelle
			echo "<td style = 'background-color:$colorToDisplay'>";
			echo $letterToDisplay;
			echo "</td>";
			
		} //endFor columns
		echo "</tr>";
	} //endFor rows
	echo "</table>";
}
?>