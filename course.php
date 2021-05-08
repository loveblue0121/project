<?php
require_once("pdo-connect.php");
$course_id=$_GET["course_id"];
$stmt=$db_host->prepare("SELECT * FROM course WHERE course_id=:course_id");
$stmt->execute(
    array(
        ":course_id"=>$course_id

    )
);
$stmtPlace=$db_host->prepare("SELECT * from course_place");
try{
  $stmtPlace->execute();
}catch(PDOException $e){
  echo "資料庫查詢失敗<br>";
  echo "Error: ".$e->getMessage();
  exit;
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
  <style>
    
  </style>
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="https://www.creative-tim.com" class="simple-text logo-mini">
          <!-- <div class="logo-image-small">
            <img src="./assets/img/logo-small.png">
          </div> -->
          <!-- <p>CT</p> -->
        </a>
        <a href="" class="simple-text logo-normal">
          後臺管理介面
          <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
        </a>
      </div>
      <div class="sidebar-wrapper">
      <ul class="nav">
          <li>
            <a href="javascript:;">
              <i class="nc-icon nc-badge"></i>
              <p>使用者管理</p>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="nc-icon nc-box"></i>
              <p>官方產品管理</p>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="nc-icon nc-diamond"></i>
              <p>客製化管理</p>
            </a>
          </li>
          <li class="active">
            <a href="javascript:;">
              <i class="nc-icon nc-palette"></i>
              <p>課程管理</p>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="nc-icon nc-paper"></i>
              <p>訂單管理</p>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="nc-icon nc-circle-10"></i>
              <p>會員管理</p>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="nc-icon nc-chart-bar-32"></i>
              <p>排行榜管理</p>
            </a>
          </li>
          <li>
            <a href="javascript:;">
              <i class="nc-icon nc-ruler-pencil"></i>
              <p>題庫管理</p>
            </a>
          </li>
        </ul>

      </div>
    </div>
    <div class="main-panel" style="height: 100vh">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="">課程修改</a>
          </div>

          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <form>
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <div class="content">
        <div class="row justify-content-center">
          <div class="card col-lg-5">
            <!-- <h3 class="mt-2">編輯課程</h3> -->
            <?php if($stmt->rowCount()>0): ?>
            <form action="course-edit.php" method="post" id="editForm">
            <?php
                while($row = $stmt->fetch()) {
                    $course_id=$row["course_id"];
            ?>

            <input type="hidden" name="course_id" value="<?=$course_id?>">
            <h3 class="mt-2"><?=$row["course_name_ch"]?></h3>
            <div class="form-group">
                <label>課程日期 </label>
                <input type="date" class="form-control" value="<?=$row["course_date"]?>" name="course_date">
            </div>
            <div>
                <label>課程開始時間 </label>
                <input type="time" class="form-control" value="<?=$row["course_start_time"]?>" name="course_start_time">
            </div>
            <div>
                <label>課程結束時間 </label>
                <input type="time" class="form-control" value="<?=$row["course_end_time"]?>" name="course_end_time">
            </div>

            <div>
            <label>課程地點 </label>
            
            <select class="form-control" name="course_place" id="course_place" >
            <?php 
              while($rowPlace=$stmtPlace->fetch()){
                // $place[$rowPlace["course_place_id"]]=$rowPlace["course_place_name"];
            ?>
                <option 
                  value="<?=$rowPlace["course_place_name"]?>"
                  <?php if($row["course_place"]==$rowPlace["course_place_name"]) {?>
                    selected 
                  <?php } ?>
                >
                  <?= $rowPlace["course_place_name"] ?>
                </option>
            <?php } ?>    
            </select>
                  
            </div>
            <div>
            <label>課程文案標題</label>
            <input type="text" class="form-control" name="course_title_ch" value="<?=$row["course_title_ch"]?>">
            </div>
            <div>
            <label>課程文案內容</label>
            <textarea type="text" class="form-control" name="course_description_ch"><?=$row["course_description_ch"]?></textarea>
            </div>
            <div>
            <label>注意事項</label>
            <input type="text" class="form-control" name="course_notice" value="<?=$row["course_notice"]?>">
            </div>
            <div>
            <label>人數限制</label>
            <input type="text" class="form-control" name="course_inventory" value="<?=$row["course_inventory"]?>">
            </div>
            <div>
            <label>課程建立時間</label>
            <?=$row["course_createdate"]?>  
            </div>
        <?php } ?>
        <div class="d-flex justify-content-end">
          <button type="submit" class="btn btn-success" value="修改" id="edit">修改</button>
        </div>
        
        </form>
        <?php else:?>
            沒有這一筆資料
        <?php endif;?>
          </div>
        

        </div>
        </div>
    </div>
  <script>
      let edit=document.querySelector("#edit");
      edit.onclick=function(){
        let editForm=document.querySelector("#editForm");
        editForm.submit();
      }
  </script>
</body>

</html>
