<?php

require_once("../dbconfig.php");

 $name=$_POST['c_name'];

 $sql = "INSERT INTO board_category (c_name,c_num) VALUES ('$name' , 0)";

echo $sql;

 if(mysqli_query($db, $sql))
 {
  echo "<script>alert('카테고리 추가 성공');</script>";
  echo "<script>location.href = './setting.php?=state=1'</script>";
 }
 else
 {
 echo "<script>alert('카테고리 이름 중복입니다. 입력을 다시한번 확인해주세요..');</script>";
 echo "<script>location.href = 'board_add.php'</script>";
 }

?>
