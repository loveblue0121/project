<?php
    session_start();
    //填補登入的漏洞，需判斷使用者的資料是否存在SESSION內，確認存在才將資料清除
    if(isset($_SESSION["account"])){
        //將session資料清除
        session_destroy();
    }
    
    
    header("location: login.php");
?>