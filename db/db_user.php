<?php
    include_once "db_connect.php";

    //회원가입
    function ins_user(&$param){
        $uid = $param["user_id"];
        $upw = $param["user_pw"];
        $nm = $param["nm"];
        $user_num = $param["user_num"];

        $sql = "INSERT INTO t_user
                (user_id, user_pw, nm, user_num )
                VALUES
                ('$uid', '$upw', '$nm', '$user_num')";
        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }

   //아이디 체크
    function id_check(&$param)
    {
      $uid = $param['user_id'];
      $sql = "SELECT *
             from t_user
             where user_id = '$uid'
      ";
      $conn = get_conn();
      $row = mysqli_query($conn, $sql);
       $result = mysqli_fetch_assoc($row);
      mysqli_close($conn); 
       if(isset($result['user_id'])) {
         return true;
        } else {
         return false;
      }
    }
   
    //로그인
    function sel_user(&$param){
        $uid = $param["user_id"];
        $upw = $param["user_pw"];

        $sql = "SELECT *
                  FROM t_user
                WHERE user_id = '$uid'
                ";
        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return mysqli_fetch_assoc($result);
    }


    // 회원정보 수정페이지

    function upd_info(&$param) {    
        $uid = $param["user_id"];
        $upw = $param["user_pw"];
        $confirm_pw = $param["confirm_pw"];
        $nm = $param["nm"];
        $user_num = $param["user_num"];
        $bank_nm = $param["bank_nm"];
        $bank_num = $param["bank_num"];
        $i_user = $param["i_user"];

        $sql = 
        "   UPDATE t_user 
               SET user_id = '$uid'
               , user_pw = '$upw'
               , nm = '$nm'
               , user_num ='$user_num'
               , bank_nm = '$bank_nm'
               , bank_num = '$bank_num'
               , updated_at = now()
            WHERE i_user = $i_user    
        ";
        $conn = get_conn();
        $result = mysqli_query($conn, $sql);
        mysqli_close($conn);
        return $result;
    }
    
// 프로필사진     
 function upd_profile_img(&$param) {
    $sql = "UPDATE t_user 
               SET profile_img = '{$param["profile_img"]}' 
             WHERE i_user = {$param["i_user"]}";
    $conn = get_conn();
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
 }

  // 정보수정 비밀번호 체크
  function sel_info(&$param){
    $conn = get_conn();
    $i_user = $param['i_user'];
    $sql = "SELECT * FROM t_user WHERE i_user = '$i_user'";

    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
  }
