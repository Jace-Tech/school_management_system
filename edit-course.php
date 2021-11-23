<?php
include './header.php';

if (!isset($_GET["id"])) {
  header("location: ./all-courses.php");
  exit();
}

$id = $_GET["id"];

$query = "SELECT * FROM `courses` WHERE `course_id` = ?";
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
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="product-payment-inner-st">
            <div id="myTabContent" class="tab-content custom-product-edit">
              <div class="product-tab-list tab-pane fade active in" id="description">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="review-content-section">
                      <div id="dropzone1" class="pro-ad">
                        <form id="form" action="./handlers/course.php" method="post" enctype="multipart/form-data" id="demo1-upload">
                          <fieldset>
                            <legend class="text-primary">Course</legend>
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="form-group">
                                  <label>Course Name</label>
                                  <input name="course-name" type="text" value="<?php echo $course_name; ?>" class="form-control" required>
                                </div>
                              </div>
                            </div>
                          </fieldset>
                          <fieldset style="margin-top: 10px;">
                            <legend class="text-primary" style="padding: 8px 0;">Subjects</legend>
                            <div class="row">

                              <?php
                              $subjects = json_decode($subjects);

                              for ($i = 0; $i < count($subjects); $i++) {
                              ?>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label>Subject <?php echo $i + 1; ?></label>
                                    <input type="text" class="form-control" value="<?php echo $subjects[$i]; ?>" name="subject<?php echo $i + 1; ?>" required>
                                  </div>
                                </div>
                                <?php
                              }

                              if (count($subjects) < 10) {
                                for ($i = count($subjects) + 1; $i <= 14; $i++) {
                                ?>

                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label>Subject <?php echo $i; ?></label>
                                      <input type="text" class="form-control" name="subject<?php echo $i; ?>">
                                    </div>
                                  </div>
                              <?php
                                }
                              }
                              ?>
                            </div>
                          </fieldset>
                          <div class="row">
                            <div class="col-lg-12" style="margin-top: 8px;">
                              <input type="hidden" name="id" value="<?php echo $_GET["id"]; ?>">
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
  <script>
    const btn = document.querySelector("#btn");

    btn.addEventListener('submit', () => {
      btn.innerText = "processing..";
      btn.style.cursor = "not-allowed";
      btn.style.opacity = ".4";
    })
  </script>
  <?php include("./footer.php"); ?>