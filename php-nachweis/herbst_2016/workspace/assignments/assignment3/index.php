<?php
/*
form:
-Name(Text)
-Geschlecht (wird im Text benutzt)(radio)
-Welches Verbrechen würden Sie am ehesten begehen?(select)
-Beschreibe, was du der Polizei erzählt hast (Zitat, text area)
-Formular erneute anzeigen (checkbox)
-Wie viel Finderlohn gibt es (number/ Zahlen-Input)
-Formular einreichen (submit)
*/

//Input-Validierung: kein Textelement sollte leer sein
function isFormValid()
{
    if(empty($_GET['gname'])){
        echo "<div class='error'>Gangster Name must not be empty!</div>";
        return false;
    }
    if(empty($_GET['quote'])){
        echo "<div class='error'>Quote must not be empty!</div>";
        return false;
    }
    if(!isset($_GET['gender'])){
        echo "<div class='error'>Gender must be chosen!</div>";
        return false;
    }
    return true;
}

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

//Input von Formular
$gname=$_GET['gname'];
$gender=$_GET['gender'];
$crime=$_GET['crime'];
$reward=$_GET['reward'];
$quote=$_GET['quote'];

//Funktion, um das Wanted-Poster zu kreieren
function WantedPoster()
{
    global $gname,$gender,$crime,$reward,$quote;
    //Variablen werden je nach User-Input geändert, um in Wanted-Poster-Text eingefügt zu werden
    if($gender=="female")
    {
       $gender="she";
    }
    if($gender=="male")
    {
       $gender="he";
    }
    if($gender=="overrated")
    {
       $gender="the criminal";
    }
    if($crime=="money")
    {
       $crime="robbing banks";
       $crime2="broke into the building, that was used as Gringotts for the Harry Potter movies, jsut because it was used as a bank. Unfortunately, the objects stord into the building were really valuable, so he got profit and the owners lost it";
    }
    if($crime=="drugs")
    {
       $crime="consuming drugs";
       $crime2="stole about 20 tons of cocaine and stored them into a foreign garage, where a little kid thought it was snow and played in it. The kid is now in hospital. The doctors say, it will be fine, but it still acts very weird";
    }
    if($crime=="food")
    {
       $crime="stealing food";
       $crime2="robbed a whole supermarket, putting all the food into a truck. The truck has been retrieved, but not the food - only the empty packages";
    }
    if($crime=="revenge")
    {
       $crime="stalking guys";
       $crime2="stalked a guy's fiancé, made her fall in love with a girl and sent them both to Timbuktu with a fake job offer to get them away from that guy";
    }
    //Display des Wanted-Posters
    echo "<div class='div1'><h1 id='h1'>
    <span id='span1'>W</span>
    <span id='span2'>a</span>
    <span id='span3'>n</span>
    <span id='span4'>t</span>
    <span id='span5'>e</span>
    <span id='span6'>d</span></h1>
    <h3>".$gname."</h3>
    <img src='img/wanted".rand(1,3).".jpg' class='imgPos' /><br>
    <div class='div2'>
    The badass gangster ".$gname." has always been known for ".$crime.". But this time, ".$gender." went over the top and ".$crime2.".
    Before ".$gender." ran away, ".$gender." did not miss the opportunity to leave a message to the public:<br>
    <p>'".$quote."'</p><br>
    <span id='span7'>Have you seen ".$gname."?</span>
    <h2>$".$reward." reward</h2>
    </div></div>";
    
    
}

$design=$_GET['design'];

//Funktion, um CSS je nach Design-Wahl zu verändern
function setDesign()
{
   global $design;
   if($design=="west")
   {
       echo 
       ".div1
       {
           background-image:url('img/westbg2.jpg');
           background-repeat:no-repeat;
           background-size:cover;
           font-family:'Engravers MT',Arial;
       }
       h2
       {
           font-family:'Engravers MT',Arial;
           font-size:24px;
       }
       #h1
       {
           font-family:'Engravers MT',Arial;
           font-size:40px;
       }
       h3
       {
           font-family:'Engravers MT',Arial;
       }
       .div2
       {
           font-family:'Engravers MT',Arial;
           font-size:16px;
       }
       p
       {
           font-family:'Engravers MT',Arial;
           font-size:15px;
       }
       #span7
       {
           font-size:17px;
        }";
       
   }
   if($design=="rainbow")
   {
       echo 
       ".div1
       {
           background-color:#ffff00;
       }
       h2
       {
           color:red;
           font-family:AR Hermann,Comic Sans MS;
       }
       #h1
       {
           font-family:AR Hermann,Comic Sans MS;
       }
       h3
       {
           color:orange;
           font-family:AR Hermann,Comic Sans MS;  
       }
       .div2
       {
          color:green;
          font-family:AR Hermann,Comic Sans MS; 
       }
       p
       {
          color:blue;
           font-family:AR Hermann,Comic Sans MS;
       }
       #span1
       {
           color:red;
       }
       #span2
       {
           color:orange;
       }
       #span3
       {
           color:#f4fdad;
       }
       #span4
       {
           color:green;
       }
       #span5
       {
           color:blue;
       }
       #span6
       {
           color:violet;
       }
       ";
       
   }
   if($design=="technology")
   {
       echo 
       ".div1
       {
           background-color:black;
       }
       #h1
       {
          color:#00ff11; 
          font-family:Agency FB,Helvetica;
          font-size:40px;
       }
       h2
       {
          color:#ffff00; 
          font-family:Agency FB,Helvetica;
       }
       h3
       {
           color:#ffff00;
           font-family:Agency FB,Helvetica;
       }
       .div2
       {
           color:#d600ff;
           font-family:Agency FB,Helvetica;
       }
       p
       {
           color:#00ff11;
           font-family:Agency FB,Helvetica;
       }
       ";
       
   }
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create your own wanted poster </title>
    </head>
     <link rel="stylesheet" href="css/style.css">
     <style>
         form
        {
            display:  <?=displayOrHideForm()?>;
        }
        <?=setDesign()?>
     </style>
    <body>
        <h1>Create your own wanted poster</h1>
        <form method="get" action="index.php?displayForm=on">
            Your gangster name: <input type="text" name="gname"><br><br>
            Are you male or female?
            <input type="radio" name="gender" value="male" id="male">
            <label for="male">Male</label>
            <input type="radio"  name="gender" value="female" id="female">
            <label for="female">Female</label>
            <input type="radio"  name="gender" value="overrated" id="overrated">
            <label for="female">Gender is overrated</label><br><br>
            Which of the following crimes would you most likely commit?
            <select name="crime">
                <option value="money">rob a bank</option>
                <option value="drugs">consume drugs</option>
                <option value="food">steal food</option>
                <option value="revenge">stalk your crush</option>
                </select><br><br>
            Select a design: <select name="design">
                <option value="west">Wild West</option>
                <option value="rainbow">Rainbow</option>
                <option value="technology">Technology</option>
                </select><br><br>
            Before you escaped from the place of crime,you yelled at the people standing around. Which memorable sentence did you say?<br>
            <textarea name="quote" rows="3" cols="30"></textarea><br>
            How much reward does the person, who finds you, get?<br>
            (between 100 and 5000)<br><br>
            <input type="number" name="reward"min="100" max="5000" step="10" value="100" checked><br><br>
            <input type="checkbox" name="displayForm">Don't display Form again<br><br>
            <input type="submit" value="Submit" name="formSubmitted" /><br>
            
        </form>
        
        <hr>
        <?php
        if(isFormValid()){
            WantedPoster();
        }
        ?>
        <br>
        <br>

    </body>
</html>