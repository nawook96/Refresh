<?php
include('./dbconfig.php');


$add = 'admin/board_add.php';
$delete = 'admin/board_delete.php';
$list = mysqli_query($db, "SELECT * FROM board_category");
$num = 1;

echo "<button href=$add>" . "카테고리 추가" . "</button>";
 echo "<table border = '1'>
 <tr>
 <th></th>
 <th>카테고리 이름</th>
 <th>게시글 갯수</th>
 <th></th>
 </tr>
 ";

 while($row = mysqli_fetch_array($list))
 {
   echo "<tr>";
   echo "<td>" . $num++ . "</td>";
   echo "<td>" . $row['c_name'] . "</td>";
   echo "<td>" . $row['c_num'] . "</td>";
   echo "<td><a href=$delete?id=$id>" . "삭제" . "</a></td>";
   echo "</tr>";
 }
 echo "</table>";
?>
