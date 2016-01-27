<?php 
$time = $_POST['TimeSlot'];
$log = $_POST['Log'];
$tasks = count(explode("\n", rtrim($log)));
$date = strtotime( $_POST['Date'] );

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "journal";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "INSERT INTO entries_tbl VALUES( DEFAULT, FROM_UNIXTIME(".$date."), '".$time."', '".$log."', ".$tasks.")";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>
<script> location.replace("index.php"); </script>