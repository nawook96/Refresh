<?php
	require_once("dbconfig.php");
	$bno = $_GET['bno'];

	$sql = 'select b_title, b_content, b_date, b_hit from board_db where b_no = ' . $bno;
	$result = $db->query($sql);

	$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<title>자유게시판</title>
	<link rel="stylesheet" href="./css/style.css" />
	<link rel="stylesheet" href="./css/board.css" />
</head>
<body>
	<?php include("frame/header.php");?>
	<?php include("frame/navbar.php");?>
	<div class = "allcontent">
		<?php include("frame/aside_user.php"); ?>
	<article class="boardArticle">
		<h3>자유게시판 글쓰기</h3>
		<div id="boardView">
			<h3 id="boardTitle"><?php echo $row['b_title']?></h3>
			<div id="boardInfo">
				<span id="boardDate">작성일: <?php echo $row['b_date']?></span>
				<span id="boardHit">조회: <?php echo $row['b_hit']?></span>
			</div>
			<div id="boardContent"><?php echo $row['b_content']?></div>
		</div>
		<div class="btnSet">
			<a href="./board_write.php?bno=<?php echo $bno?>">수정</a>
			<a href="./delete.php">삭제</a>
			<a href="./">목록</a>
		</div>
	</article>
</div>
	<?php include("frame/footer.php");?>
</body>
</html>
