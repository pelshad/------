<?php
  include_once "db/db_gsell.php";
  session_start();

  if(isset($_SESSION["login_user"])){
    $login_user = $_SESSION["login_user"];
    $nm = $login_user["nm"];}
    
    $page = 1;
    if(isset($_GET["page"])){
        $page = intval($_GET["page"]);
    }
    /* row_conut 설정(글목록 갯수) */
    if(isset($_GET["rc"])){
      $row_count = $_GET["rc"];
    } else {
      $row_count = 10;
    }
    
    $param = [
        "row_count" => $row_count,
        "start_idx" => ($page - 1) * $row_count
    ];

    $paging_count = g_paging_count($param);
    $notice = top_notice();
    $list = sel_gboard_list($param);

 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>공구게시판</title>
  <link rel="stylesheet" href="css/board_list.css">
</head>
<body>
<div id="board_body">
  <?php include_once "header.php" ?>

    <section>
      <div class="contents">
        <div class="tt_header">
          <h1>공구게시판</h1>
          <div class="select_box">
            <form action="list_gonggu.php" method="get">
              <select name="rc" onchange="this.form.submit()">
                <option value="">글목록</option>
                <option value="5">5개씩</option>
                <option value="10">10개씩</option>
                <option value="15">15개씩</option>
              </select>
            </form>
          </div>
         
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
            <!--공지사항-->
          <?php foreach($notice as $item){ ?>
              <tr class="tr_notice">
                <td class="notice">공지</td>
                <td class="title notice">
                  <a href="tip_detail.php?i_board=<?=$item["i_board"]?>"><?=$item["title"]?></a>
                   <?php if(!$item["c_cnt"] == 0){?>
                    <span class="cnt">[<?=$item["c_cnt"]?>]</span>
                  <?php } ?>
                </td>
                <td class="notice"><?=$item["nm"]?></td>
                <td class="notice"><?=$item["created_at"]?></td>
                <td class="notice"><?=$item["view_at"]?></td>
              </tr>
            <?php } ?>
            <!--공구 리스트-->
            <?php foreach($list as $item) { ?>
              <tr>
                <td><?=$item["i_gonggu"]?></td>
                <td class="title"><a href="gsell_detail.php?i_gonggu=<?=$item['i_gonggu']?>"><?=$item['title']?></a></td>
                <td><?=$item["nm"]?></td>
                <td><?=$item["created_at"]?></td>
                <td class="notice"><?=$item["view_at"]?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
        <div class="write">
          <input class="sub" type="button" value="폼 작성하기" onclick="location.href='gsell_write.php'">
        </div>
       <!-- 페이징 리스트 -->
       <div class="page">
         <?php for($i=1; $i<=$paging_count; $i++) { ?>
            <span class="<?=$i===$page ? "pageSelected" : ""?>">
              <a href="list_gonggu.php?page=<?=$i?>"><?=$i?></a>
            </span>
          <?php } ?>
        </div>      

        <!--search-->
        <div class="search">
          <form action="search_gboard.php" method="GET">
            <select name="cat" id="bsel">
              <option value="title">제목</option>
              <option value="nm">작성자</option>
            </select>
            <input class="text" type="text" name="search" required="required">
            <input class="sub" type="submit" value="검색">
          </form>
        </div>

      </div>

      <?php include_once "menubar.php";?>
      <div id="footer">
        <p>식집사들의 이야기 https://www.veranda.com </p>
        <p>VERANDA GARDEN</p>
        <p>H.PROJECT</p>
      </div>
    
    </section>
    
    
  </div>

  
  
</body>
</html>