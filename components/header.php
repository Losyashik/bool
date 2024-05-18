<?php
$link = mysqli_connect('', 'root', '', 'boolatova');

if (isset($_POST['application'])) {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $adress = $_POST['addres'];

    $link->query("INSERT INTO `application`( `name`, `mail`, `adress`) VALUES ('$name', '$mail', '$adress')");
    header("Location:./");
}

if (isset($_POST['comment'])) {
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $text = $_POST['text'];

    $link->query("INSERT INTO `comments`( `name`, `mail`, `text`) VALUES ('$name', '$mail', '$text')");
    header("Location:./");
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/catalog.css">
    <script src="./scripts/jquery-3.6.3.js"></script>
    <script src="./scripts/slick.min.js"></script>
</head>

<body>
    <nav class="topbar">
        <ul class="topbar_ul">
            <li class="topbar_ul__item">
                <a href="./" class="topbar_ul__link link">Главная</a>
            </li>
            <li class="topbar_ul__item">
                <a href="./#gallery" class="topbar_ul__link link">Галерея</a>
            </li>
            <li class="topbar_ul__item">
                <a href="./#how_we_work" class="topbar_ul__link link">Как мы работаем</a>
            </li>
            <li class="topbar_ul__item">
                <a href="./#comments" class="topbar_ul__link link">Отзывы</a>
            </li>
            <li class="topbar_ul__item">
                <a href="./#application_form" class="topbar_ul__link link">Заявка</a>
            </li>
            <li class="topbar_ul__item">
                <a href="./#contacts" class="topbar_ul__link link">Контакты</a>
            </li>
        </ul>
        <button type="button" class="topbar__burger"><img src="./images/burger.png" alt=""></button>
    </nav>