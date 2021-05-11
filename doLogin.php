<?php
session_start();
//檢查name及password是否存在，存在則執行
try{
    if(isset($_POST["account"])&& isset($_POST["password"])){
        require_once("pdo-connect-project-db.php");
        $account=$_POST["account"];
        $password=$_POST["password"];
        
        //登入
        $stmt=$db_host->prepare($sql="SELECT * FROM admin_list where admin_account='$account' AND admin_password='$password'");
        
        $stmt->execute();
    
        if($stmt->rowCount() >0){
            while($row=$stmt->fetch()){
                $_SESSION["account"]=$row["admin_account"];
                $_SESSION["admin_password"]=$row["admin_password"];
            }
            header("location: course-list.php");
        }else{
            $alert="<script> alert('帳號或密碼錯誤!');parent.location.href='login.php'; </script>";
            echo $alert;
            
        }
    }else{
        echo "請輸入帳號密碼";
    }  


        
}catch(PDOException $e){
    echo "帳號或密碼不存在<br>";
    echo "Error: ".$e->getMessage();
    exit;
}
?>