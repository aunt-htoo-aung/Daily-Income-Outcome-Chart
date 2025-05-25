<?php
session_start();
require_once "connect.php";
$submit_status = false;
$status = false;
if (isset($_POST['submit'])) {
    $submit_status = true;
    $content = $_POST['about'];
    $type = $_POST['type'];
    $amount = $_POST['amount'];
    if ($content != '' && $type != '' && $amount != 0) {
        // Insert query
        $sql = "INSERT INTO inout_table (content, type,amount) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssd", $content, $type, $amount);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $status = true;
            header("location:index.php");
        } else {
            $status = false;
            header("location:index.php");
        }
        $_SESSION['submit_status'] = $submit_status;
        $_SESSION['status'] = $status;
        $stmt->close();
        $conn->close();
    }
}
