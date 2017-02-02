<?php
include ('dbconfig.php');
if(!isset($_SESSION))
{
  session_start();
}

if(!isset($_SESSION['logined_user']))
{
  echo "<script>alert('로그인이 필요한 서비스 입니다.');</script>";
  echo "<script>location.href = 'login.php'</script>";
}
?>
