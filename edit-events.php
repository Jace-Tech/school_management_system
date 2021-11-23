<?php
include './header.php';

if (!isset($_GET["e_id"])) {
    header("location: all-events.php");
}

$id = $_GET["e_id"];

$query = "SELECT * FROM `events` WHERE `event_id` = ?";
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
    <div class="breadcome-area">
        <div class="container-fluid">
            <div class="row mg-b-20">

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
                                                <form id="form" action="./handlers/events.php" method="post" enctype="multipart/form-data">
                                                    <fieldset>
                                                        <legend class="text-primary">Update Event</legend>
                                                        <div class="row">
                                                            <div class="col-lg-6 col-md-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input name="title" type="text" class="form-control" value="<?php echo $title; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Time</label>
                                                                    <input name="time" type="time" class="form-control" value="<?php echo $time; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Content</label>
                                                                    <textarea name="content" rows="6" class="form-control" value="<?php echo $content; ?>"><?php echo $content; ?></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-6 col-md-12 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Event</label>
                                                                    <input name="event" type="text" class="form-control" value="<?php echo $event; ?>">
                                                                    <input type="hidden" name="id" value="<?php echo $event_id; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Date</label>
                                                                    <input name="date" type="date" class="form-control" value="<?php echo $date; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Image</label>
                                                                    <input name="image" style="border: none;" class="form-control" type="file">
                                                                    <input name="current_image" type="hidden" value="<?php echo $image; ?>">
                                                                    <small class="text-info">Previous Image: <?php echo $image; ?></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="row">
                                                        <div class="col-lg-12" style="margin-top: 8px;">
                                                            <button type="submit" id="btn" name="update" class="btn btn-primary btn-lg waves-effect waves-light">Update Event</button>
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
            btn.style.opacity = ".4";
        })
    </script>
    <?php
    include("./footer.php");
    ?>