<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once('header.php');
require_once('../server/connection.php');

// Add Subscriber Logic
if (isset($_POST['add_subscriber'])) {
    $whatsapp_number = trim($_POST['whatsapp_number']);
    $status = trim($_POST['status']);
    $error_message = '';
    $success_message = '';

    if (!empty($_FILES['image_url']['name'])) {
        $image_name = time() . '-' . basename($_FILES['image_url']['name']);
        $target_path = '../assets/imgs/' . $image_name;

        if (move_uploaded_file($_FILES['image_url']['tmp_name'], $target_path)) {
            $stmt = $conn->prepare("INSERT INTO cards (image_url, whatsapp_number, status) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $image_name, $whatsapp_number, $status);
            $stmt->execute();
            $success_message = 'Subscriber added successfully.';
        } else {
            $error_message = 'Failed to upload image.';
        }
    } else {
        $error_message = 'Please select an image.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Subscriber</h1>
    </div>
    <div class="content-header-right">
        <a href="subscriber.php" class="btn btn-primary btn-sm">View All Subscribers</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if (!empty($error_message)): ?>
                <div class="callout callout-danger">
                    <p><?php echo htmlspecialchars($error_message); ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="callout callout-success">
                    <p><?php echo htmlspecialchars($success_message); ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="box box-info">
                    <div class="box-body">

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Photo <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="file" name="image_url" required>
                                <p class="help-block">Only jpg, jpeg, png, gif files allowed.</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">WhatsApp Number <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="whatsapp_number" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status <span>*</span></label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control" required>
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-success" name="add_subscriber">Add Subscriber</button>
                            </div>
                        </div>

                    </div>
                </div>
            </form>

        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
