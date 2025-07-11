<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once('header.php');
require_once('../server/connection.php');

if (!isset($_REQUEST['id'])) {
    header('location: product.php');
    exit();
} else {
    // Validate the product ID
    $stmt = $conn->prepare("SELECT * FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $_REQUEST['id']);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows == 0) {
        header('location: product.php');
        exit();
    }

    $row = $result->fetch_assoc();
    $photo = $row['product_image'];
    $photo2 = $row['product_image2'];
    $photo3 = $row['product_image3'];
    $photo4 = $row['product_image4'];

    // Delete the product images if they exist
    $photos = [$photo, $photo2, $photo3, $photo4];
    foreach ($photos as $file) {
        if ($file != '' && file_exists('../assets/imgs/' . $file)) {
            unlink('../assets/imgs/' . $file);
        }
    }

    // Delete from products table
    $stmt = $conn->prepare("DELETE FROM products WHERE product_id = ?");
    $stmt->bind_param("i", $_REQUEST['id']);
    $stmt->execute();

    // Delete from order table
    $stmt = $conn->prepare("DELETE FROM tbl_order WHERE product_id = ?");
    $stmt->bind_param("i", $_REQUEST['id']);
    $stmt->execute();

    // Delete from payment table linked by product id (adjust if you use payment_id)
    $stmt = $conn->prepare("DELETE FROM tbl_payment WHERE product_id = ?");
    $stmt->bind_param("i", $_REQUEST['id']);
    $stmt->execute();

    header('location: product.php');
    exit();
}
?>
