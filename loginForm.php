<?php
include "database.php";
session_start();

if (isset($_SESSION["matric"])) {
  header("Location: userList.php");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <style>
    body {
      background-color: #f2f2f2;
      text-align: center;
    }

    form {
      background-color: #fff;
      padding: 16px;
      border: 1px solid #ccc;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      width: 50%;
      margin: auto;
    }

    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
      background-color: #fff;
    }

    input[type=submit] {
      background-color: #4CAF50;
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    input[type=submit]:hover {
      opacity: 0.8;
    }
  </style>
</head>

<body>
  <h1 style="text-align: center;">Login</h1>
  <?php

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $password = $_POST["password"];

    $sql = "SELECT matric, password, role FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if (password_verify($password, $row["password"])) {
        session_start();
        $_SESSION["matric"] = $row["matric"];
        $_SESSION["role"] = $row["role"];
        header("Location: userList.php");
      }else {
        echo "Invalid username or password, try <a href='loginForm.php'>login</a> again.";
      }
      
    } else {
      echo "Invalid username or password, try <a href='loginForm.php'>login</a> again.";
    }
  } else {
    ?>
    <form action="loginForm.php" method="post" style="text-align: left;">
      Matric: <input type="text" name="matric"><br>
      Password: <input type="password" name="password"><br>
      <input type="submit" value="Submit">
    </form>
    <br>
    <br>
    <div style="text-align: center;">
      <a href="registrationForm.php">Register</a> here if you have not.
    </div>
    <?php
  }
  ?>
</body>

</html>

