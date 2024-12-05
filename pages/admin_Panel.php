<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Мой Не Сам-Админ</title>
    <link rel="stylesheet" href="../styles/stiles_for_Main.css">
    <script>let c = 0;</script>
</head>

<body>
    <header>
        <a href="main.html" class="noViolations">
            <h1 class="noViolations">Мой Не Сам</h1>
        </a>
        <button class="settings">
            <img src="../Additional_Files/Images/Dem_exam_pr-site-Narusheniy.net-settings.png" alt="">
        </button>
    </header>
    <main>
        <h1 style="text-align: center; font-size: 26px !important;">Панель администратора</h1>
        <h1 style="text-align: center; font-size: 23px !important; margin-top: 20px !important;">Новые заявления</h1>
        <section id="massage2">
            <div class="contS2">
                <?php
                $i = 0;
                require("../remote/pd.php");
                $date = '';
                $sql = "SELECT * FROM bid_pr WHERE Status='".'На рассмотрении'."'";
                $result = $pdo->query($sql);
                foreach ($result as $row) {
                    $i++;
                    if ($date != $row['date']) {
                        $date = $row['date'];
                        echo "<div class='contD'><h2 class='Etext'>" . str_replace('/', '.', $date) . "</h2></div>";
                    }
                    $r = $row["Bid_id"];
                    $sql2 = "SELECT * FROM users_pr WHERE User_id='".$row["User_id"]."'";
                    $result2 = $pdo->query($sql2)->fetch();
                    echo "<form class='contBlur2' action='' method='POST'><input type='text' value='".$r."' name='id' id='id' style='display:none'><div class='str'><h2 class='Etext'>$i</h2><h2 class='Etext'>&nbsp;"  . $row["User_id"] . "</h2>&nbsp;&nbsp;<input type='text' id='num'  name='num' style='width: 100px !important;' value='".$row["Cornumber"]."' require/><input style='width: 150px !important;' name='stat' type='text' value='". $row["Status"]."' /></div>
                    <div class='str2'><h2 class='Etext'>ФИО:&nbsp; &nbsp;</h2><input type='text' value='".$result2["Lastname"].' '.$result2["Firstname"].' '.$result2["Surname"]."' require/></div>
                    <div class='str2'><h2 class='Etext'>Нарушение:&nbsp;</h2><input type='text' id='nar' name='nar' value='".$row["Description"]."' require/></div>
                    <div class='str2'><h2 class='Etext'>Фото:&nbsp; &nbsp;</h2><h2 class='Etext'>Отсутствует</h2></div>
                    <div class='str2'><h2 class='Etext'>Место:&nbsp; &nbsp;</h2><input type='text'  id='local' name='local' value='".$row["location"]."' require/></div>
                    <div class='str2'><input style='margin-left: 5px !important; font-size:18px; font-weight: 500 !important;  height:30px !important' type='submit' value='Сохранить'></div><div class='blur'></div></form>";
                    $r = '';
              
                }

                ?>
            </div>
        </section>
        <h1 style="text-align: center; font-size: 23px !important;  margin-top: 20px !important;">Старые заявления</h1>
        <section id="massage2">
            <div class="contS2">
                <?php
                $i = 0;
                $date = '';
                $sql = "SELECT * FROM bid_pr WHERE Status!='".'На рассмотрении'."'";
                $result = $pdo->query($sql);
                foreach ($result as $row) {
                    $i++;
                    if ($date != $row['date']) {
                        $date = $row['date'];
                        echo "<div class='contD'><h2 class='Etext'>" . str_replace('/', '.', $date) . "</h2></div>";
                    }
                    $r = $row["Bid_id"];
                    $sql2 = "SELECT * FROM Users_pr WHERE User_id='".$row["User_id"]."'";
                    $result2 = $pdo->query($sql2)->fetch();
                    echo "<form class='contBlur2' action='' method='POST'><input type='text' value='".$r."' name='id' id='id' style='display:none'><div class='str'><h2 class='Etext'>$i</h2><h2 class='Etext'>&nbsp;"  . $row["User_id"] . "</h2>&nbsp;&nbsp;<input type='text' id='num'  name='num' style='width: 100px !important;' value='".$row["Cornumber"]."' require/><input style='width: 150px !important;' name='stat' type='text' value='". $row["Status"]."' /></div>
                    <div class='str2'><h2 class='Etext'>ФИО:&nbsp; &nbsp;</h2><input type='text' value='".$result2["Lastname"].' '.$result2["Firstname"].' '.$result2["Surname"]."' require/></div>
                    <div class='str2'><h2 class='Etext'>Нарушение:&nbsp;</h2><input type='text' id='nar' name='nar' value='".$row["Description"]."' require/></div>
                    <div class='str2'><h2 class='Etext'>Фото:&nbsp; &nbsp;</h2><h2 class='Etext'>Отсутствует</h2></div>
                    <div class='str2'><h2 class='Etext'>Место:&nbsp; &nbsp;</h2><input type='text'  id='local' name='local' value='".$row["location"]."' require/></div>
                    <div class='str2'><input style='margin-left: 5px !important; font-size:18px; font-weight: 500 !important;  height:30px !important' type='submit' value='Сохранить'></div><div class='blur'></div></form>";
                    $r = '';
              
                }

                ?>
            </div>
        </section>
        <div id="request"></div>
        <section id="links">
        <a class="contactUs" href="<?php echo '../main.php?id='.$_SESSION["id"]; ?>">
                <h2 class="text">Главная</h2>
                <div class="blur"></div>
            </a>
            <a class="contactUs" href="./about_Us.php">
                <h2 class="text">Связаться с нами</h2>
                <div class="blur"></div>
            </a>
            <a class="contactUs" href="./logout.php">
                <h2 class="text">Выйти</h2>
                <div class="blur"></div>
            </a>
        </section>
    </main>
    <footer></footer>
    <?php
    $id = '';
    if (session_status() != PHP_SESSION_NONE && isset($_SESSION["id"]) && isset($_SESSION["prov"])) {
        if (is_numeric($_SESSION["id"])) {
        } else {
            header('Location: ./registration.html');
        }
    } else {
        header('Location: ./registration.html');
    }
    ?>
