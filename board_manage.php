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
  <?php include("frame/aside_admin.php");?>
  <?php include("admin/board_management.php");?>
</div>
<?php include("frame/footer.php");?>
</body>

</html>
