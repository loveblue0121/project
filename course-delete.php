<?php
    require_once("pdo-connect.php");
    $id=$_GET["course_id"];
    //使用刪除按鈕將valid欄位改為0
    $sql = "UPDATE course SET valid=0 WHERE course_id=?";
    $stmt= $db_host->prepare($sql);
    try{
         $stmt->execute([$id]);
         echo "課程刪除成功!";
    }catch(PDOException $e){
        echo "課程刪除失敗<br>";
        echo "Error: ".$e->getMessage();
        exit;
    }
   
?>