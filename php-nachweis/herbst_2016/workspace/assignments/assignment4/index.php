<?php

$host="localhost";
$dbname="quotes";
$username="web_user";
$password="s3cr3t";
//Verbindung zur Datenbank herstellen (ungültig)
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Errorhandling als Ausnahme/Exception festlegen
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//Funktion, um Autoren mit weniger als 6 Zeichen anzuzeigen
function displayFirstnameLessThan6Chars()
{
    global $dbConn;
    $sql= "SELECT LENGTH( firstName ) AS nameLen , firstName, lastName, country
           FROM author
           WHERE LENGTH( firstName ) <=6
           ORDER BY lastname";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    echo "<table border='1'>
  <tr>
    <th>Length of first name</th>
    <th>First name</th>
    <th>Last name</th>
    <th>Country of birth</th>
  </tr>";
    foreach($records as $author)
    {
  echo "<tr>
    <td>".$author['nameLen']."</td>
    <td>".$author['firstName']."</td>
	<td>".$author['lastName']."</td>
	<td>".$author['country']."</td>
  </tr>";
    }
    echo"</table>" ;
}

//Funktion, um nur Zitate, in denen das Wort 'Imagination' enthalten ist, anzuzeigen
function displayQuotesWithImagination()
{
    global $dbConn;
    $sql= "SELECT quote
           FROM quote
           WHERE quote 
           LIKE  '%Imagination%'";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    echo"<table border='1'>
  <tr>
    <th>Quote</th>
  </tr>";
    foreach($records as $author)
    {
    echo "<tr><td>".$author['quote']."</td></tr>";
    }
    echo"</table>" ;
}

//Funktion, um Autoren, die im 20. Jahrhundert starben, anzuzeigen
function displayAuthorsDeadDuringCentury20()
{
    global $dbConn;
    $sql= "SELECT firstName,lastName,dob,dod,country,picture FROM `author` WHERE dod>'1900' AND dod<'2000'";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
   echo "<table border='1'>
  <tr>
    <th>First name</th>
    <th>Last name</th>
    <th>Day of birth</th>
    <th>Day of death</th>
    <th>Country of birth</th>
    <th>Picture URL</th>
  </tr>";
    foreach($records as $author)
    {
       echo "<tr>
    <td>".$author['firstName']."</td>
	<td>".$author['lastName']."</td>
	<td>".$author['dob']."</td>
	<td>".$author['dod']."</td>
	<td>".$author['country']."</td>
	<td>".$author['picture']."</td>
  </tr>" ;
    }
    echo"</table>" ;
}

//Funktion, um Autoren, deren Heimatland mit U anfängt, anzuzeigen
function displayCountryStartswithU()
{
    global $dbConn;
    $sql= "SELECT firstName,lastName,dob,country FROM author WHERE country LIKE 'U%'";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    echo"<table border='1'>
  <tr>
    <th>First name</th>
    <th>Last name</th>
	<th>Day of birth</th>
    <th>Country of birth</th>
  </tr>";
    foreach($records as $author)
    {
       echo "<tr>
    <td>".$author['firstName']."</td>
	<td>".$author['lastName']."</td>
	<td>".$author['dob']."</td>
	<td>".$author['country']."</td>
  </tr>" ;
    }
    echo"</table>" ;
}

//Funktion, um Zitate von weiblichen Autorinnen anzuzeigen
function displayQuotesByFemaleAuthors()
{
    global $dbConn;
    $sql= "SELECT quote,firstName,lastName FROM quote NATURAL JOIN author WHERE gender='F' ORDER BY firstname";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    echo"<table border='1'>
  <tr>
    <th>First name</th>
    <th>Last name</th>
	<th>Quote</th>
  </tr>";
    foreach($records as $author)
    {
       echo "<tr>
    <td>".$author['firstName']."</td>
	<td>".$author['lastName']."</td>
	<td>".$author['quote']."</td>
  </tr>" ;
    }
    echo"</table>" ;
}

//Funktion, um Zitate und ihre Kategorie anzuzeigen
function displayQuoteCategory()
{
    global $dbConn;
    $sql= "SELECT quote,category FROM quote,category INNER JOIN quote_category WHERE quote.quoteId=quote_category.quoteId AND category.categoryId=quote_category.categoryId";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //display all records
    echo"<table border='1'>
  <tr>
	<th>Quote</th>
	<th>Category</th>
  </tr>";
    foreach($records as $author)
    {
       echo "<tr>
	<td>".$author['quote']."</td>
	<td>".$author['category']."</td>
  </tr>" ;
    }
    echo"</table>" ;
}

//Funktion, um die Nummer an Kategorien anzuzeigen
function countCategories()
{
    global $dbConn;
    $sql= "SELECT COUNT(category) AS catCount FROM category";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    echo "<table border='1'>
  <tr>
    <th>Number of categories</th>
  </tr>";
    foreach($records as $author)
    {
       echo "<tr><td>".$author['catCount']."</td></tr>" ;
    }
    echo"</table>" ;
}

