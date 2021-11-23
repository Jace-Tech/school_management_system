<?php
include "header.php";

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
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="breadcome-list">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="breadcome-heading" style="display: flex; justify-content: space-between;">
									<form action="" role="search" class="sr-input-func" method="get" style="display: block; box-sizing: border-box;">
										<input type="search" placeholder="Search name" name="search" class="search-int form-control">
									</form>
									<div style=" display:flex; margin: 0px 8px;">
										<form action="" method="get" style="display: flex; align-items: center;">
											<label style="display: flex; align-items: center; box-sizing: border-box;">
												<span>Filter</span>
												<?php $session_array = ["JS1", "JS3", "JS3", "SS1", "SS2", "SS3"]; ?>
												<select name="filter" style="padding: 6px; margin: 0 6px; border-radius: 4px; width: 150px;">
													<option value="">Select session</option>
													<?php foreach ($session_array as $item) : ?>
														<?php if ($item == $_GET["filter"]) : ?>
															<option value="<?php echo $item; ?>" selected><?php echo $item; ?></option>
														<?php else : ?>
															<option value="<?php echo $item; ?>"><?php echo $item; ?></option>
														<?php endif; ?>
													<?php endforeach; ?>
												</select>
											</label>
											<button type="submit" style="display: block; padding: 10px 12px; margin-left: 4px; border-radius: 4px; border:none;">Search</button>

										</form>
									</div>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<ul class="breadcome-menu">
									<li><a href="#">Home</a> <span class="bread-slash">/</span>
									</li>
									<li><span class="bread-blod">All Students</span>
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
	<div class="product-status mg-b-15">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="product-status-wrap">
						<h4>Students</h4>
						<div class="add-product">
							<a href="./add-student.php">Add Student</a>
						</div>
						<div class="asset-inner">
							<?php
							$sql_main = "SELECT * FROM `students`";
							$result_main = $conn->prepare($sql_main);
							$result_main->execute();

							$page_no = 1;
							if (isset($_GET["page_no"])) {
								$page_no = $_GET["page_no"];
							}

							$no_to_display = 15;

							if (isset($_GET["amount"])) {
								$no_to_display = $_GET["amount"];
							}

							$steps = [10, 15, 30, 50, 100];

							$start = ($page_no - 1) * $no_to_display;

							$total_no = $result_main->rowCount();
							$no_of_pages = ceil($total_no / $no_to_display);

							$query = "SELECT * FROM `students` LIMIT {$start},{$no_to_display}";
							$result = $conn->prepare($query);
							$result->execute();

							if (isset($_GET["search"])) {
								$search = $_GET['search'];
								$query = "SELECT * FROM `students` WHERE `firstname` REGEXP ? OR `lastname` REGEXP ?";
								$result = $conn->prepare($query);
								$result->execute([$search, $search]);
							}

							if (isset($_GET["filter"])) {
								$filter = $_GET['filter'];
								$query = "SELECT * FROM `students` WHERE `session` REGEXP ?";
								$result = $conn->prepare($query);
								$result->execute([$filter]);
							}

							if ($result->rowCount() > 0) {
								$x = 0;
							?>
								<table>
									<tr>
										<th>No</th>
										<th>Image</th>
										<th>Lastname</th>
										<th>Firstname</th>
										<th>Course</th>
										<th>Session</th>
										<th>Options</th>
									</tr>
									<?php
									while ($row = $result->fetch()) {
										$x++;
										extract($row);

										$sql = "SELECT * FROM `courses` WHERE `course_id` = ?";
										$stmt = $conn->prepare($sql);
										$stmt->execute([$course]);

										$row2 = $stmt->fetch();
										$course = $row2["course_name"];
									?>

										<tr>
											<td><?php echo $x; ?></td>
											<td><img src="./images/students/<?php echo $image; ?>" style="width: 50px; height: 50px; border-radius: 50%; object-fit: contain;"></td>
											<td>
												<a href="./student-profile.php?profile_id=<?php echo $student_id; ?>">
													<?php echo $lastname; ?>
												</a>
											</td>
											<td>
												<a href="./student-profile.php?profile_id=<?php echo $student_id; ?>">
													<?php echo $firstname; ?>
												</a>
											</td>
											<td><?php echo $course; ?></td>
											<td><?php echo $session; ?></td>
											<td style="display: flex; justify-content: space-around; ">
												<a href="./student-profile.php?profile_id=<?php echo $student_id; ?>" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="font-size: 20px; padding-top: 8px;">
													<i class="fa fa-pencil-square-o" aria-hidden="true">
													</i>
												</a>
												<a href="./handlers/student.php?delete_id=<?php echo $student_id; ?>" data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="font-size: 20px; padding-top: 8px; color: red;">
													<i class="fa fa-trash-o" aria-hidden="true"></i>
												</a>
											</td>
										</tr>


									<?php
									}
									?>
								</table>
							<?php
							} else {
							?>
								<h2 class="text-center mt-b-20 mg-b-20" style="color: #999; min-height: 300px; display: flex; align-items: center; justify-content: center;">No Student Found</h2>
							<?php
							}


							?>

						</div>
						<div style="display: flex; flex-wrap: wrap; align-items: center;" class="mg-t-30">
							<div style=" flex: 1 1; display: flex; justify-content: flex-start; align-items: center;">
								<?php
								if ($no_of_pages > 1) {
								?>
									<ul class="pagination">
										<?php if ($page_no < 2) :  ?>
											<li class="page-item">
												<a class="page-link" disabled>Previous</a>
											</li>
										<?php else :  ?>
											<li class="page-item">
												<a class="page-link" <?php if ($page_no == $no_of_pages) echo "disabled"; ?> href="all-students.php?page_no=<?php echo $page_no - 1; ?>">Previous</a>
											</li>
										<?php endif;  ?>

										<?php for ($i = 1; $i <= $no_of_pages; $i++) : ?>
											<?php if ($i == $page_no) : ?>
												<li class="page-item">
													<a class="page-link" style="background-color: #006DF0; color: #fff; " href="all-students.php?page_no=<?php echo $i; ?>"><?php echo $i; ?></a>
												</li>
											<?php else : ?>
												<li class="page-item">
													<a class="page-link" href="all-students.php?page_no=<?php echo $i; ?>"><?php echo $i; ?></a>
												</li>
											<?php endif; ?>
										<?php endfor; ?>

										<?php if ($page_no == $no_of_pages) :  ?>
											<li class="page-item">
												<a class="page-link" disabled>Next</a>
											</li>
										<?php else :  ?>
											<li class="page-item">
												<a class="page-link" <?php if ($page_no == $no_of_pages) echo "disabled"; ?> href="all-students.php?page_no=<?php echo $page_no + 1; ?>">Next</a>
											</li>
										<?php endif;  ?>
									</ul>
								<?php
								}
								?>
							</div>
							<div style=" flex: 1 1; display: flex; justify-content: flex-end; align-items: center;">
								<form action="" method="get" style="display: flex;">
									<label style=" flex: 1; display: flex; align-items: center;">
										<span>Row No.</span>
										<select name="amount" style="padding: 6px; margin: 0 6px; border-radius: 4px; width: 150px;">
											<?php foreach ($steps as $step) : ?>
												<option value="<?php echo $step ?>" <?php if ($step == $no_to_display) echo  "selected"; ?>><?php echo $step ?> </option>
											<?php endforeach; ?>
										</select>
									</label>
									<button type="submit" class="btn btn-sm btn-primary" style="height: fit-content;">Set</button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	include("./footer.php");
	?>