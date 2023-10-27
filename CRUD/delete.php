<?php
include "connect.php";
$id = $_GET['id'];

$result = mysqli_query($con, "DELETE FROM user WHERE id = $id");

header("Location: user_data.php");
exit; 
// check
?>
