
<style>
    #main_side {width: 280px; overflow:hidden; margin-left:120px;}
    #lg_side { height: 300px; background-color:#fff; display: flex; 
              border: 1px solid #67B03750; border-radius: 5px;}
    table{margin-top: 15px; font-weight: 100;}
    tbody{background-color: #f5f5f5; border:none; text-align: center;}
    #main_side #menu_bar .main_menu li {line-height: 35px;}
    #main_side #menu_bar ul li span {display:inline-block; width:280px; border-bottom:1px solid #a0a0a0; margin-top:20px;}
    #main_side #menu_bar .main_menu>li {font-size: 18px; }
    #main_side #menu_bar .sub_menu>li>a{ display:inline-block; height:35px; width:280px; font-size:14px; color:rgb(36, 36, 36);}

    #main_side #menu_bar .sub_menu li:hover { background-color:#eaf5e3;}
    
    /* 로그인 후 */
    #lg_side .user_ins { margin: 0 auto; text-align: center; box-sizing: border-box; }    
    #lg_side .user_ins > div { margin-top: 7px; font-size: 1rem; }
    #info_img { display: inline-block; margin: 20px 0 10px 0; }
    .user_ins .info_btn { padding: 15px 0;}
    .user_ins .info_btn a { width: 70px; height: 30px; 
      background-color: #fff; padding: 5px 5px;
      border: 1px solid #67B037; border-radius: 5px; color :#67B037; 
      }

    /* 로그인 전 */
    #login_form { margin-top: 20px; font-size: 1rem; }
    #login_form > div { margin-top: 5px; font-size: 1rem; }
    .user_ins > div > i { margin-top: 30px;} 
    #login_form > div:nth-child(n+1) > input { height: 25px; border: 1px solid #67B037;
      border-radius: 5px; margin-top: 10px; font-size: 1rem; height: 30px;
      padding: 0px 5px; }
    #login_form > div:last-child > input { width: 70px; color :#67B037;
      font-size: 1rem; margin-top: 10px; background-color: #fff;         
      border: 1px solid #67B037; border-radius: 5px; 
    }

  </style>
  <div id="main_side">
    <div id="lg_side"> 
      <!-- position:relativ -->
      <div class="user_ins">
        <!--로그인 상태면 유저정보/ 아니면 "유저정보가 없습니다. (로그인/회원가입)"-->
        <!-- <p>유저정보</p> -->
        <?php if(isset($_SESSION["login_user"])){ ?>
          <form action="profile_proc.php" method="post" enctype="multipart/form-data" id="info_img">
            <?php
              $login_user = $_SESSION["login_user"];
              $session_img = $login_user["profile_img"];
              $profile_img = $session_img == null ? "basic.png" : $login_user["i_user"] . "/" .$session_img;
            ?>
            <div class="circular__img wh40">
              <img src="/project/img/profile/<?=$profile_img?>" width="150">
            </div>
          </form>
          <div><p><?=$login_user["nm"]?>님, 안녕하세요.</p></div>
  
          <div class="info_btn">
            <a href="info_page.php">INFO</a>
            <a href="logout.php">LOGOUT</a>
          </div>
         <?php } else { ?>
          <div><i class="fa-solid fa-seedling fa-3x" style="color:#67B037" ></i></div>
          <!-- absolute -->
          <form action="login_proc.php" method="post" id="login_form">
              <div><input type="text" name="user_id" placeholder="아이디"></div>
              <div><input type="password" name="user_pw" placeholder="비밀번호"></div>
              <div class="l_f1"><input type="submit" value="로그인"></div>
          </form>
          <!-- <div class="joinform">
            <a href="join_page.php"><button>회원가입</button></a>
          </div> -->          
        <?php } ?>
      </div>
    </div>
          
    <nav id="menu_bar">
      <ul class="main_menu">
        <li>
          <span>필독공지</span>
          <ul class="sub_menu">
            <li><a href="notice_board.php">공지사항 click</a></li>
            <li><a href="#">건의사항</a></li>
          </ul>
        </li>

        <li>
          <span>가든 가꾸기</span>
          <ul class="sub_menu">
            <li><a href="#">가든용품</a></li>
            <li><a href="#">화원 / 마켓 정보</a></li>
            <li><a href="tip_board.php">나만의 꿀팁 click</a></li>
            <li><a href="#">식물이 아파요</a></li>
            <li><a href="#">묻고 답하기</a></li>
          </ul>
        </li>

        <li>
          <span>자랑해요</span>
          <ul class="sub_menu">
            <li><a href="img_board.php">반려식물 click</a></li>
            <li><a href="#">우리집 정원</a></li>
            <li><a href="#">성장일기</a></li>
          </ul>
        </li>

        <li>
          <span>식물집사</span>
          <ul class="sub_menu">
            <li><a href="#">식집사님들의 일상</a></li>
            <li><a href="#">수다방</a></li>
          </ul>
        </li>

        <li>
          <span>나눔해요</span>
          <ul class="sub_menu">
            <li><a href="#">나눔/교환</a></li>
            <li><a href="#">나눔/교환 후기</a></li>
            <li><a href="list_gonggu.php">공동구매 click</a></li>
            <li><a href="#">공동구매 후기</a></li>
          </ul>
        </li>     
      </ul>
    </nav>
  </div>  
