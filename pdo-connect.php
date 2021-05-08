<?php
    $servername = "localhost";
    $username = "root";
    $password = "524983";
    $dbname = "project";

    try{
        $db_host=new PDO(
            "mysql:host={$servername};dbname={$dbname};charset=utf8",$username,$password
        );
    }catch(PDOException $e){
        echo "資料庫連接失敗<br>";
        echo "Error: ".$e->getMessage();
    }
?>