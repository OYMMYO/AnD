<?php
session_start();
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $query = "SELECT id FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);

    if ($password != $confirm_password) {
        $error_msg = "패스워드가 일치하지 않습니다.";
    } else if (mysqli_num_rows($result)) {
        $error_msg = "이미 존재하는 id입니다.";
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo '<script type="text/javascript">';
            echo '  alert("회원가입이 완료되었습니다.");';
            echo 'window.location.href = "board.php";';
            echo '</script>';
        } else {
            $error_msg = "회원가입에 실패하였습니다.";
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Signup</title>
    <meta charset="utf-8">
</head>

<body>
    <header>
        <nav>
            <ul style="list-style:none;">
                <li><a href="index.php">Home</a></li>
                <li><a href="board.php">Board</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Signup</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required><br>
            <label for="password">Password:</label>
            <input type="password" name="password" required><br>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="confirm_password" required><br>
            <input type="submit" value="회원가입">
        </form>
        <?php if (isset($error_msg)): ?>
            <p>
                <?php echo $error_msg; ?>
            </p>
        <?php endif; ?>
    </main>
</body>

</html>