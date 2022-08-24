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

    $paging_count = tip_paging_count($param);
    $list = sel_tip_list($param);
    $notice = top_notice();
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
            <h1>나만의 꿀팁</h1>

            <!--페이징 목록 갯수 -->
            <div class="select_box">
              <form action="tip_board.php" method="get">
                <select name="rc" onchange="this.form.submit()">
                  <option value="">글목록</option>
                  <option value="5">5개씩</option>
                  <option value="10">10개씩</option>
                  <option value="15">15개씩</option>
                </select>
              </form>
            </div>
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
            <!--공지사항 리스트-->
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
            <!--팁게시판 리스트-->
            <?php foreach($list as $item){ ?>
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
          <!-- 글쓰기 버튼 -->
            <!-- <input class="sub" type="button" value="글쓰기" onclick="location.href='write.php'"> -->
            <?php if(isset($login_user)) { ?>
              <div class="write"><input class="sub" type="button" value="글쓰기" onclick="location.href='write.php'"></div>
              <?php } else { ?>
              <div class="write"><input class="sub" type="button" value="글쓰기" onclick="clickBack();"></div>
            <?php } ?>
          
          <!-- 페이징 리스트 -->
          <div class="page">
                    <?php for($i=1; $i<=$paging_count; $i++) { ?>
                      <span class="<?=$i===$page ? "pageSelected" : ""?>">
                        <a href="tip_board.php?page=<?=$i?>"><?=$i?></a>
                      </span>
                    <?php } ?>
                  </div>
                 
                  <!-- 검색바 -->
                  <div class="search">
                    <form action="result_search.php" method="GET">
                      <select name="cat">
                        <option value="title">제목</option>
                        <option value="nm">작성자</option>
                      </select>
                      <input type="hidden" name="sel_board" value="<?=$item["sel_board"]?>">
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
  <script>
    function clickBack() {
      alert('로그인 후 이용가능합니다.');
      location.href='login_page.php';
    }
  </script>
</body>

</html>