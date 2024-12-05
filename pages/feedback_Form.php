<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>Нарушениям.Нет-Форма</title>
    <link rel="stylesheet" href="../styles/stiles_for_Main.css">
</head>

<body>
    <header class="header" >
    </header>
    <br><br>
    <main style="display: flex; align-items: center;  justify-content: center; flex-direction: column; text-decoration: none;">
        <h1 class="noViolationsM2">Нарушениям.Нет</h1>
        <h1 class="noViolationsS">Сообщение о нарушении</h1>
        <form id="form" method="post" action="">
            <div class="contBlur"><input type="text" name="num" id="num" placeholder="Номер автомобиля" required>
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur"><input type="text" name="mark" id="mark" placeholder="Марка" required>
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur"><textarea name="nar" id="nar" placeholder="Нарушение" required></textarea>
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur" style="display: none;">
                <div class="inline-b">
                    <input type="file" name="file" id="file" accept=".jpg, .jpeg, .png" multiple>
                    <label for="file" class="file">+</label>
                    <span class="file-text"> файл</span>
                </div>
                <div class="blurS"></div>
            </div>
            <div class="contBlur"><input type="text" name="local" id="local" placeholder="Место" required>
                <div class="blurS"></div>
            </div>
            <br>
            <div class="contBlur"><input type="submit" value="Отправить">
                <div class="blur"></div>
            </div>
        </form>
        <section id="links"  style="display: flex; align-items: center;  justify-content: center;text-decoration: none; flex-direction: row;">
            <a class="reg" href="./about_Us.php" style="text-decoration: none;">
                <h2 class="text t2">Связаться</h2>
                <div class="blur"></div>
            </a>
            <a class="reg" href="<?php echo '../main.php?id='.$_GET['id'] ?>" style="text-decoration: none; margin-left: 5%;">
                <h2 class="text t2">Вернуться</h2>
                <div class="blur"></div>
            </a>
        </section>
        <section id="err"></section>
    </main>
    <footer></footer>
</body>

<script>

    array = ['num', 'mark', 'nar', 'local'];
    mass = ['Номер автомобиля', 'Марка', ' Нарушение', 'Место']
    pattern = [/^[a-zA-Z0-9]{3,20}[^!@#$%^&*()_\-=+\|\\/':;]$/m,
        /^[a-zA-Z0-9А-Яа-я]{0,50}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/m,
        /^[a-zA-Z0-9А-Яа-я\s]{5,255}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/m,
        /^[a-zA-Z0-9А-Яа-я.,\s]{3,50}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/m
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

</html>
<?php
if (isset($_POST["num"]) && isset($_POST["mark"]) && isset($_POST["nar"]) && isset($_POST['local'])) {
    $variable = [$_POST["num"], $_POST["mark"], $_POST["nar"], $_POST['local']];
    $variablePatterns = [
        '/^[a-zA-Z0-9]{3,20}[^!@#$%^&*()_\-=+\|\\/\':;]$/m',
        '/^[a-zA-Z0-9А-Яа-я]{0,50}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/mu',
        '/^[a-zA-Z0-9А-Яа-я\s]{5,255}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/mu',
        '/^[a-zA-Z0-9А-Яа-я.,\s]{5,50}[^!@#$%\^&*()_+=-?:;№\|\/\\>]$/mu'
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
        require("../remote/pd.php");
        
            $user = $_GET['id'];
            $query = "insert into Bid_pr (`Cornumber`, `Description`, `Status`, `User_id`, `image`,`Mark`,`location`,`date`,`time`) values ('" . $_POST["num"] . "', '" . $_POST["nar"] . "', 'На рассмотрении' , '$user' , '' ,'" . $_POST["mark"] . "', '" . $_POST["local"] . "', '".date('d/m/Y')."' , '".date('H:i:s', time())."')";
            $result = $pdo->query($query);
            ?>
            <script>alert('Нарушение на рассмотрении')</script>
            <?php
            if ($result !== false) {
                ?>
                <script>
                    window.location = '<?php echo '../main.php?id='.$_GET['id']; ?>';
                </script>
                <?php
                exit;
            }
        
    }
}
