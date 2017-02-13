<?php
require_once("../dbconfig.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

if(isset($id)) {
  $sql1 = "DELETE FROM board_db WHERE b_type = '$id'";
  $sql2 = "DELETE FROM board_category WHERE b_type = '$id'";
}

$result1 = $db->query($sql1);
$result2 = $db->query($sql2);

if($result1) {
  if($result2)
  {
	echo "<script>alert(\"삭제 되었습니다.\");</script>";
  echo "<script>history.back()</script>";
}
else {
  echo "<script>alert(\"삭제 실패\");</script>";
  echo "<script>history.back()</script>";
}
}
else {
  echo "<script>alert(\"삭제 실패\");</script>";
  echo "<script>history.back()</script>";
}
?>
