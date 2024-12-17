<?php
session_start();
include "database.php";
if (!isset($_SESSION["matric"])) {
  header("Location: loginForm.php");
  exit;
}
if (isset($_GET["success"])) {
  echo "<script>alert('" . $_GET["success"] . "');</script>";
}
?>

<style>
  body {
    text-align: center;
  }

  table {
    margin: auto;
    border-collapse: collapse;
    width: 80%;
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even) {
    background-color: #f2f2f2;
  }

  th {
    background-color: #4CAF50;
    color: white;
  }

  .action {
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    background-color: rgb(70, 70, 255);
    border-radius: 10px;
    color: white;
  }

  .action:hover {
    background-color:rgb(0, 0, 255);
  }

  .deleteButton {
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    background-color: red;
    border-radius: 10px;
    color: white;
  }

  .deleteButton:hover{
    background-color: rgb(212, 0, 0);
  }

  .logoutButton {
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    background-color: red;
    border-radius: 10px;
    color: white;
  }

  .logoutButton:hover{
    background-color: rgb(212, 0, 0);
  }

  .add{
    border: none;
    padding: 8px 16px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    background-color: #4CAF50;
    border-radius: 10px;
    color: white;
  }

  .add:hover{
    background-color: rgb(0, 128, 0);
  }
</style>
<h1>User List</h1>
<a class="add" href="addUser.php">Add New User</a>
<br><br>

<table border="1">
  <tr>
    <th>Matric</th>
    <th>Name</th>
    <th>Level</th>
    <th colspan="2">Action</th>
  </tr>
  <?php
  
  $sql = "SELECT matric, name, password, role FROM users";
  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
      echo "<tr>
              <td>" . $row["matric"] . "</td>
              <td>" . $row["name"] . "</td>
              <td>" . $row["role"] . "</td>
              <td style=\"width: 0%;  border-right: none;\">
                <a class='action' href='updateUser.php?matric=" . $row["matric"] . "'>Update</a>
              </td>
              <td style=\"width: 0%; border-left: none;\">
                <a class='deleteButton' href='deleteUser.php?matric=" . $row["matric"] . "'>Delete</a>
              </td>
            </tr>";
    }
  } else {
    echo "0 results";
  }
  ?>
</table>
<br><br>
<a class="logoutButton" href="logout.php">Log out</a>

