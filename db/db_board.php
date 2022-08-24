<?php
    include_once "db_connect.php";

    /* 꿀팁게시판 리스트 */
    function sel_tip_list($param){
        $conn = get_conn();
        $start_idx = $param["start_idx"];
        $row_count = $param["row_count"];
        $sql = "SELECT A.i_user, A.i_board, A.title, A.created_at, A.view_at, B.nm, A.c_cnt, A.sel_board
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE sel_board = 0
                ORDER BY i_board DESC
                LIMIT $start_idx, $row_count
                ";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }
    function tip_paging_count(&$param){
        $conn = get_conn();
        $row_count = $param["row_count"];
        $sql = "SELECT CEIL(COUNT(i_board) / $row_count) as cnt
                FROM t_board
                WHERE sel_board = 0";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $row = mysqli_fetch_assoc($result);
        return $row["cnt"];
    }

    /* 이미지 게시판 리스트*/
    function sel_img_list($param){
        $conn = get_conn();
        $start_idx = $param["start_idx"];
        $row_count = $param["row_count"];
        $sql = "SELECT A.i_user, A.i_board, A.title, A.created_at, A.view_at, A.img_board, A.c_cnt, A.sel_board,
                     B.nm
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE sel_board = 1
                ORDER BY i_board DESC
                LIMIT $start_idx, $row_count
                ";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }
    function img_paging_count(&$param){
        $conn = get_conn();
        $row_count = $param["row_count"];
        $sql = "SELECT CEIL(COUNT(i_board) / $row_count) as cnt
                FROM t_board
                WHERE sel_board = 1";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $row = mysqli_fetch_assoc($result);
        return $row["cnt"];
    }
    /*공지사항 리스트*/
    function sel_notice_list($param){
        $conn = get_conn();
        $start_idx = $param["start_idx"];
        $row_count = $param["row_count"];
        $sql = "SELECT A.i_user, A.i_board, A.title, A.created_at, A.view_at, B.nm, A.c_cnt, A.sel_board
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE sel_board = 3
                ORDER BY i_board DESC
                LIMIT $start_idx, $row_count
                ";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }
    function notice_paging_count(&$param){
        $conn = get_conn();
        $row_count = $param["row_count"];
        $sql = "SELECT CEIL(COUNT(i_board) / $row_count) as cnt
                FROM t_board
                WHERE sel_board = 3";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $row = mysqli_fetch_assoc($result);
        return $row["cnt"];
    }
    function top_notice(){
        $conn = get_conn();
        $sql = "SELECT A.i_user, A.i_board, A.title, A.created_at, A.view_at, B.nm, A.c_cnt
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE sel_board = 3
                ORDER BY i_board DESC
                LIMIT 3
                ";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }
    

    
    /*글 작성*/
    function ins_board(&$param){
        $conn = get_conn();
        $i_user = $param["i_user"];
        $title = $param["title"];
        $ctnt = $param["ctnt"];
        $newImage = $param["image"];
        $sel_board = $param["sel_board"];
        $sql = "INSERT INTO t_board
                (i_user, title, ctnt, sel_board, img_board)
                VALUES
                ('$i_user', '$title', '$ctnt', '$sel_board', '$newImage')";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    /* 디테일 */
    function sel_board(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $sql = "SELECT A.i_user, A.i_board, A.title, A.created_at, A.view_at, A.ctnt, 
                       A.img_board, A.sel_board, B.nm
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE i_board = '$i_board'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return mysqli_fetch_assoc($result);
    }

    /*조회수*/
    function view_up(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $sql = "UPDATE t_board
                SET view_at = view_at + 1
                WHERE i_board = $i_board
                ";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    /* 삭제 */
    function del_comment(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $sql = "DELETE from t_com
                WHERE i_board = '$i_board'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    function del_board(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $sql = "DELETE from t_board 
                WHERE i_board = '$i_board'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }
    
    /*삭제 이후 그 보드로 이동*/
    function fork_board(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $sql = "SELECT sel_board from t_board 
                WHERE i_board = '$i_board'";
        $back = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return mysqli_fetch_assoc($back);
    }

    /*업데이트*/
    function mod_board(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $title = $param["title"];
        $ctnt = $param["ctnt"];
        $sel_board = $param["sel_board"];
        $img_board = $param["image"];
        $sql = "UPDATE t_board
                SET title = '$title', ctnt = '$ctnt', sel_board = '$sel_board', img_board = '$img_board'
                WHERE i_board = '$i_board'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    /*댓글 작성 */
    function ins_comct(&$param){
        $conn = get_conn();
        $i_user = $param["i_user"];
        $i_board = $param["i_board"];
        $ctnt = $param["ctnt"];
        $sql = "INSERT INTO t_com
                (i_board, i_user, ctnt)
                VALUES
                ('$i_board', '$i_user', '$ctnt')";
        
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    function up_comct(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $sql = "UPDATE t_board
                SET c_cnt = c_cnt + 1
                WHERE i_board = '$i_board'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    /*댓글리스트*/
    function sel_com(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $sql = "SELECT A.*, B.nm FROM t_com A
                inner join t_user B
                on A.i_user = B.i_user
                WHERE i_board = $i_board";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    /*댓글 삭제*/
    function del_com(&$param){
        $conn = get_conn();
        $i_com = $param["i_com"];
        $i_board = $param["i_board"];
        $sql = "DELETE FROM t_com WHERE i_com = '$i_com'";
        $dn_cnt = "UPDATE t_board
                   SET c_cnt = c_cnt - 1
                   WHERE i_board = '$i_board'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    function dn_comct(&$param){
        $conn = get_conn();
        $i_board = $param["i_board"];
        $sql = "UPDATE t_board
                SET c_cnt = c_cnt - 1
                WHERE i_board = '$i_board'";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    /* 게시판 검색 */
    function sea_board(&$param){
        $conn = get_conn();
        $cat = $param["cat"];
        $search = $param["search"];
        $sel_board = $param["sel_board"];
        $row_count = $param["row_count"];
        $start_idx = $param["start_idx"];
        $sql = "SELECT * FROM t_board A
                inner join t_user B
                ON A.i_user = B.i_user
                WHERE $cat like '%$search%' AND sel_board = '$sel_board'
                LIMIT $start_idx, $row_count";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    /* 게시판 검색 페이징 */
    function search_paging_count(&$param){
        $conn = get_conn();
        $cat = $param["cat"];
        $search = $param["search"];
        $sel_board = $param["sel_board"];
        $row_count = $param["row_count"];
        $sql = "SELECT CEIL(COUNT(i_board) / $row_count) as cnt
                FROM t_board A
                inner join t_user B
                ON A.i_user = B.i_user
                WHERE $cat like '%$search%' AND sel_board = '$sel_board'"
                ;
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $row = mysqli_fetch_assoc($result);
        return $row["cnt"];
    }

    /*메인 페이지 이미지 게시판 */
    function sel_img_main(){
        $conn = get_conn();
        $sql = "SELECT A.i_user, A.i_board, A.title, A.created_at, A.view_at, A.img_board, A.c_cnt, A.sel_board,
                     B.nm
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE sel_board = 1
                ORDER BY i_board DESC
                LIMIT 4
                ";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }


    /*전체 게시글보기*/
    function sel_board_main(){
        $conn = get_conn();
        $sql = "SELECT A.i_user, A.i_board, A.title, A.created_at, A.view_at, B.nm, A.c_cnt, A.sel_board
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                ORDER BY i_board DESC
                LIMIT 10
                ";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }


    /*전체검색*/
    function sea_board_all(&$param){
        $conn = get_conn();
        $search = $param["search"];
        $row_count = $param["row_count"];
        $start_idx = $param["start_idx"];
        $sql = "SELECT * FROM t_board A
                inner join t_user B
                ON A.i_user = B.i_user
                WHERE title like '%$search%'
                LIMIT $start_idx, $row_count";
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

    /* 전체검색 페이징 */
    function searchall_paging_count(&$param){
        $conn = get_conn();
        $search = $param["search"];
        $row_count = $param["row_count"];
        $sql = "SELECT CEIL(COUNT(i_board) / $row_count) as cnt
                FROM t_board A
                inner join t_user B
                ON A.i_user = B.i_user
                WHERE title like '%$search%'"
                ;
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        $row = mysqli_fetch_assoc($result);
        return $row["cnt"];
    }
    /* 내글보기 */
    function sel_my_board(&$param){
      $conn = get_conn();
      $i_user = $param["i_user"];
      $sql = "  SELECT A.i_board, A.title, A.c_cnt, A.created_at, A.view_at, B.nm
                FROM t_board A
                INNER JOIN t_user B
                ON A.i_user = B.i_user
                WHERE A.i_user = '$i_user'";
      $result = mysqli_query($conn, $sql);
      mysqli_close($conn);
      return $result;
    }
