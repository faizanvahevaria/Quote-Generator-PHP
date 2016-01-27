<?php
include('connect.php');
$sql = "UPDATE quotes SET STATUS = 1 WHERE ID = " . $_GET['ID'];

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>

<script> location.replace("index.php"); </script>