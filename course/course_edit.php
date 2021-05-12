<?php
require_once("../project_pdo.php");
$course_id=$_POST["course_id"];
//$course_name_ch=$_POST["course_name_ch"];
$course_start_time=$_POST["course_start_time"];
$course_end_time=$_POST["course_end_time"];
$course_date=$_POST["course_date"];
//$course_apply_end=$_POST["course_apply_end"];
$course_place=$_POST["course_place"];
$course_title_ch=$_POST["course_title_ch"];
$course_description_ch=$_POST["course_description_ch"];
$course_inventory=$_POST["course_inventory"];
    

$sql = "UPDATE course SET course_start_time=?, course_end_time=?, course_date=?, course_place=?, course_title_ch=?, course_description_ch=?, course_inventory=? WHERE course_id=?";
    $stmt= $db_host->prepare($sql);
    try{
         $stmt->execute([$course_start_time, $course_end_time,  $course_date, $course_place, $course_title_ch, $course_description_ch, $course_inventory,$course_id]);
         echo "<script> alert('課程修改成功!!');parent.location.href='course-list.php'; </script>";
    }catch(PDOException $e){
        echo "課程修改失敗<br>";
        echo "Error: ".$e->getMessage();
        exit;
    }
?>