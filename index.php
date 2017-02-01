<?php
	require_once("dbconfig.php");
?>

<!DOCTYPE html>

<html>
<head>
  <meta charset = "utf-8">
  <title> 블로그 홈페이지 </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php include("frame/header.php");?>
<?php include("frame/navbar.php");?>
<div id = "allcontent">
  <aside>
    <div id="profileBox">
      <img id="profileImage" src = "images/profile_image.png" alt="Blog Profile image">
      <p> <span class="title"> Name </span> <span class="title_content" name="name" > Peter </span> </p>
      <p> <span class="title"> Intro </span> <span class="title_content" name="intro" > Hi I am Peter </span> </p>
    </div>
    <div id="sidebar">
      <ul>
        <li> 공지사항 </li>
        <li> 잡담 </li>
        <li> 공부 </li>
      </ul>
    </div>
  </aside>
  <article  class="boardArticle">
  <article>
    여기는 텍스트입니다.
  <h1>자유게시판</h1>
  	<div id="boardList">
  <table>
    <caption class="readHide">자유게시판</caption>
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
          $sql = 'select * from board_db order by b_no desc';
          $result = $db->query($sql);
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
        <td class="no"><?php echo $row['b_no']?></td>
        <td class="title"><?php echo $row['b_title']?></td>
        <td class="date"><?php echo $row['b_date']?></td>
        <td class="hit"><?php echo $row['b_hit']?></td>
      </tr>
        <?php
          }
        ?>
    </tbody>
  </table>
  <div class="btnSet">
      <a href="./write.php" class="btnWrite btn">글쓰기</a>
    </div>
  </div>
  </article>
</div>
<?php include("frame/footer.php");?>
</body>
</html>
