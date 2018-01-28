<?php
    header("Content-Type: text/html; charset=utf-8");

    $host = 'localhost'; //сервер
    $database = 'test'; //название базы
    $user = 'roman_amelyakin'; //логин
    $password = 'hIsIfff0MvpNobzq'; //пароль

    $link = mysqli_connect($host, $user, $password, $database); //создаем соединение с базой данных
    mysqli_set_charset($link, 'utf8'); //кодировка для данных, отправляемых в базу
?>