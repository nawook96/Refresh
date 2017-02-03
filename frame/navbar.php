<?php
include ('../dbconfig.php');
if(!isset($_SESSION))
{
  session_start();
}

$topRight = 'topRight';
$login = 'login.php';
$logout = 'logout.php';
$signup = 'SignUp.php';
$setting = 'setting.php';
$true = 'true';
$color = 'color:#9D9D9D';
?>

<nav>
<ul>
  <li> <a class="selected" href="index.php">HOME</a></li>
  <?php
  if(isset($_SESSION['logined_user']))
  {
    $id=$_SESSION['logined_user'];
    $sql = mysqli_query($db, "SELECT m_id FROM member WHERE m_id='$id' AND isAdmin = 1");
    $row = mysqli_fetch_array($sql);
    $login_session = $row['m_id'];

    if(isset($login_session))
    {
    echo "<li> <a href=$setting> SETTING </a></li>";
    }
  }
?>

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
