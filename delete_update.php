<?php
	require_once("dbconfig.php");

  // $bno = $_POST['bno'];
  // echo $bno;
	//$_POST['bno']이 있을 때만 $bno 선언
	if(isset($_POST['bno'])) {
		$bno = $_POST['bno'];
    echo $bno;
	}

//글 삭제
if(isset($bno)) {
	$sql = 'delete from board_db where b_no = ' . $bno;
	$result = $db->query($sql);
	$sql = 'delete from comment_free where b_no='.$bno;
	$result2=$db->query($sql);
	//틀리다면 메시지 출력 후 이전화면으로
}



//쿼리가 정상 실행 됐다면,
if($result && $result2) {
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
