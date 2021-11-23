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
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<ul class="breadcome-menu">
									<li><a href="#">Home</a> <span class="bread-slash">/</span>
									</li>
									<li><span class="bread-blod">All Books</span>
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
												<?php 
													if(isset($_GET["edit_id"])): 
														$ID =$_GET["edit_id"];
														
														$query = "SELECT * FROM `books` WHERE `book_id` = ?";
														$result = $conn->prepare($query);
														$result->execute([$ID]);

														$row = $result->fetch();
														extract($row);
													
													?>
													<form id="form" action="./handlers/book.php" method="post" enctype="multipart/form-data">
														<fieldset>
															<legend class="text-primary">Update Book</legend>
															<div class="row align-items-center">
																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Book Name</label>
																		<input name="bookName" type="text" value="<?= $book_name; ?>" class="form-control">
																	</div>
																</div>

																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Quantity</label>
																		<input name="quantity" type="number" value="<?= $quantity; ?>" class="form-control">
																		<input type="hidden" name="BOOK_ID" value="<?= $book_id; ?>">
																	</div>
																</div>

																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Upload Book</label>
																		<input name="book" type="file" class="form-control-file" accept=".pdf">
																		<p class="text-danger">Prev: <?= $book_path; ?></p>
																	</div>
																</div>

																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Upload Book Image</label>
																		<input name="image" type="file" class="form-control-file" accept=".jpg,.jpeg,.png">
																		<p class="text-danger">Prev: <?= $image; ?></p>
																	</div>
																</div>

																<div class="col-lg-12">
																	<button type="submit" name="update" class="btn d-block btn-primary btn-lg waves-effect waves-light px-5">Update</button>
																</div>
															</div>
														</fieldset>
													</form>
												<?php else: ?>
													<form id="form" action="./handlers/book.php" method="post" enctype="multipart/form-data">
														<fieldset>
															<legend class="text-primary">Add Book</legend>
															<div class="row align-items-center">
																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Book Name</label>
																		<input name="bookName" type="text" class="form-control" required>
																	</div>
																</div>

																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Quantity</label>
																		<input name="quantity" type="number" class="form-control" required>
																	</div>
																</div>

																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Upload Book</label>
																		<input name="book" type="file" class="form-control-file" accept=".pdf" required>
																	</div>
																</div>

																<div class="col-sm-12 col-md-6">
																	<div class="form-group">
																		<label>Upload Book Image</label>
																		<input name="image" type="file" class="form-control-file" accept=".jpg,.jpeg,.png" required>
																	</div>
																</div>

																<div class="col-lg-12">
																	<button type="submit" name="submit" class="btn d-block btn-primary btn-lg waves-effect waves-light px-5">Add</button>
																</div>
															</div>
														</fieldset>
													</form>		
												<?php endif; ?>
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

	<div class="product-status mg-b-15">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="product-status-wrap">
						<h4>Books</h4>
						<div class="asset-inner">
							<?php
							$sql_main = "SELECT * FROM `books`";
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

							$query = "SELECT * FROM `books` LIMIT {$start},{$no_to_display}";
							$result = $conn->prepare($query);
							$result->execute();

							if (isset($_GET["search"])) {
								$search = $_GET['search'];
								$query = "SELECT * FROM `books` WHERE `book_name` REGEXP ?";
								$result = $conn->prepare($query);
								$result->execute([$search]);
							}

							if ($result->rowCount() > 0) {
								$x = 0;
							?>
								<table>
									<tr>
										<th>No</th>
										<th>Image</th>
										<th>Book Name</th>
										<th>Quantity</th>
										<th>Date Added</th>
										<th>Options</th>
									</tr>
									<?php
									while ($row = $result->fetch()) {
										$x++;
										extract($row);
									?>

										<tr>
											<td><?= $x; ?></td>
                                            <td>
												<img src="./books/image/<?= $image; ?>" class="img-fluid" alt="">
											</td>
                                            <td>
												<a download="<?=  $book_name; ?>" href="./books/files/<?= $book_path; ?>">
													<?= $book_name; ?>
												</a>
											</td>
											<td><?= $quantity; ?></td>
											<td><?= date('D d M', strtotime($date)); ?></td>
											<td style="display: flex; justify-content: space-around; ">
												<a href="./books.php?edit_id=<?= $book_id; ?>" data-toggle="tooltip" title="Edit" class="pd-setting-ed" style="font-size: 20px; padding-top: 8px;">
													<i class="fa fa-pencil-square-o" aria-hidden="true">
													</i>
												</a>
												<a href="./handlers/book.php?delete_id=<?php echo $book_id; ?>" data-toggle="tooltip" title="Trash" class="pd-setting-ed" style="font-size: 20px; padding-top: 8px; color: red;">
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
								<h2 class="text-center mt-b-20 mg-b-20" style="color: #999; min-height: 300px; display: flex; align-items: center; justify-content: center;">No Book Found</h2>
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