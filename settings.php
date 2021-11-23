<?php
include './header.php';
include './handlers/session_check.php';
?>

<body>
    <?php
    include './components/alert.php';
    ?>
    <!-- Start Left menu area -->
    <?php
    include './components/nav.php';
    ?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <?php
    include './components/headernav.php';
    ?>
    <!-- Mobile Menu end -->

    </div>
    <div class="mg-t-30 mg-b-30">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12">
                                    <div class="white-box">
                                        <h2 class="box-title text-primary">Settings</h2>
                                        <ul class="basic-list">
                                            <li style="display: flex; height: fit-content;">
                                                <div class="details" style="flex: 1;">
                                                    <p style="margin: 3px 0;">Admin's Account</p>
                                                    <small class="text-danger">Delete account</small>
                                                </div>
                                                <div class="options">
                                                    <a href="./handlers/admin.php?del" class="pull-right label-danger label-1 label">Delete</a href="./handlers/admin.php?del">
                                                </div>
                                            </li>

                                            <li style="display: flex; height: fit-content;">
                                                <div class="details" style="flex: 1;">
                                                    <p style="margin: 3px 0;">Students Database Table</p>
                                                    <small class="text-danger">Clear database</small>
                                                </div>
                                                <div class="options">
                                                    <a href="./handlers/student.php?empty" class="pull-right label-danger label-1 label">Clear</a href="./handlers/admin.php?del">
                                                </div>
                                            </li>

                                            <li style="display: flex; height: fit-content;">
                                                <div class="details" style="flex: 1;">
                                                    <p style="margin: 3px 0;">Teachers Database Table</p>
                                                    <small class="text-danger">Clear database</small>
                                                </div>
                                                <div class="options">
                                                    <a href="./handlers/teachers.php?truncate" class="pull-right label-danger label-1 label">Clear</a href="./handlers/admin.php?del">
                                                </div>
                                            </li>

                                            <li style="display: flex; height: fit-content;">
                                                <div class="details" style="flex: 1;">
                                                    <p style="margin: 3px 0;">Courses Database Table</p>
                                                    <small class="text-danger">Clear database</small>
                                                </div>
                                                <div class="options">
                                                    <a href="./handlers/course.php?empty" class="pull-right label-danger label-1 label">Clear</a href="./handlers/admin.php?del">
                                                </div>
                                            </li>

                                            <li style="display: flex; height: fit-content;">
                                                <div class="details" style="flex: 1;">
                                                    <p style="margin: 3px 0;">Events Database Table</p>
                                                    <small class="text-danger">Clear database</small>
                                                </div>
                                                <div class="options">
                                                    <a href="./handlers/events.php?empty" class="pull-right label-danger label-1 label">Clear</a href="./handlers/admin.php?del">
                                                </div>
                                            </li>

                                            <li style="display: flex; height: fit-content;">
                                                <div class="details" style="flex: 1;">
                                                    <p style="margin: 3px 0;">Messages Database Table</p>
                                                    <small class="text-danger">Clear database</small>
                                                </div>
                                                <div class="options">
                                                    <a href="./handlers/inbox.php?del" class="pull-right label-danger label-1 label">Clear</a href="./handlers/admin.php?del">
                                                </div>
                                            </li>

                                            <li style="display: flex; height: fit-content;">
                                                <div class="details" style="flex: 1;">
                                                    <p style="margin: 3px 0;">Logout</p>
                                                </div>
                                                <div class="options">
                                                    <a href="./handlers/admin.php?del" class="pull-right label-primary label-1 label">Logout</a href="./handlers/admin.php?del">
                                                </div>
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
    </div>
    <?php
    include("./footer.php"); ?>