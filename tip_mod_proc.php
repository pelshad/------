<?php
    include_once "db/db_board.php";
    session_start();
    $login_user = $_SESSION["login_user"];
    $id = $login_user["i_user"];
    
    $i_user = $_POST["i_user"];
    $i_board = $_POST["i_board"];
    $title = $_POST["title"];
    $ctnt = $_POST["ctnt"];
    $sel_board = $_POST["board_item"];

    echo "1 : " . $i_user;
    echo "1 : " . $i_board;
    echo "1 : " . $title;
    echo "1 : " . $ctnt;
    echo "1 : " . $sel_board;
    
    if($_FILES['image']['name']){
        $imageFullName = strtolower($_FILES['image']['name']);
        $imageNameSlice = explode(".",$imageFullName);
        $imageName = $imageNameSlice[0];
        $imageType = $imageNameSlice[1];
        $image_ext = array('jpg', 'jpeg', 'gif', 'png');
        if(array_search($imageType, $image_ext) === false){
            errMsg('jpg, jpeg, gif, png 확장자만 가능합니다.');
        }
        $dates = date("mdhis",time());
        $newImage = chr(rand(97,112)).chr(rand(97,112)).$dates.rand(1,9).".".$imageType;
        $dir = "img/board/";
        move_uploaded_file($_FILES['image']['tmp_name'],$dir.$newImage);
        chmod($dir.$newImage,0777);
    }  if(!$_FILES['image']['name']){
        $newImage = '';
    }

    if(!$login_user || !$i_user == $id){
        header("location:main_page.php");
    }

    $param = [
        "i_user" => $i_user,
        "i_board" => $i_board,
        "title" => $title,
        "ctnt" => $ctnt,
        "sel_board" => $sel_board,
        "image" => $newImage
    ];

    mod_board($param);
    header("location:tip_detail.php?i_board=$i_board");