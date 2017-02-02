<?php
include ('dbconfig.php');
if(!isset($_SESSION))
{
  session_start();
}
$id=$_SESSION['logined_user'];
$sql = mysqli_query($db, "SELECT m_id FROM member WHERE m_id='$id'");
$row = mysqli_fetch_array($sql);
$login_session = $row['m_id'];

if(!isset($login_session))
{
  echo "<script>alert('로그인이 필요한 서비스 입니다.');</script>";
  echo "<script>location.href = 'login.php'</script>";
}
?>
