<?php
session_start();

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit();
}

require_once('header.php');
require_once('../server/connection.php');
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Cards</h1>
    </div>
    <div class="content-header-right">
        <a href="card_add_card.php" class="btn btn-primary btn-sm">Add Card</a>
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
                                <th>Card ID</th>
                                <th>Card Image</th>
                                <th>WhatsApp Link</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stmt = $conn->prepare("SELECT * FROM cards ORDER BY card_id ASC");
                            $stmt->execute();
                            $cards = $stmt->get_result();
                            foreach ($cards as $card): ?>
                                <tr>
                                    <td><?php echo $card['card_id']; ?></td>
                                    <td><img src="../assets/imgs/<?php echo htmlspecialchars($card['card_image']); ?>" style="width:70px;height:70px"></td>
                                    <td><a href="<?php echo htmlspecialchars($card['whatsapp_link']); ?>" target="_blank">Contact</a></td>
                                    <td><a href="card_edit.php?id=<?php echo $card['card_id']; ?>" class="btn btn-primary btn-xs">Edit</a></td>
                                    <td><a href="card_delete.php?id=<?php echo $card['card_id']; ?>" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?');">Delete</a></td>
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
