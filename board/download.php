<?php
include "db.php";

if(!preg_match("/".$_SERVER['HTTP_HOST']."/i",$_SERVER['HTTP_REFERER']))
exit('No direct access allowed');

$id = $_GET['id'];

$query = "SELECT * FROM board WHERE id = $id";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
  $row = mysqli_fetch_assoc($result);
  $filePath = $row['file_path'];
  $fileName = $row['file'];

  if (file_exists($filePath)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . $fileName);
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
  } else {
    echo "파일을 찾을 수 없습니다.";
  }
} else {
  echo "게시글을 찾을 수 없습니다.";
}
?>