<?php

  include_once "db/db_user.php";
  // 아이디 중복확인
  session_start();

  $wd = "";
  if(isset($_POST["user_id"])) {
    $param = [
      'user_id' => $_POST["user_id"]
     ];
     $result = id_check($param);
       if($result) {
          $wd = "<li>".$_POST["user_id"]."는 중복된 아이디입니다. <br> </li>";
        } else if ($_POST["user_pw"] === $_POST["confirm_pw"]){
          $uid = $_POST["user_id"];
          $upw = $_POST["user_pw"];
          $confirm_pw = $_POST["confirm_pw"];
          $nm = $_POST["nm"];
          $user_num = $_POST['user_num'];    
          $param = [
              "user_id" => $uid,
              "user_pw" => $upw,
              "confirm_pw" => $confirm_pw,
              "nm" => $nm,
              "user_num" => $user_num
          ];
          $result = ins_user($param);
          if($result) {
            header("location:login_page.php");
          }
       }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/join.css">
  <title>회원가입</title>

</head>
<body>
  <div id="join_page">
    <div class="header">
      <h1 class="header_txt"><a href="main_page.php">베란다가든</a></h1>
    </div>
    <form action="join_page.php" method="post" id="join_form">
      <div class="user_ins">
        <div>
          <p>아이디</p>
          <input type="email" name="user_id" placeholder="아이디(이메일주소)">
        </div>
        <p><?=$wd?></p>
        <div>
          <p>비밀번호</p> 
          <input type="password" name="user_pw" placeholder="비밀번호">
        </div>
        <?php
          $wp ="";
          if( !empty($_POST['user_pw']) && !empty($_POST['confirm_pw']) ){
            if ($_POST['user_pw'] !== $_POST['confirm_pw']) {
                $wp = "입력하신 비밀번호가 다릅니다.";
            }
          }
        ?>
        <div>
          <p>비밀번호 확인</p>
          <input type="password" name="confirm_pw" placeholder="비밀번호 확인">
        </div>
        <p><?= $wp?></p>
        <div>
          <p>이름</p>
          <input type="text" name="nm" placeholder="이름">
        </div>
        <div>
          <p>연락처</p>
          <input type="tel" name="user_num" placeholder="연락처">
        </div>
      </div>
      <div class="join_btn">
        <input type="submit" value="가입하기">
      </div>
    </form>
  </div>
</body>
</html>