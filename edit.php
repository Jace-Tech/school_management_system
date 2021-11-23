<?php
include './header.php';

if (!isset($_GET["id"])) {
  header("location: ./dashboard.php");
  exit();
}

$id = $_GET["id"];

$query = "SELECT * FROM `login` WHERE `id` = ?";
$result = $conn->prepare($query);
$result->execute([$id]);

$row = $result->fetch();
extract($row);
?>

<body>
  <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->

  <!-- Start Left menu area -->
  <?php
  include "./components/nav.php";
  ?>
  <!-- End Left menu area -->
  <!-- Start Welcome area -->
  <?php
  include "./components/headernav.php";
  ?>
  <!-- Mobile Menu start -->

  <!-- Mobile Menu end -->
  </div>
  <!-- Single pro tab review Start-->
  <div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  mg-t-30">
          <div class="product-payment-inner-st">
            <div id="myTabContent" class="tab-content custom-product-edit">
              <div class="product-tab-list tab-pane fade active in" id="description">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-content-section">
                      <div id="dropzone1" class="pro-ad">
                        <form id="form" action="./handlers/admin.php" method="post" enctype="multipart/form-data" id="demo1-upload">
                          <fieldset>
                            <legend class="text-primary">Profile</legend>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Name</label>
                                  <input name="name" type="text" value="<?php echo $name; ?>" class="form-control">
                                </div>
                              </div>

                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Email</label>
                                  <input name="email" type="text" value="<?php echo $email; ?>" class="form-control">
                                </div>
                              </div>

                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Image</label>
                                  <input type="hidden" name="prev_image" value="<?php echo $image; ?>">
                                  <input name="image" type="file" value="<?php echo $course_name; ?>" class="">
                                  <small class="text-info">previous image: <?php echo $image; ?></small>
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          <div class="row">
                            <div class="col-lg-12" style="margin-top: 8px;">
                              <input type="hidden" name="id" value="<?php echo $id; ?>">
                              <button type="submit" id="btn" name="update" class="btn btn-primary btn-lg waves-effect waves-light">Update</button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("./footer.php"); ?>