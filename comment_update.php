<?php
	require_once('dbconfig.php');

	$bno = $_POST['bno'];

	$coId = $_POST['coId'];
	$coContent = $_POST['coContent'];

	$sql = 'insert into comment_free values(null, ' .$bno . ', null, "' . $coId . '", "' . $coContent . '")';
	$result = $db->query($sql);
	$coNo = $db->insert_id;

	$sql = 'update comment_free set co_order = co_no where co_no = ' . $coNo;

	$result = $db->query($sql);
	if($result) {
?>
	<script>
		alert('댓글이 정상적으로 작성되었습니다.');
		location.replace("./view.php?bno=<?php echo $bno?>");
	</script>
<?php
	}
?>
