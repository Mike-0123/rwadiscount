<?php require_once('header.php'); ?>
<?php require_once('../server/connection.php'); ?>

<?php
// Ensure pdo is available
if(!isset($pdo)) {
    if(isset($GLOBALS['pdo'])) {
        $pdo = $GLOBALS['pdo'];
    } else {
        exit('Database connection is not available.');
    }
}

if(isset($_POST['form1'])) {
    $valid = 1;
    $error_message = '';

    if(empty($_POST['tcat_id'])) {
        $valid = 0;
        $error_message .= "You must have to select a top level category<br>";
    }
    if(empty($_POST['mcat_id'])) {
        $valid = 0;
        $error_message .= "You must have to select a mid level category<br>";
    }
    if(empty($_POST['ecat_id'])) {
        $valid = 0;
        $error_message .= "You must have to select an end level category<br>";
    }
    if(empty($_POST['p_name'])) {
        $valid = 0;
        $error_message .= "Product name can not be empty<br>";
    }
    if(empty($_POST['p_current_price'])) {
        $valid = 0;
        $error_message .= "Current Price can not be empty<br>";
    }
    if(empty($_POST['p_qty'])) {
        $valid = 0;
        $error_message .= "Quantity can not be empty<br>";
    }

    $path = $_FILES['p_featured_photo']['name'];
    $path_tmp = $_FILES['p_featured_photo']['tmp_name'];
    if($path!='') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if(!in_array($ext, ['jpg','png','jpeg','gif'])) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        if(isset($_FILES['photo']['name'])) {
            $photo = array_values(array_filter($_FILES['photo']['name']));
            $photo_temp = array_values(array_filter($_FILES['photo']['tmp_name']));
            $statement = $pdo->prepare("SHOW TABLE STATUS LIKE 'tbl_product_photo'");
            $statement->execute();
            $result = $statement->fetchAll();
            $next_id1 = $result[0][10];
            $z = $next_id1;
            $final_name1 = [];
            for($i=0;$i<count($photo);$i++) {
                $my_ext1 = pathinfo($photo[$i], PATHINFO_EXTENSION);
                if(in_array($my_ext1, ['jpg','png','jpeg','gif'])) {
                    $final_name1[] = $z.'.'.$my_ext1;
                    move_uploaded_file($photo_temp[$i],"../assets/uploads/product_photos/".$final_name1[$i]);
                    $z++;
                }
            }
            if(!empty($final_name1)) {
                foreach($final_name1 as $fn) {
                    $statement = $pdo->prepare("INSERT INTO tbl_product_photo (photo,p_id) VALUES (?,?)");
                    $statement->execute([$fn,$_REQUEST['id']]);
                }
            }
        }

        if($path == '') {
            $statement = $pdo->prepare("UPDATE tbl_product SET p_name=?, p_old_price=?, p_current_price=?, p_qty=?, p_description=?, p_short_description=?, p_feature=?, p_condition=?, p_return_policy=?, p_is_featured=?, p_is_active=?, ecat_id=? WHERE p_id=?");
            $statement->execute([
                $_POST['p_name'], $_POST['p_old_price'], $_POST['p_current_price'], $_POST['p_qty'], $_POST['p_description'], $_POST['p_short_description'], $_POST['p_feature'], $_POST['p_condition'], $_POST['p_return_policy'], $_POST['p_is_featured'], $_POST['p_is_active'], $_POST['ecat_id'], $_REQUEST['id']
            ]);
        } else {
            unlink('../assets/uploads/'.$_POST['current_photo']);
            $final_name = 'product-featured-'.$_REQUEST['id'].'.'.$ext;
            move_uploaded_file($path_tmp, '../assets/uploads/'.$final_name);
            $statement = $pdo->prepare("UPDATE tbl_product SET p_name=?, p_old_price=?, p_current_price=?, p_qty=?, p_featured_photo=?, p_description=?, p_short_description=?, p_feature=?, p_condition=?, p_return_policy=?, p_is_featured=?, p_is_active=?, ecat_id=? WHERE p_id=?");
            $statement->execute([
                $_POST['p_name'], $_POST['p_old_price'], $_POST['p_current_price'], $_POST['p_qty'], $final_name, $_POST['p_description'], $_POST['p_short_description'], $_POST['p_feature'], $_POST['p_condition'], $_POST['p_return_policy'], $_POST['p_is_featured'], $_POST['p_is_active'], $_POST['ecat_id'], $_REQUEST['id']
            ]);
        }

        $statement = $pdo->prepare("DELETE FROM tbl_product_size WHERE p_id=?");
        $statement->execute([$_REQUEST['id']]);
        if(isset($_POST['size'])) {
            foreach($_POST['size'] as $value) {
                $statement = $pdo->prepare("INSERT INTO tbl_product_size (size_id,p_id) VALUES (?,?)");
                $statement->execute([$value,$_REQUEST['id']]);
            }
        }
        $statement = $pdo->prepare("DELETE FROM tbl_product_color WHERE p_id=?");
        $statement->execute([$_REQUEST['id']]);
        if(isset($_POST['color'])) {
            foreach($_POST['color'] as $value) {
                $statement = $pdo->prepare("INSERT INTO tbl_product_color (color_id,p_id) VALUES (?,?)");
                $statement->execute([$value,$_REQUEST['id']]);
            }
        }

        $success_message = 'Product is updated successfully.';
    }
}

if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    $statement = $pdo->prepare("SELECT * FROM tbl_product WHERE p_id=?");
    $statement->execute([$_REQUEST['id']]);
    if($statement->rowCount() == 0) {
        header('location: logout.php');
        exit;
    }
}
?>

<!-- The rest of the HTML form remains unchanged. -->
