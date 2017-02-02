<?php
	require_once("dbconfig.php");

	//$_GET['bno']이 있어야만 글삭제가 가능함.
	if(isset($_GET['bno'])) {
		$bno = $_GET['bno'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>자유게시판</title>
	<link rel="stylesheet" href="css/style.css" />
	<link rel="stylesheet" href="css/board.css" />
</head>
<body>
  <?php include("frame/header.php");?>
  <?php include("frame/navbar.php");?>
<div class = "allcontent">
  	<?php include("frame/aside_user.php"); ?>
	<article class="boardArticle">
		<h3>자유게시판 글삭제</h3>
		<?php
			if(isset($bno)) {
				$sql = 'select count(b_no) as cnt from board_db where b_no = ' . $bno;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
				if(empty($row['cnt'])) {
		?>
		<script>
			alert('글이 존재하지 않습니다.');
    	location.replace("./index.php");
			// history.back();
		</script>
		<?php
			exit;
				}

				$sql = 'select b_title from board_db where b_no = ' . $bno;
				$result = $db->query($sql);
				$row = $result->fetch_assoc();
		?>
		<div id="boardDelete">
			<form action="./delete_update.php" method="post">
				<input type="hidden" name="bno" value="<?php echo $bno?>">
				<table>
					<thead>
						<tr>
							<th scope="col" colspan="2">글삭제</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row">글 제목</th>
							<td><?php echo $row['b_title']?></td>
						</tr>
					</tbody>
				</table>
        <p> 삭제하시겠습니까? </p>
				<div class="btnSet">
					<button type="submit" class="btnSubmit btn">삭제</button>
					<a href="./index.php" class="btnList btn">되돌아가기</a>
				</div>
			</form>
		</div>
	<?php
		//$bno이 없다면 삭제 실패
		} else {
	?>
		<script>
			alert('정상적인 경로를 이용해주세요.');
			history.back();
		</script>
	<?php
			exit;
		}
	?>
	</article>
</div>
</body>
<?php include("frame/footer.php");?>
</html>
