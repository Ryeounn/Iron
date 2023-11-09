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
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="stylesheet" href="../css/styleadmin.css">
        <link rel="shortcut icon" type="image/png" href="../img/iron.png">
        <title>Revenue</title>
    </head>
    <body>
        <?php
        require_once '../layouts/sidebar.php';
        ?>
        <div class="home_content">
            <div class="text">Revenue</div>
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
                                        <i class="fas fa-chart-line icon-order"></i>
                                        <span class="order-title">Revenue</span>
                                        <span class="order-number">14.140.000 VND</span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countProduct($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-signal icon-order"></i>
                                        <span class="order-title">Best Seller</span>
                                        <span class="order-number">Unfinished iron</span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="items">
                            <div class="row">
                                <?php
                                $result = $iron->countProduct($conn);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <i class="fas fa-sort-amount-down icon-order"></i>
                                        <span class="order-title">Slowly</span>
                                        <span class="order-number">Equilateral</span>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container local-chart">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="">
                            <canvas id="quantity" width="300" height="300"></canvas>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-5">
                        <div class="">
                            <canvas id="revenue" width="300" height="300"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="../js/chart.js"></script>
</html>
