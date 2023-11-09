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
        <title>My Order</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="title-user">MY ORDER</p>
                </div>
            </div>
            <?php
            if (isset($_SESSION['user']) && ($_SESSION['user'])) {
                $result = $iron->checkUser($conn, $_SESSION['infor'][0], $_SESSION['infor'][1]);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $_SESSION['id_users'] = $row['id'];
                        ?>
                        <div class="row">
                            <div class="col-lg-3">
                                <img class="img-infor-cus" id="image" onchange="chooseFile(this)" src="<?php echo $row['img'] ?>">
                                <ul id="information-list">
                                    <li><a href="information.php">My Information</a></li>
                                    <li><a href="myorder.php">My Order</a></li>
                                    <li><a href="logout.php">Logout</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-9">
                                <div class="infor-form">
                                    <div class="infor-head-items">
                                        <p class="infor-subtitle">Orders have been approved</p>
                                        <div class="infor-linerow"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="order-items">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Order ID</th>
                                                        <th>User ID</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                    </tr>
                                                    <?php
                                                    $user = $_SESSION['infor'][8];
                                                    $result = $iron->countIDOrder($conn, $user);
                                                    if ($result->num_rows > 0) {
                                                        while ($row = $result->fetch_assoc()) {
                                                            $total_records = $row['count(userID)'];
                                                        }
                                                    }
                                                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                                                    $limit = 4;

                                                    $total_page = ceil($total_records / $limit);

                                                    if ($current_page > $total_page) {
                                                        $current_page = $total_page;
                                                    } else if ($current_page < 1) {
                                                        $current_page = 1;
                                                    }
                                                    $start = ($current_page - 1) * $limit;
                                                    $query = $iron->showParaOrder($conn, $start, $limit, $user);
                                                    if ($query->num_rows > 0) {
                                                        while ($rows = $query->fetch_assoc()) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $rows['orderID'] ?></td>
                                                                <td><?php echo $rows['userID'] ?></td>
                                                                <td><?php echo $rows['date'] ?></td>
                                                                <td><?php echo $rows['st'] ?></td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php } ?>
                                                </table>
                                                <ul class="pagination">
                                                    <?php
                                                    if ($current_page > 1 && $total_page > 1) {
                                                        echo '<a href="?page=' . ($current_page - 1) . '"><i class="fas fa-step-backward"></i></a>';
                                                    }

                                                    for ($i = 1; $i <= $total_page; $i++) {
                                                        if ($i == $current_page) {
                                                            echo '<nav class="page">' . $i . ' | </nav>';
                                                        } else {
                                                            echo '<a href="?page=' . $i . '">' . $i . ' | </a> ';
                                                        }
                                                    }

                                                    if ($current_page < $total_page && $total_page > 1) {
                                                        echo '<a href="?page=' . ($current_page + 1) . '"><i class="fas fa-step-forward"></i></a>  ';
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </div>
    </body>
</html>
