<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공동구매 폼</title>
    <link rel="stylesheet" href="css/ggform.css">
</head>
<body>
  <div id = "container">
    <?php include_once "header.php" ?>

    <section>
      <div class="contents">
        <h1>공동구매 폼 만들기</h1>
        <form action="gsell_write_proc.php" method="post" id="sell_form">
        <input type="hidden" name="sel_board" value="2">
          <label for="tt" id="title">제목</label>
          <div class="inputarea">
            <input type="text" name="title" id="tt" placeholder="제목을 입력하세요.">
          </div>

          
          <span>상품 정보</span>
          <div class="inputarea">
            <label for="pr_nm">품목명</label>
            <input type="text" name="product_nm" id="pr_nm">

            <label for="price">가&nbsp&nbsp&nbsp격</label>
            <input type="text" name="price" id="price">
          </div>

          <span>신청 기간</span>
          <div class="inputarea">
            <input type="date" name="start_day"> ~ <input type="date" name="end_day">
            
          </div>
 
          <span>은행 정보</span>
          <div class="inputarea">
            <p>* 입금받으실 은행정보를 입력해주세요.</p>
            <input type="text" name="bank_nm" id="bnm" placeholder="은행명">
            <input type="text" name="bank_num" id="bnum" placeholder="계좌번호">
            <input type="text" name="bank_sell_user"  id="inm" placeholder="예금주명">
          </div>

          <div class="ctnt">
            <span>상세 설명</span>
            <textarea name="ctnt" placeholder=" 구매 및 구매품목에 대한 설명(관련링크첨부가능)을 입력하세요."></textarea>
          </div>

          <input class="btn" type="submit" value="등록하기">
          <a href="gonggu_list.php" class="btn" >목록으로</a>
        </form>
        
        
      </div>

      <?php include_once "menubar.php"; ?>  
    
    </section>
  </div>
</body>
</html>