<?php
require_once("../dbconfig.php");

if(isset($_GET['id'])) {
  $id = $_GET['id'];
}

if(isset($id)) {
	$sql = "DELETE FROM member WHERE m_id = '$id'";
}

$result = $db->query($sql);

if($result) {
	echo "<script>alert(\"삭제 되었습니다.\");</script>";
  echo "<script>history.back()</script>";
}
else {
  echo "<script>alert(\"삭제 실패\");</script>";
  echo "<script>history.back()</script>";
}
?>
