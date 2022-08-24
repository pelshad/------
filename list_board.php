<?php   
    include_once "db/db_board.php";

    session_start();
    $nm = "";

    $page = 1;
    $row_count_list = array(7, 14, 21, 28); //보여줄 행의 개수 리스트

    if(isset($_GET["page"])) {       
        $page = intval($_GET["page"]);
    }     
    if(isset($_SESSION["login_user"])) {
        $login_user = $_SESSION["login_user"];
        $nm = $login_user["nm"];
    }

    //현재 페이지에서 보여줄 행 개수 초기화하는 곳
    if(isset($_POST['board_list_count'])){   
        $row_count = $_POST['board_list_count'];
    }
    else{
        $row_count = $row_count_list[0];
    }

    $param = [
        "row_count" => $row_count,
        "start_idx" => ($page - 1) * $row_count,
    ];
    $paging_count = sel_paging_count($param);

    $max_page_count = 4; //표시할 페이지 넘버 수
    $start_page_count = intval(($page - 1) / $max_page_count) * $max_page_count + 1;
    $max_page_count = $start_page_count + $max_page_count - 1;
    if($max_page_count > $paging_count){
        $max_page_count = $paging_count;
    }

    $list = sel_board_list($param);
    //검색버튼을 눌렀거나, 검색어가 존재한다면
    if(isset($_POST['search_input_txt']) && $_POST['search_input_txt'] != ""){
        //파라미터에 추가해준다
        $param += [
            "search_select" => $_POST["search_select"], //select박스 value값
            "search_input_txt" => $_POST["search_input_txt"] //검색어
        ];
        //DB조회 전달 후 결과 list를 받아온다
        $list = sea_board($param);
    }

    //select value값에 따라 select 설정해주는 함수
    function select_check($row_count, $count)
    {
        if($row_count == $count){
            return "<option value=".$count." selected>";
        }
        return "<option value=".$count.">";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="common.css">
    <title>리스트</title>
</head>
<body>
    <div id="container">
      <?php include_once "header.php" ?>
        <main>
            <h1>리스트</h1>
            <div>
                <form method="POST">
                    <select name="board_list_count" onchange="this.form.submit()">
                        <?php
                            foreach ($row_count_list as $count) {
                                // <option value="$row_count_list[$i]">$row_count_list[$i]."개"</option>
                                echo select_check($row_count, $count).$count."개</option>";
                            }
                        ?>
                    </select>
                </form>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>글번호</th>
                        <th>제목</th>
                        <th>글쓴이</th>
                        <th>등록일시</th>
                        <th>조회수</th>
                    </tr>
                </thead>
                <tbody>                    
                    <?php foreach($list as $item) { ?>
                        <tr>
                            <td><?=$item["i_board"]?></td>
                            <td><a href="detail.php?i_board=<?=$item["i_board"]?>"><?=$item["title"]?></a></td>
                            <td><?=$item["nm"]?></td>
                            <td><?=$item["created_at"]?></td>
                            <td><?=$item["clickedCt"]?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div>
                <?php if($page != 1) {?>
                <button onclick="location.href='list.php?page=<?=$page-1?>'">prev</button>
                <?php }?>
            <?php
            for($i=$start_page_count; $i<=$max_page_count; $i++) { ?>
                <span class="<?=$i===$page ? "pageSelected" : ""?>">
                    <a href="list.php?page=<?=$i?>"><?=$i?></a>
                </span>
            <?php } ?>
                <?php if($page != $paging_count) {?>
                <button onclick="location.href='list.php?page=<?=$page+1?>'">next</button>
                <?php }?>
            </div>
            <form method="POST" action="list.php">
                <div>
                    <select name="search_select">
                        <option value="search_writer">작성자</option>
                        <option value="search_title">제목</option>
                        <option value="search_ctnt">제목+내용</option>
                    </select>
                    <div>
                        <input type="text" name="search_input_txt">
                        <input type="submit" value="검색">
                    </div>
                </div>
            </form>


        </main>
    </div>
</body>
</html>