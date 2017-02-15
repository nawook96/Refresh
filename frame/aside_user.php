<?php
$cate_sql = mysqli_query($db,"SELECT * FROM board_category ORDER BY b_type");
$ad_sql = mysqli_query($db,"SELECT * FROM admin");
$ad_row = mysqli_fetch_array($ad_sql);
$index = 'index.php';
?>

<aside>
  <div id="profileBox">
    <span>
      <?php
      if($ad_row['ad_src']!=null)
      {?>
        <img id = "profileImage" src="<?php echo $ad_row['ad_src']?>">
        <?php
      }
      else
      {
        ?>
        <img id="profileImage" src = "images/profile_image.png" alt="Blog Profile image">
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
      <?php
       while($cate_row = mysqli_fetch_array($cate_sql))
       {
         $bo_type = $cate_row['b_type'];
         echo "<li> <a href=$index?cate_id=$bo_type>" . $cate_row['c_name'] . "</a></li>";
       }
       ?>
    </ul>
  </div>
</aside>
