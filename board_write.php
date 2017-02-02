<?php
	require_once("dbconfig.php");

	//$_GET['bno']이 있을 때만 $bno 선언
	if(isset($_GET['bno'])) {
		$bno = $_GET['bno'];
	}

	if(isset($bno)) {
		$sql = 'select b_title, b_content from board_db where b_no = ' . $bno;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
	}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset = "utf-8">
    <title>게시판 글 작성 </title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/board.css">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
  <?php include("frame/header.php") ?>
  <?php include("frame/navbar.php") ?>
<BR>
<!-- 입력된 값을 다음 페이지로 넘기기 위해 FORM을 만든다. -->
<div class="board">
<p>
  <div width=800px nowrap align=center class="cellcolor">
      <B>글 쓰 기</B>
  </div>
</p>
  <form action="./write_update.php" method=post>
    <?php
  				if(isset($bno)) {
  					echo '<input type="hidden" name="bno" value="' . $bno . '">';
  				}
  				?>

  <table id="boardWrite">
      <tr>
        <td width=150px nowrap align=left >
          <select style="width:150px" name="게시판">
            <option value="Announce">공지사항</option>
            <option value="Extra">잡담</option>
          </select>
        </td>
        <td align=left width=588px nowrap>
            <input type=text name=bTitle style="width:580px" maxlength=35
            onfocus="if(this.value =='제목을 입력하세요') this.value='';"
            onblur="if(this.value =='') this.value='제목을 입력하세요';"
            value="<?php echo isset($row['b_title'])?$row['b_title']:'제목을 입력하세요'?>">
        </td>
    </tr>
    <tr>
        <td width=150px align=left >내용</td>
        <td align=left  width=578px nowrap>
            <TEXTAREA style = "width:578px"name=bContent cols=90 rows=15>
            <?php echo isset($row['b_content'])?$row['b_content']:null?>
          </TEXTAREA>
        </td>
    </tr>
  <tr>
      <td rowspan="2" width=150px align=left>사진 첨부</td>
      <td  align=left id="status"></td>
    </tr>
    <tr>
      <td  align=left>
        <input type="file" name="fileName" accept="image/gif, image/jpeg, image/png">
      </td>
    </tr>
    <tr align=center id="holder">
    </tr>
    <tr>
        <td colspan=10 align=center>
            <INPUT type=submit>
              <?php echo isset($bno)?'수정':'작성'?>
            &nbsp;&nbsp;
            <INPUT type=reset value="다시 쓰기">
            &nbsp;&nbsp;
            <INPUT type=button value="되돌아가기"
            onclick="history.back(-1)"> <!--버튼이 클릭되었을때 발생하는 이벤트로 자바스크립트를 실행함. 이렇게 하면 바로 이전페이지로 감-->
        </td>
    </tr>
          <!-- </TABLE> -->
  <!-- </td> -->
  <!-- </tr> -->
  <!-- 입력 부분 끝 -->
  </table>
  </form>
</div>
</body>
</html>

<script>
var upload = document.getElementsByName('fileName')[0],
    holder = document.getElementById('holder'),
    state = document.getElementById('status');

if (typeof window.FileReader === 'undefined') {
  state.className = 'fail';
} else {
  state.className = 'success';
  state.innerHTML = '가능';

}

upload.onchange = function (e) {
  e.preventDefault();

  var file = upload.files[0],
      reader = new FileReader();
  reader.onload = function (event) {
    var img = new Image();
    img.src = event.target.result;
    // note: no onload required since we've got the dataurl...I think! :)
    if (img.width > 560) { // holder width
      img.width = 560;
    }
    holder.innerHTML = '';
    holder.appendChild(img);
  };
  reader.readAsDataURL(file);

  return false;
};
</script>
