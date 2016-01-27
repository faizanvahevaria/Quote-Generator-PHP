<?php
include('connect.php');

$sqlCaption = "UPDATE quotes SET CAPTION = '" . $conn->real_escape_string( $_POST['CAPTION'] ) . "' WHERE ID = " . $_POST['ID'];

if ($conn->query($sqlCaption) === TRUE) {
    echo "Caption Created Successfully";
} else {
    echo "Error: " . $sqlCaption . "<br>" . $conn->error;
}

$conn->close();

?>
<script> location.replace("index.php"); </script>