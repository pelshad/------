<?php
    include_once "db/db_user.php";

    $confirm_pw = $_POST["confirm_pw"];
    $upw = $_POST["user_pw"];
    
    if($upw === $confirm_pw){
        $uid = $_POST["user_id"];
        $nm = $_POST["nm"];
        $user_num = $_POST["user_num"];
        $bank_nm = $_POST["bank_nm"];
        $bank_num = $_POST["bank_num"];
        $i_user = $_POST["i_user"];

        $param = [
            "user_id" => $uid ,
            "user_pw" => $upw ,
            "confirm_pw" => $confirm_pw ,
            "nm" => $nm ,
            "user_num" => $user_num ,
            "bank_nm" => $bank_nm ,
            "bank_num" => $bank_num ,
            "i_user" => $i_user
        ];

        $result = upd_info($param);
        if($result){
            header("location:main_page.php");
        }
    }
    else {
        header("location:info_page.php");
    }