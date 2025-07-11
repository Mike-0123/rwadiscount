<?php
//here we get the deal from the restaurant and allimentation  please not the featured product 
include('connection.php');
$stmt= $conn->prepare("SELECT *FROM products WHERE product_category='coats' LIMIT 20");
$stmt->execute();

$coats_products = $stmt->get_result()//[];

?>