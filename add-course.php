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
                                    <li><span class="bread-blod">Add Course</span>
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
                                                <form id="form" action="./handlers/course.php" method="post" enctype="multipart/form-data" id="demo1-upload">
                                                    <fieldset>
                                                        <legend class="text-primary">Course</legend>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label>Course Name</label>
                                                                    <input name="course-name" type="text" class="form-control" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <fieldset style="margin-top: 10px;">
                                                        <legend class="text-primary" style="padding: 8px 0;">Subjects</legend>
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 1</label>
                                                                    <input type="text" class="form-control" name="subject1" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 2</label>
                                                                    <input type="text" class="form-control" name="subject2" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 3</label>
                                                                    <input type="text" class="form-control" name="subject3" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 4</label>
                                                                    <input type="text" class="form-control" name="subject4" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 5</label>
                                                                    <input type="text" class="form-control" name="subject5" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 6</label>
                                                                    <input type="text" class="form-control" name="subject6" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 7</label>
                                                                    <input type="text" class="form-control" name="subject7" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 8</label>
                                                                    <input type="text" class="form-control" name="subject8" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 9</label>
                                                                    <input type="text" class="form-control" name="subject9" required>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 10</label>
                                                                    <input type="text" class="form-control" name="subject10">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 11</label>
                                                                    <input type="text" class="form-control" name="subject11">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 12</label>
                                                                    <input type="text" class="form-control" name="subject12">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 13</label>
                                                                    <input type="text" class="form-control" name="subject13">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label>Subject 14</label>
                                                                    <input type="text" class="form-control" name="subject14">
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
        const form = document.querySelector("#form");

        form.addEventListener('submit', () => {
            btn.innerText = "processing..";
            btn.style.opacity = ".4";
        })
    </script>
    <?php
    include("./footer.php");
    ?>