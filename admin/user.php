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
        <title>User</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <div class="text">User</div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countUser($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-users icon-order"></i>
                                        <span class="order-title">Users</span>
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
                                $result = $iron->countCustomer($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-user icon-order"></i>
                                        <span class="order-title">Customer</span>
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
                                $result = $iron->countAdmin($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                <i class="fas fa-user-tie icon-order"></i>
                                <span class="order-title">Admin</span>
                                <span class="order-number"><?php echo $row['count(id)'] ?></span>
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
                            $result = $iron->deleteUser($conn, $id);
                            echo '<Script>alert("Delete ' . $id . ' Successfully!")</script>';
                        }
                        ?>
                        <div class="items-table">
                            <p class="title-table">User Details</p>
                            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                                <a class="btn btn-primary btn-add" href="adduser.php"><i class="fas fa-plus"></i> Add User</a>
                                <input class="input-search-user" type="text" name="key" placeholder="Search...">
                                <input type="submit" name="search" value="Search" class="btn btn-primary btn-search-product">
                            </form>
                            <table class="table index-fix">
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Email</th>
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
                                $result = $iron->showUser($conn, $key);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $row['id'] ?></td>
                                            <td><?php echo $row['username'] ?></td>
                                            <td><?php echo $row['password'] ?></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['phone'] ?></td>
                                            <td><?php echo $row['email'] ?></td>
                                            <td><img class="img-table" src="<?php echo $row['img'] ?>"></td>
                                            <td style="text-align: center"><a href="edituser.php?action=edit&id=<?php echo $row['id'] ?>"><i class="fas fa-pen"></i></a></td>
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
