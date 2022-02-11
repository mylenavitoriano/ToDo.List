<?php

$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli("localhost", "root", "", "lista_tarefas");

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
