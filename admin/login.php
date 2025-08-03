<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <!-- link Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
    
    <?php
    session_start();
    include "koneksi.php";
    
    if (isset($_POST['login'])) {
      $username = $_POST['username'];
      $password = $_POST['password'];
    
      $sql = "SELECT * FROM data_admin WHERE username='$username' AND password='$password'";
      $result = $koneksi->query($sql);
    
      if ($result->num_rows > 0) {
        $_SESSION['admin'] = true;
        header("Location: ../index.php");
      } else {
        $error = "Username atau password salah!";
      }
    }
    ?>
    
    <!-- Form Login -->
    <form method="POST" action="">
      <input type="text" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" name="login">Login</button>
    </form>
    
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>


