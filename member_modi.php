<?php
session_start();

$sid = $_SESSION['id'];

if (isset($_POST['id']))
    $id = $_POST['id'];
else
    $id = $_GET['id'];
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>realboard</title>
<link rel="stylesheet" href="allcss/allcss.css">
<script type="text/javascript">

function check_input()
{
 

   if (!document.member_form.userpass.value)
   {
       alert("비밀번호를 입력해주세요");    
       document.member_form.userpass.focus();
       return false;
   }

   if (!document.member_form.userpass_c.value)
   {
       alert("비밀번호 확인을 입력해주세요");    
       document.member_form.userpass_c.focus();
       return false;
   }

   if (!document.member_form.username.value)
   {
       alert("이름을 입력해주세요");    
       document.member_form.username.focus();
       return false;
   }

   if (!document.member_form.usernick.value)
   {
       alert("닉네임을 입력해주세요");    
       document.member_form.usernick.focus();
       return false;
   }


   if (!document.member_form.hp2.value || !document.member_form.hp3.value )
   {
       alert("전화번호를 입력해주세요");    
       document.member_form.hp2.focus();
       return false;
   }

   if (!document.member_form. sample4_postcode.value)
   {
       alert("우편번호를 입력해주세요");    
       document.member_form. sample4_postcode.focus();
       return false;
   }

   
   if (document.member_form.userid.value.length<4)
   {
       alert("아이디를 4자 이상 입력해주세요");    
       document.member_form.userid.focus();
       return false;
   }
  
   if (document.member_form.userpass.value.length<6)
   {
       alert("비밀번호를 6자 이상 입력해주세요");    
       document.member_form.userpass.focus();
       return false;
   }

   if (document.member_form.usernick.value.length<2)
   {
       alert("닉네임을 2자 이상 입력해주세요");    
       document.member_form.usernick.focus();
       return false;
   }

   if (document.member_form.hp2.value.length<3 || document.member_form.hp3.value.length<4 || document.member_form.hp2.value.length>4 || document.member_form.hp3.value.length>4)
   {
       alert("전화번호를 정확히 입력해주세요");    
       document.member_form.hp2.focus();
       return false;
   }
   

   
   if (document.member_form.userpass.value != 
         document.member_form.userpass_c.value)
   {
       alert("비밀번호가 일치하지 않습니다.");    
       document.member_form.userpass_c.focus();
       document.member_form.userpass_c.select();
       return false;
   }
   
   var check = confirm("회원정보를 수정하겠습니까?");
   if(!check) {
   	return false;
   }
 
}

function numkeyCheck(e){
	var keyValue = event.keyCode; 
	if( ((keyValue >= 48) && (keyValue <= 57)) ) return true; 
	else return false;

	
}

function removeChar(event) {
    event = event || window.event;
    var keyID = (event.which) ? event.which : event.keyCode;
    if ( keyID == 8 || keyID == 46 || keyID == 37 || keyID == 39 ) 
        return;
    else
        event.target.value = event.target.value.replace(/[^0-9]/g, "");
}

</script>

</head>

<body>
	<div class="all">
		<div class="title" onclick="location.href='main.php'">LISTBOARD</div>
		<div class="title2"></div>

<?php

$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$query = "select * from member where id = '$id'";

$result = $mysqli->query($query);

$row = $result->fetch_assoc();

$hp = explode('-', $row['hp']);

