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


	if(!empty($_FILES['fileName']['name']))
	{
		$iName = $_FILES['fileName']['name'];
		$iPath = "images/upload/".$_FILES['fileName']['name'];
		$iSize = $_FILES['fileName']['size'];
		$tmp_file = $_FILES['fileName']['tmp_name'];
	}

	//글 수정
	if(isset($bno)) {

			$sql = 'update board_db set b_title="' . $bTitle . '", b_content="' . $bContent . '" where b_no = "' . $bno.'"';
			$msgState = '수정';
			$result = $db->query($sql);
				if(!empty($_FILES['fileName']['name']))
				{
					$query = 'select * from board_image where b_no = "'.$bno.'"';
					$count = $db->query($query);
					$num = mysqli_num_rows($count);

						if ($num != 0)
					{
						$sql3 = 'select i_path from board_image where b_no = "' . $bno.'"';
						$r3 = $db->query($sql3);
						$rr = $r3->fetch_assoc();
						unlink($rr['i_path']);
						$sql2 = 'update board_image set i_path="'.$iPath.'", i_name="'.$iName.'", i_size="'.$iSize.'" where b_no = "'.$bno.'"';
						$r = move_uploaded_file($tmp_file, $iPath);
					}
					else {
						$sql2 = 'insert into board_image (i_no, b_no, i_path, i_name, i_size) values (null, "'.$bno.'", "'.$iPath.'", "'.$iName.'", "'.$iSize.'")';
						$r = move_uploaded_file($tmp_file, $iPath);
					}
						$result2= $db->query($sql2);
				}
		}



		//글 등록.
	 else {

	$sql = 'insert into board_db (b_type, b_no, b_title, b_content, b_date, b_hit, b_src) values(0, null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, null)';
			$msgState = '등록';
			$result = $db->query($sql);
			if(!empty($_FILES['fileName']['name']))
			{
				$sql = 'select * from board_db size order by b_date DESC limit 1';
				$re = $db->query($sql);
				$num = $re->fetch_assoc();
				$sql2 = 'insert into board_image (i_no, b_no, i_path, i_name, i_size) values (null, "'.$num['b_no'].'", "'.$iPath.'", "'.$iName.'", "'.$iSize.'")';
				$r = move_uploaded_file($tmp_file, $iPath);
				$result2= $db->query($sql2);
			}
		}


	//메시지가 없다면 (오류가 없다면)
	if(empty($msg)) {

			//쿼리가 정상 실행 됐다면,
		if($result) {

			$msg = '정상적으로 글이 ' . $msgState . '되었습니다.';
			if(empty($bno)) {
				$sql = 'select * from board_db size order by b_date DESC limit 1';
				$re = $db->query($sql);
				$num = $re->fetch_assoc();
				$bno = $num['b_no'];
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
