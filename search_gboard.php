<?php
    include_once "db/db_gsell.php";
    $cat = $_GET["cat"];
    $search = $_GET["search"];


    if($cat === 'title'){
        $keyword = '제목';
    } else if($cat === 'nm'){
        $keyword = '작성자';
    }

    $page = 1;
    if(isset($_GET["page"])){
        $page = intval($_GET["page"]);
    }
    $row_count = 10;

    $param = [
        "row_count" => $row_count,
        "start_idx" => ($page - 1) * $row_count,

        "cat" => $cat,
        "search" => $search,
    ];

    $list = sea_gboard($param);
    $paging_count = search_paging_count($param);
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
    <h2>[공구게시판] 게시판에서 [<?=$keyword?>]으로 '<?=$search?>'를 검색한 결과</h2>

    <table>
    <tr class="tr_line">
        <th width="80px">글번호</th>
        <th width="500px">제&nbsp&nbsp&nbsp&nbsp목</th>
        <th width="100px">작성자</th>
        <th width="180px">작성일</th>
        <th width="90px">조회수</th>
    </tr>
    <?php
    foreach($list as $item){?>
        <tr>
        <td><?=$item["i_gonggu"]?></td>
        <td class="title"><a
            href="tip_detail.php?i_gonggu=<?=$item["i_gonggu"]?>"><?=$item["title"]?></a>
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
    <div class="page">
    <?php for($i=1; $i<=$paging_count; $i++) { ?>
    <span class="<?=$i===$page ? "pageSelected" : ""?>">
    <a href="result_search.php?cat=<?=$cat?>&sel_board=<?=$sel_board?>&search=<?=$search?>&page=<?=$i?>"><?=$i?></a>
    </span>
    <?php } ?>
            </div>
            </div>
            <?php include_once "menubar.php";?>
    </section>
    
</div>
</body>
</html>