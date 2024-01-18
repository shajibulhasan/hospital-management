<?php include 'connection.php'; ?>
<?php 
   $record_id =  $_REQUEST['record_id'];
   $s = "delete from records where id=$record_id";
   if(mysqli_query($conn, $s)){
    header('Location: appointmentStatus.php');
   }
?>