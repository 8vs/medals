<?php

$hostname = '127.0.0.1';
$username = 'root';
$password = '';
$dbname   = 'medals';

$connection = mysqli_connect($hostname, $username, $password) or die ('Соединение с базой данных не установлено.');
mysqli_select_db($connection, $dbname);