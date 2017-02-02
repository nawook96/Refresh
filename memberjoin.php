<?php

 $db_host = 'localhost'; // host
 $db_user = 'root'; // db ID
 $db_pw = 'rabbit';  // db PW
 $db_name = 'refresh'; // db name
 $db_table = 'member'; // table name
 $conn = new mysqli($db_host, $db_user, $db_pw, $db_name);

 session_start();

 $id=$_POST['m_id'];
 $password=md5($_POST['m_pass']);

 $sql = "SELECT m_id FROM member WHERE m_id = '$id' AND m_pw = '$password'";
 $result = mysqli_query($conn, $sql);

 $count = mysqli_num_rows($result);

 if($count == 1)
 {
   $_SESSION['logined_user'] = $id;
   echo "<script>location.href = 'index.php'</script>";
 }
 else
 {
   echo "<script>alert('아이디나 비밀번호를 확인해 주세요.');</script>";
   //echo "<script>location.href = 'login.php'</script>";
 }

?>
