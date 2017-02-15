<?php

include ('dbconfig.php');

 $name=$_POST['ad_name'];
 $intro=$_POST['ad_intro'];


 $sql1 = "UPDATE admin SET ad_name = '$name'";
 $sql2 = "UPDATE admin SET ad_intro = '$intro'";
 $sql3 = "UPDATE member SET m_name = '$name' WHERE isAdmin = 1";

 $check = $_POST['check'];

 if(empty($check))
 {
     if(!empty($_FILES['fileName']['name']))
   {
     $iName = $_FILES['fileName']['name'];
     $iPath = "images/".$_FILES['fileName']['name'];
     $iSize = $_FILES['fileName']['size'];
     $tmp_file = $_FILES['fileName']['tmp_name'];
     $tPath = "images/"."thum_".$_FILES['fileName']['name'];
     }
   }
   if(!empty($_FILES['fileName']['name']))
   {

     $r = move_uploaded_file($tmp_file, $iPath);
     $result2= $db->query($sq);

     if(getThumb($iPath, $tPath, 100, 100))
     {
        $sq = 'update admin set ad_src ='.$tPath;

     }
   }

mysqli_query($db, $sql1);
mysqli_query($db, $sql2);
mysqli_query($db, $sql3);
echo "<script>alert('정보 수정 성공');</script>";
echo "<script>location.href = 'index.php'</script>";
?>
<?php
function getThumb($o_path, $n_path, $width, $height){
$o = array();
$t = array();

// 원본 이미지 path 확인
if(!file_exists($o_path))		return array('bool' => false);

// 원본 이미지 정보 호출
$imginfo = getimagesize($o_path);

// 원본 이미지 mime 타입
$o['mime'] = $imginfo['mime'];

// 원본 이미지 리소스 호출
switch($o['mime']){
  case 'image/jpeg' :	$o['img'] = imagecreatefromjpeg($o_path);	break;
  case 'image/gif' :	$o['img'] = imagecreatefromgif($o_path);		break;
  case 'image/png' :	$o['img'] = imagecreatefrompng($o_path);	break;

  // mime 타입이 해당되지 않으면 return false
  // default :		return array('bool' => false);						break;
}

// 원본 이미지 크기
$o['size'] = array('w' => $imginfo[0], 'h' => $imginfo[1]);


// 썸네일 이미지 리소스 생성
$t['img'] = imagecreatetruecolor($t['size']['w'], $t['size']['h']);

// 썸네일 이미지 투명 배경 처리
$bgclear = imagecolorallocate($t['img'],255,255,255);
imagefill($t['img'],0,0,$bgclear);

// 원본 이미지 썸네일 이미지 크기에 맞게 복사
ImageCopyResized($t['img'],$o['img'],0,0,0,0,90,90,$o['size']['w'],$o['size']['h']);
ImageInterlace($t['img']);

// 썸네일 이미지 리소스를 기반으로 실제 이미지 생성
switch($o['mime']){
  case 'image/jpeg' :	imagejpeg($t['img'], $n_path);	break;
  case 'image/gif' :	imagegif($t['img'], $n_path);	break;
  case 'image/png' :	imagepng($t['img'], $n_path);	break;
}
// 원본 이미지 리소스 종료
imagedestroy($o['img']);
// 썸네일 이미지 리소스 종료
imagedestroy($t['img']);

// 썸네일 파일경로 존재 여부 확인후 리턴
return file_exists($n_path) ? array('bool' => true, 'path' => $n_path) : array('bool' => false);
} ?>
