<?php
    $connect = mysqli_connect('localhost','root','','db');

    if (!$connect) {
        die('Не удалось подключится');
    }

    session_start();
?>