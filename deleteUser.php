<?php
session_start();
if (!isset($_SESSION["matric"])) {
  header("Location: loginForm.php");
  exit;
}
include "database.php";

if (isset($_GET["matric"])) {
  $matric = $_GET["matric"];
  $sql = "DELETE FROM users WHERE matric = '$matric'";
  if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Record deleted successfully'); window.location.href='userList.php';</script>";
  } else {
    echo "<script>alert('Error deleting record: " . $conn->error . "');</script>";
  }
}
?>

