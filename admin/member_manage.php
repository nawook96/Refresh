<?php
include('./dbconfig.php');

$modify = 'admin/member_modify.php';
$delete = 'admin/member_delete.php';
$boardList = 'boardList';
$pa = 'paging';
$list = mysqli_query($db, "SELECT * FROM member WHERE isAdmin = 0");
$num = 1;
echo "<article class=boardArticle>";
echo "<div id=$boardList>";
 echo "<table border = '1'>
 <tr>
 <th></th>
 <th>ID</th>
 <th>이름</th>
 <th>전화 번호</th>
 <th>E-mail</th>
 <th>성별</th>
 <th></th>
 <th></th>
 </tr>
 </article>";


 while($row = $result->fetch_assoc())
 {
   $id = $row['m_id'];
   echo "<tr>";
   echo "<td>" . $num++ . "</td>";
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
 echo "<div class=$pa>";
   echo $paging;
 echo "</div>";
 echo "</div>";
?>
