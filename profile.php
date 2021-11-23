<?php
include("./header.php");
?>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <!-- Start Left menu area -->
    <?php
    include("./components/nav.php");
    ?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <?php
    include("./components/headernav.php");

    $email = $_COOKIE["email"];

    $query = "SELECT * FROM `login` WHERE `email` = ?";
    $result = $conn->prepare($query);
    $result->execute([$email]);

    $row = $result->fetch();
    extract($row);
    ?>
    <div class="contacts-area mg-b-15 mg-t-30">
        <div class="container-fluid">
            <div style="display: flex; justify-content: center; align-items: center;">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="single-cards-item">
                        <div class="single-product-image" style="margin-bottom: -22px;">
                            <a href="#"><img src="img/product/profile-bg.jpg" alt="" style="height: 250px; object-fit: cover;"></a>
                        </div>
                        <div class="single-product-text">
                            <img src="<?php echo $image; ?>" alt="" style="height: 150px; width: 150px;">
                            <h4><a class=" cards-hd-dn" href="#"><?php echo $name; ?></a></h4>
                            <h5><?php echo $email; ?></h5>
                            <a class="follow-cards mg-t-15" href="edit.php?id=<?php echo $id; ?>">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./footer.php");  ?>