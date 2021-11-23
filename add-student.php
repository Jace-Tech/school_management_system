<?php
include './header.php';
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
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="breadcome-list single-page-breadcome">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <ul class="breadcome-menu">
                                    <li><a href="#">Home</a> <span class="bread-slash">/</span>
                                    </li>
                                    <li><span class="bread-blod">Add Student</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                                                <form id="form" action="./handlers/student.php" method="post" enctype="multipart/form-data" id="demo1-upload">
                                                    <fieldset>
                                                        <legend class="text-primary">Student Information</legend>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>First Name</label>
                                                                    <input name="firstname" type="text" class="form-control" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Middle Name</label>
                                                                    <input name="middle-name" type="text" class="form-control" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Last Name</label>
                                                                    <input name="lastname" type="text" class="form-control" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Date-of-birth</label>
                                                                    <input name="date-of-birth" type="date" class="form-control" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Session</label>
                                                                    <select name="session" id="session" class="form-control" required>
                                                                        <option value="none" selected="" disabled>Select Session</option>
                                                                        <option value="JS1">Junior Secondary 1</option>
                                                                        <option value="JS2">Junior Secondary 2</option>
                                                                        <option value="JS3">Junior Secondary 3</option>
                                                                        <option value="SS1">Senior Secondary 1</option>
                                                                        <option value="SS2">Senior Secondary 2</option>
                                                                        <option value="SS3">Senior Secondary 3</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Course</label>
                                                                    <select name="course" id="course" class="form-control" required>
                                                                        <option value="none" selected="" disabled>Select Course</option>
                                                                        <?php
                                                                        $query = "SELECT * FROM `courses`";
                                                                        $result = $conn->prepare($query);
                                                                        $result->execute();

                                                                        while ($row = $result->fetch()) {
                                                                            extract($row);
                                                                        ?>
                                                                            <option value="<?php echo $course_id; ?>"><?php echo $course_name; ?></option>
                                                                        <?php
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Gender</label>
                                                                    <select name="gender" class="form-control" required>
                                                                        <option value="none" selected="" disabled="">Select Gender</option>
                                                                        <option value="male">Male</option>
                                                                        <option value="female">Female</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Address</label>
                                                                    <input name="address" type="text" class="form-control" required>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input name="image" style="border: none;" value="image" class="form-control" type="file" required>
                                                                    <small class="text-info">Not more than 2mb</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset style="margin-top: 10px;">
                                                        <legend class="text-primary" style="padding: 8px 0;">Parent/Guardian Information</legend>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Full Name</label>
                                                                    <input type="text" class="form-control" name="guardian-name" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Phone No</label>
                                                                    <input type="tel" class="form-control" name="phone-no" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="row">
                                                        <div class="col-lg-12" style="margin-top: 8px;">
                                                            <button type="submit" id="btn" name="submit" class="btn btn-primary btn-lg waves-effect waves-light">Submit</button>
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
        const form = document.querySelector('#form');

        form.addEventListener('submit', () => {
            btn.innerText = "processing..";
            // btn.disabled = true;
            btn.style.opacity = ".4";
        })
    </script>
    <?php
    include("./footer.php");
    ?>