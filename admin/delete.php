<?php
require_once "../db_connection.php";

$bus_id = $_GET['bus_id'];

$sqldelete =" DELETE FROM buses WHERE bus_id = $bus_id";

if($conn->query($sqldelete) === TRUE){
    header('location:view_bus.php');
}else{
    echo "Error: ".$sqldelete."<br>". $conn->error;
}
?>