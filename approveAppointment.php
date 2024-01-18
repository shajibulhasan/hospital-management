<?php 
    include 'connection.php';
    $record_id = $_REQUEST['record_id'];
    $s = "UPDATE records SET status='Serial No $record_id', Report='Waiting' where id=$record_id";
    if(mysqli_query($conn, $s)){
        header('Location: pendingAppointment.php');
    }
?>