</body>

</html>
    <?php

    if (isset($_POST["id"])&&isset($_POST["num"])&& isset($_POST["nar"]) && isset($_POST['local'])&&isset($_POST['stat'])) {
        $variable = [$_POST["num"], $_POST["nar"], $_POST['local']];
        $variablePatterns = [
            '/^[a-zA-Z0-9]{3,20}[^!@#$%^&*()_\-=+\|\\/\':;]$/m',
            '/^[a-zA-Z0-9А-Яа-я\s]{5,255}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/mu',
            '/^[a-zA-Z0-9А-Яа-я.\s]{5,50}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/mu'
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
            if (session_status() != PHP_SESSION_NONE && isset($_SESSION["id"])) {
                $user = $_SESSION['id'];
                $sql3 = "SELECT * FROM bid_pr WHERE bid_id='" . $_POST['id'] . "'";
                $result2 = $pdo->query($sql3);
                $result3 = $pdo->query($sql3)->fetch();
                if ($result2->rowCount() == 0) {
                    header('location: ./logout.php');
                }
                $query = "UPDATE `Bid_pr` SET `Cornumber`= '" . $_POST["num"] . "',`Description`='" . $_POST["nar"] . "',`Status`='".$_POST['stat']."',`User_id`='".$result3['User_id']."',`image`='',`location`='" . $_POST["local"] . "',`Mark`='" . $result3["Mark"] . "',`date`='" . date('d/m/Y') . "',`time`='" . date('H:i:s', time()) . "' WHERE `bid_id`='" . $_POST["id"] . "'";
                $result = $pdo->query($query);
                if ($result->rowCount() == 0) {
                    header('location: ./logout.php');
                }
                $pdo = null;
                ?>
                    <script> alert('Нарушение измененно')</script>
            <?php
            if ($result !== false) {
                ?>
                <script>
                    window.location = '../pages/admin_Panel.php';
                </script>
                <?php
                exit;
            }
            }
        }
    }