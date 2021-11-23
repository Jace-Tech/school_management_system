<?php

include "./header.php";

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

  <div class="courses-area">
    <div class="container-fluid">
      <div class="row mg-b-30 mg-t-30">
        <?php
        $query = "SELECT * FROM `courses` ORDER BY `course_name` ASC";
        $result = $conn->prepare($query);
        $result->execute();

        while ($row = $result->fetch()) {
          extract($row);
        ?>
          <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 mg-b-10 mg-t-10">
            <div class="product-status-wrap" style="border-radius: 4px;">
              <div style="display: flex; justify-content: center; align-items: center;">
                <h4 style="flex: 1; padding-top: 8px;"><?php echo $course_name; ?></h4>
                <div style="flex: 1; display: flex; align-items: center; justify-content: flex-end;">
                  <a class="btn btn-primary btn-sm" style="display: block; margin-right: 2px;" href="edit-course.php?id=<?php echo $course_id;  ?>">Edit </a>
                  <a class="btn btn-danger btn-sm" style="display: block;" href="./handlers/course.php?delete_id=<?php echo $course_id;  ?>">Delete </a>
                </div>
              </div>
              <div class="asset-inner">
                <table>
                  <thead>
                    <tr>
                      <th>S/N</th>
                      <th>Subject</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $array = json_decode($subjects);

                    for ($x = 0; $x < count($array); $x++) {
                    ?>
                      <tr>
                        <td><?php echo $x + 1; ?></td>
                        <td><?php echo $array[$x]; ?></td>
                      </tr>
                    <?php
                    }

                    ?>
                  </tbody>

                </table>
              </div>
            </div>
          </div>
        <?php
        }
        ?>
      </div>
    </div>
    <?php include("./footer.php"); ?>