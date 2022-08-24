<?php
session_start();
include_once "db/db_board.php";

if(isset($_SESSION["login_user"])){
  $login_user = $_SESSION["login_user"];
  $nm = $login_user["nm"];
  $i_user = $login_user["i_user"];}

    $list = sel_img_main();/*이미지보드 불러오기*/
    $fr_list = sel_board_main();/*모든 글 불러오기*/

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인페이지</title>
    <link rel="stylesheet" href="css/main.css">
    
    <script src="https://kit.fontawesome.com/35a40717bb.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="container">
        <header>
          <div class="top">
            <div class="top_logo">
              <a href="main_page.php"><i class="fa-solid fa-seedling fa-3x" id="logo_icon" style="color:#67B037"></i></a>
            </div>
            <div class="lg_join">
              <!--로그인 상태일때는 내글보기/내정보/로그아웃-->
              <?php if(isset($_SESSION["login_user"])){ ?>
              <p><?=$nm?>님, 안녕하세요.</p>
              <a href="my_board.php"><button>MYBOARD</button></a>
              <a href="info_page.php"><button>INFO</button></a>
              <a href="logout.php"><button>LOGOUT</button></a>
              <?php } else { ?>
                <a href="login_page.php"><button>LOGIN</button></a>
                <a href="join_page.php"><button>JOIN</button></a>
              <?php } ?>
            </div>
          </div>

          <div id="bn">
            <div id="bn_left">
                <div class="left_txt">
                    <p>Hello, Gardener!</p>
                    <h1>베란다 가든에 어서오세요.</h1>
                    <h4>반려식물을 모시는 식집사들의 친목활동, 정보공유를 위한 커뮤니티입니다.</h4>
                </div>

                <div id="search_bar">
                    <form action="result_search_all.php" method="get">
                        <input type="text" placeholder="무엇이든 물어보세요" name="search">
                        <button type="submit" class="search_btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                    </form>
                </div>
            </div>

            <div id="bn_right">
                <h1>오늘의 매거진</h1>
                <div class="right_item">
                    <div class="item-inner clearfix">
                        <h2 class="inner_title">
                            <a href="https://magazine.brique.co/brq-news/%ec%8b%9d%eb%ac%bc%ec%83%9d%ed%99%9c%ea%b0%80%ec%a0%84-lg-%ed%8b%94%ec%9a%b4-%ec%b6%9c%ec%8b%9c/"
                                class="inner_a">
                                뉴스: LG전자, 실내 식물 키워주는 생활가전 ‘LG 틔운tiiun’ 출시 </a>
                        </h2>
                        <div class="post-summary">
                            에디터. 윤정훈&nbsp; 자료. LG 전자
                            서랍장의 손잡이를 당기니 싱그러운 꽃과 채소가 나타난다. 공상과학 영화 속 한 장면 같은 이야기일까?
                            LG전자가 꽃, 채소, 허브 등 다양한 식물을 누구나…
                        </div>

                        <div class="post-meta">
                            <span class="time"><time class="post-published updated"
                                    datetime="2021-10-17T20:22:46+09:00">2021-10-17</time></span>
                        </div>
                    </div>
                </div>

                <div class="item-inner clearfix">
                    <h2 class="inner_title">
                        <a href="https://magazine.brique.co/article/%ec%a7%80%ea%b5%ac%ec%9d%b8%ec%9d%98-%ec%a0%95%ec%9b%90/"
                            class="inner_a">
                            기사: 지구인의 정원
                        </a>
                    </h2>
                    <div class="post-summary">
                        에디터. 김지아&nbsp; 사진. 윤현기&nbsp; 자료. 서울가드닝클럽
                        서울가드닝클럽은 식물과 정원을 기반으로 공간을 만들고 콘텐츠를 기획하는 크리에이티브 스튜디오이다. 흔히 아는 정원뿐 아니라 모르는 정원까지… </div>
                    <div class="post-meta">
                        <span class="time"><time class="post-published updated"
                                datetime="2021-09-28T15:32:51+09:00">2021-09-28</time></span>
                    </div>
                </div>
            </div>
          </div>
        </header>

        <div id="main_contents">
            <div id="board_contents">
                <div id="gell_box">
                    <div class="board_title">
                        <h4>우리집 초록이를 자랑해요</h4>
                        <p><a href="img_board.php">더보기</a></p>
                    </div>
                    <div id="box_inner">
                    <!--이미지 게시판-->
                            <div class="img_ul">
                                <?php foreach($list as $item){ ?>
                                <ul>
                                    <li class="img">
                                        <a href="tip_detail.php?i_board=<?=$item["i_board"]?>">
                                            <?php if(!$item["img_board"]){?>
                                            <img class="size_40" src="img/icon1.png">
                                            <?php }else{ ?>
                                            <img class="size_40" src="img/board/<?=$item["img_board"]?>">
                                            <br>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <hr>
                                    <li class="title"><a
                                            href="tip_detail.php?i_board=<?=$item["i_board"]?>"><?=$item["title"]?></a>
                                        <?php if(!$item["c_cnt"] == 0){?>
                                        <span class="cnt">[<?=$item["c_cnt"]?>]</span>
                                        <?php } ?>
                                    </li>
                                    <li class="nm"><?=$item["nm"]?></li>
                                    <li class="cre"><?=$item["created_at"]?></li>
                                    <li class="view"><span>View</span><?=$item["view_at"]?></li>
                                </ul>
                                <?php } ?>
                            </div>
                    <!--이미지 게시판 끝-->
                    </div>
                </div>
                
                <div id="total_board">
                    <div class="board_title" id="btle">
                        <h4>최신글보기</h4>
                    </div>
                    <!--테이블 시작-->
                    <table>
                        <tr class="tr_line">
                            <th width="80px">NO.</th>
                            <th width="500px">제&nbsp&nbsp&nbsp&nbsp목</th>
                            <th width="100px">작성자</th>
                            <th width="180px">작성일</th>
                            <th width="90px">조회수</th>
                        </tr>
                        <?php foreach($fr_list as $item){ ?>
                        <tr>
                            <td><?=$item["i_board"]?></td>
                            <td class="title"><a
                                    href="tip_detail.php?i_board=<?=$item["i_board"]?>"><?=$item["title"]?></a>
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
            </div>

            <?php include_once "menubar.php"; ?>
            
          <div id="footer">
            <p>식집사들의 이야기 https://www.veranda.com </p>
            <p>VERANDA GARDEN</p>
            <p>H.PROJECT</p>
          </div>

          </div> 

        
        </div>

        
    </div>
</body>

</html>