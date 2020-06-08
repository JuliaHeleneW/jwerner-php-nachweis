<?php
$host="localhost";
$dbname="midterm";
$username="web_user";
$password="s3cr3t";
//Establishing a connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
//Setting Errorhandling to Exception
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

function population50To80K()
{
    global $dbConn;
    $sql= "SELECT * 
           FROM mp_town
           WHERE population >  '50000'
           AND population <  '80000'";
    //prepare,execute and fetch
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    //all records
    //$records=$stmt->fetchAll();
    //only first record:
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($records as $mp)
    {
        echo $mp['town_name']." ".$mp['population'];
    }
}

function displayAllTowns()
{
    global $dbConn;
    $sql= "SELECT town_name,county_name,population FROM mp_county AS c,mp_town AS t WHERE t.county_id=c.county_id ORDER BY population DESC";
    //prepare,execute and fetch
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    //all records
    //$records=$stmt->fetchAll();
    //only first record:
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($records as $mp)
    {
        echo $mp['town_name']." ".$mp['county_name']." ".$mp['population']."<br>";
    }
}

function totalPopulationCounty()
{
    global $dbConn;
    $sql= "SELECT DISTINCT county_name,SUM(population) AS countyPop FROM mp_county INNER JOIN mp_town ON mp_county.county_id=mp_town.county_id GROUP BY county_name";
    //prepare,execute and fetch
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    //all records
    //$records=$stmt->fetchAll();
    //only first record:
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($records as $mp)
    {
        echo $mp['county_name']." ".$mp['countyPop']."<br>";
    }
}

function totalPopulationState()
{
    global $dbConn;
    $sql= "SELECT DISTINCT state_name,SUM(population) AS statePop FROM mp_state,mp_county,mp_town WHERE mp_county.county_id=mp_town.county_id AND mp_state.state_id=mp_county.state_id GROUP BY state_name";
    //prepare,execute and fetch
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    //all records
    //$records=$stmt->fetchAll();
    //only first record:
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($records as $mp)
    {
        echo $mp['state_name']." ".$mp['statePop']."<br>";
    }
}

function threeLeastPopulated()
{
    global $dbConn;
    $sql= "SELECT town_name,population FROM mp_town ORDER BY population ASC LIMIT 0,3";
    //prepare,execute and fetch
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    //all records
    //$records=$stmt->fetchAll();
    //only first record:
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($records as $mp)
    {
        echo $mp['town_name']." ".$mp['population']."<br>";
    }
}

function countiesNoTown()
{
    global $dbConn;
    $sql= "SELECT DISTINCT county_name FROM mp_town,mp_county WHERE mp_county.county_id NOT IN (SELECT county_id FROM mp_town)";
    //prepare,execute and fetch
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    //all records
    //$records=$stmt->fetchAll();
    //only first record:
    $records=$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($records as $mp)
    {
        echo $mp['county_name']."<br>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Database and SQL</title>
    </head>
    <body>
    <h1>PHP and SQL</h1>
    <h3>Population between 50000 and 80000</h3>
    <?=population50To80K()?>
    <h3>All towns with their county name and population, ordered by population</h3>
    <?=displayAllTowns()?>
    <h3>Total population per county</h3>
    <?=totalPopulationCounty()?>
    <h3>Total population per state</h3>
    <?=totalPopulationState()?>
    <h3>Three least populated towns</h3>
    <?=threeLeastPopulated()?>
    <h3>Counties with no town in the "town" table</h3>
    <?=countiesNoTown()?>

    </body>
</html>