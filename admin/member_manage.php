<?php
include('./dbconfig.php');

$modify = 'admin/member_modify.php';
$delete = 'admin/member_delete.php';
$list = mysqli_query($db, "SELECT * FROM member WHERE isAdmin = 0");

 echo "<table border = '1'>
 <tr>
 <th>ID</th>
 <th>이름</th>
 <th>전화 번호</th>
 <th>E-mail</th>
 <th>성별</th>
 <th></th>
 <th></th>
 </tr>
 ";

 while($row = mysqli_fetch_array($list))
 {
   $id = $row['m_id'];
   echo "<tr>";
   echo "<td>" . $id . "</td>";
   echo "<td>" . $row['m_name'] . "</td>";
   echo "<td>" . $row['m_tel'] . "</td>";
   echo "<td>" . $row['m_email'] . "</td>";
   echo "<td>" . $row['m_gender'] . "</td>";
   echo "<td><a href=$modify?id=$id>" . "수정" . "</a></td>";
   echo "<td><a href=$delete?id=$id>" . "삭제" . "</a></td>";
   echo "</tr>";
 }
 echo "</table>";
?>
