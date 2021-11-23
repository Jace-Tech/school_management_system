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
                <li><span class="bread-blod">All Teachers</span>
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
        $query = "SELECT * FROM `teachers`";
        $result = $conn->prepare($query);
        $result->execute();

        if (isset($_GET['search'])) {
          $search = $_GET['search'];
          $query = "SELECT * FROM `teachers` WHERE `firstname` REGEXP ? OR `lastname` REGEXP ?";
          $result = $conn->prepare($query);
          $result->execute([$search, $search]);
        }

        $rows = $result->fetchAll();
        ?>
        <?php if (count($rows) > 0) : ?>
          <?php foreach ($rows as $row) : extract($row); ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
              <a href="teacher-profile.php?profile_id=<?php echo $teacher_id; ?>">
                <div class="hpanel hblue contact-panel contact-panel-cs responsive-mg-b-30">
                  <div class="panel-body custom-panel-jw">
                    <img alt="logo" class="img-circle m-b" src="./images/teachers/<?php echo $image; ?>">
                    <h3><?php echo $firstname . ' ' . substr($middlename, 0, 1) . ' ' . $lastname; ?></h3>
                    <p class="all-pro-ad mg-b-20">ID: <?php echo $teacher_id; ?></p>
                  </div>
                </div>
              </a>
            </div>
          <?php endforeach; ?>
        <?php else : ?>
          <h2 class="text-center text-muted" style="padding-top: 15px; height: 60vh;">No Teacher Found</h2>
        <?php endif; ?>
      </div>
    </div>
  </div><?php include("./footer.php"); ?>