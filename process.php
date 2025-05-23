<?php

require_once "connect.php";

if (isset($_POST['submit'])) {
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
            echo "Data inserted successfully!";
        } else {
            echo "Insert failed.";
        }

        $stmt->close();
        $conn->close();
    }
}
