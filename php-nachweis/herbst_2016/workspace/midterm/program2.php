<?php
    $host="localhost";
    $dbname="midterm";
    $username="web_user";
    $password="s3cr3t";
    //Verbindung zur Datenbank herstellen (ungültig)
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    //Errorhandling als Ausnahme/Exception festlegen
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
function display1()
{
    global $dbConn;
    $sql= "SELECT firstName,lastName,gender FROM m_students WHERE gender='F'";
    ///Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    foreach($records as $mp)
    {
        echo $mp['firstName']." ".$mp['lastName']."<br>";
    }
}
function display2()
{
    global $dbConn;
    $sql= "SELECT firstName,lastName,grade FROm m_students AS s,m_gradebook AS g WHERE s.studentId=g.studentId AND grade<'50'";
    ///Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    foreach($records as $mp)
    {
        echo $mp['firstName']." ".$mp['lastName']." ".$mp['grade']."<br>";
    }
}
function display3()
{
    global $dbConn;
    $sql= "SELECT DISTINCT title,dueDate FROm m_assignments,m_gradebook WHERE m_assignments.assignmentId NOT IN (SELECT assignmentId FROM m_gradebook)";
    ///Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    foreach($records as $mp)
    {
        echo $mp['title']." ".$mp['dueDate']."<br>";
    }
}
function display4()
{
    global $dbConn;
    $sql= "SELECT firstName,lastName,title,grade FROM m_gradebook AS g INNER JOIN m_students AS s,m_assignments AS a WHERE g.studentId=s.studentId AND g.assignmentId=a.assignmentId ORDER BY lastName ASC,title ASC";
    ///Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    foreach($records as $mp)
    {
        echo $mp['firstName']." ".$mp['lastName']." ".$mp['title']." ".$mp['grade']."<br>";
    }
}
function display5()
{
    global $dbConn;
    $sql= "SELECT DISTINCT m_students.studentId,firstName,lastName,AVG(grade) AS average FROM m_students,m_gradebook WHERE m_students.studentId=m_gradebook.studentId GROUP BY m_students.studentId ORDER BY average DESC";
    ///Vorbereiten, Ausführen, Daten holen
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //Ergebnisse aus der Datenbank anzeigen
    foreach($records as $mp)
    {
        echo $mp['m_student.studentId']." ".$mp['firstName']." ".$mp['lastName']." ".$mp['average']."<br>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Database</title>
    </head>
    <body>
        <h3>Display female students</h3>
        <?=display1()?>
        <h3>Grade less than 50</h3>
        <?=display2()?>
        <h3>Not graded assignments</h3>
        <?=display3()?>
        <h3>Gradebook</h3>
        <?=display4()?>
        <h3>Average Grade</h3>
        <?=display5()?>
        <h3></h3>
    </body>
</html>