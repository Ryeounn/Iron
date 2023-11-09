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
        <link rel="stylesheet" href="../css/style.css">
        <link rel="shortcut icon" type="image/png" href="../img/iron.png">
        <title>Home Admin</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <div class="text">Dashboard</div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countProduct($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fa-brands fa-codepen icon-order"></i>
                                        <span class="order-title">Product</span>
                                        <span class="order-number"><?php echo $row['count(id)'] ?></span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countOrder($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-database icon-order"></i>
                                        <span class="order-title">Order</span>
                                        <span class="order-number"><?php echo $row['count(orderID)'] ?></span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countUser($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-users icon-order"></i>
                                        <span class="order-title">User</span>
                                        <span class="order-number"><?php echo $row['count(id)'] ?></span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="items-table">
                            <?php
                            if (isset($_GET['action']) && ($_GET['action']) == 'accept') {
                                $id = $_GET['id'];
                                $st = 'accept';
                                $result = $iron->updateStatus($conn, $st, $id);
                            }

                            if (isset($_GET['action']) && ($_GET['action']) == 'refuse') {
                                $id = $_GET['id'];
                                $st = 'cancel';
                                $result = $iron->updateStatusRefuse($conn, $st, $id);
                            }
                            ?>
                            <table class="table">
                                <p class="pending-order">Pending Order</p>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Accept</th>
                                    <th>Remove</th>
                                </tr>
                                <?php
                                $st = 'pending';
                                $result = $iron->showOrderPending($conn, $st);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><?php echo $row['date'] ?></td>
                                            <td><?php echo $row['st'] ?></td>
                                            <td class="text-center"><a href="?action=accept&id=<?php echo $row['orderID'] ?>"><i class="fas fa-check-circle"></i></a></td>
                                            <td class="text-center"><a href="?action=refuseid=<?php echo $row['orderID'] ?>"><i class="fas fa-times-circle"></i></a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                
            </div>
            <div class="container margintop-container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="items-table">
                            <table class="table">
                                <p class="pending-order">Order Details</p>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Price</th>
                                </tr>
                                <?php
                                $result = $iron->showOrderDetail($conn);
                                if($result->num_rows > 0){
                                    while ($row = $result->fetch_assoc()){
                                ?>
                                <tr>
                                    <td><?php echo $row['orderID']?></td>
                                    <td><?php echo $row['productName']?></td>
                                    <td><?php echo $row['quantity']?></td>
                                    <td><?php echo number_format($row['price'],3)?> VND</td>
                                    <td><?php echo number_format($row['price'] * $row['quantity'],3)?> VND</td>
                                </tr>
                                    <?php } ?>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
