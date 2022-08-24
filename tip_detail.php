<?php
    include_once "db/db_board.php";
    session_start();
    
    if(isset($_SESSION["login_user"])){
      $login_user = $_SESSION["login_user"];
      $nm = $login_user["nm"];
    }

    $i_board = $_GET["i_board"];
    $param = [
        "i_board" => $i_board
    ];

    $result = sel_board($param);
    $view_up = view_up($param);
    $list = sel_com($param);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>리스트</title>
    <link rel="stylesheet" href="css/detail.css">
</head>

<body>
    <div id="container">
        
      <?php include_once "header.php" ?>
        
      <section>
        <div class="contents">
          <div class="tt_head">
            <h1><?=$result["title"]?></h1>
            <p><?=$result["created_at"]?></p>
            <p>작성자 : <?=$result["nm"]?></p>

            <?php if(isset($_SESSION["login_user"])) {
              if ($login_user["i_user"] === $result["i_user"] || $login_user["i_user"] == 1) { ?>
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
                location.href = "tip_del.php?i_board=<?=$result['i_board']?>";
                }
              }
            </script>
          </div>

          <div class="ctnt_box">                    
            <div class="ctnt" name="ctnt">
              <?php if(!$result["img_board"]){ } else{ ?>
                <img class="board_img" src="img/board/<?=$result["img_board"]?>">
                <br>
              <?php } ?>
              
              <?=$result["ctnt"]?>
          </div>
          <hr>
          <!--댓글 시작-->
          <!--댓글 리스트-->
          <div class="comment">
            <?php foreach($list as $item){ ?>
              <ul>
                <div class="com_id"><li><?=$item["nm"]?></li></div>
                <div class="com_ct"><li><?=$item["ctnt"]?></li></div>
                <div class="com_cr"><li><?=$item["created_at"]?></li></div>

                <!--댓글 작성자일 경우 보이는 삭제/수정 버튼-->
                <?php if($result == $item["nm"]){?>
                  <a class="del_com" href="del_com.php?i_board=<?=$item["i_board"]?>&i_com=<?=$item["i_com"]?>">삭제</a>
                <?php } ?>
              </ul>
            <?php } ?>
            <br>
            <!--댓글 작성 구간-->
            <?php if(isset($_SESSION["login_user"])){?>
              <?php $login_user = $_SESSION["login_user"]; $i_user = $login_user["i_user"];?>
                <form action="com_proc.php" method="post">
                  <div class="comment_write">
                    <div class="com_nm"><?=$nm?></div>
                    <input type="hidden" name="i_user" value="<?=$i_user?>">
                    <input type="hidden" name="i_board" value="<?=$i_board?>">
                    <input class="comct" type="text" name="ctnt" maxlength="40" placeholder="간단한 댓글을 남겨보세요(40자이내)">
                    <input class="sub2" type="submit" value="등&nbsp록">
                  </div>
                </form>
            <?php } ?>
          </div>
          <hr>
          <!--목록 버튼(작성자일 경우, 삭제 수정버튼 추가)-->
          <div class="button_end">
            <?php if($result["sel_board"] == '0'){?>
              <input class="sub" type="button" value="목록" onClick="location.href='tip_board.php'">
            <?php } else if($result["sel_board"] == '1'){?>
              <input class="sub" type="button" value="목록" onClick="location.href='img_board.php'">
            <?php } else if($result["sel_board"] == '3'){?>
              <input class="sub" type="button" value="목록" onClick="location.href='notice_board.php'">
            <?php }  ?>
            
            <?php if(isset($_SESSION["login_user"])){ ?>
              <?php if($result["i_user"] === $login_user["i_user"]){ ?>
                <input class="sub" type="button" value="수정" onClick="location.href='tip_mod.php?i_board=<?=$i_board?>'">
                <button class="sub" onclick="isDel();">삭제</button>
              <?php } ?>
            <?php } ?>
          </div>
                
        </div>
      </div>
        <?php include_once "menubar.php";?>

      </section>
    </div>

    <!--삭제시 질문 스크립트-->
    <script>
        function isDel(){
            console.log('isDel 실행됨!!');
            if(confirm('삭제하시겠습니까?')){
                location.href="tip_del.php?i_board=<?=$i_board?>";
            }
        }
    </script>
</body>

</html>