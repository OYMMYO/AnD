<?php
session_start();
include "db.php";

if(!preg_match("/".$_SERVER['HTTP_HOST']."/i",$_SERVER['HTTP_REFERER']))
exit('No direct access allowed');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $name = $_POST['name'];
    $content = $_POST['content'];

    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK){

            $uploadFile = $_FILES['file'];
    $fileName = "uploads/" . basename($uploadFile['name']);
    if (move_uploaded_file($uploadFile['tmp_name'], $fileName)) {

        mysqli_query($conn, "set names utf8");

        $stmt = $conn->prepare("INSERT INTO board (title, name, content, file, file_path) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $title, $name, $content, $uploadFile['name'], $fileName);
        $stmt->execute();
        $postid=$conn->insert_id;
        $stmt->close();

        mysqli_close($conn);
        echo '<script type="text/javascript">';
        echo 'if (confirm("파일이 업로드되었습니다."+'.$postid.')) {';
        echo '  window.location.href = "view.php?id='.$postid.'";';
        echo '}';
        echo '</script>';
        exit;
        }
    }
    else {      //UPLOAD_ERR_NO_FILE

            mysqli_query($conn, "set names utf8");
            $stmt = $conn->prepare("INSERT INTO board (title, name, content) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $name, $content);
            $stmt->execute();
             $postid=$conn->insert_id;
            $stmt->close();
            mysqli_close($conn);

    echo '<script type="text/javascript">';
    echo 'if (confirm("게시글이 업로드되었습니다."+'.$postid.')) {';
    echo '  window.location.href = "view.php?id='.$postid.'";';
    echo '}';
    echo '</script>';
    exit;
    }
}
?>