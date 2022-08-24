<?php
    include_once "db/db_board.php";
    
    session_start();
    $login_user = $_SESSION["login_user"];
    $i_user = $login_user["i_user"];


    $title = $_POST["title"];
    $ctnt = $_POST["ctnt"];
    $sel_board = $_POST["board_item"];

    if(!$sel_board){
        echo "게시판을 선택해주세요.";
    }

    /* 파일 올리기 */
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
    
    $param = [
        "i_user" => $i_user,
        "title" => $title,
        "ctnt" => $ctnt,
        "sel_board" => $sel_board,
        "image" => $newImage
    ];
    
    $result = ins_board($param);

    if($sel_board == 0){
        header("location:tip_board.php");
        die;
    }

    if($sel_board == 1){
    header("location:img_board.php");
    die;}

    if($sel_board == 3){
    header("location:notice_board.php");
    die;}
