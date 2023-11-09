<?php
session_start();
require_once '../dbconnect.php';
require_once '../Iron.php';
$iron = new Iron();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/iron.png">
        <title>Edit Order</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <div class="text">Edit Status Order</div>
            <div class="container">
                <div class="items-order">
                    <?php
                    if (isset($_POST['save']) && ($_POST['save'])) {
                        $status = $_POST['st'];
                        $result = $iron->updateStatusOrder($conn, $_SESSION['id_st'], $status);
                         echo '<Script>alert("Update Status Successfully!")</script>';
                         echo '<Script>window.location = "order.php"</script>';
                    }
                    ?>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="title-form">Edit Status</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <?php
                            if (isset($_GET['action']) && ($_GET['action'] == 'edit')) {
                                $id = $_GET['id'];
                                $_SESSION['id_st'] = $id;
                                $result = $iron->showOrderDetailbyID($conn, $id);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <div class="col-lg-4">
                                            <input type="text" name="st" class="input-search-editorder" value="<?php echo $row['st'] ?>">
                                            <input type="submit" class="btn btn-primary btn-search-product" name="save" value="Save">
                                        <?php } ?>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <div class="col-lg-4"></div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
