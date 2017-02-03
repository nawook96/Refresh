
<html>
<head>
  <meta charset = "utf-8">
  <title> 블로그 홈페이지 </title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/signup.css">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script type="text/javascript" src="js/signup.js"></script>
</head>
<body>
  <?php include("frame/header.php");?>
  <?php include("frame/navbar.php");?>
  <div>
    <form name="joinfrm" id="joinfrm" action="join.php" method="post">
  <input type="hidden" id="id_ch" name="id_ch" value="false"/>
  <input type="hidden" id="pass_ch" name="pass_ch" value="false"/>
  <input type="hidden" id="year_ch" name="year_ch" value="false"/>
  <input type="hidden" id="email_ch" name="email_ch" value="false"/>
  <input type="hidden" id="m_tel" name="m_tel" value=""/>
  <div class ="wrapper_table">
   <div class="join_body">
    <dl>
     <div>
      <dt><label>User ID</label></dt>
      <dd><input id="m_id" name="m_id" type="text" size = "30" maxlength="10" name="m_id" id="m_id" placeholder="아이디"></dd>
     </div>
     <div class='arrow_box' id="id_notice">
        <ul>
      <li><a class="notice" id="info_id1">* 영문 또는, 영문과 숫자의 조합으로 설정해주시기 바랍니다. </a></li>
      <li><a class="notice" id="info_id2">* 5자 이상 12자 이하로 설정 가능합니다.</a></li>
        </ul>
       </div>
     <div>
      <dt><label>PassWord</label></dt>
      <dd><input id="m_pass" name="m_pass" type="password" size = "30" maxlegnth="10" placeholder="비밀번호"></dd>
     </div>
    <div class='arrow_box' id="pass_notice">
        <ul>
      <li><a class = "notice" id="info_pass1">* 영문과 숫자의 조합으로 설정해주시기 바랍니다.</li>
      <li><a class = "notice" id="info_pass2">* 8자 이상으로 설정 가능합니다.</a></li>
        </ul>
       </div>
     <dt><label>PassWord Check</label></dt>
     <dd><input id="m_pass_ch" name="m_pass_ch" type="password" size = "30" maxlength="10" placeholder="비밀번호 확인"></dd>
    <div class='arrow_box' id="pass_ch_notice" style="display:none;">
         <ul>
       <li><a class = "notice" style="color:red;">비밀번호를 확인해 주세요.</a></li>
         </ul>
       </div>
     <dt><label>Name</label></dt>
     <dd><input id="m_name" name="m_name" type="text" size = "30" maxlength="10" placeholder="이름"></dd>
     <dt><label>Birth Year</label></dt>
     <dd><input id="m_year" name="m_year" type="text" size = "30" maxlength="4" placeholder="년(4자)"></dd>
     <dt><label>Phone Number</label></dt>
     <dd class = "tel"><select id = "m_tel1" name ="tel1"><option selected>010</option>
      <option>011</option>
      <option>016</option>
      <option>017</option>
      <option>019</option>
     </select>
     &nbsp-&nbsp<input id = "m_tel2" name ="m_tel2" type="text" minlength="3" maxlength="4" size="4" required/>
     &nbsp-&nbsp<input id = "m_tel3" name ="m_tel3" type="text" maxlength="4" minlength="4" size="4" required/>
     </dd>
     <dt><label>Gender</label></dt>
     <dd><input id="m_gender" name="m_gender" type="radio" value="man" required>남</input>&nbsp&nbsp<input name="m_gender" id="m_gender" type="radio" value="woman"required>여</input></dd>
     <dt><label>Email</label></dt>
     <dd><input id="m_email" name="m_email" type="text" placeholder="E-mail"/></dd>
    <div class='arrow_box' id="email_notice" style="display:none;">
         <ul>
       <li><a class = "notice" style="color:red;">이메일 형식이 맞지 않습니다.</a></li>
         </ul>
       </div>
    </dl>
   </div>
   <div class="join_footer">
    <input type="button" value="JOIN" onclick="doSubmit()">
   </div>
  </div>
  </form>

  </div>
  <?php include("frame/footer.php");?>
</body>

</html>
