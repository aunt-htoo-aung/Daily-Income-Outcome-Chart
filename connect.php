<?php
$conn = new mysqli('localhost', 'root', '', 'income_outcome');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
