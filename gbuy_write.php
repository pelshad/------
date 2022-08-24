<?php
  include_once "db/db_gsell.php";
  session_start();
  
  $i_gonggu = $_GET["i_gonggu"];
  $param = [
    "i_gonggu" => $i_gonggu
  ];

  $item = sel_gboard($param);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>공구 신청서 작성하기</title>
    <link rel="stylesheet" href="css/gbuyform.css">
</head>
<body>
  <div id = "container">
    
    <?php include_once "header.php";?>
    
    <section>
      <div class="contents">
        <h1>신청하기</h1>
        <!--===========신청폼 영역=============-->
        <form action="gbuy_write_proc.php" method="post" id ="buy_form" class="buy_form">
          <input type="hidden" name="i_gonggu" value="<?=$i_gonggu?>">
          <h2><?=$item["title"]?></h2> 

          <div class="pd_area">
            <div>상품명 : <?=$item["product_nm"]?></div>
            <div>가격 : <?=$item["price"]?></div>
            <div><?=$item["start_day"]?> ~ <?=$item["end_day"]?></div>

            <p>* 입금 후 폼 작성 바랍니다.</p>
            <div>
            <?=$item["bank_nm"]?> <?=$item["bank_num"]?> <?=$item["bank_sell_user"]?>
            </div>
          </div>

          <div class="buy_inv">
            <h4>구매수량</h4>
            <div class="inv_area">
              <div class="pd_nm"><?=$item["product_nm"]?></div>
              <div class="number-input">
                <input type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()" value="-">
                <input class="quantity" min="0" name="buy_inv" value="1" type="number">
                <input type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus" value="+">
              </div>
            </div>
          </div>

          <div class="buyuser_info">
            <div class="user_info">
              <h4>주문자 정보<span>*</span></h4>
              <input type="text" name="buy_unm" placeholder="주문자명">
              <input type="text" name="user_number" placeholder="주문자 핸드폰 번호" value="">
            </div>

            <div class="user_bank">
              <h4>입금 정보<span>*</span></h4>
              <input type="text" name="bank_user" placeholder="입금자명">
              <input type="text" name="buy_price" placeholder="입금액">

              <p>환불계좌 정보 (공동구매 무산 등의 경우) <span>*</span> </p>
              <input type="text" name="bank_nm" placeholder="은행명" value="">
              <input type="text" name="bank_num" placeholder="계좌번호" value="">
              <input type="text" name="bank_user" placeholder="예금주명">
            </div>

            <div class="user_addr">
              <h4>배송지 정보 <span>*</span></h4>
              <input type="text" name="pickup_nm" placeholder="수령자명" value="">
              <input type="text" name="addr_num" id="sample6_postcode" placeholder="우편번호">
              <input type="button" onclick="sample6_execDaumPostcode()" value="우편번호 찾기"><br>
              <input type="text" name="addr" id="sample6_address" placeholder="주소"><br>
              <input type="text" name="addr_part"id="sample6_detailAddress" placeholder="상세주소">
              <input type="text" id="sample6_extraAddress" placeholder="참고항목">

              <script src="//t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
              <script>
                  function sample6_execDaumPostcode() {
                      new daum.Postcode({
                          oncomplete: function(data) {
                              // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                              // 각 주소의 노출 규칙에 따라 주소를 조합한다.
                              // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                              var addr = ''; // 주소 변수
                              var extraAddr = ''; // 참고항목 변수

                              //사용자가 선택한 주소 타입에 따라 해당 주소 값을 가져온다.
                              if (data.userSelectedType === 'R') { // 사용자가 도로명 주소를 선택했을 경우
                                  addr = data.roadAddress;
                              } else { // 사용자가 지번 주소를 선택했을 경우(J)
                                  addr = data.jibunAddress;
                              }

                              // 사용자가 선택한 주소가 도로명 타입일때 참고항목을 조합한다.
                              if(data.userSelectedType === 'R'){
                                  // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                                  // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                                  if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                                      extraAddr += data.bname;
                                  }
                                  // 건물명이 있고, 공동주택일 경우 추가한다.
                                  if(data.buildingName !== '' && data.apartment === 'Y'){
                                      extraAddr += (extraAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                                  }
                                  // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                                  if(extraAddr !== ''){
                                      extraAddr = ' (' + extraAddr + ')';
                                  }
                                  // 조합된 참고항목을 해당 필드에 넣는다.
                                  document.getElementById("sample6_extraAddress").value = extraAddr;
                              
                              } else {
                                  document.getElementById("sample6_extraAddress").value = '';
                              }

                              // 우편번호와 주소 정보를 해당 필드에 넣는다.
                              document.getElementById('sample6_postcode').value = data.zonecode;
                              document.getElementById("sample6_address").value = addr;
                              // 커서를 상세주소 필드로 이동한다.
                              document.getElementById("sample6_detailAddress").focus();
                          }
                      }).open();
                  }
              </script>
            </div>
          </div>

          <h4>메모</h4>
          <div class="memo">
            <textarea name="memo" value="공구주에게 전할 말을 입력하세요.(비우기 가능)"></textarea>
          </div>
          <input class="btn" type="submit" value="신청하기">
          <a href="list_gonggu.php" class="btn" >목록으로</a>
        </form>
           
      </div>

      <!--===========신청폼 영역=============-->

      <?php include_once "menubar.php"; ?>  
    
    </section>
  </div>
</body>
</html>