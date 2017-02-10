<?php
include('./dbconfig.php');

$list = mysqli_query($db, "SELECT * FROM member WHERE isAdmin = 0");
// echo "<table border = '1'>
// <tr>
// <th>"
?>
