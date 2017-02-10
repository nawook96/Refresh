<?php
	require_once("dbconfig.php");
	$bno = $_GET['bno'];

		if(!empty($bno) && empty($_COOKIE['board_db_' . $bno])) {

			$sql = 'update board_db set b_hit = b_hit + 1 where b_no = ' . $bno;
			$result = $db->query($sql);
			if(empty($result)) {
				?>
				<script>
					alert('오류가 발생했습니다.');
					history.back();
				</script>
				<?php
			} else {
				setcookie('board_db_' . $bno, TRUE, time() + (60 * 60 * 24), '/');
			}
		}

	$sql = 'select b_title, b_content, b_date, b_hit from board_db where b_no = ' . $bno;
	$result = $db->query($sql);
	if(!$result)
	{
		echo '오류가 발생했습니다.';
	}
	$row = $result->fetch_assoc();
?>

<script>
	$(document).ready(function () {
		var commentSet = '';
		var action = '';

		$('#commentView').on('.comt', 'click', function () {
			//현재 작성 내용을 변수에 넣고, active 클래스 추가.
			commentSet = $(this).parents('.commentSet').html();
			$(this).parents('.commentSet').addClass('active');

			//취소 버튼
			var commentBtn = '<a href="#" class="addComt cancel">취소</a>';

			//버튼 삭제 & 추가
			$('.comt').hide();
			$(this).parents('.commentBtn').append(commentBtn);


			//commentInfo의 ID를 가져온다.
			var co_no = $(this).parents('.commentSet').attr('id');

			//전체 길이에서 3("co_")를 뺀 나머지가 co_no
			co_no = co_no.substr(3, co_no.length);

			var addOption = '<input type="hidden" name="co_no" value="' + co_no + '">';

			//변수 초기화
			var comment = '';
			var coId = '';
			var coContent = '';

			if($(this).hasClass('write')) {
				//댓글 쓰기
				action = 'w';
				//ID 영역 출력
				coId = '<input type="text" name="coId" id="coId">';

			} else if($(this).hasClass('modify')) {
				//댓글 수정
				action = 'u';
				$(this).parents('.commentBtn');

				var modifyParent = $(this).parents('.commentSet');
				var coId = modifyParent.find('.coId').text();
				var coContent = modifyParent.find('.commentContent').text();

			} else if($(this).hasClass('delete')) {
				//댓글 삭제
				action = 'd';

			}

				comment += '<div class="writeComment">';
				comment += '	<input type="hidden" name="w" value="' + action + '">';
				comment += addOption;
				comment += '	<table>';
				comment += '		<tbody>';
				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coId">아이디</label></th>';
					comment += '				<td>' + coId + '</td>';
					comment += '			</tr>';
				}
				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coContent">내용</label></th>';
					comment += '				<td><textarea name="coContent" id="coContent">' + coContent + '</textarea></td>';
					comment += '			</tr>';
				}
				comment += '		</tbody>';
				comment += '	</table>';
				comment += '	<div class="btnSet">';
				comment += '		<input type="submit" value="확인">';
				comment += '	</div>';
				comment += '</div>';

				$(this).parents('.commentSet').after(comment);
			return false;
		});

		$('#commentView').on(".cancel", "click", function () {
			if(action == 'w') {
				$('.writeComment').remove();
			} else if(action == 'u') {
				$('.writeComment').remove();
			}
				$('.commentSet.active').removeClass('active');
				$('.addComt').remove();
				$('.comt').show();
			return false;
		});
	});
</script>
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
		<h3><a href = "index.php">자유게시판</a></h3>
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
			<a href="./delete.php?bno=<?php echo $bno?>">삭제</a>
			<a href="./">목록</a>
		</div>
		<div id="boardComment">
			<?php include('comment.php'); ?>
		</div>
	</article>
</div>
	<?php include("frame/footer.php");?>
</body>
</html>
