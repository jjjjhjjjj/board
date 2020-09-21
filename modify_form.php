
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
	 alert(f.contents.value); 
	  return false; } 

function check_input()
{


  
if (!document.EditorForm.subject.value)
   {
       alert("제목을 입력해주세요.");    
       document.EditorForm.subject.focus();
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
		<?php
$number = $_GET['number'];
$mysqli = new mysqli("localhost", "hjhjhj", "0123", "list");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$mysqli->set_charset('utf-8');

$query = "select * from board where num = $number";

$result = $mysqli->query($query);

$fquery = "select * from file where list_num=$number";
$fdata = mysqli_query($mysqli, $fquery);
$ftotal_rows = mysqli_num_rows($fdata);

while ($row = $result->fetch_assoc()) {

    ?>

	
			<form id="EditorForm" name="EditorForm" method="post"
				action="modify.php" enctype="multipart/form-data">
				<TABLE border='0' width='650' cellpadding='2' cellspacing='2'>
					<input type=hidden name='number' value=<?php echo $row['num'];?>>



					<TR height='50px'>
						<TD width='200' bgcolor='cccccc'><font size='2'><center>
									<b>글 제목</b>
								</center></font></TD>
						<TD><font size='2'><input type='text' size='70' maxlength='50'
								name='subject' value=<?php echo $row['title'];?>></font></TD>
					</TR>


					<div>
						<TR height='20px'>
							<TD bgcolor='cccccc'><font size='2'><center>
										<b>첨부파일</b>
									</center></font></TD>
							<td><input type="file" name="upfile[]" id="upfile"
								multiple='multiple'></td>


						</TR>
						
						

<?php
    // if 첨부파일 존재

    if ($ftotal_rows != 0) {

        $i = 1; //
        $ffquery = "select * from file where list_num=$number";
        $ffdata = $mysqli->query($ffquery);

        while ($frow = $ffdata->fetch_assoc()) {
            $delfile_id = $frow['file_id'];
            ?>


<TR bgcolor='cccccc'>
							<TD bgcolor='cccccc'><font size='2'><center>
										<b>첨부된 파일</b>
									</center></font></TD>
							<TD><font size='2'><?php echo $frow['file'];?>&nbsp; &nbsp; 파일을 삭제합니다. <input
									type="button" value="x"
									onclick="location.href='delete_file.php?file_id=<?php echo $frow['file_id']?>'"></font>
							</TD>

						</TR>
<?php
        }
    }

    ?>
						
					<tr>

							<TD bgcolor='cccccc'><font size='2'><center>
										<b>글 내용</b>
									</center></font></TD>

							<td width='500' height='150'><textarea id="contents"
									name="contents"><?php echo $row['contents'];?></textarea></td>
						</tr>
				
				</TABLE>
		<?php
}
?>
	
		
		
		
		
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




