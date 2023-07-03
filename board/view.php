 <?php
session_start();

include "db.php";

if (!preg_match("/" . $_SERVER['HTTP_HOST'] . "/i", $_SERVER['HTTP_REFERER']))
  exit('No direct access allowed');


$id = $_GET['id'];

$query = "SELECT * FROM board WHERE id = $id";
$result = $conn->query($query);

if (mysqli_num_rows($result) === 1) {
  $row = $result->fetch_assoc();

  ?> <h2> <?php echo $row['title'] ?> </h2><br> <?php
        echo "작성자: " . $row['name'] . "<br>";
        echo "작성일: " . $row['created_at'] . "<br>";
        echo "내용: " . $row['content'] . "<br>";
        echo "파일: <a href='download.php?id=" . $id . "'>" . $row['file'] . "</a><br>";

        if (isset($_SESSION['username']) && $_SESSION['username'] == $row['name']) {
          echo "<a href='update.php?id=$id'> 수정</a>";
          echo "<a href='delete.php?id=$id'> 삭제</a>";
        }
}
?>