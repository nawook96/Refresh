<?php
require_once("dbconfig.php");

$adsql = 'SELECT * FROM admin';
$adresult = $db->query($adsql);
$adrow = $adresult->fetch_assoc();

?>

<html>
<head>
  <meta charset = "utf-8">
  <title> 블로그 홈페이지 </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/signup.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/profileset.js"></script>
</head>
<body>
  <div>
    <form name="joinfrm" id="joinfrm" action="profile.php" method="post">
  <div class ="wrapper_table">
   <div class="join_body">
    <dl>
     <div>
      <dt><label>Name</label></dt>
      <dd><input id="ad_name" name="ad_name" type="text" size = "30" maxlength="16" placeholder="이름"></dd>
     </div>
     <div>
      <dt><label>Intro</label></dt>
      <TEXTAREA style = "width:400px"name="ad_intro" cols=90 rows=15><?php echo isset($adrow['ad_intro'])?$adrow['ad_intro']:null?></TEXTAREA>
     </div>
    </dl>
   </div>
   <div class="join_footer">
    <input type="button" value="MODIFY" onclick="doSubmit()">
   </div>
  </div>
  </form>

  </div>
</body>

</html>
