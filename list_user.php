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
          <h1>내가 쓴 글</h1>   
        </div>
        <table>
          <thead>
            <tr class="table_title">
              <th width="100px"><!--NO.--></th>
              <th width="470px">제목</th>
              <th width="120px">작성자</th>
              <th width="175px">작성일</th>
              <th width="100px">조회</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($list as $item) { ?>
              <tr>
                <td><?=$item["i_gonggu"]?></td>
                <td><a href="gsell_detail.php?i_gonggu=<?=$item['i_gonggu']?>"><?=$item['title']?></a></td>
                <td><?=$item["nm"]?></td>
                <td><?=$item["created_at"]?></td>
                <td>0</td>
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