<?php
	require_once("dbconfig.php");

  $bNo = $_POST['bno'];
  echo $bNo;
	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bNo = $_POST['bno'];
    echo $bNo;
	}

//글 삭제
if(isset($bNo)) {
	$sql = 'delete from board_db where b_no = ' . $bNo;
	//틀리다면 메시지 출력 후 이전화면으로
}

	$result = $db->query($sql);

//쿼리가 정상 실행 됐다면,
if($result) {
	$msg = '정상적으로 글이 삭제되었습니다.';
	$replaceURL = './';
} else {
	$msg = '글을 삭제하지 못했습니다.';
?>
	<!-- <script>
		alert("<?php echo $msg?>");
		history.back();
	</script> -->
<?php
	exit;
}


?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>