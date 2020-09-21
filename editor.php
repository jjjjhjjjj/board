<?php
session_cache_limiter('private');
session_start();
if (! isset($_SESSION['id'])) {
    echo ("
           <script>
             location.href='login.php'
           </script>
         ");
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="utf-8" />
<link rel="stylesheet" href="allcss/allcss.css">
<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
<script type="text/javascript"> 
function LoadPage() { CKEDITOR.replace('contents'); } 
function FormSubmit(f) { 
	CKEDITOR.instances.contents.updateElement(); 
	if(f.contents.value == "") { 
		alert("내용을 입력해 주세요."); 
		return false; 
		}
	 alert(f.contents.value); // 전송은 하지 않습니다.
	  return false; } 

function check_input()
{


  
if (!document.EditorForm.subject.value)
   {
       alert("제목을 입력해주세요.");    
       document.EditorForm.subject.focus();
       return false;
   }
   
else if (document.EditorForm.subject.value.length<2)
{
    alert("제목을 2글자 이상 입력해주세요.");    
    document.EditorForm.subject.focus();
    return false;
}
else if(CKEDITOR.instances.contents.getData().length < 7) { 
	alert("내용을 입력해 주세요."); 
	return false; 
	}
   else {
	   var check = confirm("글을 작성하시겠습니까?");
	   if(!check) {
	   	return false;
	   }
	   }
   
  
  
}

</script>
</head>
<body onload="LoadPage();">
	<div class="all">
		<div class="title" onclick="location.href='main.php'">LISTBOARD</div>
		<div class="title2">글 작성</div>
		<div class="meno3">

			<form id="EditorForm" name="EditorForm" method="post"
				action="insert_write.php" enctype="multipart/form-data">
				<TABLE border='0' width='650' cellpadding='2' cellspacing='2'>

					<TR height='50px'>
						<TD width='200' bgcolor='cccccc'><font size='2'><center>
									<b>글 제목</b>
								</center></font></TD>
						<TD><font size='2'><input type='text' size='70' maxlength='50'
								name='subject'></font></TD>
					</TR>


					<div>
						<TR height='20px'>
							<TD width='200' bgcolor='cccccc'><font size='2'><center>
										<b>첨부파일</b>
									</center></font></TD>
							<td><input type="file" name="upfile[]" id="upfile"
								multiple='multiple' /></td>
						</TR>



						<tr>

							<TD bgcolor='cccccc'><font size='2'><center>
										<b>글 내용</b>
									</center></font></TD>

							<td width='500' height='150'><textarea id="contents"
									name="contents"></textarea></td>
						</tr>
				
				</TABLE>
		
		</div>

		<div class="allbutton">
			<div class="modifybutton">

				<input type="button" value="목록" onclick="location.href='main.php'">
			</div>

			<div class="rightbutton">
				<input type="submit"
					onclick="return check_input(); return FormSubmit(this) " value="완료" />
				</a>
			</div>
		</div>
		</form>

	</div>
</body>
</html>




