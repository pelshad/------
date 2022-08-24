<?php
  include_once "db_connect.php";

  function ins_sell_board(&$param){

    $sel_board = $param["sel_board"];
    $i_user = $param["i_user"];
    $title = $param["title"];
    $ctnt = $param["ctnt"];
    $pd_nm = $param["product_nm"];
    $price = $param["price"];
    $bnm = $param["bank_nm"];
    $bnum = $param["bank_num"];
    $bsell = $param["bank_sell_user"];
    $sday = $param["start_day"];
    $eday = $param["end_day"];

    $conn = get_conn();
    $sql =
    "INSERT INTO t_gg_sell
    (sel_board, i_user, title, ctnt, product_nm, price, bank_nm, bank_num, bank_sell_user, start_day, end_day)
     VALUES
    ('$sel_board', '$i_user', '$title', '$ctnt', '$pd_nm', '$price', '$bnm', '$bnum', '$bsell', '$sday','$eday')
    ";

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function ins_buy_board(&$param){

    $i_gonggu = $param["i_gonggu"];
    $i_user = $param["i_user"];
    

    $buy_inv = $param["buy_inv"];
    $buy_price = $param["buy_price"];
    $buy_unm = $param["buy_unm"];
    $bnm = $param["bank_nm"];
    $bnum = $param["bank_num"];
    $buser = $param["bank_user"];
    $user_num = $param["user_number"];
    $picknm = $param["pickup_nm"];
    $addr = $param["addr"];
    $anum = $param["addr_num"];
    $apart = $param["addr_part"];
    $memo = $param["memo"];

    $sql = "INSERT INTO t_gg_buy
    ( i_gonggu, i_user, buy_inv, buy_price, buy_unm, bank_nm, bank_num
    ,bank_user, user_number, pickup_nm, addr, addr_part, addr_num, memo)
    VALUES
    ('$i_gonggu','$i_user', '$buy_inv', '$buy_price', '$buy_unm', '$bnm', '$bnum'
    ,'$buser', '$user_num', '$picknm', '$addr', '$apart', '$anum', '$memo')
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }

  function sel_gboard(&$param){
    $i_gonggu = $param["i_gonggu"];
    $sql = " SELECT A.title, A.ctnt, A.created_at, A.product_nm, A.price
                  , A.bank_nm, A.bank_num, A.bank_sell_user
                  , A.start_day, A.end_day
                  , B.i_user, B.nm
               FROM t_gg_sell A
         INNER JOIN t_user B
                 ON A.i_user = B.i_user
              WHERE A.i_gonggu = $i_gonggu
    ";

    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return mysqli_fetch_assoc($result);
  }

  //공구게시판 리스트
  function sel_gboard_list(&$param){
    $start_idx = $param["start_idx"];
    $row_count = $param["row_count"];
    $sql ="SELECT A.i_gonggu, A.title, A.created_at, A.view_at, B.nm
             FROM t_gg_sell A
       INNER JOIN t_user B
               ON A.i_user = B.i_user
         ORDER BY A.i_gonggu DESC
         LIMIT $start_idx, $row_count
    ";

    $conn = get_conn();
    $result=mysqli_query($conn,$sql);
    mysqli_close($conn);
    return $result;
  }

  function g_paging_count(&$param){
    $conn = get_conn();
    $row_count = $param["row_count"];
    $sql = "SELECT CEIL(COUNT(i_gonggu) / $row_count) as cnt
            FROM t_gg_sell";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    $row = mysqli_fetch_assoc($result);
    return $row["cnt"];
}

function top_notice(){
  $conn = get_conn();
  $sql = "SELECT A.i_user, A.i_board, A.title, A.created_at, A.view_at, B.nm, A.c_cnt
          FROM t_board A
          INNER JOIN t_user B
          ON A.i_user = B.i_user
          WHERE sel_board = 3
          ORDER BY i_board DESC
          LIMIT 3
          ";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return $result;
}
  //공구 구매자 리스트
  function sel_gbuy_list(&$param){
    $i_gonggu = $param["i_gonggu"];
    $sql = "SELECT A.buy_unm, A.buy_inv, A.buy_price, A.addr_num
                  ,A.bank_nm, A.bank_num, A.bank_user
                  ,A.addr, A.addr_part, A.created_at, B.product_nm
              FROM t_gg_buy A
        INNER JOIN t_gg_sell B
                ON A.i_gonggu = B.i_gonggu
             WHERE A.i_gonggu = $i_gonggu
          ORDER BY created_at DESC
    ";

    $conn = get_conn();
    $result = mysqli_query($conn,$sql);
    mysqli_close($conn);
    return $result;

  }

  /* 게시판 검색 */
  function sea_gboard(&$param){
    $conn = get_conn();
    $cat = $param["cat"];
    $search = $param["search"];
    $row_count = $param["row_count"];
    $start_idx = $param["start_idx"];
    $sql = "SELECT * FROM t_gg_sell A
            INNER JOIN t_user B
            ON A.i_user = B.i_user
            WHERE $cat like '%$search%' 
            LIMIT $start_idx, $row_count";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

/* 게시판 검색 페이징 */
function search_paging_count(&$param){
    $conn = get_conn();
    $cat = $param["cat"];
    $search = $param["search"];
    $row_count = $param["row_count"];
    $sql = "SELECT CEIL(COUNT(i_board) / $row_count) as cnt
            FROM t_gg_sell A
            INNER JOIN t_user B
            ON A.i_user = B.i_user
            WHERE $cat like '%$search%'"
            ;
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    $row = mysqli_fetch_assoc($result);
    return $row["cnt"];
}

 /*조회수*/
 function view_up(&$param){
  $conn = get_conn();
  $i_gonggu = $param["i_gonggu"];
  $sql = "UPDATE t_gg_sell
          SET view_at = view_at + 1
          WHERE i_gonggu = $i_gonggu
          ";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return $result;
}

/*내글 보기*/
function sel_my_gonggu(&$param){
  $conn = get_conn();
  $i_user = $param["i_user"];
  $sql = "SELECT * FROM t_gg_sell
          WHERE i_user = '$i_user'";
  $result = mysqli_query($conn, $sql);
  mysqli_close($conn);
  return $result;
}