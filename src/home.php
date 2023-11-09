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
        <title>Home</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div id="slider">
            <div id="demo" class="carousel slide" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    <li data-target="#demo" data-slide-to="0" class="active"></li>
                    <li data-target="#demo" data-slide-to="1"></li>
                    <li data-target="#demo" data-slide-to="2"></li>
                </ul>

                <!-- The slideshow -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="../img/banner/banner1.jpg" alt="Los Angeles" width="100%" height="400">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/banner/banner2.jpg" alt="Chicago" width="100%" height="400">
                    </div>
                    <div class="carousel-item">
                        <img src="../img/banner/banner3.jpg" alt="New York" width="100%" height="400">
                    </div>
                </div>

                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
        <div class="container">
            <div class="row fix-row">
                <div class="col-lg-3">
                    <div class="company">
                        <i class="fa-solid fa-earth-americas traidat"></i>
                        <p class="texttraidat">Category</p>
                        <p class="iiii">We have all the leading types of iron and steel on the market such as: Southern iron, Pomina steel, Viet Nhat, Viet Uc,...</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="company">
                        <i class="fa-solid fa-dollar-sign traidat"></i>
                        <p class="texttraidat">Price</p>
                        <p class="iiii">Current steel prices are affordable (cheap on the market)</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="company">
                        <i class="fa-solid fa-truck traidat"></i>
                        <p class="texttraidat">Delivery</p>
                        <p class="iiii">There are trucks that transport goods to customers' homes</p>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="company">
                        <i class="fa-solid fa-book-atlas traidat"></i>
                        <p class="texttraidat">Policy</p>
                        <p class="iiii">Thoughtful after-sales and warranty policy</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="textwcome">
                        <p class="title-user">Providing wholesale iron and cheap price, prestige and quality</p>
                        <p class="title-user1">Manh Phat is one of the companies specializing in distributing all kinds of iron and steel at leading reputable wholesale prices in the Can Tho City area. Since our establishment, we have been loved by many customers because of our good product quality and affordable prices.</p>
                        <hr>

                    </div>
                </div>
            </div>
            <div class="row welcomehome">
                <div class="col-lg-6">
                    <div>
                        <img class="img-welcome" src="../img/home/home-1.jpg">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="ertyuio">
                        <p class="text-welcome">Welcome<i class="fa-brands fa-codepen welcome-icon"></i>Iron</p>
                        <p class="title-user2">We provide wholesale prices for customers who work as iron and steel agents and construction material stores to buy iron and steel in Can Tho City in large quantities. However, not only units specializing in distributing and selling iron and steel can import wholesale prices, but also customers who are individual construction contractors who can continuously import goods to serve construction purposes when negotiating. With us, we can still give wholesale prices to customers, all of which are negotiated by both parties.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <p class="best-title">Best Seller</p>
                </div>
            </div>
            <div class="row">
                <?php
                $result = $iron->showBestSeller($conn);
                if($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                ?>
                <div class="col-lg-3">
                    <div class="product-itemshome">
                        <img class="img-producthome" src="<?php echo $row['img']?>">
                        <p class="product-namehome"><b><?php echo $row['name']?></b> </p>
                        <p class="product-typehome"><b>Type: </b><?php echo $row['type']?></p>
                        <p class="product-typehome"><b>Category: </b><?php echo $row['category']?></p>
                        <p class="product-typehome"><b>Size: </b><?php echo $row['size']?></p>
                        <p class="product-typehome"><b>Price: </b><?php echo $row['price']?></p>
                        <a href="details.php?action?details&id=<?php echo $row['id']?>" class="btn btn-primary btndetailshome">Detail</a>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>
            </div>
        </div>
        <?php
        require_once '../layouts/footer.php';
        ?>
    </body>
</html>
