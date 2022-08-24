<?php
  include_once "db/db_gsell.php";
  session_start();
  $login_user = $_SESSION["login_user"];
  $i_user = $login_user["i_user"];

  $i_gonggu = $_POST["i_gonggu"];
  $buy_inv = $_POST["buy_inv"];
  $buy_price = $_POST["buy_price"];
  $buy_unm = $_POST["buy_unm"];
  $bnm = $_POST["bank_nm"];
  $bnum = $_POST["bank_num"];
  $buser = $_POST["bank_user"];
  $user_num = $_POST["user_number"];
  $picknm = $_POST["pickup_nm"];
  $addr = $_POST["addr"];
  $anum = $_POST["addr_num"];
  $apart = $_POST["addr_part"];
  $memo = $_POST["memo"];

  $param = [
    "i_gonggu" => $i_gonggu,
    "i_user" => $i_user,
    "buy_inv" => $buy_inv,
    "buy_price" => $buy_price,
    "buy_unm" => $buy_unm,
    "bank_nm" => $bnm,
    "bank_num" => $bnum,
    "bank_user" => $buser,
    "user_number" => $user_num,
    "pickup_nm" => $picknm,
    "addr" => $addr,
    "addr_num" => $anum,
    "addr_part" => $apart,
    "memo" => $memo,
  ];

    echo "i_gonggu => $i_gonggu <br>";
    echo "i_user => $i_user <br>";
    echo "buy_inv => $buy_inv <br>";
    echo  "buy_price => $buy_price <br>";
    echo "buy_unm => $buy_unm <br>";
    echo "bnm => $bnm <br>";
    echo "bnum => $bnum <br>";
    echo "buser => $buser <br>";
    echo "user_number => $user_num <br>";
    echo "picknm => $picknm <br>"; 
    echo "addr => $addr <br>";
    echo "anum => $anum <br>";
    echo "apart => $apart <br>";
    echo "memo => $memo <br>";

    $result = ins_buy_board($param);

    if($result) {
      header("location: list_gonggu.php");
    }