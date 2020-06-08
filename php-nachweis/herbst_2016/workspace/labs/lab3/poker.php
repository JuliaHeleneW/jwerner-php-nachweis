<?php

//Array mit Nummern der Karten
$deck=array();
for($i=1;$i<=52;$i++){
    $deck[]=$i;
}

//Funktion, um eine zufällige Karte anzuzeigen
function displayRandomCard(){
    global $deck;
    shuffle($deck);
    $acesCount=0;
    //jeder Spieler bekommt 5 Karten
    for($i=0;$i<5;$i++){
        $card=array_pop($deck);
        //Punkte-Wert der Karte
        $cardValue=$card%13+1;
        $suit="clubs";
        //richtige Kategorie der Karten finden, da die Bilder im entsprechenden Ordner gespeichert sind
        if ($card < 14) {
          $suit = "clubs";
        } else if ($card > 14 && $card <= 26 ) {
          $suit = "diamonds";
        }  else if ($card > 26 && $card <= 39 ) {
           $suit = "hearts";
        } else {
          $suit = "spades";
        }
        
        //Ass-Zähler, wenn ein Ass gezogen wird
        if($cardValue==1)
        {
            $acesCount++;
            $border=" style='border: 4px solid yellow;'";//gelbe Umrandung für Asse
        }
        else{
            $border=" ";
        }
        //Kartenwert zu Punkten hinzufügen
        $points=$points+$cardValue;
        //entsprechendes Bild anzeigen
        echo "<img src='img/cards/".$suit."/".$cardValue.".png'".$border." />";
    }
    //Punkte werden angezeigt
    echo "Points: ".$points;
    //Nummer der Asse und Punkte werden in Array gespeichert
    $hand=array($acesCount,$points);
    return $hand;
}

//Funktion, um den Gewinner zu ermitteln
function winner($player1,$player2,$points1,$points2)
{
    //Punkte, die der Gewinner gewinnt
    $totalPoints=$points1+$points2;
    //Resultat je nach Nummer der Asse
   if($player1>$player2)
   {
       echo "Player wins ".$totalPoints. " points!";
   }
   else if($player2>$player1)
   {
       echo "PC wins ".$totalPoints." points!";
   }
   else
   {
      echo "Tie!"; 
   }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Ace Poker</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <h2>Ace Poker</h2>
        <div>Player with more aces wins all points!</div>
        <!--2 Spieler bekommen gemischte Karten zugeteilt-->
        You: <?php $handPlayer1=displayRandomCard()?><br>
        PC: <?php $handPlayer2=displayRandomCard()?> <br>
        <!--der Gewinner wird ermittelt-->
        <?=winner($handPlayer1[0],$handPlayer2[0],$handPlayer1[1],$handPlayer2[1])?>
    </body>
</html>