?>

	<div class="table6">

			<div class="title6">정보수정</div>
			<form id="member_form" name="member_form" method="post"
				action="member_modify.php" enctype="multipart/form-data">


				<div class="t2">
					<TABLE border='0' width='650' cellpadding='2' cellspacing='2'>
						<input type="hidden" name="realid" id="realid"
							value=<?php echo $row['id']; ?>>



						<tr>
							<TD width='120' bgcolor='cccccc'><font size='2'><center>
										<b>PASS</b>
									</center></font></TD>
									
									<?php
        $password = 'password string';
        $password = substr(hash('sha256', $password, true), 0, 32);
        $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
        $depass = openssl_decrypt(base64_decode($row['pass']), 'aes-256-cbc', $password, OPENSSL_RAW_DATA, $iv);

        ?>
									
									
							<TD><input type='password' size='12' name='userpass'
								value=<?php echo $depass; ?>></TD>
						</TR>
						<tr>
						
				
				<?php if($sid != 'admin'){?>
				
					
						<tr>
							<TD width='120' bgcolor='cccccc'><font size='2'><center>
										<b>PASS CHECK</b>
									</center></font></TD>
							<TD><input type='password' size='12' name='userpass_c'></TD>
						</TR>
						
					<?php  } ?>
						<tr>
							<TD width='120' bgcolor='cccccc'><font size='2'><center>
										<b>NAME</b>
									</center></font></TD>
							<TD><input type='text' size='12' name='username'
								value=<?php echo $row['name']; ?>></TD>
						</TR>
						<tr>
							<TD width='120' bgcolor='cccccc'><font size='2'><center>
										<b>NICK</b>
									</center></font></TD>
							<TD><input type='text' size='12' name='usernick'
								value=<?php echo $row['nick']; ?>></TD>
						</TR>
						<tr>
							<TD width='120' bgcolor='cccccc'><font size='2'><center>
										<b>PHONE</b>
									</center></font></TD>
							<td><select class="center_input" class="hp" name="hp1"
								value=<?php echo $hp[0];?>>
									<option value='010'>010</option>
									<option value='011'>011</option>
									<option value='016'>016</option>
									<option value='017'>017</option>
									<option value='018'>018</option>
									<option value='019'>019</option>
							</select> - <input type="text" class="hp" name="hp2" size='6'
								onKeyPress="return numkeyCheck(event)"
								onkeyup='removeChar(event)' value=<?php echo $hp[1]; ?>> - <input
								type="text" class="hp" name="hp3" size='6'
								onKeyPress="return numkeyCheck(event)"
								onkeyup='removeChar(event)' value=<?php echo $hp[2]; ?>></td>
						</TR>

						<tr>
							<TD width='120' bgcolor='cccccc'><font size='2'><center>
										<b>ADDRESS</b>
									</center></font></TD>

							<td><input type="text" id="sample4_postcode"
								name="sample4_postcode" placeholder="우편번호"
								value=<?php echo $row['addr']; ?>> <input type="button"
								onclick="sample4_execDaumPostcode()" value="우편번호 찾기"> <br> <input
								type="text" id="sample4_roadAddress" name="sample4_roadAddress"
								placeholder="도로명주소" value="<?php echo $row['roadaddr']; ?>"
								style="width: 200px;"> <br> <input type="text"
								id="sample4_jibunAddress" name="sample4_jibunAddress"
								placeholder="지번주소" value="<?php echo $row['jibunaddr']; ?>"
								style="width: 200px;"> <span id="guide"
								style="color: #999; display: none"></span> <Br> <input
								type="text" id="sample4_detailAddress"
								name="sample4_detailAddress" placeholder="상세주소"
								value="<?php echo $row['plusaddr']; ?>"></td>
							<script
								src="https://ssl.daumcdn.net/dmaps/map_js_init/postcode.v2.js"></script>
								
								
							<script>
    //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
    function sample4_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.
                

                // 도로명 주소의 노출 규칙에 따라 주소를 표시한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var roadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 참고 항목 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 표시할 참고항목이 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('sample4_postcode').value = data.zonecode;
                document.getElementById("sample4_roadAddress").value = roadAddr;
                document.getElementById("sample4_jibunAddress").value = data.jibunAddress;
                
                // 참고항목 문자열이 있을 경우 해당 필드에 넣는다.
                if(roadAddr !== ''){
                    document.getElementById("sample4_extraAddress").value = extraRoadAddr;
                } else {
                    document.getElementById("sample4_extraAddress").value = '';
                }

                var guideTextBox = document.getElementById("guide");
                // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                if(data.autoRoadAddress) {
                    var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                    guideTextBox.innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';
                    guideTextBox.style.display = 'block';

                } else if(data.autoJibunAddress) {
                    var expJibunAddr = data.autoJibunAddress;
                    guideTextBox.innerHTML = '(예상 지번 주소 : ' + expJibunAddr + ')';
                    guideTextBox.style.display = 'block';
                } else {
                    guideTextBox.innerHTML = '';
                    guideTextBox.style.display = 'none';
                }
            }
        }).open();
    }
</script>
						</tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>
						<tr></tr>

					</TABLE>
					<center>
						<input type="submit" value="수정" onclick="return check_input();">
					</center>
				</div>
				<div class="b"></div>
			</form>

		</div>
		<div class="title2"></div>


	</div>

</body>
</html>
