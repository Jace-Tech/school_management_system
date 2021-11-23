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
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="breadcome-list">
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="breadcome-heading">
                <form action="" role="search" class="sr-input-func" method="get" style="display: block; box-sizing: border-box;">
                  <input type="search" placeholder="Search name" name="search" class="search-int form-control">
                </form>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <ul class="breadcome-menu">
                <li><a href="#">Home</a> <span class="bread-slash">/</span>
                </li>
                <li><span class="bread-blod">All events</span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="contacts-area mg-b-15">
    <div class="container-fluid">
      <div class="row">
        <?php
        $query = "SELECT * FROM `events`";
        $result = $conn->prepare($query);
        $result->execute();

        if (isset($_GET['search'])) {
          $search = $_GET['search'];
          $query = "SELECT * FROM `events` WHERE `title` REGEXP ?";
          $result = $conn->prepare($query);
          $result->execute([$search]);
        }

        $rows = $result->fetchAll();
        ?>
        <?php if (count($rows) > 0) : ?>
          <?php foreach ($rows as $row) : extract($row); ?>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <div class="courses-inner res-mg-t-30 table-mg-t-pro-n tb-sm-res-d-n dk-res-t-d-n">
                <div class="courses-title">
                  <a><img src="./images/events/<?php echo $image; ?>" alt="" /></a>
                  <h2><?php echo $title; ?></h2>
                </div>
                <div class="courses-alaltic">
                  <p style="word-break: break-all;" title="<?php echo $content; ?>">
                    <?php echo substr($content, 0, 80) . "..."; ?>
                  </p>
                </div>
                <div class="course-des">
                  <p><span><i class="fa fa-clock"></i></span> <b>Event:</b> <?php echo $event; ?></p>
                  <p><span><i class="fa fa-clock"></i></span> <b>Time:</b> <?php echo date('g:i a', strtotime($time));  ?></p>
                  <p><span><i class="fa fa-clock"></i></span> <b>date:</b> <?php echo date('d M Y', strtotime($date)) ?></p>
                </div>
                <div class="product-buttons">
                  <a href="./edit-events.php?e_id=<?php echo $event_id; ?>" class="btn btn-sm btn-primary ">Edit </a>
                  <a href="./handlers/events.php?del_id=<?php echo $event_id; ?>" class="btn btn-sm btn-danger">Delete</a>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <h2 class="text-center text-muted" style="padding-top: 15px; height: 60vh;">No Event Found</h2>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <?php include("./footer.php");  ?>