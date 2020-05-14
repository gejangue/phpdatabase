<?php
$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("databaseuser");
$dbpwd = getenv("databasepassword");
$dbname = getenv("databasename");

$connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
// if ($connection->connect_errno) {
    // printf("Connect failed: %s\n", $mysqli->connect_error);
    // exit();
// } else {
    // printf("Connected to the database");
// }
 //$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $$dbpwd);
$query = $connection->prepare("SELECT * FROM buecher");
var_dump($query);
$query->execute();
echo "<ol>";
while($book = $query->fetch()){
    //var_dump($book);
    echo "<li>".$book['titel'] . "</li><br>";
}
echo "</ol>";
?>
<footer>
    <p><a href="insert.php">Neues Buch</a> <a href="mysqlconnect.php">Buchliste</a></p>
</footer>




