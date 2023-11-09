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
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Shopping Cart</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <?php
        if (isset($_GET['action']) && ($_GET['action'] == 'remove')) {
            foreach ($_SESSION[$_SESSION['user']] as $key => $value) {
                if ($_GET['id'] == $key) {
                    unset($_SESSION[$_SESSION['user']][$key]);
                }
                if (empty($_SESSION[$_SESSION['user']])) {
                    unset($_SESSION[$_SESSION['user']]);
                }
            }
        }
        if (isset($_GET['action']) && ($_GET['action'] == 'empty')) {
            unset($_SESSION[$_SESSION['user']][$id]);
        }
        ?>

        <?php
        if (isset($_SESSION[$_SESSION['user']])) {
            $total_quantity = 0;
            $total_price = 0;
            ?>
            <div id="shopping">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        if (isset($_GET['action']) && ($_GET['action'] == 'up')) {
                            $id = $_GET['id'];
                            $_SESSION[$_SESSION['user']][$id]['quantity'] += 1;
                        } else if (isset($_GET['action']) && ($_GET['action'] == 'down')) {
                            $id = $_GET['id'];
                            $_SESSION[$_SESSION['user']][$id]['quantity'] -= 1;
                            if ($_SESSION[$_SESSION["user"]][$id]['quantity'] <= 0) {
                                unset($_SESSION[$_SESSION["user"]][$id]);
                            }
                        }
                        ?>
                        <div class="col-lg-12">
                            <p class="title-user">Shopping Cart</p>
                            <a href="?action=empty" class="btn btn-primary">Empty Cart</a>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if (isset($_GET['action']) && ($_GET['action'] == 'order')) {

                            $_SESSION['order'] = $_SESSION[$_SESSION['user']];
                            $id = $_SESSION['infor'][8];
                            $date = date('Y-m-d');
                            $st = 'pending';
                            foreach ($_SESSION['order'] as $item) {
                                $product = $item['name'];
                                $price = $item['price'];
                                $quantity = $item['quantity'];
                                $result = $iron->addOrder($conn, $st, $date, $id);
                                $query = $iron->addOrdersDetails($conn, $product, $price, $quantity);
                            }
                            unset($_SESSION[$_SESSION['user']]);
                            echo '<script>alert("Order Successfully")</script>';
                            echo '<script>window.location = "home.php"</script>';
                        }
                        ?>
                        <div class="col-lg-12">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Product ID</th>
                                    <th>Product Name</th>
                                    <th class="text-right">Quantity</th>
                                    <th class="text-right">Unit Price</th>
                                    <th class="text-right">Price</th>
                                    <th class="text-center">Remove</th>
                                </tr>
                                <?php
                                foreach ($_SESSION[$_SESSION['user']] as $item => $value) {
                                    $item_price = $value['quantity'] * $value['price'];
                                    ?>
                                    <tr>
                                        <td><?php echo $item ?><img class="cart-item-image" src="<?php echo $value['image'] ?>"></td>
                                        <td><?php echo $value['name'] ?></td>
                                        <td class="text-right"><a href="?action=up&id=<?php echo $item; ?>"><i class="fas fa-caret-up"></i></a> <?php echo $value['quantity'] ?> <a href="?action=down&id=<?php echo $item; ?>"><i class="fas fa-caret-down"></i></a></td>
                                        <td class="text-right"><?php echo number_format($value['price'],3) . " VND" ?></td>
                                        <td class="text-right"><?php echo number_format($item_price, 3) . " VND" ?></td>
                                        <td class="text-center"><a href="?action=remove&id=text-center<?php echo $item; ?>"><i class="fas fa-trash-alt"></i></a></td>
                                        <?php
                                        $total_quantity += $value['quantity'];
                                        $total_price += ($value['price'] * $value['quantity']);
                                        $_SESSION['total'] = array('total_quantity' => $total_quantity, 'total_price' => $total_price);
                                    }
                                    ?>
                                </tr>
                                <tr>
                                    <td colspan="2" align="right">Total:</td>
                                    <td align="right"><?php echo $total_quantity; ?></td>
                                    <td align="right" colspan="2"><strong><?php echo number_format($total_price, 3) . " VND" ?></strong></td>
                                    <td></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <a href="?action=order" class="btn btn-primary btnorder">Order</a>
                        </div>
                        <div class="col-lg-4"></div>
                    </div>
                </div>
            </div>
        <?php } else {
            ?>
            <div class="no-reconds">Your Cart is Empty</div>
        <?php } ?>
    </body>
</html>
