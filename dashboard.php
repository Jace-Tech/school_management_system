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
    <div class="analytics-sparkle-area mg-t-30">
        <div class="container-fluid">
            <div class="row">
                <a href="./all-students.php" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                        <h3 class="box-title">Total No. Of Students</h3>
                        <?php
                        $query = "SELECT * FROM `students`";
                        $result = $conn->prepare($query);
                        $result->execute();

                        $count = $result->rowCount();

                        ?>
                        <ul class="list-inline two-part-sp">
                            <li>
                                <i class="educate-icon educate-student icon-wrap"></i>
                            </li>
                            <li class="text-right sp-cn-r"> <span class="text-success"><?php echo $count; ?></span></li>
                        </ul>
                    </div>
                </a>

                <a href="./all-teachers.php" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                        <h3 class="box-title">Total No. Of Teachers</h3>
                        <?php
                        $query = "SELECT * FROM `teachers`";
                        $result = $conn->prepare($query);
                        $result->execute();

                        $count = $result->rowCount();

                        ?>
                        <ul class="list-inline two-part-sp">
                            <li>
                                <i class="educate-icon educate-professor icon-wrap"></i>
                            </li>
                            <li class="text-right sp-cn-r"> <span class="text-success"><?php echo $count; ?></span></li>
                        </ul>
                    </div>
                </a>

                <a href="./all-courses.php" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                        <h3 class="box-title">Total No. Of Courses</h3>
                        <?php
                        $query = "SELECT * FROM `courses`";
                        $result = $conn->prepare($query);
                        $result->execute();

                        $count = $result->rowCount();

                        ?>
                        <ul class="list-inline two-part-sp">
                            <li>
                                <i class="educate-icon educate-course icon-wrap"></i>
                            </li>
                            <li class="text-right sp-cn-r"> <span class="text-success"><?php echo $count; ?></span></li>
                        </ul>
                    </div>
                </a>

                <a href="./all-events.php" class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <div class="white-box analytics-info-cs mg-b-10 res-mg-b-30 res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                        <h3 class="box-title">Total No. Of Events</h3>
                        <?php
                        $query = "SELECT * FROM `events`";
                        $result = $conn->prepare($query);
                        $result->execute();

                        $count = $result->rowCount();

                        ?>
                        <ul class="list-inline two-part-sp">
                            <li>
                                <i class="educate-icon educate-event icon-wrap"></i>
                            </li>
                            <li class="text-right sp-cn-r"> <span class="text-success"><?php echo $count; ?></span></li>
                        </ul>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="product-sales-area mg-tb-20">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="product-sales-chart">
                        <div style="height: 356px;">
                            <?php
                            $query = "SELECT * FROM `inbox` ORDER BY `date_received` DESC";
                            $result = $conn->prepare($query);
                            $result->execute();
                            $rows = $result->fetchAll();
                            ?>
                            <style>
                                .hover {
                                    padding-left: 10px;
                                    padding-right: 10px;
                                }

                                .hover:hover {
                                    background-color: #f7f7f7;
                                }
                            </style>
                            <?php if (count($rows) > 0) : ?>
                                <div class="single-review-st-item res-mg-t-30 table-mg-t-pro-n">
                                    <div class="single-review-st-hd">
                                        <h2>Messages</h2>
                                    </div>
                                    <?php foreach ($rows as $row) : extract($row); ?>
                                        <a href="mailbox-view.php?message_id=<?php echo $message_id; ?>" class="single-review-st-text hover">
                                            <div style="width: 50px; color: #777; height: 50px; border-radius: 50%; border: 1px solid #454545; font-size: 20px; display: flex; justify-content: center; align-items: center;">
                                                <?php echo substr($sender, 0, 2); ?>
                                            </div>
                                            <div class="review-ctn-hf">
                                                <h3><?php echo $sender; ?></h3>
                                                <p><?php echo substr($message, 0, 150); ?></p>
                                            </div>
                                            <div class="review-item-rating">
                                                <p class="text-muted"><?php echo date('h:i a', strtotime($date_received)); ?></p class="text-muted">
                                                <p class="text-muted"><?php echo date('D, jS M Y', strtotime($date_received)); ?></p class="text-muted">
                                            </div>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php else : ?>
                                <h4 class="text-center text-muted">No message in inbox</h4>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- jquery
		============================================ -->
        <script src="js/vendor/jquery-1.12.4.min.js"></script>
        <!-- bootstrap JS
		============================================ -->
        <script src="js/bootstrap.min.js"></script>
        <!-- wow JS
		============================================ -->
        <script src="js/wow.min.js"></script>
        <!-- price-slider JS
		============================================ -->
        <script src="js/jquery-price-slider.js"></script>
        <!-- meanmenu JS
		============================================ -->
        <script src="js/jquery.meanmenu.js"></script>
        <!-- owl.carousel JS
		============================================ -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- sticky JS
		============================================ -->
        <script src="js/jquery.sticky.js"></script>
        <!-- scrollUp JS
		============================================ -->
        <script src="js/jquery.scrollUp.min.js"></script>
        <!-- counterup JS
		============================================ -->
        <script src="js/counterup/jquery.counterup.min.js"></script>
        <script src="js/counterup/waypoints.min.js"></script>
        <script src="js/counterup/counterup-active.js"></script>
        <!-- mCustomScrollbar JS
		============================================ -->
        <script src="js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
        <script src="js/scrollbar/mCustomScrollbar-active.js"></script>
        <!-- metisMenu JS
		============================================ -->
        <script src="js/metisMenu/metisMenu.min.js"></script>
        <script src="js/metisMenu/metisMenu-active.js"></script>
        <!-- morrisjs JS
		============================================ -->
        <script src="js/morrisjs/raphael-min.js"></script>
        <script src="js/morrisjs/morris.js"></script>
        <script src="js/morrisjs/morris-active.js"></script>
        <!-- morrisjs JS
		============================================ -->
        <script src="js/sparkline/jquery.sparkline.min.js"></script>
        <script src="js/sparkline/jquery.charts-sparkline.js"></script>
        <script src="js/sparkline/sparkline-active.js"></script>
        <!-- calendar JS
		============================================ -->
        <script src="js/calendar/moment.min.js"></script>
        <script src="js/calendar/fullcalendar.min.js"></script>
        <script src="js/calendar/fullcalendar-active.js"></script>
        <!-- plugins JS
		============================================ -->
        <script src="js/plugins.js"></script>
        <!-- main JS
		============================================ -->
        <script src="js/main.js"></script>
        <!-- tawk chat JS
		============================================ -->
        <script src="js/tawk-chat.js"></script>
</body>

</html>