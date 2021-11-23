<?php
include "header.php";
?>

<?php
if (isset($_GET["profile_id"])) {
    $profile_id = $_GET["profile_id"];


    try {
        $sql = "SELECT * FROM `students` WHERE `student_id` = ?";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$profile_id]);

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            extract($row);

            $query = "SELECT * FROM `guardian` WHERE `student_id` = ?";
            $result = $conn->prepare($query);
            $result->execute([$profile_id]);

            if ($result->rowCount() > 0) {
                $row2 = $result->fetch();
                extract($row2);

                $sql = "SELECT * FROM `courses` WHERE `course_id` = ?";
                $result = $conn->prepare($sql);
                $result->execute([$course]);

                $row = $result->fetch();
                extract($row);
                $course = $course_name;
            }
        } else {
            header("location: all-students.php");
        }
    } catch (PDOException $e) {
        echo "error" . $e;
    }
} else {
    header("location: all-students.php");
}
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
    include "components/headernav.php";
    ?>
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area mg-t-30 mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="profile-info-inner">
                        <div class="profile-img">
                            <img src="./images/students/<?php echo $image; ?>" alt="<?php echo 'image of ' . $firstname . ' ' . $lastname; ?>" />
                        </div>
                        <div class="profile-details-hr">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="address-hr" style="display: flex; font-size: 1.2rem; align-items: center; justify-content: space-evenly;">
                                        <p><b>Name: </b></p>
                                        <p class="text-capitalize" style="flex: 1;"><?php echo $firstname . " " . $middlename . " " . $lastname; ?></p>
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="address-hr" style="display: flex; font-size: 1.2rem; align-items: center; justify-content: space-evenly;">
                                        <p><b>Gender: </b></p>
                                        <p class="text-capitalize" style="flex: 1;"><?php echo $gender; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="address-hr" style="display: flex; font-size: 1.2rem; align-items: center; justify-content: space-evenly;">
                                        <p><b>Course: </b></p>
                                        <p class="text-capitalize" style="flex: 1;"><?php echo $course; ?></p>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="address-hr" style="display: flex; font-size: 1.2rem; align-items: center; justify-content: space-evenly;">
                                        <p><b>Session: </b></p>
                                        <p class="text-capitalize" style="flex: 1;"><?php echo $session; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="address-hr" style="display: flex; font-size: 1.2rem; align-items: center; justify-content: space-evenly;">
                                        <p><b>Address: </b></p>
                                        <p class="text-capitalize" style="flex: 1; "><?php echo $address; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                        <ul id="myTabedu1" class="tab-review-design">
                            <li class="active"><a href="#description">Details</a></li>
                            <li><a href="#INFORMATION">Update Details</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content custom-product-edit st-prf-pro">
                            <div class="product-tab-list tab-pane fade active in" id="description">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="review-content-section">
                                            <div class="row mg-b-15">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="skill-title">
                                                                <h2>Subjects</h2>
                                                                <hr />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ex-pro">
                                                        <ul>
                                                            <?php
                                                            $query = "SELECT `subjects` FROM `courses` WHERE `course_id` = ?";
                                                            try {
                                                                $stmt = $conn->prepare($query);
                                                                $stmt->execute([$course_id]);

                                                                $row = $stmt->fetch();
                                                                extract($row);

                                                                $subject_array = json_decode($subjects);
                                                                for ($i = 0; $i < count($subject_array); $i++) {
                                                            ?>
                                                                    <li><i class="fa fa-angle-right"></i> <?php echo $subject_array[$i]; ?></li>
                                                            <?php
                                                                }
                                                            } catch (PDOException $e) {
                                                                echo $e;
                                                            }
                                                            ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mg-b-15">
                                                <div class="col-lg-12">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="skill-title">
                                                                <h2>Parents / Guardian Information</h2>
                                                                <hr />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="address-hr" style="display: flex; font-size: 1.2rem; align-items: center; justify-content: space-evenly;">
                                                                <p><b>Name: </b></p>
                                                                <p class="text-capitalize" style="flex: 1;"><?php echo $fullname; ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="address-hr" style="display: flex; font-size: 1.2rem; align-items: center; justify-content: space-evenly;">
                                                                <p><b>Phone No: </b></p>
                                                                <p class="text-capitalize" style="flex: 1;"><?php echo $phone_no; ?></p>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="address-hr" style="display: flex; font-size: 1.2rem; align-items: center; justify-content: space-evenly;">
                                                                <p><b>Address: </b></p>
                                                                <p class="text-capitalize" style="flex: 1;"><?php echo $address; ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <a class="btn btn-danger" href="./handlers/student.php?delete_id=<?php echo $profile_id; ?>">Delete</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-tab-list tab-pane fade" id="INFORMATION">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <form action="./handlers/student.php" method="post" enctype="multipart/form-data" class="review-content-section">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input name="firstname" type="text" name="firstname" class="form-control" value="<?php echo $firstname; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Middle Name</label>
                                                        <input type="text" class="form-control" name="middlename" value="<?php echo $middlename; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Date Of Birth</label>
                                                        <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $dob; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="gender">Gender</label>
                                                        <select name="gender" class="form-control">
                                                            <option value="" disabled>Select gender</option>
                                                            <?php
                                                            if ($gender === "male") {
                                                            ?>
                                                                <option value="male" selected>Male</option>
                                                                <option value="female">Female</option>
                                                            <?php
                                                            } else {
                                                            ?>
                                                                <option value="male">Male</option>
                                                                <option value="female" selected>Female</option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <div class="file-upload-inner ts-forms">
                                                        <label style="color: #222; margin-bottom: 10px;">Image</label>
                                                        <div class="input prepend-big-btn">
                                                            <label class="icon-right" for="prepend-big-btn">
                                                                <i class="fa fa-download"></i>
                                                            </label>
                                                            <div class="file-button">
                                                                Browse
                                                                <input type="file" name="image" onchange="document.getElementById('prepend-big-btn').value = this.value;">
                                                            </div>
                                                            <input type="text" id="prepend-big-btn" value="<?php echo $image; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 mg-t-15">
                                                    <div class="form-group sm-res-mg-15 tbpf-res-mg-15">
                                                        <label for="">Session</label>
                                                        <select name="session" class="form-control">
                                                            <option value="" disabled>Select session</option>
                                                            <option class="opts" value="JS 1">Junior Secondary 1</option>
                                                            <option class="opts" value="JS 2">Junior Secondary 2</option>
                                                            <option class="opts" value="JS 3">Junior Secondary 3</option>
                                                            <option class="opts" value="SS 1">Senior Secondary 1</option>
                                                            <option class="opts" value="SS 2">Senior Secondary 2</option>
                                                            <option class="opts" value="SS 3">Senior Secondary 3</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Course</label>
                                                        <select name="course" class="form-control">
                                                            <option value="" disabled>Select course</option>
                                                            <?php
                                                            $mainCourse = $course_id;
                                                            $query = "SELECT * FROM `courses`";
                                                            $result = $conn->prepare($query);
                                                            $result->execute();

                                                            while ($row = $result->fetch()) {
                                                                extract($row);

                                                                if ($course_id == $mainCourse) {
                                                            ?>
                                                                    <option value="<?php echo $course_id; ?>" selected><?php echo $course_name; ?></option>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <option value="<?php echo $course_id; ?>"><?php echo $course_name; ?></option>
                                                            <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="">Address</label>
                                                        <input type="text" name="address" value="<?php echo $address; ?>" class="form-control">
                                                        <input type="hidden" name="id" value="<?php echo $student_id; ?>">
                                                        <input type="hidden" name="previous_image" value="<?php echo $image; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Parents / Guardian's Fullname</label>
                                                        <input type="text" class="form-control" name="fullname" value="<?php echo $fullname; ?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Phone</label>
                                                        <input type="tel" class="form-control" name="phone" value="<?php echo $phone_no; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="payment-adress mg-t-15">
                                                        <button type="submit" name="update" class="btn btn-primary waves-effect waves-light mg-b-15">Update</button>
                                                    </div>
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
    <script>
        const options = document.querySelectorAll(".opts");
        const sessionValue = "<?php echo $session; ?>";

        options.forEach(option => {
            if (option.value == sessionValue) {
                option.setAttribute("selected", true);
            }
        })
    </script>
    <?php
    include("./footer.php");
    ?>