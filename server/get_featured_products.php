<?php
//here we get the deal from the restaurant and allimentation  please not the featured product 
include('connection.php');
$stmt= $conn->prepare("SELECT *FROM products LIMIT 20");
$stmt->execute();
$featured_products = $stmt->get_result();

?>