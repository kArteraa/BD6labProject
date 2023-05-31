<?php
    require_once '../includes/db.php';
    if (isset($_POST['btnEditId'])) {
        $_SESSION['btnEditId'] = $_POST['btnEditId'];
    }    
    
    if (isset($_POST['name'])) {
        $curId = $_SESSION['btnEditId'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $count = $_POST['count'];
        $date = $_POST['date'];
        mysqli_query($connect,"
            UPDATE `deliveries` 
            SET `deliveries`.`nname` = '$name', `deliveries`.`price` = '$price', `deliveries`.`count` = '$count', `deliveries`.`ddate` = '$date'
            WHERE `deliveries`.`id` = '$curId'
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
    <form class='edit' action="edit2.php" method='post'>
        <h3 style='margin-top:100px'>Название</h3>
        <input name='name' type="text" required>
        <h3 style='margin-top:10px'>Цена</h3>
        <input name='price' type="number" required>
        <h3 style='margin-top:10px'>Количество</h3>
        <input name='count' type="number" required>
        <h3 style='margin-top:10px'>Дата</h3>
        <input name='date' type="date" required>
        <button style='margin-top:10px'>Поменять</button>
    </form>

</body>
</html>