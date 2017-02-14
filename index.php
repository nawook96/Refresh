<?php
	require_once("dbconfig.php");
	if(!isset($_SESSION))
	{
	  session_start();
	}

	if(isset($_GET['cate_id']))
	{
		$cate_id = $_GET['cate_id'];
	}
	else {
		$cate_id = 1;
	}

$cate_list = mysqli_query($db, "SELECT c_name FROM board_category WHERE b_type = $cate_id");
$cate_name = mysqli_fetch_array($cate_list);

	/* 페이징 시작 */
		//페이지 get 변수가 있다면 받아오고, 없다면 1페이지를 보여준다.
		if(isset($_GET['page'])) {
			$page = $_GET['page'];
		} else {
			$page = 1;
		}

		/* 검색 시작 */
		$subString=null;
		$searchColumn=null;
		$searchText=null;

	if(isset($_GET['searchColumn'])) {
		$searchColumn = $_GET['searchColumn'];
		$subString .= '&amp;searchColumn=' . $searchColumn;
	}

	if(isset($_GET['searchText'])) {
		$searchText = $_GET['searchText'];
		$subString .= '&amp;searchText=' . $searchText;
	}

	if(isset($searchColumn) && isset($searchText)) {
		$searchSql = ' where ' . $searchColumn . ' like "%' . $searchText . '%" AND ';
	} else {
		$searchSql = ' WHERE ';
	}

	/* 검색 끝 */

		$sql = 'select count(*) as cnt from board_db' . $searchSql . "b_type = $cate_id";

		$result = $db->query($sql);
		$row = $result->fetch_assoc();

		$allPost = $row['cnt']; //전체 게시글의 수

		if(empty($allPost)) {
			$emptyData = '<tr><td class="textCenter" colspan="5">글이 존재하지 않습니다.</td></tr>';
			$paging = '<ul>';
			if($page == 1)
			{
					$paging .= '<li class="page current">1</li>';
			}

				$paging .= '</ul>';
		} else {

		$onePage = 3; // 한 페이지에 보여줄 게시글의 수.
		$allPage = ceil($allPost / $onePage); //전체 페이지의 수 ceil로 올림

		if($page < 1 || $page > $allPage) {
	?>
			<script>
				alert("존재하지 않는 페이지입니다.");
				history.back();
			</script>
	<?php
			exit;
		}

		$oneSection = 10; //한번에 보여줄 총 페이지 개수(1 ~ 10, 11 ~ 20 ...)
		$currentSection = ceil($page / $oneSection); //현재 섹션
		$allSection = ceil($allPage / $oneSection); //전체 섹션의 수

		$firstPage = ($currentSection * $oneSection) - ($oneSection - 1); //현재 섹션의 처음 페이지

		if($currentSection == $allSection) {
			$lastPage = $allPage; //현재 섹션이 마지막 섹션이라면 $allPage가 마지막 페이지가 된다.
		} else {
			$lastPage = $currentSection * $oneSection; //현재 섹션의 마지막 페이지
		}

		$prevPage = (($currentSection - 1) * $oneSection); //이전 페이지, 11~20일 때 이전을 누르면 10 페이지로 이동.
		$nextPage = (($currentSection + 1) * $oneSection) - ($oneSection - 1); //다음 페이지, 11~20일 때 다음을 누르면 21 페이지로 이동.

		$paging = '<ul>'; // 페이징을 저장할 변수

		//첫 페이지가 아니라면 처음 버튼을 생성
		if($page != 1) {
$paging .= '<li class="page page_start"><a href="./index.php?page=1' . $subString . '">처음</a></li>';
		}
		//첫 섹션이 아니라면 이전 버튼을 생성
		if($currentSection != 1) {
$paging .= '<li class="page page_prev"><a href="./index.php?page=' . $prevPage . $subString . '">이전</a></li>';
		}

		for($i = $firstPage; $i <= $lastPage; $i++) {
			if($i == $page) {
				$paging .= '<li class="page current">' . $i . '</li>';
			} else {
				$paging .= '<li class="page"><a href="./index.php?page=' . $i . $subString . '">' . $i . '</a></li>';
			}
		}

		//마지막 섹션이 아니라면 다음 버튼을 생성
		if($currentSection != $allSection) {
$paging .= '<li class="page page_next"><a href="./index.php?page=' . $nextPage . $subString . '">다음</a></li>';		}

		//마지막 페이지가 아니라면 끝 버튼을 생성
		if($page != $allPage) {
			$paging .= '<li class="page page_end"><a href="./index.php?page=' . $allPage . $subString . '">끝</a></li>';
		}


		// if($page == 1)
		// {
		// 		$paging .= '<li class="page current">1</li>';
		// }
		//
			$paging .= '</ul>';
		/* 페이징 끝 */


		$currentLimit = ($onePage * $page) - $onePage; //몇 번째의 글부터 가져오는지
		$sqlLimit = ' limit ' . $currentLimit . ', ' . $onePage; //limit sql 구문

		$sql = 'select * from board_db' . $searchSql .  ' b_type = '.$cate_id.' order by b_no desc' . $sqlLimit; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$sql2 = 'select * from board_db' . $searchSql . ' b_type = '.$cate_id.' order by b_no desc'; //원하는 개수만큼 가져온다. (0번째부터 20번째까지
		$result = $db->query($sql);
		$result2 = $db->query($sql2);

}


