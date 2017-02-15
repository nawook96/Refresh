<?php
	require_once("dbconfig.php");

  // $bno = $_POST['bno'];
  // echo $bno;
	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bno = $_POST['bno'];
	}

//글 삭제
if(isset($bno)) {

	$sql = 'select * from board_image where b_no='.$bno;
	$result4 = $db->query($sql);
	$num = mysqli_num_rows($result4);
	if($num != 0)
	{
		$bb = $result4->fetch_assoc();
		$iPath = $bb['i_path'];
		unlink($iPath);

		$sql = 'delete from board_image where b_no='.$bno;
		$result3 = $db->query($sql);
		$sql = 'select* from board_db where b_no'.$bno;
		$re = $db->query($sql);
		$b = $re->fetch_assoc();
		$src = $b['b_src'];
		unlink($src);
	}
	$sql = 'delete from board_db where b_no = ' . $bno;
	$result = $db->query($sql);
	$sql = 'delete from comment_free where b_no='.$bno;
	$result2=$db->query($sql);
	//틀리다면 메시지 출력 후 이전화면으로
}



//쿼리가 정상 실행 됐다면,
if($result && $result2) {
	$sql3 = 'UPDATE board_category SET c_num = c_num - 1 WHERE b_type = ' . $bType;
	$result3 = $db->query($sql3);
	$msg = '정상적으로 글이 삭제되었습니다.';
	$replaceURL = './';
} else {
	$msg = '글을 삭제하지 못했습니다.';
?>
	<!-- <script>
		alert("<php echo $msg?>");
		history.back();
	</script> -->
<?php
	exit;
}


?>
<script>
	alert("<?php echo $msg ?>");
	location.replace("<?php echo $replaceURL?>");
</script>
