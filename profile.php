<?php

include ('dbconfig.php');

 $name=$_POST['ad_name'];
 $intro=$_POST['ad_intro'];

 $sql1 = "UPDATE admin SET ad_name = '$name'";
 $sql2 = "UPDATE admin SET ad_intro = '$intro'";
 $sql3 = "UPDATE member SET m_name = '$name' WHERE isAdmin = 1";

 if(!empty($_FILES['file']['name']))
 {
   $iName = $_FILES['file']['name'];
   $iPath = "images/".$_FILES['file']['name'];
   $tmp_file = $_FILES['file']['tmp_name'];

   $r = move_uploaded_file($tmp_file, $iPath);
   $sq = "update admin set ad_src = '$iPath'";
   $result2= $db->query($sq);

 }

mysqli_query($db, $sql1);
mysqli_query($db, $sql2);
mysqli_query($db, $sql3);
echo "<script>alert('정보 수정 성공');</script>";
echo "<script>location.href = 'index.php'</script>";
?>
