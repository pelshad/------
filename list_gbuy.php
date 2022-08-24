<?php
  include_once "db/db_gsell.php";
  session_start();

  $i_gonggu = $_GET["i_gonggu"];
  $param = [
    "i_gonggu" => $i_gonggu
  ];
  
  $list = sel_gbuy_list($param);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>신청현황</title>
  <link rel="stylesheet" href="css/board_list.css">
</head>
<body>
<div id="board_body">
  <?php include_once "header.php" ?>

    <section>
      <div class="contents">
        <div class="tt_header">
          <h1>공동구매 신청 현황</h1>   
        </div>
        <table>
          <thead>
            <tr class="table_title">
              <th>상품명</th>
              <th>구매자</th>
              <th>구매수량</th>
              <th>입금금액</th>
              <th>환불계좌</th>
              <th>우편번호</th>
              <th>주소</th>
              <th>신청일</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($list as $item) { ?>
              <tr>
                <td><?=$item["product_nm"]?></td>
                <td><?=$item['buy_unm']?></a></td>
                <td><?=$item["buy_inv"]?></td>
                <td><?=$item["buy_price"]?></td>
                <td><?=$item["bank_nm"]?> : <?=$item["bank_num"]?>, <?=$item["bank_user"]?></td>
                <td><?=$item["addr_num"]?></td>
                <td><?=$item["addr"]?>, <?=$item["addr_part"]?></td>
                <td><?=$item["created_at"]?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>

      <?php include_once "menubar.php";?>

    
    </section>

    
  </div>
  
</body>
</html>