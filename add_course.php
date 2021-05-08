<?php
require_once ("pdo-connect.php");
$stmt=$db_host->prepare("SELECT * from course");
$stmt->execute();

$stmtPlace=$db_host->prepare("SELECT * from course_place");
//$stmtPlace->execute();
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
  <title>
    Paper Dashboard 2 by Creative Tim
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="./assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <style>
      .btnWidth{
        width: 100%;
      }
  </style>
</head>

<body class="">
  <div class="wrapper ">
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
    <div class="main-panel" >
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="">新增課程</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
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
          <div class="col-lg-5 card">
          <form action="do_add_course.php" method="post" id="addForm">
            <div class="form-group mt-2">
                <label for="">課程名稱</label>
                <input type="text" class="form-control" name="course_name_ch" required>
            </div>
            <div class="form-group">
                <label for="">課程日期</label>
                <input type="date" class="form-control" name="course_date" required>
            </div>
            
            <div class="form-group">
                <label for="">課程開始時間</label>
                <input type="time" class="form-control" name="course_start_time" required>
            </div>

            <div class="form-group">
                <label for="">課程結束時間</label>
                <input type="time" class="form-control" name="course_end_time" required>
            </div>

            
            
            <div class="form-group">
                <label for="">報名截止時間</label>
                <input type="datetime-local" class="form-control" name="course_apply_end" required>
            </div>

            <div class="form-group">
                <label for="">課程地點</label>
                <select class="form-control" name="course_place" id="course_place">
                  <?php while($rowPlace=$stmtPlace->fetch()){
                    $place[$rowPlace["course_place_id"]]=$rowPlace["course_place_name"];?>
                      <option><?= $rowPlace["course_place_name"] ?></option>
                  <?php } ?>  
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="">課程文案標題</label>
                <input type="text" class="form-control" name="course_title_ch">
            </div>

            <div class="form-group mt-2">
                <label for="">課程文案內容</label>
                <textarea type="text" class="form-control" name="course_description_ch"></textarea>
            </div>

            <div class="form-group mt-2">
                <label for="">課程人數限制</label>
                <input type="text" class="form-control" name="course_inventory">
            </div>
            <input type="hidden" name="valid" value=1>
            <div class="btnWidth d-flex justify-content-end">
                 <input type="submit" class="btn btn-primary" value="新增" id="add">   
            </div>
            
            </form>
            

          </div>  
        </div>
      </div>
      <footer class="footer" style="position: absolute; bottom: 0; width: -webkit-fill-available;">
        <div class="container-fluid">
          
        </div>
      </footer>
    </div>
  </div>
    <script>
        let add=document.querySelector("#add");
        add.onclick=function(){
            let addForm=document.querySelector("#addForm");
            let formgroup=document.querySelector(".form-group")
            if(formgroup.length ==0){
              alert("請填入資料")
            }else{
              addForm.submit();
            }
            
        }

    </script>
</body>

</html>
