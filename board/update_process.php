<?php
include "db.php";

if(!preg_match("/".$_SERVER['HTTP_HOST']."/i",$_SERVER['HTTP_REFERER']))
exit('No direct access allowed');

if (isset($_POST['id'])) {
  $id = $_POST['id'];
  $title = $_POST['title'];
  $name = $_POST['name'];
  $content = $_POST['content'];

  if ($_FILES['fileToUpload']['size'] > 0) {
    $fileName = "uploads/" . basename($_FILES['fileToUpload']['name']);
    if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $fileName)) {
      $stmt = $conn->prepare("UPDATE board SET title=?, name=?, content=?, file=?, file_path=? WHERE id=?");
      $stmt->bind_param("sssssi", $title, $name, $content, $fileName, $fileName, $id);
      $result = $stmt->execute();
      $stmt->close();
    }
  } else {
    $stmt = $conn->prepare("UPDATE board SET title=?, name=?, content=? WHERE id=?");
    $stmt->bind_param("sssi", $title, $name, $content, $id);
    $result = $stmt->execute();
    $stmt->close();
  }

  $conn->close();
  echo "<script> alert('수정되었습니다') </script>";
  echo '<script type="text/javascript">';
    echo '  window.location.href = "view.php?id='.$id.'";';
    echo '}';
    echo '</script>';
}
?>