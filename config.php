<?php
$conn = new mysqli("localhost", "root", "", "eddymarsan_system_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
?>