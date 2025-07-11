<?php require_once('header.php'); ?>
<?php   

if(!isset($_SESSION['admin_logged_in'])){
    header('Location: login.php');
    exit();
}

//get all products 
$stmt2 = $conn->prepare("SELECT * FROM products ");
$stmt2->execute();
$products = $stmt2->get_result();
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Products</h1>
    </div>
    <div class="content-header-right">
        <a href="product-add.php" class="btn btn-primary btn-sm">Add Product</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th width="160">Product ID</th>
                                <th width="60">Product Image</th>
                                <th width="60">Product Name</th>
                                <th width="60">Product Price</th>
                                <th width="60">Product Offer</th>
                                <th>Discount Percentage</th>
                                <th width="60">Product Category</th>
                                <th>Product Color</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['product_id']; ?></td>
                                    <td><img src="<?php echo "../assets/imgs/" . $product['product_image']; ?>" style="width:70px;height:70px"/></td>
                                    <td><?php echo $product['product_name']; ?></td>
                                    <td><?php echo $product['product_price']; ?></td>
                                    <td><?php echo $product['product_special_offer']; ?></td>
                                    <td><?php echo $product['product_discount_percentage']; ?></td>
                                    <td><?php echo $product['product_category']; ?></td>
                                    <td><?php echo $product['product_color']; ?></td>
                                    <td>                                        
                                        <a href="product-edit.php?id=<?php echo $product['product_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-xs" data-href="product-delete.php?id=<?php echo $product['product_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>  
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure want to delete this item?</p>
                <p style="color:red;">Be careful! This product will be deleted from the order table, payment table, size table, color table and rating table also.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
