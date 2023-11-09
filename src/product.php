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
        <link rel="stylesheet" href="../css/styleclient.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png">
        <title>Product</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="title-user">Product</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <ul id="product-list">
                        <li class="first-li"><a href="product.php?action?product&id=0" class="first-list"><i class="fab fa-codepen"></i>Category</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=1" class="second-list"><i class="fas fa-arrow-circle-right"></i>Circle</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=2" class="second-list"><i class="fas fa-arrow-circle-right"></i>Equilateral Triangle</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=3" class="second-list"><i class="fas fa-arrow-circle-right"></i>Unfinished Iron and Steel</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=4" class="second-list"><i class="fas fa-arrow-circle-right"></i>Letter C</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=5" class="second-list"><i class="fas fa-arrow-circle-right"></i>Rectangle</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=6" class="second-list"><i class="fas fa-arrow-circle-right"></i>Square</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=7" class="second-list"><i class="fas fa-arrow-circle-right"></i>Straight</a></li>
                        <li class="first-li"><a href="product.php?action?product&id=8" class="first-list"><i class="fas fa-wallet"></i>Price</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=9" class="second-list"><i class="fas fa-arrow-circle-right"></i><50.000 VND</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=10" class="second-list"><i class="fas fa-arrow-circle-right"></i><100.000 VND</a></li>
                        <li class="second-li"><a href="product.php?action?product&id=11" class="second-list"><i class="fas fa-arrow-circle-right"></i>>100.000 VND</a></li>
                    </ul>
                </div> 
                <div class="col-lg-9">
                    <div class="row">
                        <?php
                        if (isset($_GET['id']) && ($_GET['id']) > 0) {
                            $iddm = $_GET['id'];
                        } else {
                            $iddm = 0;
                        }
                        $listproduct = $iron->showProductClient($conn, $iddm);
                        foreach ($listproduct as $item) {
                            echo '
                                <div class="col-lg-4">
                                    <div class="product-items">
                                        <img class="product-img" src="' . $item['img'] . '">
                                        
                                        <p class="product-name">' . $item['name'] . '</p>
                                        <p class="product-type"><b>Type:</b> ' . $item['type'] . '</p>
                                        <p class="product-time"><b>Category:</b> ' . $item['category'] . '</p>
                                        <p class="product-price"><b>Price:</b> ' . $item['price'] . ' VND</p>
                                        <a class="btn btn-primary btndetails" href="details.php?action?details&id=' . $item['id'] . '">Details</a>
                                    </div>
                                </div>
                            ';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once '../layouts/footer.php';
        ?>
    </body>
</html>
