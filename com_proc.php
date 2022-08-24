<?php
    include_once "db/db_board.php";
    $i_user = $_POST["i_user"];
    $i_board = $_POST["i_board"];
    $ctnt = $_POST["ctnt"];

    echo " user : " . $i_user;
    echo " board : " . $i_board;
    echo " ctnt : " . $ctnt;

    $param = [
        "i_user" => $i_user,
        "i_board" => $i_board,
        "ctnt" => $ctnt
    ];

    $result = ins_comct($param);
    up_comct($param);
    header("location:tip_detail.php?i_board=$i_board");