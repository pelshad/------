<!-- 게시판별 넘버링(임시)
     나만의 꿀팁(자유게시판 형식) 0
     반려식물(사진게시판 형식) 1
     정모(자유게시판?) 2
     공지 3-->
<?php
  session_start();
  // $login_user = $_SESSION["login_user"];
  // $i_user = $login_user;

  if(isset($_SESSION["login_user"])){
    $login_user = $_SESSION["login_user"];
    $nm = $login_user["nm"];
  } 
  else {
    echo "<script>history.back()</script>";
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>글쓰기</title>
  <link rel="stylesheet" href="css/write.css">
</head>
<body>
  <div class="container">
    <header>
    <?php include_once "header.php" ?>
    </header>
    
    <section>
      <div id="write_box">
        <h1>글쓰기</h1>
        <form action="write_proc.php" name="write" method="POST" enctype="multipart/form-data">
          <select name="board_item" class="board_item">
            <option value="">카테고리</option>
            <?php if($i_user["i_user"] == 1){?>
            <option value="3">공지사항</option> <!--관리자만 가능-->
            <?php } ?>
            <option value="0">나만의 꿀팁</option>
            <option value="1">반려식물</option>

          </select>
          <div class="titlebox"><input type="text" name="title" placeholder="제목을 입력해주세요."></div>
          <div class="upload_img">
            <input type="file" name="image" accept="image/*" onchange="readURL(this);">
            <div class="imgbox"><img id="preview" width="150" height="150"/></div>
          </div>
          <div class="ctntbox"><textarea name="ctnt" placeholder="내용을 입력하세요."></textarea></div>
          <div class="write_btn">
            <input class="sub" type="submit" value="등록">
            <!--<button class="sub">임시저장</button>-->
          </div>
        </form>

      </div>
      <?php include_once "menubar.php"; ?>  
    </section>
  </div>
  <!-- 파일 미리보기 -->
  <script>
    function readURL(input) {
    if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      document.getElementById('preview').src = e.target.result;
    };
    reader.readAsDataURL(input.files[0]);
    } else {
    document.getElementById('preview').src = "";
    }
    }
  </script>
</body>
</html>