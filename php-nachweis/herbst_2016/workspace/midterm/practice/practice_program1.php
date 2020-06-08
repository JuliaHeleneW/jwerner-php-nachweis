<?php
$letterToFind=$_GET['letterToFind'];
$letterToOmit=$_GET['letterToOmit'];
function isFormValid()
{
    global $letterToFind;
    global $letterToOmit;
    if($letterToFind==$letterToOmit)
    {
        echo "Letter to find and letter to omit must not be the same";
        return false;
    }
    return true;
}
function letterToFind()
{
    echo "<select name='letterToFind'>";
    for($i=65;$i<=90;$i++)
    {
        echo "<option value=".chr($i).">".chr($i)."</option>";
    }
    echo "</select>";
}
function letterToOmit()
{
    echo "<select name='letterToOmit'>";
    for($i=65;$i<=90;$i++)
    {
        echo "<option value=".chr($i).">".chr($i)."</option>";
    }
    echo "</select>";
}

function displayTable() {
    global $letterToFind;
    global $letterToOmit;
    $size=$_GET['size'];
    echo "Letter to find: ".$letterToFind."<br>";
    echo "Letter to omit: ".$letterToOmit;
    $letterIsDisplayed = 0;
	echo "<table border = 1>";
	for ($i = 0; $i < $size; $i++) {
		echo "<tr>";
		for ($j = 0; $j < $size; $j++) {
		    if($letterIsDisplayed == 0)
		    {
		        $letterToDisplay = $letterToOmit;
		        while($letterToDisplay==$letterToOmit)
		        {
		           $letterToDisplay = chr(rand(65,90));
		        }
		        if($letterToDisplay==$letterToFind)
		        {
		            $letterIsDisplayed=1;
		        }
		    }
		    else
		    {
		        $letterToDisplay = $letterToOmit;
		        while($letterToDisplay==$letterToOmit||$letterToDisplay==$letterToFind)
		        {
		           $letterToDisplay = chr(rand(65,90));
		        }
		    }
		    if($letterToDisplay<chr(73))
		    {
		        $colorToDisplay="red";
		    }
		    else if($letterToDisplay<chr(82))
		    {
		        $colorToDisplay="blue";
		    }
		    else
		    {
		        $colorToDisplay="green";
		    }
		    echo "<td style = 'color:".$colorToDisplay."'>";
			echo $letterToDisplay;
			echo "</td>";
		}
		echo "</tr>";
	}
	echo "</table>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Find the letter!</title>
    </head>
    <style>
    h1{font-size:30px;font-fweight:bold;font-family:'Comic Sans MS';}
    body{font-family:'Comic Sans MS';font-size:15px;}
    </style>
    <body>
        <h1>Find the letter!</h1>
        <form>
            Select a size: <select name="size">
                <option value="6">6x6</option>
                <option value="7">7x7</option>
                <option value="8">8x8</option>
                <option value="9">9x9</option>
                <option value="10">10x10</option>
                </select><br>
            Letter to find:
            <?=letterToFind()?><br>
            Letter to omit:
            <?=letterToOmit()?><br>
            <input type="submit" value="Submit" name="formSubmitted"><br>
        </form>
        <hr>
        <?php
        if(isFormValid()){
            displayTable();
        }
        ?>
    </body>
</html>