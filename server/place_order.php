<?php
 include('connection.php');
 session_start();

if(isset($_POST['place_order'])){


//get the users information  wee need the email phone  numger email and address  and store i

$name = $_POST['name'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$city= $_POST['city'];
$order_cost= $_SESSION['total'];
$order_status = "on_hold";
$user_id = $_SESSION['user_id'];
date_default_timezone_set('Africa/Kigali');
$order_date = date('Y-m-d H:i:s');




$stmt=$conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                VALUES (?,?,?,?,?,?,?);"// this help to protect the hackers 
                 );

                 $stmt->bind_param('isiisss',$order_cost,$order_status,$user_id,$phone,$city,$address,$order_date);
                 
                 $stmt-> execute();
                   $order_id = $stmt ->insert_id;
                    echo $order_id;




// get product from the cart  from the session 


$_SESSION['cart'];
foreach(
    $_SESSION['cart'] as $key =>$value){
        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
 $stmt1= $conn->prepare("INSERT INTO order_items (order_id,product_id,product_name,product_image,product_price,product_quantity,user_id,order_date)
            VALUES (?,?,?,?,?,?,?,?)");


$stmt1->bind_param('iissiiis',$order_id,$product_id,$product_name,$product_image,$product_price,$product_quantity,$user_id,$order_date);
  $stmt1->execute();

    }








// issues from store the order information on database 




//store each single item in order item database 






//remove the very thing from the cart  dealy until payment is done please



//unset($_SESSION['cart']);





//inform use everything is fine there is a problem tell them and remind him 

header('location:../payment.php?order_status= order list success fullly');

}


?>