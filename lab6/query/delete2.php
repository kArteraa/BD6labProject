<?php
    require_once '../includes/db.php';
    if (isset($_POST['btnDeleteId'])) {
        
        $deleteId = $_POST['btnDeleteId'];

        mysqli_query($connect,"
            DELETE FROM `deliveries` 
            where `deliveries`.`id` = '$deleteId'
        ");
  
    }
    header("Location: ../index.php");

?>