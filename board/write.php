<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>글쓰기</title>
</head>
<body>
   <form method="POST" enctype="multipart/form-data" action="write_process.php">
        제목: <input type="text" name="title" required><br>
        내용: <textarea name="content" required></textarea><br>
        파일: <input type="file" name="file"><br>
        <input type="hidden" name="name" value="<?php echo $_SESSION['username']; ?>" required><br>
        <input type="submit" value="글쓰기">
    </form>
</body>
</html>