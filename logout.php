<?php
include ('dbconfig.php');

$id=$_SESSION['logined_user'];
$sql = mysqli_query($db, "SELECT m_id FROM member WHERE m_id='$id'");
$row = mysqli_fetch_array($sql);
$login_session = $row['m_id'];

if(isset($login_session))
{
  session_destroy();
  echo "<script>alert('로그아웃 되었습니다.');</script>";
  echo "<script>location.href = 'index.php'</script>";
}
?>
