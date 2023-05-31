<?php
    require_once '../includes/db.php';
    if (isset($_POST['btnEditId'])) {
        $_SESSION['btnEditId'] = $_POST['btnEditId'];
    }    
    
    if (isset($_POST['name'])) {
        $curId = $_SESSION['btnEditId'];
        $name = $_POST['name'];
        $surname = $_POST['surname'];
        $patronymic = $_POST['patronymic'];
        $job = $_POST['job'];
        mysqli_query($connect,"
            UPDATE `personal` 
            SET `personal`.`nname` = '$name', `personal`.`surname` = '$surname', `personal`.`patronymic` = '$patronymic', `personal`.`job_title_id` = '$job'
            WHERE `personal`.`id` = '$curId'
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
                <h1 class="header__title">Детские садики. Редактирование записи <?php echo $_SESSION['btnEditId']; ?></h1>         
                <!-- <div class="header__nav">
                    <a href="" class="header__nav__link">Сотрудники</a>
                    <a href="" class="header__nav__link">Дети</a>
                    <a href="" class="header__nav__link">Поставки</a>
                </div> -->
            </div>
            
        </div>
    </header>
    <form class='edit' action="edit.php" method='post'>
        <h3 style='margin-top:100px'>Имя</h3>
        <input name='name' type="text" required>
        <h3 style='margin-top:10px'>Фамилия</h3>
        <input name='surname' type="text" required>
        <h3 style='margin-top:10px'>Отчество</h3>
        <input name='patronymic' type="text" required>
        <h3 style='margin-top:10px'>Должность</h3>
        <input name='job' type="number" min='1' max='6' required>
        <button style='margin-top:10px'>Поменять</button>
    </form>

</body>
</html>