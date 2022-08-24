<style>
a{text-decoration: none;}
header .top{width:100%; height:50px; position: relative; }
header .top_logo a{color:#67B037; font-size:20px; padding:15px 0;}
header .top_menu {position:absolute; right:50px; top:25px;}
header .top_menu a{color:#000; margin-left:15px;}
</style>

<header>
      <div class="top">
        <h1 class="top_logo"><a href="main_page.php">베란다가든</a></h1>
        <div class="top_menu"> <!--로그인 상태일때는 내글보기/내정보/로그아웃-->
          <?php  if(isset($_SESSION["login_user"])) { ?>
            <a href="my_board.php">내글보기</a>
            <a href="info_page.php">내정보</a>
            <a href="logout.php">로그아웃</a>
          <?php } else { ?>
            <a href="login_page.php">LOGIN</a>
            <a href="join_page.php">JOIN</a>
          <?php } ?>
        </div>
      </div>
  
      <div class="top_bn"><!--이미지--></div>
</header>