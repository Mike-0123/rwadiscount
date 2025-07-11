<?php
// Delete Subscriber Logic - subscriber-delete.php
include('../server/connection.php');
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT image_url FROM cards WHERE card_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result && !empty($result['image_url'])) {
        unlink('../assets/imgs/' . $result['image_url']);
    }

    $stmt = $conn->prepare("DELETE FROM cards WHERE card_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();

    header('Location: subscriber.php');
    exit();
}
?>
