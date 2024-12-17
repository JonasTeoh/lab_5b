<!DOCTYPE html>
<html>

<head>
  <title>Registration Form</title>
  <style>
    body {
      background-color: #f2f2f2;
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
    input[type=password],
    select {
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
  <h1 style="text-align: center;">Registration Form</h1>

  <form action="registrationForm.php" method="post">
    Matric: <input type="text" name="matric" required><br>
    Name: <input type="text" name="name" required><br>
    Password: <input type="password" name="password" required><br>
    Role: <select name="role" required>
      <option disabled selected value="">Please select</option>
      <option value="student">Student</option>
      <option value="lecturer">Lecturer</option>
    </select><br>
    <input type="submit" value="Submit">
  </form>

  <?php
  include "database.php";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST["matric"];
    $name = $_POST["name"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $role = $_POST["role"];

    $sql = "SELECT matric FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      echo "Matric already exists, try <a href='registrationForm.php'>register</a> again.";
    } else {
      $sql = "INSERT INTO users (matric, name, password, role) VALUES ('$matric', '$name', '$password', '$role')";
      if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
    }
  }
  ?>
  <br>
  <br>
  <div style="text-align: center;">Already have an account? <a href="loginForm.php">Login here</a>.</div>
</body>

</html>

