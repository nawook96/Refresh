<?php
$ad_sql = mysqli_query($db,"SELECT * FROM admin");
$ad_row = mysqli_fetch_array($ad_sql);
?>

<aside>
  <div id="profileBox">
    <img id="profileImage" src = "images/profile_image.png" alt="Blog Profile image">
    <p> <span class="title"> Name </span> <span class="title_content" name="name" > <?=$ad_row['ad_name']?> </span> </p>
    <p> <span class="title"> Intro </span> <span class="title_content" name="intro" > <?=$ad_row['ad_intro']?> </span> </p>
    <a href="profileset.php"><i class="fa fa-info-circle" aria-hidden="true"></i></a>
  </div>
  <div id="sidebar">
    <ul>
      <li> <a href="setting.php?state=0"> 회원 관리 </a> </li>
      <li> <a href="setting.php?state=1"> 게시판 관리 </a> </li>
      <li> <a href="setting.php?state=2"> 게시물 관리 </a> </li>
    </ul>
  </div>
</aside>
