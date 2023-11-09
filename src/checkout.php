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
        <title>Check Out</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="title-user">Check Out</p>
                </div>
            </div>
            <?php
            if (isset($_POST['order']) && ($_POST['order'])) {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $address = $_POST['address'];
                $note = $_POST['note'];

                $result = $iron->findCustomerbyPhone($conn, $phone, $email);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        foreach ($_SESSION[$_SESSION['user']] as $item) {
                            $query = $iron->addOrder($conn, $name, $email, $phone, $address, $note);
                            $add = $iron->addOrdersDetails($conn, $item['id'], $row['id'], $item['quantity'], $item['price']);
                        }
                    }
                }
            }
            ?>
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="row">
                    <div class="panel panel-primary col-md-6">
                        <h4 class="text-center">INFORMATION CUSTOMER</h4>
                        <div class="form-group">
                            <label for="usr">Full name:</label>
                            <input required="true" type="text" class="form-control" id="usr" name="name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input required="true" type="email" class="form-control" id="email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone number:</label>
                            <input required="true" type="text" class="form-control" id="phone_number" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input required="true" type="text" class="form-control" id="address" name="address">
                        </div>
                        <div class="form-group">
                            <label for="note">Note:</label>
                            <textarea class="form-control" rows="3" name="note" id="note"></textarea>
                        </div>
                    </div>
                    <div class="panel panel-primary col-md-6">
                        <h4 class="text-center">ORDER</h4>
                        <table class="table table-bordered table-hover none">
                            <thead>
                                <tr style="font-weight: 500;text-align: center;">
                                    <td width="50px">Order</td>
                                    <td>Product</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                    <td>Total Price</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION[$_SESSION['user']])) {
                                    $count = 0;
                                    $total_price = 0;
                                    $total_quantity = 0;
                                    foreach ($_SESSION[$_SESSION['user']] as $item) {
                                        $total_price = $item['quantity'] * $item['price'];
                                        echo '
                                    <tr style="text-align: center;">
                                        <td width="50px">' . (++$count) . '</td>
                                        <td style="text-align:center; display:flex">
                                            <img class="img-checkout" src="' . $item['image'] . '" alt="" style="width: 50px;margin:0 1rem 0 1rem;"> <span>' . $item['name'] . '</span>
                                        </td>
                                        <td width="100px">' . $item['quantity'] . '</td>
                                        <td width="100px">' . number_format($item['price'], 3) . '</td>
                                        <td class="b-500 red">' . $total_price . '<span> VNĐ</span></td>
                                       
                                    </tr>
                                    ';
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <p>Total Order: <span class="bold red"><?php echo number_format($_SESSION['total']['total_price'], 3) ?><span> VNĐ</span></span></p>
                        <input type="submit" name="order" class="btn btn-primary" value="Order">
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
