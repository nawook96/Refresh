<html>
<head>
  <meta charset = "utf-8">
  <title> 블로그 홈페이지 </title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
  <link rel="stylesheet" type="text/css" href="../css/signup.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="../js/board_add.js"></script>
</head>
<body>
  <div>
    <form name="joinfrm" id="joinfrm" action="add.php" method="post">
  <input type="hidden" id="name_ch" name="id_ch" value="false"/>
  <div class ="wrapper_table">
   <div class="join_body">
    <dl>
     <div>
      <dt><label>Category Name</label></dt>
      <dd><input id="c_name" name="c_name" type="text" size = "30" maxlength="16" placeholder="카테고리 명"></dd>
     </div>
     <div class='arrow_box' id="name_notice">
        <ul>
      <li><a class="notice" id="info_name1">* 한글으로 설정해주시기 바랍니다. </a></li>
      <li><a class="notice" id="info_name2">* 2자 이상 8자 이하로 설정 가능합니다.</a></li>
        </ul>
       </div>
    </dl>
   </div>
   <div class="join_footer">
    <input type="button" value="ADD" onclick="doSubmit()">
   </div>
  </div>
  </form>

  </div>
</body>

</html>
