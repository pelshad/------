<?php
  include_once "db/db_gsell.php";
  session_start();
  $login_user = $_SESSION["login_user"];
  $i_user = $login_user["i_user"];

  $sel_board = $_POST["sel_board"];
  $title = $_POST["title"];
  $ctnt = $_POST["ctnt"];
  $pd_nm = $_POST["product_nm"];
  $bnm = $_POST["bank_nm"];
  $bnum = $_POST["bank_num"];
  $bsell = $_POST["bank_sell_user"];
  $price = $_POST["price"];
  $sday = $_POST["start_day"];
  $eday = $_POST["end_day"];

  $param = [
    "sel_board" => $sel_board,
    "i_user" =>$i_user,
    "title" => $title,
    "ctnt" => $ctnt,
    "product_nm" => $pd_nm,
    "bank_nm" => $bnm,
    "bank_num" => $bnum,
    "bank_sell_user" => $bsell,
    "price" => $price,
    "start_day" => $sday,
    "end_day" => $eday,
  ];

  print_r($param);

$result = ins_sell_board($param);

if($result){
  header("location:list_gonggu.php");
}
  
?>