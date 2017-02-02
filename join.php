<?php

include ('dbconfig.php');

 $id=$_POST['m_id'];
 $password=md5($_POST['m_pass']);
 $name = $_POST['m_name'];
 $year = $_POST['m_year'];
 $tel = $_POST['m_tel'];
 $gender = $_POST['m_gender'];
 $email = $_POST['m_email'];

 $sql = "INSERT INTO member VALUES ('$id','$password','$name' , '$tel', '$year', '$email', '$gender' , 0)";

 if(mysqli_query($db, $sql))
 {
  echo "<script>alert('회원가입 성공');</script>";
  echo "<script>location.href = 'index.php'</script>";
 }
 else
 {
 echo "<script>alert('ID중복입니다. 입력을 다시한번 확인해주세요..');</script>";
 echo "<script>location.href = 'SignUp.php'</script>";
 }

?>
