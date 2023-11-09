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
        <title>Contact</title>
    </head>
    <body>
        <?php
        require_once '../layouts/header.php';
        ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <p class="title-user">Contact Information</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="mapping">
                        <iframe class="mapping" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1210.9763194323941!2d105.7792519778954!3d10.033661275321304!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0881f9a732075%3A0xfa43fbeb2b00ca73!2sCUSC%20-%20Cantho%20University%20Software%20Center!5e0!3m2!1sen!2s!4v1695227268780!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-lg-6">
                    <?php
                    if(isset($_POST['send']) && ($_POST['send'])){
                        $name = $_POST['name'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $note = $_POST['note'];
                        $date = date("m/d/Y");
                        
                        $result = $iron->addContact($conn, $name, $phone, $email, $note, $date);
                        echo '<script>alert("Contact information has been sent")</script>';
                    }
                    ?>
                    <div class="form-contact">
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                            <div class="form-group">
                                <label for="email">Name:</label>
                                <input type="text" class="form-control" placeholder="Enter name" name="name">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Phone:</label>
                                <input type="number" class="form-control" placeholder="Enter phone" name="phone">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" placeholder="Enter email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="pwd">Note:</label>
                                <input type="text" class="form-control" placeholder="Enter note" name="note">
                            </div>
                            <input type="submit" class="btn btn-primary btn-send" name="send" value="Send">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
        require_once '../layouts/footer.php';
        ?>
    </body>
</html>
