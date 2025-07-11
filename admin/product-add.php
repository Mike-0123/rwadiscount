<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once('header.php');
require_once('../server/connection.php');

$error_message = '';
$success_message = '';

if (isset($_POST['form1'])) {
    $valid = 1;
    if (empty($_POST['p_name'])) {
        $valid = 0;
        $error_message .= "Product title cannot be empty<br>";
    }
    if (empty($_POST['p_current_price'])) {
        $valid = 0;
        $error_message .= "Current price cannot be empty<br>";
    }
    if (empty($_POST['p_offer_percentage'])) {
        $valid = 0;
        $error_message .= "Special offer percentage cannot be empty<br>";
    }
    if (empty($_POST['p_category'])) {
        $valid = 0;
        $error_message .= "Category cannot be empty<br>";
    }
    if (empty($_POST['p_contact_number'])) {
        $valid = 0;
        $error_message .= "Contact number cannot be empty<br>";
    }

    $required_images = ['p_image1', 'p_image2', 'p_image3', 'p_image4'];
    foreach ($required_images as $image) {
        if (empty($_FILES[$image]['name'])) {
            $valid = 0;
            $error_message .= "All 4 images are required<br>";
            break;
        }
    }

    if ($valid == 1) {
        $image_names = [];
        foreach ($required_images as $key => $image) {
            $path = $_FILES[$image]['name'];
            $path_tmp = $_FILES[$image]['tmp_name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $final_name = 'product-' . time() . '-' . ($key + 1) . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/imgs/' . $final_name);
            $image_names[] = $final_name;
        }

        $stmt = $conn->prepare("INSERT INTO products (
            product_name, product_description, product_price, product_special_offer,
            product_category, product_color, product_image, product_image2, product_image3, product_image4, product_contact_number
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ssdisssssss",
            $_POST['p_name'],
            $_POST['p_description'],
            $_POST['p_current_price'],
            $_POST['p_offer_percentage'],
            $_POST['p_category'],
            $_POST['p_color'],
            $image_names[0],
            $image_names[1],
            $image_names[2],
            $image_names[3],
            $_POST['p_contact_number']
        );
        $stmt->execute();
        $success_message = 'Product is added successfully.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Product</h1>
    </div>
    <div class="content-header-right">
        <a href="product.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if ($error_message): ?>
                <div class="callout callout-danger">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>
            <?php if ($success_message): ?>
                <div class="callout callout-success">
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>
            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Product Title <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-8">
                                <textarea name="p_description" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Current Price <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_current_price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Special Offer (%) <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="number" name="p_offer_percentage" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Category <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_category" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Color</label>
                            <div class="col-sm-4">
                                <input type="text" name="p_color" class="form-control">
                            </div>
                        </div>
                        <?php for ($i = 1; $i <= 4; $i++): ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Product Image <?php echo $i; ?> <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="file" name="p_image<?php echo $i; ?>">
                            </div>
                        </div>
                        <?php endfor; ?>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Contact Number (WhatsApp) <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" name="p_contact_number" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-4">
                                <button type="submit" class="btn btn-success" name="form1">Add Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
