<?php
$ad_sql = mysqli_query($db,"SELECT * FROM admin");
$ad_row = mysqli_fetch_array($ad_sql);
?>

<aside>
  <div id="profileBox">
    <span id="profileImage">
      <?php
      if(isset($path))
      {?>
        <img src="<?php echo $ad_row['ad_src']?>">
        <?php
      }
      ?>
    </span>
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
