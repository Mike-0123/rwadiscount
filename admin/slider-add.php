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
    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if ($path == '') {
        $valid = 0;
        $error_message .= 'You must select a photo.<br>';
    }
    if (empty($_POST['caption'])) {
        $valid = 0;
        $error_message .= 'Caption is required.<br>';
    }
    if (empty($_POST['whatsapp_number'])) {
        $valid = 0;
        $error_message .= 'WhatsApp Number is required.<br>';
    }
    if (empty($_POST['status'])) {
        $valid = 0;
        $error_message .= 'Status is required.<br>';
    }

    if ($valid == 1) {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $final_name = 'slide-' . time() . '.' . $ext;
        move_uploaded_file($path_tmp, '../assets/imgs/' . $final_name);

        $stmt = $conn->prepare("INSERT INTO slides (photo, caption, whatsapp_number, status) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $final_name, $_POST['caption'], $_POST['whatsapp_number'], $_POST['status']);
        $stmt->execute();

        $success_message = 'Slide added successfully.';
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Slide</h1>
    </div>
    <div class="content-header-right">
        <a href="slider.php" class="btn btn-primary btn-sm">View All</a>
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
                            <label class="col-sm-2 control-label">Photo <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="file" name="photo" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Caption <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="caption" value="<?php if(isset($_POST['caption'])){echo $_POST['caption'];} ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">WhatsApp Number <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="whatsapp_number" value="<?php if(isset($_POST['whatsapp_number'])){echo $_POST['whatsapp_number'];} ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status <span>*</span></label>
                            <div class="col-sm-6">
                                <select name="status" class="form-control" required>
                                    <option value="active" <?php if(isset($_POST['status']) && $_POST['status'] == 'active') echo 'selected'; ?>>Active</option>
                                    <option value="inactive" <?php if(isset($_POST['status']) && $_POST['status'] == 'inactive') echo 'selected'; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" class="btn btn-success" name="form1">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
