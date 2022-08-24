<?php
    include_once "db/db_board.php";
    session_start();

    if(isset($_SESSION["login_user"])){
    $login_user = $_SESSION["login_user"];
    $nm = $login_user["nm"];}

    $page = 1;
    if(isset($_GET["page"])){
        $page = intval($_GET["page"]);
    }

    /* row_conut 설정 */
    if(isset($_GET["nrc"])){
      $row_count = $_GET["nrc"];
    } else {
      $row_count = 10;
    }

    $param = [
        "row_count" => $row_count,
        "start_idx" => ($page - 1) * $row_count
    ];

    $paging_count = notice_paging_count($param);
    $list = sel_notice_list($param);
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
      <h2 class="title">공지사항</h1>
      <!--페이징 목록-->
      <div class="select_box">
      <form action="notice_board.php" method="get">
        <select name="nrc" onchange="this.form.submit()">
          <option value="">글목록</option>
          <option value="5">5개씩</option>
          <option value="10">10개씩</option>
          <option value="15">15개씩</option>
        </select>
      </form>
      </div>
      <!-- 공지사항 테이블 -->
      <table>
            <tr class="tr_line">
                <th width="80px">글번호</th>
                <th width="500px">제&nbsp&nbsp&nbsp&nbsp목</th>
                <th width="100px">작성자</th>
                <th width="180px">작성일</th>
                <th width="90px">조회수</th>
            </tr>
            <?php foreach($list as $item){ ?>
                <tr>
                    <td><?=$item["i_board"]?></td>
                    <td class="title"><a href="tip_detail.php?i_board=<?=$item["i_board"]?>"><?=$item["title"]?></a>
                    <?php if(!$item["c_cnt"] == 0){?>
                      <span class="cnt">[<?=$item["c_cnt"]?>]</span> 
                    <?php } ?></td>
                    <td><?=$item["nm"]?></td>
                    <td><?=$item["created_at"]?></td>
                    <td><?=$item["view_at"]?></td>
                </tr>
            <?php } ?>
        </table>
        <!--페이징-->
        <div class="page">
           <?php for($i=1; $i<=$paging_count; $i++) { ?>
            <span class="<?=$i===$page ? "pageSelected" : ""?>">
            <a href="notice_board.php?page=<?=$i?>"><?=$i?></a>
            </span>
           <?php } ?>
       </div>
       <div class="write"><input class="sub" type="button" value="글쓰기" onclick="location.href='write.php'"></div>
      </div>

      <?php include_once "menubar.php";?>
 
    
    </section>
  </div>
  
</body>
</html>