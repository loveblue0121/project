<?php
require_once("pdo-connect-project-db.php");
$course_name_ch=$_POST["course_name_ch"];
$course_start_time=$_POST["course_start_time"];
$course_end_time=$_POST["course_end_time"];
$course_date=$_POST["course_date"];
$course_apply_end=$_POST["course_apply_end"];
$course_place=$_POST["course_place"];
$course_title_ch=$_POST["course_title_ch"];
$course_description_ch=$_POST["course_description_ch"];
$course_inventory=$_POST["course_inventory"];
$valid=$_POST["valid"];
//現在的時間
ini_set('date.timezone', 'Asia/Taipei');
$now=date('Y-m-d H:i:s');
$sql="INSERT INTO course (course_name_ch, course_start_time, course_end_time, course_date, course_apply_end, course_place, course_title_ch, course_description_ch, course_inventory, valid, course_createdate) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, '$now')";

$stmtCourse=$db_host->prepare($sql);

try{
    $stmtCourse->execute([$course_name_ch, $course_start_time, $course_end_time, $course_date, $course_apply_end, $course_place, $course_title_ch, $course_description_ch, $course_inventory, $valid]);

    echo "<script> alert('課程上架成功!!');parent.location.href='course-list.php'; </script>";
}catch(PDOException $e){
echo "課程上架失敗<br>";
echo "Error: ".$e->getMessage();
    exit;
}
?>