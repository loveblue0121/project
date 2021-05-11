<?php
session_start();
require_once("pdo-connect-project-db.php");
 $account=$_POST["account"];
// $password=$_POST["password"];

$stmt=$db_host->prepare("SELECT admin_account,admin_password FROM admin_list WHERE admin_account='$account'");

try{ 
        $array = array();
        $stmt->execute();
        while($res = $stmt->fetch()) {
            $array[] = $res;
            
        }
        echo json_encode($array);
    } catch(PDOException $e){
        echo "資料庫查詢失敗<br>";
        echo "Error: ".$e->getMessage();
           
    }


?>