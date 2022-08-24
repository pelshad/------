<?php
    include_once "db/db_board.php";
    session_start();
    $login_user = $_SESSION["login_user"];
    $id = $login_user["i_user"];

    $i_board = $_GET["i_board"];
    $param = [
        "i_board" => $i_board
    ];

    $result = sel_board($param);

    

    /*if(!$id == $result["i_user"]){
        header("location:main_page.php");
    }*/

   ?> 
<!-- 게시판별 넘버링(임시)
    나만의 꿀팁(자유게시판 형식) 0
    반려식물(사진게시판 형식) 1
    정모(자유게시판?) 2
    공지 3-->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>글수정</title>
  <link rel="stylesheet" href="css/write.css">
</head>
<body>
  <div class="container">
    <header>
    <?php include_once "header.php" ?>
    </header>
    
    <section>
      <div id="write_box">
        <h1>글수정</h1>
        <form action="tip_mod_proc.php?i_board=<?=$result["i_board"]?>" name="write" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="board_item" value="<?=$result["sel_board"]?>">
          <input type="hidden" name="i_user" value="<?=$result["i_user"]?>">
          <input type="hidden" name="i_board" value="<?=$result["i_board"]?>">
          <div class="titlebox"><input type="text" name="title" placeholder="제목을 입력해주세요." value="<?=$result["title"]?>"></div>
          <div class="upload_img"><input type="file" name="image" accept="image/*">
          <?php if(isset($result["img_board"])){?>
          <span class="file">등록된 파일 : <?=$result["img_board"]?></span>
          <?php } ?>
          </div>
          <div class="ctntbox"><textarea name="ctnt" placeholder="내용을 입력하세요."><?=$result["ctnt"]?></textarea></div>

          <div class="write_btn">
            <input class="sub" type="submit" value="수정">
            <!--<button class="sub">임시저장</button>-->
          </div>
        </form>
      </div>
      <?php include_once "menubar.php";?>
    </section>
  </div>
</body>
</html>