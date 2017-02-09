<?php
if(!isset($_SESSION))
{
  session_start();
}

$list = mysqli_query($db, "SELECT * FROM member WHERE isAdmin = 0");
 echo "<table border = '1'>
 <tr>
 <th>ID</th>
 <th>이름</th>
 <th>전화 번호</th>
 <th>출생 년도</th>
 <th>E-mail</th>
 <th>성별</th>
 </tr>
 ";

 while($row = mysqli_fetch_array($list))
 {
   echo "<tr>";
   echo "<td>" . $row['m_id'] . "</td>";
   echo "<td>" . $row['m_name'] . "</td>";
   echo "<td>" . $row['m_tel'] . "</td>";
   echo "<td>" . $row['m_born_year'] . "</td>";
   echo "<td>" . $row['m_email'] . "</td>";
   echo "<td>" . $row['m_gender'] . "</td>";
   echo "</tr>";
 }
 echo "</table>";
?>
