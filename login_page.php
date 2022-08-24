
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>로그인</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body>
  <div id="login_page">
    <div class="header"><!--아이디나 비번이 틀렸을 경우 문구가 나타나게-->
      <h1 class="header_txt"><a href="main_page.php">베란다가든</a></h1>
    </div>
  
      <form action="login_proc.php" method="post" id="login_form">
        <div><input type="text" name="user_id" placeholder="아이디"></div>
        <div><input type="password" name="user_pw" placeholder="비밀번호"></div>
        <div><input type="submit" value="로그인"></div>

        <ul class="account_help">
          <li><a href="#">아이디 찾기</a></li>
          <li><a href="#">비밀번호 찾기</a></li>
          <li><a href="join_page.php">회원가입</a></li>
        </ul>
      </form>
  </div>
</body>
</html>