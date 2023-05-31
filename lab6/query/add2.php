<?php
    require_once '../includes/db.php';

    if (isset($_POST['name'])) {
        $curId = $_SESSION['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $count = $_POST['count'];
        $date = $_POST['date'];
        mysqli_query($connect,"
            INSERT INTO `deliveries`(`child_garden_id`,`nname`,`count`,`price`,`ddate`) 
            VALUES ('$curId','$name','$count','$price','$date')
        ");

        unset($_SESSION['btnEditId']);
        header("Location: ../index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@400;700&family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <title>Детские садики</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <h1 class="header__title">Детские садики. Добавление записи</h1>         
                <!-- <div class="header__nav">
                    <a href="" class="header__nav__link">Сотрудники</a>
                    <a href="" class="header__nav__link">Дети</a>
                    <a href="" class="header__nav__link">Поставки</a>
                </div> -->
            </div>
            
        </div>
    </header>
    <form class='edit' action="add2.php" method='post'>
        <h3 style='margin-top:100px'>Название</h3>
        <input name='name' type="text" required>
        <h3 style='margin-top:10px'>Цена</h3>
        <input name='price' type="number" required>
        <h3 style='margin-top:10px'>Количество</h3>
        <input name='count' type="number" required>
        <h3 style='margin-top:10px'>Дата</h3>
        <input name='date' type="date" required>
        <button style='margin-top:10px'>Добавить</button>
    </form>

</body>
</html>