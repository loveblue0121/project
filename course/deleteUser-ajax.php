<?php
require_once("../project_pdo.php");
    $id=$_POST["id"];
    //使用刪除按鈕將valid欄位改為0
    $sql = "UPDATE users SET valid=0 WHERE id=?";
    $stmt= $db_host->prepare($sql);
    try{
        $stmt->execute([$id]);
        $data=array(
            "status"=>1,//回傳狀態代碼，成功的話回傳
            "message"=>"刪除成功"
        );
        echo json_encode($data);
   }catch(PDOException $e){
       echo "資料庫查詢失敗<br>";
       echo "Error: ".$e->getMessage();
       $data=array(
        "status"=>0,//回傳狀態代碼   
        "message"=>"Error: ".$e->getMessage()
        );
        echo json_encode($data);
       exit;
   }
?>

