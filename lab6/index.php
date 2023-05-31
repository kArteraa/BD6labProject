<?php
    require_once 'includes/db.php';

    if (isset($_POST['id'])) {
        $_SESSION['id'] = $_POST['id'];
    }
        
    if (isset($_SESSION['id'])) {
        $id = $_SESSION['id'];
        $childGardenAdress = mysqli_query($connect,"
            SELECT `adress` from `child_garden`
            where `child_garden`.`id` = '$id'
        ");
        $personal = mysqli_query($connect,"
            SELECT * from `personal`
            where `personal`.`child_garden_id` = '$id'
        ");
        $delivery = mysqli_query($connect,"
            SELECT * from `deliveries`
            where `deliveries`.`child_garden_id` = '$id'
        ");
        $childGardenAdress = mysqli_fetch_assoc($childGardenAdress);
    }
    
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Montserrat:wght@400;700&family=Source+Sans+Pro:wght@400;700&display=swap" rel="stylesheet">
    <title>Детские садики</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header__inner">
                <h1 class="header__title">Детские садики</h1>         
                <!-- <div class="header__nav">
                    <a href="" class="header__nav__link">Сотрудники</a>
                    <a href="" class="header__nav__link">Дети</a>
                    <a href="" class="header__nav__link">Поставки</a>
                </div> -->
            </div>
            
        </div>
    </header>
    <section class="main">
        <h3 class="main__title">Введите номер садика который хотите просмотреть( промежуток[1,10000] )</h3>
        <form class="main__form" action="index.php" method="post">
                    <input name="id" type="text">
                    <button style="cursor:pointer">Просмотреть</button>
        </form>
        <?php if (isset($_SESSION['id']) and $_SESSION['id'] <= 10000 and $_SESSION['id'] >= 1): ?>
        <h3 class="main__info__childGarden" style="margin:20px;">Детский садик с номером <?php echo $_SESSION['id'] ?> находится по адрессу <?php echo $childGardenAdress['adress']; ?> </h3>
        <form style='display:flex;flex-direction:column;align-item:center;width:30%;margin:0 auto;' action="child.php" method='post'>
            <label for="">Поиск детей по именам</label>
            <input name='name' placeholder='Введите имя' required style='margin-bottom:20px;' type="text">
            <button name='findChild' class="main__info__personal__block__btn__edit">Найти</button>
        </form>
        <form style='display:flex;flex-direction:column;align-item:center;width:30%;margin:0 auto;margin-top:20px;' action="child.php" method='post'>
            <label for="">Поиск детей по группам</label>
            <input name='group' placeholder='Введите номер группы' required style='margin-bottom:20px;' type="text">
            <button name='findGroup' class="main__info__personal__block__btn__edit">Найти</button>
        </form>
        <div class="container">
            <div class="main__inner">
                <div class="main__info">
                    
                    <div class="main__info__personal">
                        <h1 class="main__info__personal__title" style="margin-bottom:20px;">Сотрудники</h1>
                        <a href="query/add.php" class="main__info__personal__block__btn__edit">Добавить</a>
                        <?php while($res = $personal->fetch_assoc()):  ?>
                                <?php 
                                    $jobTitleId = $res['job_title_id'];
                                    $jobTitle = mysqli_query($connect,"
                                        SELECT `nname` from `job_title`
                                        where `job_title`.`id` = '$jobTitleId'
                                    ");
                                    
                                ?>
                                <div class="main__info__personal__block">
                                    <div class="main__info__personal__block__info">
                                        <h1 class="main__info__personal__block__name">Имя: <?php echo $res['nname'] ?></h1>
                                        <h1 class="main__info__personal__block__surname">Фамилия: <?php echo $res['surname'] ?></h1>
                                        <h1 class="main__info__personal__block__patronymic">Отчество: <?php echo $res['patronymic'] ?></h1>
                                        <h1 class="main__info__personal__block__jobTitle">Должность: <?php echo $jobTitle->fetch_assoc()['nname'] ?></h1>
                                    </div>
                                    <div class="main__info__deliveries__block__btn">
                                        <form action="query/edit.php" method='post'>
                                            <button class="main__info__personal__block__btn__edit" name='btnEditId' value="<?php echo $res['id'] ?>">Редактировать</button>
                                        </form>
                                        <form action='query/delete.php' method='post' class="main__info__personal__block__btn"> 
                                            <button class="main__info__personal__block__btn__edit" name='btnDeleteId' value="<?php echo $res['id'] ?>" style="margin-top:20px;cursor:pointer">Удалить из ДБ</button>
                                        </form>
                                    </div>
                                </div>
                                
                            
                        <?php endwhile; ?>
                        
                    </div>
                    <div class="main__info__deliveries">
                        <h1 class="main__info__deliveries__title" style="margin-bottom:20px;">Поставки</h1>
                        <a href="query/add2.php" class="main__info__personal__block__btn__edit">Добавить</a>
                        <?php while($res = $delivery->fetch_assoc()):  ?>
                            <div class="main__info__deliveries__block">
                                <div class="main__info__deliveries__block__info">
                                    <h1 class="main__info__personal__block__name">Название: <?php echo $res['nname'] ?></h1>
                                    <h1 class="main__info__personal__block__surname">Цена: <?php echo $res['price'] ?>р</h1>
                                    <h1 class="main__info__personal__block__patronymic">Количество: <?php echo $res['count'] ?></h1>
                                    <h1 class="main__info__personal__block__jobTitle">Дата: <?php echo $res['ddate'] ?></h1>
                                </div>
                                <div class="main__info__deliveries__block__btn">
                                    <form action="query/edit2.php" method='post'>
                                        <button name='btnEditId' value="<?php echo $res['id'] ?>" class="main__info__personal__block__btn__edit">Редактировать</button>
                                    </form>
                                    
                                    <form action='query/delete2.php' method='post'>
                                        <button name='btnDeleteId' class="main__info__personal__block__btn__edit" value="<?php echo $res['id'] ?>" style="margin-top:20px;cursor:pointer">Удалить из ДБ</button>
                                    </form>
                                </div>
                                
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php else: ?>
        <h3 class="main__info__childGarden" style="margin-top:20px;">Детский садик с номером <?php echo $_SESSION['id'] ?> не найден! </h3>
        <?php endif; ?>
    </section>
            
</body>
</html>