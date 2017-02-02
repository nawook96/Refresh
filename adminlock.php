<?php
include ('dbconfig.php');
session_start();
$id=$_SESSION['logined_user'];
$sql = mysqli_query("SELECT m_id FROM member WHERE m_id='$id' AND isAdmin = 1");
$row = mysqli_fetch_array($sql);
$login_session = $row['m_id'];

if(!isset($login_session))
{
  echo "<script>alert('권한이 없습니다.');</script>";
  echo "<script>location.href = 'index.php'</script>";
}
?>
