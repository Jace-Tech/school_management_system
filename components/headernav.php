<div class="all-content-wrapper" style="position: relative;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="logo-pro">
                    <a href="dashboard.php"><img class="main-logo" src="img/logo/logo.png" alt="" /></a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-advance-area">
        <div class="header-top-area">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-top-wraper">
                            <div class="row">
                                <div class="col-lg-1 col-md-0 col-sm-1 col-xs-12">
                                    <div class="menu-switcher-pro">
                                        <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                            <i class="educate-icon educate-nav"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-7 col-sm-6 col-xs-12">
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                                    <div class="header-right-info">
                                        <ul class="nav navbar-nav mai-top-nav header-right-menu">
                                            <li class="nav-item dropdown">
                                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                    <i class="educate-icon educate-message edu-chat-pro" aria-hidden="true"></i>
                                                    <?php
                                                    $sql = "SELECT * FROM `counter`";
                                                    $stmt = $conn->prepare($sql);
                                                    $stmt->execute();

                                                    if ($stmt->rowCount() > 0) {
                                                    ?>
                                                        <span class="indicator-ms"></span>
                                                    <?php
                                                    }
                                                    ?>

                                                </a>
                                                <div role="menu" class="author-message-top dropdown-menu animated zoomIn" style="height: fit-content;">
                                                    <div class="message-single-top">
                                                        <h1>Message</h1>
                                                    </div>
                                                    <ul class="message-menu">
                                                        <?php
                                                        $sql = "SELECT * FROM `counter`";
                                                        $stmt = $conn->prepare($sql);
                                                        $stmt->execute();

                                                        if ($stmt->rowCount() > 0) {
                                                            while ($row = $stmt->fetch()) {
                                                                extract($row);
                                                                $query = "SELECT * FROM `inbox` WHERE `message_id` = ?";
                                                                $result = $conn->prepare($query);
                                                                $result->execute([$message_id]);

                                                                while ($row2 = $result->fetch()) {
                                                                    extract($row2);
                                                        ?>
                                                                    <li>
                                                                        <a href="#">
                                                                            <div class="message-img" style="border: 1px solid #999; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                                                                                <h1 class="text-muted" style="padding: 12px 0; margin-top: 5px;"><?php echo substr($sender, 0, 2);  ?></h1>
                                                                            </div>
                                                                            <div class="message-content">
                                                                                <span class="message-date"><?php echo $date_received; ?></span>
                                                                                <h2><?php echo $sender; ?></h2>
                                                                                <p><?php echo $message; ?></p>
                                                                            </div>
                                                                        </a>
                                                                    </li>
                                                            <?php
                                                                }
                                                            }
                                                        } else {
                                                            ?>
                                                            <li>
                                                                <a href="#">
                                                                    <div class="message-img" style="border: 1px solid #999; border-radius: 50px; display: flex; justify-content: center; align-items: center;">
                                                                        <h1 class="text-muted" style="padding: 12px 0; margin-top: 5px;">JS</h1>
                                                                    </div>
                                                                    <div class="message-content">
                                                                        <span class="message-date">2020-15-80</span>
                                                                        <h2>Jace</h2>
                                                                        <p>Please done this project as soon possible.</p>
                                                                    </div>
                                                                </a>
                                                            </li>
                                                        <?php
                                                        }

                                                        ?>
                                                    </ul>
                                                    <div class="message-view">
                                                        <a href="inbox.php" style="color: #777">View All Messages</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                                    <img src="<?php echo $admin_image; ?>" alt="" />
                                                    <span class="admin-name"><?php echo $admin_name; ?></span>
                                                    <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
                                                </a>
                                                <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                    <li>
                                                        <a href="profile.php"><span class="edu-icon edu-user-rounded author-log-ic"></span>My Profile</a>
                                                    </li>
                                                    <li>
                                                        <a href="settings.php"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                                                    </li>
                                                    <li>
                                                        <a href="./handlers/logout_handler.php"><span class="edu-icon edu-locked author-log-ic"></span>Log Out</a>
                                                    </li>
                                                </ul>
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

        <?php
        include "alert.php";
        ?>
        <!-- Mobile Menu start -->

        <?php
        include "mobile_menu.php";
        ?>