//Funktion, um die durchschnittliche ID der Autoren von Zitaten anzuzeigen
function displayAverageAuthor()
{
    global $dbConn;
    $sql= "SELECT AVG(authorId) AS averageAuthor FROM quote";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    echo "<table border='1'>
  <tr>
    <th>Average author</th>
  </tr>";
    foreach($records as $author)
    {
       echo "<tr><td>".$author['averageAuthor']."</td></tr>" ;
    }
    echo"</table>" ;
}

//Funktion, um die Autoren von Zitaten anzuzeigen
function displayAuthorsOfQuotes()
{
    global $dbConn;
    $sql= "SELECT DISTINCT firstName, lastName
           FROM author
           RIGHT JOIN quote 
           ON author.authorId = quote.authorId";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    echo"<table border='1'>
  <tr>
    <th>First name</th>
    <th>Last name</th>
  </tr>";
    foreach($records as $author)
    {
       echo " <tr>
    <td>".$author['firstName']."</td>
	<td>".$author['lastName']."</td>
  </tr>" ;
    }
    echo"</table>" ;
}

//Funktion, um Name und Geburtsdatum männlicher Autoren anzuzeigen
function displayMaleAuthors()
{
    global $dbConn;
    $sql= "SELECT firstName,lastName,dob FROM author WHERE dob<'1900' AND gender='M' ORDER BY firstName";
    //Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    echo "<table border='1'>
  <tr>
    <th>First name</th>
    <th>Last name</th>
	<th>Day of birth</th>
  </tr>" ;
    foreach($records as $author)
    {
       echo "<tr>
    <td>".$author['firstName']."</td>
	<td>".$author['lastName']."</td>
	<td>".$author['dob']."</td>
  </tr>" ;
    }
    echo"</table>" ;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Assignment 4: Reports</title>
    </head>
    <link rel="stylesheet" href="css/style.css">
    <body>
        <h1>Learn SELECT with 10 examples</h1>
        
        <h3>1: Display all authors, whose firstname has less than 5 characters</h3>
        <strong>SELECT</strong> LENGTH( firstName ) AS nameLen, firstName, lastName, country <br>
        FROM author<br>
        WHERE LENGTH(firstName)<=6 <br><br>
        <?=displayFirstnameLessThan6Chars()?>
        <h3>2: Display all quotes containing the word "Imagination"</h3>
        <strong>SELECT</strong> quote <br>
        FROM quote<br>
        WHERE quote <br>
        LIKE  '%Imagination%' <br>
        <?=displayQuotesWithImagination()?>
        <h3>3: Display all authors, who died during the 20th century</h3>
        <strong>SELECT</strong> firstName,lastName,dob,dod,country,picture<br>
        FROM author<br>
        WHERE dod>'1900'<br> 
        AND dod<'2000'<br>
        <?=displayAuthorsDeadDuringCentury20()?>
        <h3>4: Display all authors living in countries starting with the letter 'U'</h3>
        <strong>SELECT</strong> firstName,lastName,dob,country<br>
        FROM author<br>
        WHERE country<br> 
        LIKE 'U%'<br>
        <?=displayCountryStartswithU()?>
        <h3>5: Display the average author of the quotes</h3>
        <strong>SELECT</strong> AVG(authorId) AS averageAuthor<br>
        FROM quote<br>
        <?=displayAverageAuthor()?>
        <h3>6: Display all quotes by female authors</h3>
         <strong>SELECT</strong> quote,firstName,lastName <br>
        FROM quote<br>
        NATURAL JOIN author <br>
        WHERE gender='F' <br>
        ORDER BY quote<br>
        <?=displayQuotesByFemaleAuthors()?>
        <h3>7: Display all quotes and for each quote its category</h3>
        <strong>SELECT</strong>quote,category <br>
        FROM quote,category<br>
        INNER JOIN quote_category<br>
        WHERE quote.quoteId=quote_category.quoteId<br>
        AND category.categoryId=quote_category.categoryId<br>
        <?=displayQuoteCategory()?>
        <h3>8: Count the categories</h3>
        <strong>SELECT</strong> COUNT(category) AS catCount <br>
        FROM categories<br>
        <?=countCategories()?>
        <h3>9: Display the distinct authors</h3>
        <strong>SELECT</strong> DISTINCT firstName,lastName <br>
        FROM quote<br>
        LEFT JOIN author<br>
        ON author.authorId=quote.authorId<br>
        <?=displayAuthorsOfQuotes()?>
        <h3>10: Display all quotes by male authors, who were born before the 19th century</h3>
        <strong>SELECT</strong> firstName,lastName<br>
        FROM author<br>
        WHERE dod<'1900'
        AND gender='M'
        <?=displayMaleAuthors()?>
        

    </body>
</html>