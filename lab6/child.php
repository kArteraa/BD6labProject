<?php
    require_once 'includes/db.php';

    if (isset($_POST['findChild']) || isset($_SESSION['child'])) {
        $name = $_POST['name'];
        $_SESSION['nm'] = $name;
        $childs = mysqli_query($connect,"
            SELECT * from `child`
            where `child`.`nname` = '$name'
        ");
        $_SESSION['child'] = $childs;
        $cnt = mysqli_query($connect,"
            SELECT count(*) as cNt from `child`
            where `child`.`nname` = '$name'
        ");
        $cnt = mysqli_fetch_assoc($cnt)['cNt'];
        $_SESSION['cnt'] = $cnt;
        unset($_SESSION['findChild']);
    }

    if (isset($_POST['findGroup'])) {
        $group = $_POST['group'];
  
        $nm = $_POST['findGroup'];
    
        $childs = mysqli_query($connect,"
            SELECT * from `child`
            where `child`.`nname` = '$nm' and `child`.`group_id` = '$group'
        ");

        $_SESSION['child'] = $childs;
        unset($_SESSION['findGroup']);
        
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
        <h3 class="main__title">Дети</h3>
        <?php if (isset($_SESSION['cnt']) && $_SESSION['cnt'] != 0): ?>
        <h3>Количество детей: <?php echo $_SESSION['cnt']; ?></h3>
        <?php else: ?>
            <h3>Номер группы: <?php echo $group; ?></h3>
        <?php endif; ?>
        <form style='display:flex;flex-direction:column;align-item:center;width:30%;margin:0 auto;margin-top:20px;' action="child.php" method='post'>
            <label for="">Поиск детей по группам</label>
            <input name='group' placeholder='Введите номер группы' required style='margin-bottom:20px;' type="text">
            <button value="<?php echo  $name ?>" name='findGroup' class="main__info__personal__block__btn__edit">Найти</button>
        </form>
        <div class="container">
            <div class="main__inner">
                <div class="main__info" style='margin-top:20px;'>
                    
                    <div class="main__info__personal">

                        <?php while($res = $_SESSION['child']->fetch_assoc()):  ?>
                                <?php $cnt++; ?>
                                <div class="main__info__personal__block" style='display:flex;flex-direction:column;align-items:center;margin-top:20px;'>
                                    <div class="main__info__personal__block__info" style="display:flex;flex-direction:column;align-items:center;   ">
                                        <h1 class="main__info__personal__block__name">Имя: <?php echo $name ?></h1>
                                        <h1 class="main__info__personal__block__surname">Фамилия: <?php echo $res['surname'] ?></h1>
                                        <h1 class="main__info__personal__block__patronymic">Отчество: <?php echo $res['patronymic'] ?></h1>
                                        <h1 class="main__info__personal__block__patronymic">Номер группы: <?php echo $res['group_id'] ?></h1>
                                    </div>
                            
                                </div>
                                
                            
                        <?php endwhile; ?>
                        
                    </div>
                  
                </div>
            </div>
        </div>

    </section>
            
</body>
</html>