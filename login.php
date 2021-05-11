<?php
session_start();
//如果$_SESSION存在使用者資料 則直接跳轉course-list.php頁面
if(isset($_SESSION["account"])){
    header("location: course-list.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <title>後台管理系統</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/svg" href="unicorn.svg">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Itim&family=M+PLUS+Rounded+1c&display=swap" rel="stylesheet">

    <style>
        html, body{
            height: 100%;
        }
        body{
            background-image: url("bottle.jpeg");
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
        }
       .logo{
           font-family: 'Itim', cursive;
       }
       #unicorn{
           width: 40px;
       }
       #submitBtn{
           font-size: 16px;
           font-family: 'M PLUS Rounded 1c', sans-serif;
       }
       .space{
           height: 20vh;
       }
       
    </style>
  </head>
  <body>
      <div class="space">

      </div>
      <div class="container">
          <div class="row">
            <div class="col d-flex justify-content-center">
                  <div class="card-panel">
                      <!-- <div class="d-flex justify-content-center"> -->
                          <!-- <img src="unicorn.svg" id="unicorn" alt=""> -->
                          <h2 class="text-center logo">licorne.</h2>
                      <!-- </div> -->
                      <form action="doLogin.php" method="post" id="signUpForm">
                          <div class="input-field col">
                              <label for="">帳號</label>
                              <input type="text" class="form-control" id="account" name="account">
                          </div>
                          <div class="input-field col">
                            <label for="">密碼</label>
                            <input type="password" class="form-control" name="password" id="password">
                          </div>
                          
                        <div class="text-right">
                            <button class="btn-large waves-effect waveslight red lighten-2 mt-4" id="submitBtn" type="submit">登入</button>
                        </div>
                    </form>
                  </div>
              </div>
          </div>
        </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>

        $("#submitBtn").click(function(){
            let signUpForm=$("#signUpForm");
            let account = $("#account").val();
            let password = $("#password").val();
            if(account == "") {
                alert('請輸入帳號');
                return;
                exit();
            }
            if(password == ""){
                alert("請輸入密碼");
                return;
            }
            signUpForm.submit();
        })



    /* use ajax
        $(function() {
            $('#submitBtn').click(function() {
                let account = $('#account').val();
                let password = $('#password').val();
                if(account == '') {
                    alert('請輸入帳號');
                    return;
                }
                if(password == ""){
                    alert("請輸入密碼");
                    return;
                }
                $.ajax({
                    method: "POST",
                    url: "doLogin.php",
                    data: {
                        account: account
                    },
                    dataType: "json"
                })
                .done((data) => {
                    
                    if(data.length == 1) {
                        //console.log(data[0].admin_password);
                        if(password != data[0].admin_password) {
                            alert('密碼錯誤');
                        } else {
                            location.href = './course-list.php';
                        }
                    } else if(data.length == 0) {
                        alert('帳號錯誤');
                    } else {
                        console.log('err');
                    }
                })
                .fail((err) => {
                    console.log(err);
                })

            })
        })

        */
    </script>
  </body>
</html>