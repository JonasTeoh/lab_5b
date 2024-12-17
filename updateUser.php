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
  select,
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

  .cancel {
    display: inline-block;
    padding: 10px 0 10px 0;
    margin: 8px 0;
    text-decoration: none;
    color: black;
    background-color: white;
    border-radius: 4px;
    border: solid;
    border-width: 1px;
    border-color: black;
    text-align: center;
    cursor: pointer;
    width: 100%;
  }

  .cancel:hover {
    background-color: lightgray;
  }

</style>

<?php
session_start();
include "database.php";
if (!isset($_SESSION["matric"])) {
  header("Location: loginForm.php");
  exit;
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Update User</title>
</head>

<body>
  <h1 style="text-align: center;">Update User</h1>
  <form action="updateUser.php" method="post">
    <?php
    $matric = $_GET["matric"];
    $sql = "SELECT matric, name, password, role FROM users WHERE matric = '$matric'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    Matric: <input type="text" name="matric" value="<?php echo $row["matric"]; ?>"><br>
    Name: <input type="text" name="name" value="<?php echo $row["name"]; ?>"><br>
    Access Level: <select name="role">
      <option disabled selected value="">Please select</option>
      <option value="student" <?php if ($row["role"] == "student")
        echo "selected"; ?>>Student</option>
      <option value="lecturer" <?php if ($row["role"] == "lecturer")
        echo "selected"; ?>>Lecturer</option>
    </select><br>
    <input type="submit" value="Update">
    <a class="cancel" href="userList.php">Cancel</a>

  </form>
</body>

</html>

<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $matric = $_POST["matric"];
  $name = $_POST["name"];
  $role = $_POST["role"];

  $sql = "UPDATE users SET name = '$name', role = '$role' WHERE matric = '$matric'";

  if ($conn->query($sql) === TRUE) {  
    header("Location: userList.php?success=Record+updated+successfully");
    exit;
  } else {
    echo "Error updating record: " . $conn->error;
  }
}

?>

