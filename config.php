<?php
// Enter the MYSQL Server connections for the connections
// edit the space where the x's are below with the credentials
// of your MYSQL server.
//
//  ** $servername (if located on the same server as this file is usually localhost or 127.0.0.1)
//  ** $username (username of MYSQL user that is authorized to INSERT into your OPENSIS database tables)
//  ** $password (password of the above user)
//  ** $dbname (Name of your OPENSIS Database)
//  ** $port (Set to the MYSQL default port. Only change if needed)
//
//

$servername = "localhost";
$username = "sjaadmin";
$password = "stjohns159pxb2";
$dbname = "opensis";
$port = "3306";  //// This is set to the normal MYSQL default port

$mysqli = new mysqli($servername.':'.$port,$username,$password,$dbname);
// Create connection to visitor
if ($mysqli->connect_errno) {
    echo "Failed to connect to your OPENSIS MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    $dbcheck=0;
} else {
  echo "Your Database Connection is Successful";
  $dbcheck=1;
}

?>
