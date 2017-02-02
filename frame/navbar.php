<?php
include ('dbconfig.php');
if(!isset($_SESSION))
{
  session_start();
}

$topRight = 'topRight';
$login = 'login.php';
$logout = 'logout.php';
$signup = 'SignUp.php';
$true = 'true';
$color = 'color:#9D9D9D';
?>

<nav>
<ul>
  <li> <a class="selected" href="index.php">HOME</a></li>
  <li> <a href="setting.php"> SETTING </a> </li>

  <li>
    <?php
    if(!isset($_SESSION['logined_user']))
    {
      echo "<a class = $topRight href= $signup>";
      echo "<i class= 'fa fa-user-circle-o' aria-hidden= $true></i> SignUp </a>";
    }
    ?>
  </li>
  <li>
    <?php
    if(!isset($_SESSION['logined_user']))
    {
      echo "<a class = $topRight href= $login>";
      echo "<i class= 'fa fa-sign-in' aria-hidden= $true></i> Login </a>";
    }
    else
    {
      $id = $_SESSION['logined_user'];
      echo "<a class = $topRight href= $logout>";
      echo "<i class= 'fa fa-sign-out' aria-hidden= $true></i> Logout </a>";
      echo "<a class = $topRight style = $color>";
      echo "<i aria-hidden= $true></i> $id 님 환영합니다! </a>";
    }
    ?>
  </li>
</ul>
</nav>
