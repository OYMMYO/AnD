<?php
include "db.php";

if(!preg_match("/".$_SERVER['HTTP_HOST']."/i",$_SERVER['HTTP_REFERER']))
exit('No direct access allowed');

$id = $_GET['id'];
$sql = "DELETE FROM board WHERE id = '".$id."'";
$torf = mysqli_query($conn, $sql);

if ($torf==False):
    echo "<script>alert('삭제에 실패했습니다.');</script>";
else:
    echo "<script>alert('삭제되었습니다.');</script>";
    echo '<script type="text/javascript">';
    echo '  window.location.href = "board.php";';
    echo '}';
    echo '</script>';
    exit;
endif
?>