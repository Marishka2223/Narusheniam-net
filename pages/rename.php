<?php
session_start();
require("../remote/pd.php");
$sql = "SELECT * FROM bid_pr WHERE bid_id='" . $_GET['massage_id'] . "'";
$result2 = $pdo->query($sql)->fetch();

$sql = null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Нарушениям.Нет-Главная</title>
    <link rel="stylesheet" href="../styles/stiles_for_Main.css">
    <script src="../javaScript/Ways.js"></script>
    <script>let c = 0;</script>
</head>

<body>
    <header>
        <a href="main.php" class="noViolations" style="display: flex; align-items: center;  justify-content: center; flex-direction: column; text-decoration: none;">
            <h1 class="noViolations">Нарушениям.Нет</h1>
        </a>
    </header>
    <main style="display: flex; align-items: center;  justify-content: center; flex-direction: column; text-decoration: none;">
        <h1 style="text-align: center;">Изменение заявления</h1>
        <form id="form" method="post" action="">
            <div class="contBlur"><input type="text" name="num" value="<?php echo $result2['Cornumber']; ?>" id="num"
                    placeholder="Номер телефона" required>
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur"><input type="text" name="mark" value="<?php echo $result2['Mark']; ?>" id="mark"
                    placeholder="Услуга" required>
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur"><textarea name="nar" id="nar" placeholder="Метод оплаты"
                    required><?php echo $result2['Description']; ?></textarea>
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur">
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur"><input type="text" value="<?php echo $result2['location']; ?>" name="local" id="local"
                    placeholder="Место" required>
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur"><input type="submit" value="Сохранить">
                <div class="blur"></div>
            </div>
        </form>
        <div id="request"></div>
        <section id="links">
            <a class="newMassage" href="<?php echo '../pages/feedback_Form.php?id='.$_GET['id'] ?>">
                <h2 class="text">Новое заявление</h2>
                <div class="blur"></div>
            </a>
            <a class="contactUs" href="../pages/about_Us.php">
                <h2 class="text">Связаться с нами</h2>
                <div class="blur"></div>
            </a>
        </section>
    </main>
    <footer></footer>
</body>

</html>
<script>

    array = ['num', 'mark', 'nar', 'local'];
    mass = ['Номер автомобиля', 'Марка', ' Нарушение', 'Место']
    pattern = [/^[a-zA-Z0-9]{3,255}/,
        /^[a-zA-Z0-9А-Яа-я\s]{0,255}/,
        /^[a-zA-Z0-9А-Яа-я\s]{5,255}/,
        /^[a-zA-Z0-9А-Яа-я\s]{3,255}/
    ];
    form.addEventListener('submit', function (event) {
        let flag = true;
        if (document.querySelector('.blurSErr')) {
            document.querySelector('.blurSErr').classList.add('blurS')
            document.querySelector('.blurSErr').classList.remove('blurSErr')
        }
        let indexCount = 0;
        array.forEach(element => {
            if (!flag)
                return;
            console.log(`${pattern[indexCount]}` + ' ' + `${document.getElementById(element).value}` + ' = ')
            console.log(pattern[indexCount].test(`${document.getElementById(element).value}`));
            if (!pattern[indexCount].test(`${document.getElementById(element).value}`)) {
                // console.log(element)
                flag = false;
                let massage = '';
                if (array[indexCount] == 'mark' || array[indexCount] == 'local') {
                    if (document.getElementById(element).value.length <= 2) {
                        massage = 'не может содержать менее 3 или более 50 символов!';
                    }
                    else {
                        massage = 'не может содержать спецсимволов, точек и т.д.!';
                    }
                }
                if (array[indexCount] == 'num') {
                    if (document.getElementById(element).value.length <= 3) {
                        massage = 'не может содержать менее 3 или более 20 символов!';
                    }
                    else {
                        massage = 'не может содержать спецсимволов, слов ,точек и т.д.!';
                    }
                }
                if (array[indexCount] == 'nar') {
                    if (document.getElementById(element).value.length <= 6) {
                        massage = 'не может содержать менее 6 или более 255 символов!';
                    }
                    else {
                        massage = 'не может содержать спецсимволов, точек и т.д.!';
                    }
                }
                document.getElementById(element).parentElement.querySelector('.blurS').classList.add('blurSErr')
                document.getElementById(element).parentElement.querySelector('.blurS').classList.remove('blurS')
                document.getElementById('err').innerHTML = `<div class="contBlur"><h3 class="err">Ошибка: Поле ${mass[indexCount]} ${massage}</h3><div class="blurSErr"></div></div>`;
                indexCount++;
                return false;
            }
            indexCount++;
        });
        if (flag === false)
            event.preventDefault();
    });
    </script>
    <?php

    if (isset($_POST["num"]) && isset($_POST["mark"]) && isset($_POST["nar"]) && isset($_POST['local']) && ($_POST["num"] != $result2['Cornumber'] || $_POST["mark"] != $result2['Mark'] || $_POST["nar"] != $result2['Description'] || $_POST["local"] != $result2['location'])) {
        $variable = [$_POST["num"], $_POST["mark"], $_POST["nar"], $_POST['local']];
        $variablePatterns = [
            '/^[a-zA-Z0-9]{3,255}/',
            '/^[a-zA-Z0-9А-Яа-я\s]{0,255}/',
            '/^[a-zA-Z0-9А-Яа-я\s]{5,255}/',
            '/^[a-zA-Z0-9А-Яа-я\s]{5,255}/'
        ];
        $i = 0;
        $flag = true;
        foreach ($variable as $key) {
            if ($key == '' || !preg_match($variablePatterns[$i], $key)) {
                $flag = false;
                echo "<h3 style='color: white;'>Данные занесены не верно</h3>";
                break;
            }
            $i += 1;
        }
        if ($flag) {

                $user = $_SESSION['id'];
                $sql = "SELECT * FROM bid_pr WHERE Bid_id='" . $_GET['massage_id'] . "'";
                $result = $pdo->query($sql);
                if ($result->rowCount() == 0) {
                    header('location: ./logout.php');
                }
                $query = "INSERT INTO `log_pr`(`date`, `last date`, `time`, `User_id`, `last_number`, `new_number`) VALUES ('" . date('d/m/Y') . "','" . $result2['date'] . "','" . date('H:i:s', time()) . "','" . $result2['User_id'] . "','" . $result2['Cornumber'] . "','" . $_POST["num"] . "')";
                $result = $pdo->query($query);
                if ($result->rowCount() == 0) {
                    header('location: ./logout.php');
                }
                $query = "UPDATE `bid_pr` SET `Cornumber`= '" . $_POST["num"] . "',`Description`='" . $_POST["nar"] . "',`Status`='На рассмотрении',`User_id`='$user',`image`='',`location`='" . $_POST["local"] . "',`Mark`='" . $_POST["mark"] . "',`date`='" . date('d/m/Y') . "',`time`='" . date('H:i:s', time()) . "' WHERE `Bid_id`='" . $result2['Bid_id'] . "'";
                $result = $pdo->query($query);
                if ($result->rowCount() == 0) {
                    header('location: ./logout.php');
                }
                $pdo = null;
                ?>
                    <script> alert('Нарушение на рассмотрении')</script>
            <?php
            if ($result !== false) {
                ?>
                <script>
                    window.location = "<?php echo '../main.php?id='.$_GET['id']; ?>";
                </script>
                <?php
                exit;
            }
            
        }
    }