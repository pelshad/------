<?php
  include_once "db/db_gsell.php";
  session_start();
  if(isset($_SESSION["login_user"])){
    $login_user = $_SESSION["login_user"];
  }

  $i_gonggu = $_GET["i_gonggu"];
  $param = [
    "i_gonggu" => $i_gonggu
  ];

  $item = sel_gboard($param);
  $view_up = view_up($param);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공동구매 폼</title>
    <link rel="stylesheet" href="css/detail.css">
</head>
<body>
  <div id = "container">
    <?php include_once "header.php" ?>

    <section>
      <div class="contents">
        <div class="tt_head">
          <h1><?=$item["title"]?></h1>
          <p><?=$item["created_at"]?></p>
          <p>작성자 : <?=$item["nm"]?></p>

          <?php if(isset($_SESSION["login_user"])) {
            if ($login_user["i_user"] === $item["i_user"] || $login_user["i_user"] == 1) { ?>
            <div class="mod_del"> 
              <a href="mod.php?i_gonggu=<?=$i_gonggu?>"><button>수정</button></a>
              <button onclick="isDel();">삭제</button>
            </div>
            <?php } ?>
          <?php } ?>

          <script>
            function isDel(){
            console.log('isDel 실행 됨!!')
            const result = confirm('삭제하시겠습니까?');
            if(result) {
            location.href = "del.php?i_gonggu=<?=$item['i_gonggu']?>";
              }
            }
          </script>
        </div>

        <div class="con_top">
          <div><span>상품명</span><?=$item["product_nm"]?></div>
          <div><span>가격</span><?=$item["price"]?>원</div> 
          <div><span>신청기간</span><?=$item["start_day"]?> ~ <?=$item["end_day"]?></div>
        </div>

        <div class="ctnt_box">
          <div><?=$item["ctnt"]?></div>
        </div>

        <div><a href="#"><?=$item["nm"]?>님의 게시글 더보기 > </a></div>

        <div class="buy_btn">
          <?php if(isset($_SESSION["login_user"]) && $login_user["i_user"] === $item["i_user"]) { ?>
            <a href="list_gbuy.php?i_gonggu=<?=$i_gonggu?>"><button>신청현황</button></a>
            <a href="list_gonggu.php"><button>목록으로</button></a>
          <?php } else { ?>        
          <a href="gbuy_write.php?i_gonggu=<?=$i_gonggu?>"><button>신청하기</button></a>
          <a href="list_gonggu.php"><button>목록으로</button></a>
          <?php } ?>

        </div>

      </div>

      
      <?php include_once "menubar.php"; ?>  
    
    </section>
  </div>
</body>
</html>