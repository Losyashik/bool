<?php
session_start();
if (empty($_SESSION['art_user'])) {
    header("Location:./");
}
$link = mysqli_connect('', 'root', '', 'boolatova');

if (isset($_GET['exit'])) {
    session_unset();
    header("Location:./../");
}
if (isset($_POST['name']) and isset($_POST['login']) and isset($_POST['password']) and isset($_POST['passwordDbl'])) {

    $name = $_POST['name'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password_dbl = $_POST['passwordDbl'];

    if ($password == $password_dbl) {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO user (`name`, `login`, `password`, `passwordView`) VALUES ('$name', '$login', '$password', '$password_dbl')";
        $link->query($query);
    }
}

function translit($str)
{
    $tr = array(
        "А" => "A", "Б" => "B", "В" => "V", "Г" => "G",
        "Д" => "D", "Е" => "E", "Ж" => "J", "З" => "Z", "И" => "I",
        "Й" => "Y", "К" => "K", "Л" => "L", "М" => "M", "Н" => "N",
        "О" => "O", "П" => "P", "Р" => "R", "С" => "S", "Т" => "T",
        "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "TS", "Ч" => "CH",
        "Ш" => "SH", "Щ" => "SCH", "Ъ" => "", "Ы" => "YI", "Ь" => "",
        "Э" => "E", "Ю" => "YU", "Я" => "YA", "а" => "a", "б" => "b",
        "в" => "v", "г" => "g", "д" => "d", "е" => "e", "ж" => "j",
        "з" => "z", "и" => "i", "й" => "y", "к" => "k", "л" => "l",
        "м" => "m", "н" => "n", "о" => "o", "п" => "p", "р" => "r",
        "с" => "s", "т" => "t", "у" => "u", "ф" => "f", "х" => "h",
        "ц" => "ts", "ч" => "ch", "ш" => "sh", "щ" => "sch", "ъ" => "y",
        "ы" => "yi", "ь" => "", "э" => "e", "ю" => "yu", "я" => "ya",
        "." => "_", " " => "_", "?" => "_", "/" => "_", "\\" => "_",
        "*" => "_", ":" => "_", "*" => "_", "\"" => "_", "<" => "_",
        ">" => "_", "|" => "_"
    );
    return strtr($str, $tr);
}

if ((!empty($_POST['name']))  and (!empty($_POST['discription']))) {
    $name = $_POST['name'];
    $discription = $_POST['discription'];

    if (isset($_FILES['image']) and $_FILES['image']["error"] == 0) {
        $img = $_FILES['image'];
        $imgName = $img['name'];
        $imgName = "images/gallery/" . translit($name . time()) . substr($imgName, strpos($imgName, '.', 0));
        if (move_uploaded_file($img['tmp_name'], "./../$imgName")) {
            $query = "INSERT INTO `catalog`( name, discription, src) VALUES ('$name', '$discription','./$imgName')";
            echo $query;
            mysqli_query($link, $query) or die(mysqli_error($link));
            header('Location:./main.php');
        } else {
            echo "error";
        }
    } else {
        print_r($_FILES['image']);
    }
}

?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Административная панель</title>
    <style>
        .table {
            width: 90%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        .table_ceil,
        .table_row {
            border: 1px solid;
            padding: 1vh 1vw;
        }

        .table_ceil img {
            max-width: 300px;
        }

        .form {
            display: flex;
            align-content: center;
            align-items: center;
            flex-direction: column;
        }

        .form__body {
            width: 40%;
            display: flex;
            flex-direction: column;
        }

        .form__body * {
            margin: 1vh;
        }
    </style>
</head>

<body>
    <form>
        <button name="exit" type="submit">Выход</button>
    </form>
    <main class="main_admin">
        <section class="works">
            <div class="form">
                <h2>Добавление работ</h2>
                <form method="post" class="form__body" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Название">
                    <textarea name="discription" id="" cols="30" rows="10"></textarea>
                    <input type="file" name="image" id="">
                    <button type="submit" name="addWork">Добавить</button>
                </form>
            </div>
            <h1>Работы</h1>
            <table class="work_list table">
                <tr class="administrators_list__row table_row">
                    <th class="administrators_list__ceil table_ceil">Изображение</th>
                    <th class="administrators_list__ceil table_ceil">Имя</th>
                    <th class="administrators_list__ceil table_ceil">Адрес</th>
                    <th class="administrators_list__ceil table_ceil">Удаление</th>
                </tr>
                <?php
                $result = $link->query("SELECT * FROM `catalog` ORDER BY `time` ASC");
                for ($data = []; $row = $result->fetch_assoc(); $data[] = $row);
                foreach ($data as $elem) {
                    echo
                    '<tr class="work_list__row table_row">
                    <td class="work_list__ceil table_ceil"><img src="../' . $elem['src'] . '" alt=""></td>
                    <td class="work_list__ceil table_ceil">' . $elem['name'] . '</td>
                    <td class="work_list__ceil table_ceil">' . $elem['discription'] . '</td>
                    <td class="work_list__ceil table_ceil">
                        <form method="post"><button type="submit" name="workDelete" value="' . $elem['id'] . '">Удалить</button></form>
                    </td>
                </tr>';
                }
                ?>
            </table>
        </section>
        <section class="application">
            <h2>Заявки</h2>
            <table class="application_list table">
                <tr class="administrators_list__row table_row">
                    <th class="administrators_list__ceil table_ceil">Имя</th>
                    <th class="administrators_list__ceil table_ceil">Эл.Почта</th>
                    <th class="administrators_list__ceil table_ceil">Адрес</th>
                    <th class="administrators_list__ceil table_ceil">Удаление</th>
                </tr>
                <?php
                $result = $link->query("SELECT * FROM `application` ORDER BY `time` ASC");
                for ($data = []; $row = $result->fetch_assoc(); $data[] = $row);
                foreach ($data as $elem) {
                    echo
                    '<tr class="aplication_list__row table_row">
                        <td class="application_list_ceil table_ceil">' . $elem['name'] . '</td>
                        <td class="application_list_ceil table_ceil">' . $elem['mail'] . '</td>
                        <td class="application_list_ceil table_ceil">' . $elem['adress'] . '</td>
                        <td class="application_list_ceil table_ceil">
                            <form method="post"><button type="submit" value="' . $elem['id'] . '" name="applicationDelete">Удалить</button></form>
                        </td>
                    </tr>';
                }
                ?>
            </table>
        </section>
        <sectiion class="comments">
            <h2>Коментарии</h2>

            <table class="commets_list table">
                <tr class="administrators_list__row table_row">
                    <th class="administrators_list__ceil table_ceil">Имя</th>
                    <th class="administrators_list__ceil table_ceil">Почта</th>
                    <th class="administrators_list__ceil table_ceil">Коментарий</th>
                    <th class="administrators_list__ceil table_ceil">Удаление</th>
                </tr>
                <?php
                $result = $link->query("SELECT * FROM comments ORDER BY `time` ASC");
                for ($data = []; $row = $result->fetch_assoc(); $data[] = $row);
                foreach ($data as $elem) {
                    echo
                    '<tr class="comments_list__row table_row">
                        <td class="comments_list__ceil table_ceil">' . $elem['name'] . '</td>
                        <td class="comments_list__ceil table_ceil">' . $elem['mail'] . '</td>
                        <td class="comments_list__ceil table_ceil">' . $elem['text'] . '</td>
                        <td class="comments_list__ceil table_ceil">
                            <form method="post"><button type="submit" name="commentDelete" value="' . $elem['id'] . '">Удалить</button></form>
                        </td>
                    </tr>';
                } ?>
            </table>
        </sectiion>
        <sectiion class="administrators">

            <div class="form">
                <h2>Добавление администратора</h2>
                <form method="post" class="form__body" enctype="multipart/form-data">
                    <input type="text" name="name" placeholder="Имя">
                    <input type="text" name="login" placeholder="Логин">
                    <input type="password" name="password" id="" placeholder="Пароль">
                    <input type="password" name="passwordDbl" id="" placeholder="Повторите пароль">
                    <button type="submit" name="addUser">Добавить</button>
                </form>
            </div>
            <h1>Администраторы</h1>
            <table class="administrators_list table">
                <tr class="administrators_list__row table_row">
                    <th class="administrators_list__ceil table_ceil">Имя</th>
                    <th class="administrators_list__ceil table_ceil">Логин</th>
                    <th class="administrators_list__ceil table_ceil">Пароль</th>
                    <th class="administrators_list__ceil table_ceil">Удаление</th>
                </tr>
                <?php
                $result = $link->query("SELECT * FROM user");
                for ($data = []; $row = $result->fetch_assoc(); $data[] = $row);
                foreach ($data as $elem) {
                    echo
                    '<tr class="administrators_list__row table_row">
                        <td class="administrators_list__ceil table_ceil">' . $elem['name'] . '</td>
                        <td class="administrators_list__ceil table_ceil">' . $elem['login'] . '</td>
                        <td class="administrators_list__ceil table_ceil">' . $elem['passwordView'] . '</td>
                        <td class="administrators_list__ceil table_ceil">
                            <form method="post"><button type="submit" name="commentDelete" value="' . $elem['id'] . '">Удалить</button></form>
                        </td>
                    </tr>';
                } ?>
            </table>
        </sectiion>
    </main>
</body>

</html>