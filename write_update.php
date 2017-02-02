<?php
	require_once("dbconfig.php");

	$bTitle = $_POST['bTitle'];
	$bContent = $_POST['bContent'];

	$date = date('Y-m-d H:i:s');


	$sql = 'insert into board_db (b_type, b_no, b_title, b_content, b_date, b_hit, b_src) values(0, null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, null)';

	$result = $db->query($sql);
	if($result) { // query가 정상실행 되었다면,
		$msg = "정상적으로 글이 등록되었습니다.";
		$bno = $db->insert_id;
		$replaceURL = './view.php?bno=' . $bno;
	} else {
		$msg = "글을 등록하지 못했습니다.";
?>
		<script>
			alert("<?php echo $msg?>");
			history.back();
		</script>
<?php
	}

?>
<script>
	alert("<?php echo $msg?>");
	location.replace("<?php echo $replaceURL?>");
</script>
