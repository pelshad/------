<?php
include_once "db/db_user.php";

  $uid = $_POST["user_id"];
  $upw = $_POST["user_pw"];
  $confirm_upw = $_POST["confirm_pw"];
  $nm = $_POST["nm"];
  $user_num = $_POST['user_num'];

  $param = [
    "user_id" => $uid,
    "user_pw" => $upw,
    "nm" => $nm,
    "user_num" => $user_num,
  ];
  
  $result = ins_user($param);

  if($result){
    header("location:login_page.php");
  }
