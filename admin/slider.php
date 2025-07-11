<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once('header.php');
require_once('../server/connection.php'); // Ensure this file initializes $conn

// Get all slides
$stmt = $conn->prepare("SELECT slide_id, photo, whatsapp_number, caption, status FROM slides ORDER BY slide_id ASC");
$stmt->execute();
$slides = $stmt->get_result();
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Slides</h1>
    </div>
    <div class="content-header-right">
        <a href="slider-add.php" class="btn btn-primary btn-sm">Add Slide</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Whatsapp Number</th>
                                <th>Caption</th>
                                <th>Status</th>
                               
                              
                               
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0; foreach($slides as $slide): $i++; ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><img src="../assets/imgs/<?php echo htmlspecialchars($slide['photo']); ?>" style="width:70px;height:70px" alt="Slide Image"></td>
                                    <td><?php echo htmlspecialchars($slide['whatsapp_number']); ?></td>
                                    <td><?php echo htmlspecialchars($slide['caption']); ?></td>
                                    <td><?php echo htmlspecialchars($slide['status']); ?></td>
                                 
                                    <td>
                                        <a href="slider-edit.php?id=<?php echo $slide['slide_id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-xs" data-href="slider-delete.php?id=<?php echo $slide['slide_id']; ?>" data-toggle="modal" data-target="#confirm-delete">Delete</a>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
</div>

<?php require_once('footer.php'); ?>
