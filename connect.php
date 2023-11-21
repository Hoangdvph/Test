<?php
    $localhost = 'localhost';
    $databaseName = 'wd18410_quanlisinhvien';
    $username = 'root';
    $password = '';

    $conn = new PDO("mysql:host=$localhost;dbname=$databaseName", $username, $password);

    if($conn){
        echo 'ket noi thanh cong'.'<br>';
    }else{
        echo 'ket noi that bai'.'<br>';
    }
?>