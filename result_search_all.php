<?php
    include_once "db/db_board.php";
    session_start();

    if(isset($_SESSION["login_user"])){
      $login_user = $_SESSION["login_user"];
      $nm = $login_user["nm"];
    } 
    $search = $_GET["search"];

    $page= 1;
    if(isset($_GET["page"])){
        $page = intval($_GET["page"]);
    }

    $row_count = 10;

    $param = [
        "row_count" => $row_count,
        "start_idx" => ($page - 1) * $row_count,
        "search" => $search
    ];

    $list = sea_board_all($param);
    $paging_count = searchall_paging_count($param);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/board_list.css">
</head>


<body>
<div id="board_body">
        <header>
            <?php include_once "header.php" ?>
        </header>

        <section>
        <div class="contents">
        <h2>'<?=$search?>'를 검색한 결과</h2>
    <table>
    <tr class="tr_line">
        <th width="80px">글번호</th>
        <th width="500px">제&nbsp&nbsp&nbsp&nbsp목</th>
        <th width="100px">작성자</th>
        <th width="80px">게시판</th>
        <th width="180px">작성일</th>
        <th width="90px">조회수</th>
    </tr>
    <?php
    foreach($list as $item){?>
        <tr>
        
        <td class="board_num"><?=$item["i_board"]?></td>
        <td class="title"><a
            href="tip_detail.php?i_board=<?=$item["i_board"]?>"><?=$item["title"]?></a>
            <?php if(!$item["c_cnt"] == 0){?>
            <span class="cnt">[<?=$item["c_cnt"]?>]</span>
            <?php } ?>
        </td>
        <td><?=$item["nm"]?></td>
        <td class="board">
            <?php if($item["sel_board"] == 0){
                echo "꿀팁";
            } else if($item["sel_board"] == 1){
                echo "반려식물";
            } else if($item["sel_board"] == 3){
                echo "공지사항";
            }?>
         </td>
        <td><?=$item["created_at"]?></td>
        <td><?=$item["view_at"]?></td>
        </tr>
        <?php } ?>
    </table>
    <!-- 페이징 -->
    <div class="page">
        <?php for($i=1; $i<=$paging_count; $i++) { ?>
        <span class="<?=$i===$page ? "pageSelected" : ""?>">
        <a href="result_search_all.php?search=<?=$search?>&page=<?=$i?>"><?=$i?></a>
        </span>
        <?php } ?>
    </div>
        </div>
        <?php include_once "menubar.php";?>
    </section>
    
</div>
</body>
</html>