<?php
  include_once "db/db_user.php";

  $uid = $_POST["user_id"];
  $upw = $_POST["user_pw"];

  $param = [
    "user_id" => $uid,
    "user_pw" => $upw,
  ];

  $result = sel_user($param);
  if(empty($result)){
    echo "<script> alert('해당하는 아이디가 없습니다.'); </script>";
    echo "<script> history.back() </script>";
    die;
  }

  if($upw === $result["user_pw"]){
    session_start();
    $_SESSION["login_user"] = $result;
    header("Location:main_page.php");
  } else {
    echo "<script> alert('비밀번호가 맞지 않습니다.'); </script>";
    header("Location:login_page.php");   
  }
?>