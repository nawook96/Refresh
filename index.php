<!DOCTYPE html>
<html>
<head>
  <meta charset = "utf-8">
  <title> 블로그 홈페이지 </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<? include("frame/header.php")?>
<? include("frame/navbar.php")?>
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
  <article>
    여기는 텍스트입니다.
  </article>
</div>
<?include("frame/footer.php")?>
</body>
</html>
