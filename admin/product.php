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
        <title>Product</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <div class="text">Product</div>
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
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->sumQuantity($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-chart-pie icon-order"></i>
                                        <span class="order-title">Quantity</span>
                                        <span class="order-number"><?php echo $row['sum(quantity)'] ?></span>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <i class="fas fa-tags icon-order"></i>
                                <span class="order-title">Category</span>
                                <span class="order-number">Iron</span>
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
                            <p class="title-table">Product Details</p>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <a class="btn btn-primary btn-add" href="addproduct.php"><i class="fas fa-plus"></i> Add Product</a>
                                <input class="input-search-product" type="text" name="key" placeholder="Search...">
                                <input type="submit" name="search" value="Search" class="btn btn-primary btn-search-product">
                            </form>
                            <table class="table index-fix">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Detail</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Size</th>
                                    <th>Kg</th>
                                    <th>Image</th>
                                    <th>Edit</th>
                                    <th>Remove</th>
                                </tr>
                                <?php
                                if (isset($_POST['search']) && ($_POST['search'])) {
                                    $key = $_POST['key'];
                                } else {
                                    $key = 1;
                                }
                                $result = $iron->showProduct($conn, $key);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['type'] ?></td>
                                            <td><?php echo $row['category'] ?></td>
                                            <td><?php echo $row['detail'] ?></td>
                                            <td><?php echo $row['price'] ?></td>
                                            <td><?php echo $row['quantity'] ?></td>
                                            <td><?php echo $row['size'] ?></td>
                                            <td><?php echo $row['kg'] ?></td>
                                            <td><img class="img-table" src="<?php echo $row['img'] ?>"></td>
                                            <td style="text-align: center"><a href="editproduct.php?action=edit&id=<?php echo $row['id'] ?>"><i class="fas fa-pen"></i></a></td>
                                            <td style="text-align: center"><a href="?action=del&id=<?php echo $row['id'] ?>"><i class="fas fa-trash-alt"></i></a></td>
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
