<?php
    include_once "db/db_board.php";
    session_start();
    $login_user = $_SESSION["login_user"];
    
    $i_board = $_GET["i_board"];

    $param = [
        "i_board" => $i_board
    ];

    /*삭제된 후 그 게시판으로 이동을 위해 sel_board값 남김*/
    $back = fork_board($param);
    echo $sel_board = $back["sel_board"];
    $sel_board = $back["sel_board"];

    /*삭제*/
    del_comment($param);
    del_board($param);
    
    /*남은 sel_board값으로 해당 게시판 이동*/
    if($sel_board == 0){
        header("location:tip_board.php");
        die;}
    
    if($sel_board == 1){
        header("location:img_board.php");
        die;}
    
    if($sel_board == 3){
        header("location:notice_board.php");
        die;}
    