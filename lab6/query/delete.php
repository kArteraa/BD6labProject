<?php
    require_once '../includes/db.php';
    if (isset($_POST['btnDeleteId'])) {
        
        $deleteId = $_POST['btnDeleteId'];

        mysqli_query($connect,"
            DELETE FROM `personal` 
            where `personal`.`id` = '$deleteId'
        ");
  
    }
    header("Location: ../index.php");

?>