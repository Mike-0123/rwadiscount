<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once('header.php');
require_once('../server/connection.php');

if (!isset($_REQUEST['id'])) {
    header('location: slider.php');
    exit();
} else {
    // Validate the id
    $stmt = $conn->prepare("SELECT * FROM slides WHERE slide_id = ?");
    $stmt->bind_param("i", $_REQUEST['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        header('location: slider.php');
        exit();
    }

    $row = $result->fetch_assoc();
    $photo = $row['photo'];

    // Delete the photo file if it exists
    if ($photo != '' && file_exists('../assets/uploads/' . $photo)) {
        unlink('../assets/uploads/' . $photo);
    }

    // Delete the slide from the database
    $stmt = $conn->prepare("DELETE FROM slides WHERE slide_id = ?");
    $stmt->bind_param("i", $_REQUEST['id']);
    $stmt->execute();

    header('location: slider.php');
    exit();
}
?>
