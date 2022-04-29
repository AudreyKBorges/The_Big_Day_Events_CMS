<?php
/*
* Audrey Borges
* WEBD-325-45
* Week 3 Project: Logging In
* April 10, 2022
*
* This is the database connection.
*/

$mysqli = new mysqli("localhost", "root", "", "THE_BIG_DAY_EVENTS");
 
if ($mysqli === false) {
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
 
$sql = "INSERT INTO users (username, password) VALUES ('user1234', 'Coder2002#')";
if ($mysqli->query($sql) === true) {
    echo "Records inserted successfully.";
} else {
    echo "ERROR: Could not able to execute $sql. " . $mysqli->error;
}
 
$mysqli->close();`

function openCon()
{
    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "THE_BIG_DAY_EVENTS";
    
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}
 
function closeCon($conn)
{
    $conn -> close();
}
?>