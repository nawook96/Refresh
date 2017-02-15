<?php
	$sql = 'select * from comment_free where co_no=co_order and b_no=' . $bno;
	$result = $db->query($sql);
	$logined_user = $_SESSION['logined_user'];
	$sql2 = mysqli_query($db, "SELECT m_id FROM member WHERE m_id='$logined_user' AND isAdmin = 1");
	$result2 = mysqli_fetch_array($sql2);
	$isad = $result2['m_id'];
?>
<div id="commentView">
	<form action="comment_update.php" method="post">
		<input type="hidden" name="bno" value="<?php echo $bno?>">
		<?php
			while($row = $result->fetch_assoc()) {
				$com_id = $row['co_id'];
		?>
		<ul class="oneDepth">
			<li>
				<?php
				if($row['co_lock'] == 0)
				{
					if($logined_user != $com_id && !isset($isad)){
			?>
			<div id="co_<?php echo $row['co_no']?>" class="commentSet">
				<div class="commentInfo">
					<div class="commentId">작성자: <span class="coId"><?=$com_id?></span></div>
					<div class="commentBtn">
						<a href="#" class="comt write">댓글</a>
					</div>
				</div>
				<div class="commentContent"><?php echo $row['co_content']?></div>
			</div>
			<?php
		}
		else{
				?>
				<div id="co_<?php echo $row['co_no']?>" class="commentSet">
					<div class="commentInfo">
						<div class="commentId">작성자: <span class="coId"><?=$com_id?></span></div>
						<div class="commentBtn">
							<a href="#" class="comt write">댓글</a>
							<a href="#" class="comt modify">수정</a>
							<a href="#" class="comt delete">삭제</a>
						</div>
					</div>
					<div class="commentContent"><?php echo $row['co_content']?></div>
				</div>
				<?php
			}
		}
			else {
				if($logined_user != $com_id && !isset($isad)){
			?>
			<div id="co_<?php echo $row['co_no']?>" class="commentSet">
				<div class="commentInfo">
					<div class="commentId">작성자: <span class="coId"><?=$com_id?></span></div>
				</div>
				<div class="commentContent">권한이 없습니다.</div>
			</div>
			<?php
		}
		else{
			?>
			<div id="co_<?php echo $row['co_no']?>" class="commentSet">
				<div class="commentInfo">
					<div class="commentId">작성자: <span class="coId"><?=$com_id?></span></div>
					<div class="commentBtn">
						<a href="#" class="comt write">댓글</a>
						<a href="#" class="comt modify">수정</a>
						<a href="#" class="comt delete">삭제</a>
					</div>
				</div>
				<div class="commentContent"><?php echo $row['co_content']?></div>
			</div>
			<?php
		}
		}
		?>
				<?php
					$sql2 = 'select * from comment_free where co_no!=co_order and co_order=' . $row['co_no'];
					$result2 = $db->query($sql2);

					while($row2 = $result2->fetch_assoc()) {
						$com_id2 = $row2['co_id'];
				?>
				<ul class="twoDepth">
					<li>
						<?php
						if($row['co_lock'] == 0)
						{
							if($logined_user != $com_id2 && !isset($isad)){
					?>
					<div id="co_<?php echo $row['co_no']?>" class="commentSet">
						<div class="commentInfo">
							<div class="commentId">작성자: <span class="coId"><?=$com_id2?></span></div>
							<div class="commentBtn">
								<a href="#" class="comt write">댓글</a>
							</div>
						</div>
						<div class="commentContent"><?php echo $row2['co_content']?></div>
					</div>
					<?php
				}
				else{
						?>
						<div id="co_<?php echo $row['co_no']?>" class="commentSet">
							<div class="commentInfo">
								<div class="commentId">작성자: <span class="coId"><?=$com_id2?></span></div>
								<div class="commentBtn">
									<a href="#" class="comt write">댓글</a>
									<a href="#" class="comt modify">수정</a>
									<a href="#" class="comt delete">삭제</a>
								</div>
							</div>
							<div class="commentContent"><?php echo $row2['co_content']?></div>
						</div>
						<?php
					}
				}
					else {
						if($logined_user != $com_id && !isset($isad)){
					?>
					<div id="co_<?php echo $row['co_no']?>" class="commentSet">
						<div class="commentInfo">
							<div class="commentId">작성자: <span class="coId"><?=$com_id2?></span></div>
						</div>
						<div class="commentContent">권한이 없습니다.</div>
					</div>
					<?php
				}
				else{
					?>
					<div id="co_<?php echo $row['co_no']?>" class="commentSet">
						<div class="commentInfo">
							<div class="commentId">작성자: <span class="coId"><?=$com_id2?></span></div>
							<div class="commentBtn">
								<a href="#" class="comt write">댓글</a>
								<a href="#" class="comt modify">수정</a>
								<a href="#" class="comt delete">삭제</a>
							</div>
						</div>
						<div class="commentContent"><?php echo $row2['co_content']?></div>
					</div>
					<?php
				}
				}
				?>
					</li>
				</ul>
				<?php
					}
				?>
			</li>
		</ul>
		<?php } ?>
	</form>
</div>

<form action="comment_update.php" method="post">
	<input type="hidden" name="bno" value="<?php echo $bno?>">
	<input type="hidden" name="coId" value="<?=$logined_user?>">
	<table>
		<tbody>
			<tr>
				<th scope="row"><label for="coId">아이디</label></th>
				<td><?=$logined_user?></td>
			</tr>
			<!-- <tr>
				<th scope="row">
			<label for="coPassword">비밀번호</label></th>
				<td><input type="password" name="coPassword" id="coPassword"></td>
			</tr> -->
			<tr>
				<th scope="row"><label for="coContent">내용</label></th>
				<td><textarea name="coContent" id="coContent"></textarea></td>
			</tr>
		</tbody>
	</table>
	<div class="btnSet">
		<input type="checkbox" name="chk_info" value="onlyAdmin">주인만 보기&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="submit" value="코멘트 작성">
	</div>
</form>

<script>
	$(document).ready(function () {
		var commentSet = '';
		var action = '';
		$('#commentView').delegate('.comt', 'click', function () {
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
				coId = <?=$logined_user?>;

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
				// comment += '			<tr>';
				// comment += '				<th scope="row">';
				// comment += '			<label for="coPassword">비밀번호</label></th>';
				// comment += '				<td><input type="password" name="coPassword" id="coPassword"></td>';
				// comment += '			</tr>';
				if(action !== 'd') {
					comment += '			<tr>';
					comment += '				<th scope="row"><label for="coContent">내용</label></th>';
					comment += '				<td><textarea name="coContent" id="coContent">' + coContent + '</textarea></td>';
					comment += '			</tr>';
				}
				comment += '		</tbody>';
				comment += '	</table>';
				comment += '	<div class="btnSet">';
				comment += '<input type="checkbox" name="chk_info" value="onlyAdmin">주인만 보기&nbsp;&nbsp;&nbsp;&nbsp;';
				comment += '		               <input type="submit" value="확인">';
				comment += '	</div>';
				comment += '</div>';

				$(this).parents('.commentSet').after(comment);
			return false;
		});

		$('#commentView').delegate(".cancel", "click", function () {
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