?>

<!DOCTYPE html>

<html>
<head>
  <meta charset = "utf-8">
  <title> 블로그 홈페이지 </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
	    <link rel="stylesheet" type="text/css" href="css/board.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include("frame/header.php");?>
<?php include("frame/navbar.php");?>
<div class = "allcontent">
  <?php include("frame/aside_user.php");?>
  <article  class="boardArticle">
  <h1><?=$cate_name['c_name'];?></h1>
  	<div id="boardList">
	  <table>
	    <thead>
	      <tr>
	        <th scope="col" class="no">번호</th>
	        <th scope="col" class="title">제목</th>
	        <th scope="col" class="date">작성일</th>
	        <th scope="col" class="hit">조회</th>
	      </tr>
	    </thead>
	    <tbody>
	        <?php
					$cnt = 1;
					if(isset($emptyData)) {
							echo $emptyData;
						} else {
							$num_rows = mysqli_num_rows($result2);
							$virtual_bno =$num_rows - $onePage*($page-1);
	          while($row = $result->fetch_assoc())
	          {
	            $datetime = explode(' ', $row['b_date']);
	            $date = $datetime[0];
	            $time = $datetime[1];
	            if($date == Date('Y-m-d'))
	              $row['b_date'] = $time;
	            else
	              $row['b_date'] = $date;
	        ?>
	      <tr>
	        <td class="no"><?php echo $virtual_bno?> <?php $virtual_bno--; ?></td>
	        <td class="title"><a href="./view.php?bno=<?php echo $row['b_no']?>"><?php echo htmlspecialchars($row['b_title']);?></a></td>
	        <td class="date"><?php echo $row['b_date']?></td>
	        <td class="hit"><?php echo $row['b_hit']?></td>
	      </tr>
	        <?php
	          }
					}
	        ?>
	    </tbody>
	  </table>
		<?php
	  if(isset($_SESSION['logined_user']))
	  {
	    $id=$_SESSION['logined_user'];
	    $sql = mysqli_query($db, "SELECT m_id FROM member WHERE m_id='$id' AND isAdmin = 1");
	    $row = mysqli_fetch_array($sql);
	    $login_session = $row['m_id'];

			$btnSet = 'btnSet';
			$boardwrite = './board_write.php';

	    if(isset($login_session))
	    {
	    echo "<div class=$btnSet>
		      <a href= $boardwrite class='btnWrite btn'>글쓰기</a>
		    </div>";
	    }
	  }
	?>
		<div class="paging">
			<?php echo $paging ?>
		</div>
		<div class="searchBox">
			<form action="./index.php" method="get">
				<select name="searchColumn">
					<option <?php echo $searchColumn=='b_title'?'selected="selected"':null?> value="b_title">제목</option>
					<option <?php echo $searchColumn=='b_content'?'selected="selected"':null?> value="b_content">내용</option>
				</select>
				<input type="text" name="searchText" value="<?php echo isset($searchText)?$searchText:null?>">
				<button type="submit">검색</button>
			</form>
		</div>
  </div>
  </article>
</div>
<?php include("frame/footer.php");?>
</body>

</html>
