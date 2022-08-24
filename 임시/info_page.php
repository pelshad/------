<?php
    include_once "db/db_user.php";

    session_start();
    $login_user = $_SESSION["login_user"];
    $i_user = $login_user["i_user"];

    $user_pre_pw = $login_user["user_pw"];
    $param = [
      "i_user" => $i_user
    ];
    $result = sel_info($param);
    foreach ($result as $items){
        $uid = $items['user_id'];
        $upw = $items['user_pw'];
        $nm = $items['nm'];
        $user_num = $items['user_num'];
        $bank_nm = $items['bank_nm'];
        $bank_num = $items['bank_num'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/info.css">
    <title>회원정보 수정</title>
</head>
<body>
<div id="info_page">
    <div class="header">
      <h1 class="header_txt"><a href="main_page.php">베란다가든</a></h1>
    </div>
    <form action="profile_proc.php" method="post" enctype="multipart/form-data" id="info_img">
      <?php
        $session_img = $_SESSION["login_user"]["profile_img"];
        $profile_img = $session_img == null ? "basic.png" : $_SESSION["login_user"]["i_user"] . "/" .$session_img;
      ?>
      <div class="circular__img wh40">
        <img src="/project/img/profile/<?=$profile_img?>" width="150">
       
        <div class="f_img">
          <div>
            <input type="submit" value="이미지 업로드">
            <label><input type="file" name="img" accept="image/*" value="이미지 선택"></label>
          </div>
        </div>
      </div>
    </form>

    <form action="info_proc.php" method="post" id="info_form">
      <div class="user_info">
        <div>
          <input type="hidden" name="i_user" value="<?=$i_user?>">
          <p>아이디</p>
          <input type="text" name="user_id" placeholder="아이디(이메일주소)" value="<?=$uid?>" readonly/>
        </div>
        
        <div>
            <p>이름</p>
            <input type="text" name="nm" placeholder="이름" value="<?=$nm?>">
        </div>

        <div>
            <p>연락처</p> 
            <input type="tel" name="user_num" placeholder="연락처" value="<?=$user_num?>">
        </div>
        <div>
            <p>은행명</p>            
            <input type="text" name="bank_nm" placeholder="은행명" value="<?=$bank_nm?>">
        </div>
        <div>
            <p>계좌번호</p>
            <input type="text" name="bank_num" placeholder="계좌번호" value="<?=$bank_num?>">
        </div>
      </div>

      <div class="pw_area">
        <input type="checkbox" id="ck_btn">
        <label for="ck_btn" class="pw_tt"> >> 비밀번호 수정하기</label>
        <div class="pw_input">
          <input type="password" name="user_pw" placeholder="비밀번호" value="<?=$upw?>" onfocus="this.value=''">
          <input type="password" name="confirm_pw" placeholder="비밀번호 확인" value="<?=$upw?>" onfocus="this.value=''">
        </div>

        <?php
            if($upw !== $confirm_pw && !empty($confirm_pw)){
              print "<p>입력하신 비밀번호가 다릅니다.</p>";
            }
        ?> 
        
        
      </div>

      <div class="info_btn">
        <input type="submit" value="저장하기">
      </div>
    </form>
  </div>
</body>
</html>
