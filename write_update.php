<?php
	require_once("dbconfig.php");

	//$_POST['bno']이 있을 때만 $bno 선언
		if(isset($_POST['bno'])) {
			$bno = $_POST['bno'];
		}

		//bno이 없다면(글 쓰기라면) 변수 선언
	if(empty($bno)) {
		$date = date('Y-m-d H:i:s');
	}
	//항상 변수 선언
	$bTitle = $_POST['bTitle'];
	$bContent = $_POST['bContent'];


	//글 수정
	if(isset($bno)) {

			$sql = 'update board_db set b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_no = ' . $bno;
			$msgState = '수정';
		}

		//글 등록
	 else {
	$sql = 'insert into board_db (b_type, b_no, b_title, b_content, b_date, b_hit, b_src) values(0, null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, null)';
			$msgState = '등록';

		}


	//메시지가 없다면 (오류가 없다면)
	if(empty($msg)) {

			$result = $db->query($sql);

			//쿼리가 정상 실행 됐다면,
		if($result) {

			$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
			if(empty($bno)) {
				$bno = $db->insert_id;
			}
			$replaceURL = './view.php?bno=' . $bno;
		} else {
			$msg = '글을 ' . $msgState . '하지 못했습니다.';
	?>
			<script>
				alert("<?php echo $msg?>");
				// history.back();
			</script>
	<?php
			exit;
		}
	}

	?>
	<script>
		alert("<?php echo $msg?>");
		location.replace("<?php echo $replaceURL?>");
	</script>
