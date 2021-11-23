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
    ?>
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
                                    <li><span class="bread-blod">Inbox</span>
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
    <div class="mailbox-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="hpanel responsive-mg-b-30">
                        <div class="panel-body">

                            <ul class="mailbox-list">
                                <li class="">
                                    <?php
                                    $sql = $conn->query("SELECT * FROM `counter`");
                                    $sql->execute();
                                    ?>
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
                    <div class="hpanel">
                        <div class="panel-heading hbuilt mailbox-hd">
                            <div class="text-center p-xs font-normal">

                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6 col-md-6 col-sm-6 col-xs-8">
                                    <div class="btn-group ib-btn-gp active-hook mail-btn-sd mg-b-15">
                                        <a href="" class="btn btn-default btn-sm"><i class="fa fa-refresh"></i> Refresh</a>
                                    </div>
                                </div>
                                <div class="col-md-6 col-md-6 col-sm-6 col-xs-4 mailbox-pagination">

                                </div>
                            </div>
                            <div class="table-responsive ib-tb">
                                <table class="table table-hover table-mailbox">
                                    <tbody>
                                        <?php
                                        $stmt = $conn->query("SELECT * FROM `inbox`");
                                        $stmt->execute();

                                        $rows = $stmt->fetchAll();

                                        $sql = $conn->query("SELECT * FROM `counter`");
                                        $sql->execute();

                                        $items = $sql->fetchAll();
                                        $item_array = [];

                                        for ($i = 0; $i < count($items); $i++) {
                                            array_push($item_array, $items[$i]["message_id"]);
                                        }
                                        ?>
                                        <?php  ?>
                                        <?php if (count($rows) > 0) : ?>
                                            <?php foreach ($rows as $row) : extract($row); ?>
                                                <tr class="">
                                                    <td class="unread">
                                                        <div class="checkbox checkbox-single checkbox-success">
                                                            <input type="checkbox" checked>
                                                            <label></label>
                                                        </div>
                                                    </td>
                                                    <td><a href="mailbox-view.php?message_id=<?php echo $message_id; ?>"><?php echo $sender; ?></a></td>
                                                    <td style="overflow: hidden;"><a href="mailbox-view.php?message_id=<?php echo $message_id; ?>"><?php echo $message; ?></a></td>
                                                    <td class="text-right mail-date"><?php echo date("D, M j", strtotime($date_received)); ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <p class="text-muted text-center">No message found</p>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="panel-footer ib-ml-ft">
                            <i class="fa fa-eye"> </i> <?php echo $sql->rowCount(); ?> unread
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include("./footer.php");
    ?>