<?php
    include_once "db/db_user.php";
    session_start();
    
    define("PROFILE_PATH", "img/profile/"); 

    $login_user = $_SESSION["login_user"];  

    //var_dump($_FILES); 확인용

    if($_FILES["img"]["name"] === "") {
       echo "<script>alert('이미지를 선택해주세요.')</script>";
        echo "<script>history.back();</script>";
        
    } else {

    function gen_uuid_v4() {  
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x'
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0x0fff) | 0x4000
            , mt_rand(0, 0x3fff) | 0x8000
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff)
            , mt_rand(0, 0xffff) 
        ); 
    }
    $img_name = $_FILES["img"]["name"];        
    $last_index = mb_strrpos($img_name, ".");  
    $ext = mb_substr($img_name, $last_index);

    $target_filenm = gen_uuid_v4() . $ext; 

    $target_full_path = PROFILE_PATH . $login_user["i_user"];  
    if(!is_dir($target_full_path)) {
        mkdir($target_full_path, 0777, true);       
    }

    $tmp_img = $_FILES['img']['tmp_name'];
    $imageUpload = move_uploaded_file($tmp_img, $target_full_path . "/" .$target_filenm);

    if($imageUpload) {         
        if($login_user["profile_img"]) {
            $saved_img = $target_full_path . "/" . $login_user["profile_img"];  
            if(file_exists($saved_img)) {   
                unlink($saved_img);
            }
        }

        $param = [
            "profile_img" => $target_filenm,
            "i_user" => $login_user["i_user"]
        ];

        $result = upd_profile_img($param);
        $login_user["profile_img"] = $target_filenm;
        $_SESSION["login_user"] = $login_user;
        Header("Location: info_page.php");
    }
 }