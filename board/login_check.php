<?php
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();


if($result->num_rows == 1){
        $row = $result->fetch_assoc();
        $hashed = $row['password'];

        if(password_verify($password, $hashed)){
        session_start();
        $_SESSION['username'] = $username;
        header("Location: board.php");
        }

}
else{
            header("Location: login.php");
exit("dd");
}
?>