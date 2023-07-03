<?php
include "db.php";

if(!preg_match("/".$_SERVER['HTTP_HOST']."/i",$_SERVER['HTTP_REFERER']))
exit('No direct access allowed');


if (isset($_GET['id'])) {
  $id = $_GET['id'];

  $stmt = $conn->prepare("SELECT * FROM board WHERE id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>글 수정</title>
</head>
<body>
  <h2>글 수정하기</h2>
  <form method="post" action="update_process.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <input type="hidden" name="name" value="<?php echo $row['name'] ?>">
    <div>
      <label for="title">제목</label>
      <input type="text" id="title" name="title" value="<?php echo $row['title'] ?>">
    </div>
    <div>
      <label for="content">내용</label>
      <textarea id="content" name="content"><?php echo $row['content'] ?></textarea>
    </div>
    <div>
      <label for="fileToUpload">파일 첨부</label>
      <input type="file" name="fileToUpload" id="fileToUpload">
    </div>
    <button type="submit">수정</button>
  </form>
</body>
</html>