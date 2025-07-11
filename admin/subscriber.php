<?php
// subscriber.php (previously card.php)
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once('header.php');
require_once('../server/connection.php');

$stmt = $conn->prepare("SELECT * FROM cards ORDER BY card_id DESC");
$stmt->execute();
$cards = $stmt->get_result();
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Subscribers</h1>
    </div>
    <div class="content-header-right">
        <a href="subscriber-remove.php" class="btn btn-primary btn-sm">Add Subscriber</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Subscriber ID</th>
                                <th>Subscriber Image</th>
                                <th>WhatsApp Number</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cards as $card): ?>
                            <tr>
                                <td><?php echo $card['card_id']; ?></td>
                                <td><img src="../assets/imgs/<?php echo $card['image_url']; ?>" style="width:70px;height:70px"></td>
                                <td><?php echo $card['whatsapp_number']; ?></td>
                                <td>
                                    <a href="subscriber-delete.php?id=<?php echo $card['card_id']; ?>" class="btn btn-danger btn-xs">Delete</a>
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

<?php require_once('footer.php'); ?>
