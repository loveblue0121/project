<!-- <td>$row["course_title_ch"] </td>
<td>$row["course_description_ch"] </td> -->

<?php
require_once("../project_pdo.php");
$stmt=$db_host->prepare("SELECT * from course WHERE valid=1 ORDER BY course_id DESC");

try{
  $stmt->execute();
}catch(PDOException $e){
    echo "資料庫查詢失敗<br>";
    echo "Error: ".$e->getMessage();
    exit;
} 
//頁碼               
if(!isset($_GET["p"])){
  $page=1;
}else{
  $page=$_GET["p"];
}

$limit=7;
$start=($page-1)*$limit;
$stmtTotal=$db_host->prepare("SELECT * FROM course WHERE valid=1");
try{
  $stmtTotal->execute();
  //取得符合條件的有幾筆
  $total=$stmtTotal->rowCount();
  // echo $total;
  // exit();
}catch(PDOException $e){
  echo "資料庫查詢失敗<br>";
  echo "Error: ".$e->getMessage();
  exit;
}
//取得頁數
$pageCount=CEIL($total/$limit);
$stmt=$db_host->prepare("SELECT * FROM course WHERE valid=1 LIMIT $start,$limit");
    try{
        $stmt->execute();
        //取得符合條件的有幾筆
        
    }catch(PDOException $e){
        echo "資料庫查詢失敗<br>";
        echo "Error: ".$e->getMessage();
        exit;
    }

$stmtPlace=$db_host->prepare("SELECT * FROM course_place");
while($rowPlace= $stmtPlace->fetch()) {
    $place[$rowPlace["course_place"]]=$rowPlace["course_place_name"];

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
      .title_add{
        padding: 0;
      }
      .card_bg{
        padding: 0;
      }
      .pages{
        width: 100%;
      }
      .btn-round:hover{
        width: 5rem;
      }
  </style>
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="" class="simple-text logo-mini">
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
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="">課程管理</a>
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
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
    <div class="card_bg content card mx-3">
      <div class="title_add col-md-12 d-flex justify-content-between mt-2">
          <h3>課程列表</h3>
            <a href="add_course.php" class="btn btn-outline-primary btn-icon btn-round add" role="button"><i class="fas fa-plus"></i></a>  
            <!-- <h3 class="description">Your content here</h3> -->
      </div>
      <div class="row">
        <?php if($stmt->rowCount() > 0): ?>
          <table class="table table-hover">
            <thead>
              <tr class="">
                <th class="">課程名稱</th>
                <th>課程日期</th>
                <th>課程開始時間</th>
                <th>課程結束時間</th>
                <th>報名截止時間</th>
                <th>課程地點</th>
                <!-- <th>課程標題</th>
                <th>課程內容</th> -->
                <th>剩餘名額</th>
                <th>報名人數</th>
                <th>課程建立時間</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php
                //fetch_assoc() 將讀出的資料Key值設定為該欄位的欄位名稱。
                while($row = $stmt->fetch()) {
                  $course_id=$row["course_id"];
              ?>
              <tr>
                <td><?= $row["course_name_ch"] ?></td>
                <td><?= $row["course_date"] ?></td>
                <td><?= $row["course_start_time"] ?></td>
                <td><?= $row["course_end_time"] ?></td>
                <td><?= $row["course_apply_end"] ?></td>
                <td><?= $row["course_place"] ?></td>
                <td><?= $row["course_inventory"] ?></td>
                <td><?= $row["item_quantity"] ?></td>
                <td><?= $row["course_createdate"] ?></td>
                <td>
                  <a href="course.php?course_id=<?=$course_id?>" class="btn btn-success" role="button"><i class="fas fa-edit"></i>編輯</a>
                  <button data-id="<?=$row["course_id"]?>" class="btn btn-danger delete-btn" role="button"><i class="fas fa-trash-alt"></i> 刪除</button>
                  
              </td>
              </tr>
                <?php } ?>
            </tbody>
          </table>
            <?php
              else:
            ?>
              目前沒有開課
            <?php endif; 
              $db_host=NULL;
            ?>
            <div class="pages d-flex justify-content-center">
              <ul class="pagination">
                <?php for($i=1;$i<=$pageCount;$i++){ ?>
                  <li class="page-item <?php
                  if($page==$i)echo "active";
                  ?>"><a class="page-link" href="course-list-gg.php?p=<?=$i?>"><?=$i?></a></li>
                <?php } ?>
              </ul> 
            </div>
            
            
      </div>
  </div>
  <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script>
    $(".delete-btn").on("click", function(){
        let deleteId=$(this).data("id");
        Swal.fire({
          icon: 'warning',
          text: '確認刪除?',
          showCloseButton: true,
          confirmButtonColor: '#dc3545',
          showCancelButton: true,
          confirmButtonText:"YES",
          cancelButtonText:"Cancel"
        })
        .then((result) => {
          if (result.isConfirmed) {
            $.ajax({
               method: "POST",
                url: "deleteUser-ajax.php",
                data: { id: deleteId },
                dataType: "json"
            })
            .done(function( data ) {
              console.log(data)
              if(data.status===1){ //狀態碼=1(刪除成功)時顯示訊息
                $("<?=$row["course_id"]?>"+deleteId).remove();
                Swal.fire(
                  '成功!!!',
                  '恭喜你擺脫它了',
                  'success'
                )
              }
            })
            .fail(function(error) {
              if(data.status===0){
                Swal.fire(
                  'fail', 
                  data.message,
                  'error'
                )
              }
            })
            .always(function() {
                      
            })
            ;
                    
                    
          }
      })

    })
  </script>
</body>

</html>
