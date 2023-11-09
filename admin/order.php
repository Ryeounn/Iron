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
        <title>Order</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <div class="text">Order</div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countOrder($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-clipboard-list icon-order"></i>
                                        <span class="order-title">Order</span>
                                        <span class="order-number"><?php echo $row['count(orderID)'] ?></span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countAccept($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-clipboard-check icon-order"></i>
                                        <span class="order-title">Accept</span>
                                        <span class="order-number"><?php echo $row['count(orderID)'] ?></span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countPending($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-clipboard icon-order"></i>
                                        <span class="order-title">Pending</span>
                                        <span class="order-number"><?php echo $row['count(orderID)'] ?></span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        if (isset($_GET['action']) && ($_GET['action']) == 'del') {
                            $id = $_GET['id'];
                            $result = $iron->deleteProduct($conn, $id);
                            echo '<Script>alert("Delete ' . $id . ' Successfully!")</script>';
                        }
                        ?>
                        <div class="items-table">
                            <p class="title-table">Orders</p>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <input class="input-search-order" type="text" name="key" placeholder="Search...">
                                <input type="submit" name="search" value="Search" class="btn btn-primary btn-search-product">
                            </form>
                            <table class="table index-fix">
                                <tr>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>ProductName</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                </tr>
                                <?php
                                if (isset($_POST['search']) && ($_POST['search'])) {
                                    $key = $_POST['key'];
                                } else {
                                    $key = 1;
                                }
                                $result = $iron->showOrder($conn, $key);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['orderID'] ?></td>
                                            <td><?php echo $row['userID'] ?></td>
                                            <td><?php echo $row['productName'] ?></td>
                                            <td><?php echo $row['date'] ?></td>
                                            <td><?php echo $row['st'] ?></td>
                                            <td><a href="editorder.php?action=edit&id=<?php echo $row['orderID'] ?>"><i class="fas fa-pen"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
