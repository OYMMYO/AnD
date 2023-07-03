<?php
session_start();
include "db.php";

$query = "SELECT * FROM board";
$result = mysqli_query($conn, $query);

?>
<!DOCTYPE html>

<html>
<head>
<title>Board</title>
<meta charset="utf-8">

<style>
        #home {
        font-size:50px;
        border-bottom: 2px solid;
        margin:0px;
        }

        ul {
        font-size:25px;
        font-style:italic;
        font-weight:bold;
        list-style-type: none;
        border-right: 2px solid;
        border-bottom: 2px solid;
        width:100px;
        padding:0;
        margin:0;
        }

        body{
        margin:10px;
        }

        a{
        text-decoration:none;
        color:Black;
        }

        table{
        border-collapse: collapse;
        width:100%;
        }

        th, td{
         border: 2px solid;
        text-align:center;
        padding:5px;
        }

        #grid{
        display:grid;
        grid-template-columns: 130px 2fr ;
        }

</style>

</head>



<body>

<h1 id="home"><a href="index.php" style="color:blue;">S!</a></h1>
      
<div id="grid">
                        <ul>
                                <li><a href="board.php">Board</a></li>
                        </ul>

<div>
<h2>Board</h2>
<table>
                         <th>번호</th> <th>제목</th> <th> 작성자</th> <th>작성일</th>
 <?php while($row = mysqli_fetch_array($result)): ?>
        <tr>
                <td> <?php echo $row['id'] ?> </td>
            <td><a href="view.php?id=<?php echo $row['id'] ?>"><?php echo $row['title'] ?></a></td>
            <td><?php echo $row['name'] ?></td>
                <td> <?php echo $row['created_at'] ?></td>
        </tr>
        <?php endwhile; ?>
</div>
</div>

    </table>
      <?php if(isset($_SESSION['username'])): ?>
        <div style="text-align:end;">
        <a href="write.php">글쓰기</a>
        <a href="logout.php">로그아웃</a>
        </div>
      <?php else: ?>
        <div style="text-align:end;">
        <a href="login.php">로그인</a>
        <a href="signup.php">회원가입</a>
        </div>
      <?php endif; ?>

<?php echo $_SESSION['id'] ?>

</body>
</html>