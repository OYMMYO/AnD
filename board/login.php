<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8">
</head>
<body>
  <header>
    <h1>Login</h1>
    <nav>
      <ul style="list-style:none;">
        <li><a href="index.php">Home</a></li>
        <li><a href="board.php">Board</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <form method="POST" action="login_check.php">
      <div>
        <label for="id">아이디</label>
        <input type="text" id="id" name="username" required>
      </div>
      <div>
        <label for="password">비밀번호</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit">로그인</button>
    </form>
  </main>
</body>
</html>