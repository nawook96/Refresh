<?php
if(isset($_SESSION['logined_user']))
{
  echo "<script>alert('이미 로그인 되어있습니다.');</script>";
  echo "<script>location.href = 'index.php'</script>";
}
?>

<html>
<head>
  <meta charset = "utf-8">
  <title> 블로그 홈페이지 </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/signup.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/login.js"></script>
</head>
<body>
  <?php include("frame/header.php");?>
  <?php include("frame/navbar.php");?>
  <div class = "allcontent">
    <form name="joinfrm" id="joinfrm" action="memberjoin.php" method="post">
  <div class ="wrapper_table">
   <div class="join_body">
    <dl>
     <div>
      <dt><label>ID</label></dt>
      <dd><input id="m_id" name="m_id" type="text" size = "30" maxlength="10" name="m_id" id="m_id" placeholder="아이디"></dd>
     </div>
     <div>
      <dt><label>PassWord</label></dt>
      <dd><input id="m_pass" name="m_pass" type="password" size = "30" maxlegnth="10" placeholder="비밀번호"></dd>
     </div>
   <div class="join_footer">
    <input type="button" value="LOGIN" onclick="doLogIn()">
   </div>
  </div>
  </form>

  </div>
  </div>
  <?php include("frame/footer.php");?>
</body>

</html>
