<?php
include("./header.php");

if (!isset($_GET["message_id"])) {
    header("location: ../mailbox.php");
}

$id = $_GET["message_id"];
$sql = $conn->query("DELETE FROM `counter` WHERE `message_id` = {$id}");
$sql->execute();

$query = "SELECT * FROM `inbox` WHERE `message_id` = ?";
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
    include("./components/nav.php");
    ?>
    <!-- End Left menu area -->
    <!-- Start Welcome area -->
    <?php
    include("./components/headernav.php");
    ?>
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
                                    <li><a href="dashboard.php">Home</a> <span class="bread-slash">/</span>
                                    </li>
                                    <li><span class="bread-blod">View Mail</span>
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
    <div class="mailbox-view-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="hpanel shadow-inner responsive-mg-b-30">
                        <div class="panel-body">
                            <ul class="mailbox-list">
                                <?php
                                $sql = $conn->query("SELECT * FROM `counter`");
                                $sql->execute();
                                ?>
                                <li>
                                    <a href="inbox.php">
                                        <span class="pull-right">
                                            <?php if ($sql->rowCount() > 0) {
                                                echo $sql->rowCount();
                                            } else {
                                                echo "";
                                            } ?>
                                        </span>
                                        <i class="fa fa-envelope"></i> Inbox
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 col-md-9 col-sm-9 col-xs-12">
                    <div class="hpanel email-compose mailbox-view">
                        <div class="panel-heading hbuilt">

                            <div class="p-xs h4">
                                <small class="pull-right view-hd-ml">
                                    <?php
                                    echo date('h:i A', strtotime($date_received));
                                    ?>
                                </small>
                            </div>
                        </div>
                        <div class="border-top border-left border-right bg-light">
                            <div class="p-m custom-address-mailbox">
                                <div>
                                    <span class="font-extra-bold">From: </span>
                                    <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
                                </div>
                                <div>
                                    <span class="font-extra-bold">Date: </span><?php echo date("j-m-Y", strtotime($date_received)); ?>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body panel-csm">
                            <h4>Body </h4>
                            <div class="panel-footer ft-pn">
                                <p>
                                    <?php echo $message; ?>
                                </p>

                                <p><a class="text-info" href="mailto:<?php echo $email; ?>"> ~ <i><?php echo $sender; ?></i></a></p>
                            </div>
                        </div>
                        <div class="text-right mg-t-10">
                            <div class="btn-group active-hook">
                                <a href="./handlers/inbox.php?delete=<?php echo $message_id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i> Remove</a href="./handlers//inbox.php?m">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./footer.php"); ?>