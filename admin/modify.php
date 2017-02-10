<?php

include ('../dbconfig.php');

$orin_id=$_POST['orin_id'];

 $id=$_POST['m_id'];
 $password=md5($_POST['m_pass']);
 $name = $_POST['m_name'];
 $year = $_POST['m_year'];
 $tel = $_POST['m_tel'];
 $gender = $_POST['m_gender'];
 $email = $_POST['m_email'];

 $sql = "UPDATE member SET m_id = '$id',m_pw = '$password',m_name = '$name' , m_tel = '$tel', m_born_year = '$year', m_email = '$email', m_gender = '$gender' , isAdmin = 0 WHERE m_id = '$orin_id'";
 if(mysqli_query($db, $sql))
 {
  echo "<script>alert('회원 정보 수정 성공');</script>";
  echo "<script>location.href = '../setting.php'</script>";
 }
 else
 {
 echo "<script>alert('회원 정보 수정 실패');</script>";
 echo "<script>location.href = 'member_modify.php?id=$orin_id'</script>";
 }

?>
