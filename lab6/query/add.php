<?php
    require_once '../includes/db.php';

    if (isset($_POST['name'])) {
        $idChild = $_SESSION['id'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $patronymic = $_POST['patronymic'];
        $job = $_POST['job'];
        mysqli_query($connect,"
            INSERT INTO `personal`(`child_garden_id`,`nname`,`surname`,`patronymic`,`job_title_id`) 
            VALUES ('$idChild','$name','$surname','$patronymic','$job')
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
    <form class='edit' action="add.php" method='post'>
        <h3 style='margin-top:100px'>Имя</h3>
        <input name='name' type="text" required>
        <h3 style='margin-top:10px'>Фамилия</h3>
        <input name='surname' type="text" required>
        <h3 style='margin-top:10px'>Отчество</h3>
        <input name='patronymic' type="text" required>
        <h3 style='margin-top:10px'>Должность</h3>
        <input name='job' type="number" min='1' max='6' required>
        <button style='margin-top:10px'>Добавить</button>
    </form>

</body>
</html>