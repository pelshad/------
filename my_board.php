<?php
    include_once "db/db_board.php";
    session_start();

    if(isset($_SESSION["login_user"])){
    $login_user = $_SESSION["login_user"];
    $i_user = $login_user["i_user"];
  } else {
    header("location:main_page.php");
  }

    $param = [
      "i_user" => $i_user
    ];

    $board = sel_my_board($param);
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리스트</title>
    <link rel="stylesheet" href="css/board_list.css">
</head>

<body>
  <div id="board_body">
        
    <?php include_once "header.php" ?>
        
    <section>
        <div class="contents">
        <div class="tt_header">
          <h1>나의 작성글</h1>   
        </div>
          <!-- 테이블 시작 -->
          <table>
            <tr class="tr_line">
              <th width="80px">NO.</th>
              <th width="500px">제&nbsp&nbsp&nbsp&nbsp목</th>
              <th width="100px">작성자</th>
              <th width="180px">작성일</th>
              <th width="90px">조회수</th>
            </tr>
            <!--내 글 리스트-->
            <?php foreach($board as $item){ ?>
              <tr>
                <td><?=$item["i_board"]?></td>
                <td class="title"><a href="tip_detail.php?i_board=<?=$item["i_board"]?>"><?=$item["title"]?></a>
                <?php if(!$item["c_cnt"] == 0){?>
                  <span class="cnt">[<?=$item["c_cnt"]?>]</span>
                <?php } ?>
                </td>
                <td><?=$item["nm"]?></td>
                <td><?=$item["created_at"]?></td>
                <td><?=$item["view_at"]?></td>
              </tr>
            <?php } ?>
          </table>
        </div>
      <?php include_once "menubar.php";?>        

    </section>

  </div>

</body>

</html>