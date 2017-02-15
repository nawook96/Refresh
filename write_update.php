<?php
	require_once("dbconfig.php");

		if(isset($_POST['bno'])) {
			$bno = $_POST['bno'];
		}

		//bno이 없다면(글 쓰기라면) 변수 선언
	if(empty($bno)) {
		$date = date('Y-m-d H:i:s');
	}
	//항상 변수 선언
	$bType = $_POST['category'];
	$bTitle = $_POST['bTitle'];
	$bContent = $_POST['bContent'];
	$check = $_POST['check'];

	if(empty($check))
	{
			if(!empty($_FILES['fileName']['name']))
		{
			$iName = $_FILES['fileName']['name'];
			$iPath = "images/upload/".date('YmdHis').$_FILES['fileName']['name'];
			$iSize = $_FILES['fileName']['size'];
			$tmp_file = $_FILES['fileName']['tmp_name'];
			$tPath = "images/upload/thumbnails/".date('YmdHis').$_FILES['fileName']['name'];
			}
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

					if(empty($check))
					{
							if ($num != 0)
						{
							$sql3 = 'select i_path from board_image where b_no = "' . $bno.'"';
							$r3 = $db->query($sql3);
							$rr = $r3->fetch_assoc();
							unlink($rr['i_path']);
							$sql2 = 'update board_image set i_path="'.$iPath.'", i_name="'.$iName.'", i_size="'.$iSize.'" where b_no = "'.$bno.'"';
							$r = move_uploaded_file($tmp_file, $iPath);
							if(getThumb($iPath, $tPath, 100, 100))
							{
								$sql = 'update board_db set b_src="'.$tPath.'" where b_no = "'.$bno.'"';
								$re = $db->query($sql);
							}
						}
						else {
							$sql2 = 'insert into board_image (i_no, b_no, i_path, i_name, i_size) values (null, "'.$bno.'", "'.$iPath.'", "'.$iName.'", "'.$iSize.'")';
							$r = move_uploaded_file($tmp_file, $iPath);
							if(getThumb($iPath, $tPath, 100, 100))
							{
								$sql = 'update board_db set b_src="'.$tPath.'" where b_no = "'.$bno.'"';
								$re = $db->query($sql);
							}
						}
							$result2= $db->query($sql2);
				}
				else{
					$sql = 'select * from board_image where b_no='.$bno;
					$result4 = $db->query($sql);
					$num = mysqli_num_rows($result4);
					echo "check";
					if($num != 0)
					{
						echo "내가 뭘";
						$bb = $result4->fetch_assoc();
						$path = $bb['i_path'];
						unlink($path);

					$sql = 'delete from board_image where b_no='.$bno;
					$result3 = $db->query($sql);
					}
				}
			}

			if(!empty($check))
			{
				$sql = 'select * from board_image where b_no='.$bno;
				$result4 = $db->query($sql);
				$num = mysqli_num_rows($result4);

				if($num != 0)
				{
					$bb = $result4->fetch_assoc();
					$path = $bb['i_path'];
					unlink($path);
					$sql = 'select* from board_db where b_no'.$bno;
					$re = $db->query($sql);
					$b = $re->fetch_assoc();
					$src = $b['b_src'];
					unlink($src);

				$sql = 'delete from board_image where b_no='.$bno;
				$result3 = $db->query($sql);

					$sql = 'update board_db set b_src= null where b_no = "'.$bno.'"';
					$re = $db->query($sql);
			}
		}
}


		//글 등록.
	 else {

		 	$sql = 'insert into board_db (b_type, b_no, b_title, b_content, b_date, b_hit, b_src) values('. $bType . ', null, "' . $bTitle . '", "' . $bContent . '", "' . $date . '", 0, null)';
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

				$sql3 = 'UPDATE board_category SET c_num = c_num + 1 WHERE b_type = ' . $bType;
				if(getThumb($iPath, $tPath, 100, 100))
				{
					$sql = 'update board_db set b_src="'.$tPath.'" where b_no = "'.$num['b_no'].'"';
					echo $sql;
					$re = $db->query($sql);
					if($re)
					{
						echo "성겅";
					}
					else {
						echo "밍";
					}

				}
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
				 //history.back();
			</script>
	<?php
			exit;
		}
	}
	function getThumb($o_path, $n_path, $width, $height){
	$o = array();
	$t = array();

	// 원본 이미지 path 확인
	if(!file_exists($o_path))		return array('bool' => false);

	// 원본 이미지 정보 호출
	$imginfo = getimagesize($o_path);

	// 원본 이미지 mime 타입
	$o['mime'] = $imginfo['mime'];

	// 원본 이미지 리소스 호출
	switch($o['mime']){
		case 'image/jpeg' :	$o['img'] = imagecreatefromjpeg($o_path);	break;
		case 'image/gif' :	$o['img'] = imagecreatefromgif($o_path);		break;
		case 'image/png' :	$o['img'] = imagecreatefrompng($o_path);	break;

		// mime 타입이 해당되지 않으면 return false
		// default :		return array('bool' => false);						break;
	}

	// 원본 이미지 크기
	$o['size'] = array('w' => $imginfo[0], 'h' => $imginfo[1]);

	// 썸네일 이미지 가로, 세로 비율 계산
	$t['ratio']['w'] = $o['size']['w'] / $width;
	$t['ratio']['h'] = $o['size']['h'] / $height;

	// 썸네일 이미지의 비율계산 (가로 == 세로)
	if($t['ratio']['w'] == $t['ratio']['h']){
		$t['size']['w'] = $width;
		$t['size']['h'] = $height;
	}
	// 썸네일 이미지의 비율계산 (가로 > 세로)
	elseif($t['ratio']['w'] > $t['ratio']['h']){
		$t['size']['w'] = $width;
		$t['size']['h'] = round(($width * $o['size']['h']) / $o['size']['w']);
	}
	// 썸네일 이미지의 비율계산 (가로 < 세로)
	elseif($t['ratio']['w'] < $t['ratio']['h']){
		$t['size']['w'] = round(($height * $o['size']['w']) / $o['size']['h']);
		$t['size']['h'] = $height;
	}

	// 썸네일 이미지 리소스 생성
	$t['img'] = imagecreatetruecolor($t['size']['w'], $t['size']['h']);

	// 썸네일 이미지 투명 배경 처리
	$bgclear = imagecolorallocate($t['img'],255,255,255);
	imagefill($t['img'],0,0,$bgclear);

	// 원본 이미지 썸네일 이미지 크기에 맞게 복사
	ImageCopyResized($t['img'],$o['img'],0,0,0,0,$t['size']['w'],$t['size']['h'],$o['size']['w'],$o['size']['h']);
	ImageInterlace($t['img']);

	// 썸네일 이미지 리소스를 기반으로 실제 이미지 생성
	switch($o['mime']){
		case 'image/jpeg' :	imagejpeg($t['img'], $n_path);	break;
		case 'image/gif' :	imagegif($t['img'], $n_path);	break;
		case 'image/png' :	imagepng($t['img'], $n_path);	break;
	}
	// 원본 이미지 리소스 종료
	imagedestroy($o['img']);
	// 썸네일 이미지 리소스 종료
	imagedestroy($t['img']);

	// 썸네일 파일경로 존재 여부 확인후 리턴
	return file_exists($n_path) ? array('bool' => true, 'path' => $n_path) : array('bool' => false);
}
	?>
<script>
		alert("<?php echo $msg?>");
		location.replace("<?php echo $replaceURL?>");
</script>
