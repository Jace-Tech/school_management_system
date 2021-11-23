<?php

include_once("./db/config.php");
include_once("../functions/index.php");

/*
 * ============================================================================
 * ************************* BASIC CRUD OPERATION ***********************
 * ============================================================================
 */

/* ************************************ CREATE [Insert] ************************************ */
if (isset($_POST["submit"])) {
	$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	$array = ['A', 'B', 'C', 'D', 'E'];
	$id = $array[rand(0, 4)] . $array[rand(0, 4)];
	$id .= rand(10000, 999999);

	/*  Students Info's */
	$firstname = $POST["firstname"];
	$lastname = $POST["lastname"];
	$middlename = $POST["middle-name"];
	$date_of_birth = $POST["date-of-birth"];
	$address = $POST["address"];
	$gender = $POST["gender"];
	$course = $POST["course"];
	$session = $POST["session"];

	$filename = $_FILES["image"]["name"];
	$rand = rand(10000, 1000000);
	$destination = "../images/students/";
	$extension = pathinfo($filename, PATHINFO_EXTENSION);

	$filename .= $rand . '.' . $extension;
	$file = $_FILES["image"]["tmp_name"];
	$size = $_FILES["image"]["size"];

	$sql = "SELECT * 
		FROM `students` 
		WHERE `student_id` = '$id' 
		OR `lastname` = '$lastname' 
		AND `middlename` = '$middlename'";
	$result = $conn->prepare($sql);
	$result->execute();

	if ($result->rowCount() > 0) {
		header("location: ../add-student.php?alert=s_e");
		exit();
	}

	if ($size > 2000000) {
		header("location: ../add-student.php?alert=f_l");
		exit();
	}

	$moved = move_uploaded_file($file, $destination . $filename);

	if ($moved) {
		$query = "INSERT 
			INTO `students`(`student_id`, `firstname`, `lastname`, `middlename`, `dob`, `image`, `gender`, `session`, `course`, `address`) 
			VALUES (:id, :firstname, :lastname, :middlename, :dob, :image, :gender, :session, :course, :address)";
		try {
			$stmt = $conn->prepare($query);
			$stmt->execute([
				"id" => $id,
				"firstname" => $firstname,
				"lastname" => $lastname,
				"middlename" => $middlename,
				"dob" => $date_of_birth,
				"image" => $filename,
				"gender" => $gender,
				"session" => $session,
				"course" => $course,
				"address" => $address
			]);
		} catch (PDOException $e) {
			header("location: ../add_student.php?alert=reg_f&m=" . $e);
		}


		if ($stmt) {
			// Add Payment Status
			$payment_id = generateId(10);
			$session = date("y") . " - " . intval(date("y")) + 1;
			$query = "INSERT INTO `payment_status`(`payment_id`, `student_id`, `status`, `session`) VALUES (:paymentId, :studentId, :status, :session)";
			$result = $conn->prepare($query);
			$result->execute([
				"paymentId" => $payment_id,
				"studentId" => $id,
				"status" => "not paid",
				"session" => $session
			]);
			// Guardians / Parent Info's
			$fullname = $POST["guardian-name"];
			$phone = $POST["phone-no"];

			$sql = "INSERT 
			INTO `guardian`(`student_id`, `fullname`, `phone_no`) 
			VALUES (:id, :fullname, :phone)";
			try {
				$result = $conn->prepare($sql);
				$result->execute([
					"id" => $id,
					"fullname" => $fullname,
					"phone" => $phone
				]);

				if ($result) {
					header("location: ../add-student.php?alert=reg_s");
				}
			} catch (PDOException $e) {
				header("location: ../add-student.php?alert=reg_f&m=" . $e);
			}
		} else {
		}
	} else {
		header("location: ../add-student.php?alert=up_f");
	}
}



/* ************************************ EDIT [Update] ************************************ */
if (isset($_POST["update"])) {
	$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

	$firstname = $POST["firstname"];
	$lastname = $POST["lastname"];
	$middlename = $POST["middlename"];
	$date_of_birth = $POST["dob"];
	$address = $POST["address"];
	$gender = $POST["gender"];
	$course = $POST["course"];
	$session = $POST["session"];
	$previous_image = $POST["previous_image"];
	$id = $POST["id"];


	$phone = $POST["phone"];
	$fullname = $POST["fullname"];

	if ($_FILES["image"]["name"] !== '') {
		$filename = $_FILES["image"]["name"];
		$rand = rand(10000, 1000000);
		$destination = "../images/students/";
		$extension = pathinfo($filename, PATHINFO_EXTENSION);

		$filename .= $rand . '.' . $extension;
		$file = $_FILES["image"]["tmp_name"];
		$size = $_FILES["image"]["size"];


		if ($size > 2000000) {
			header("location: ../add-student.php?alert=f_l");
			exit();
		}

		$moved = move_uploaded_file($file, $destination . $filename);
		if ($moved) {
			chmod($destination, 777);

			$path = $destination . $previous_image;
			$unlinked = unlink($path);

			if ($unlinked) {
				try {
					$query = "UPDATE `students` 
				SET `firstname`= :firstname,
				`lastname`= :lastname,
				`middlename`= :middlename,
				`dob` = :dob,
				`image` = :image,
				`address` = :address,
				`session` = :session,
				`gender`= :gender, 
				`course` = :course 
				WHERE `student_id` = :id";
					$result = $conn->prepare($query);
					$result->execute([
						"id" => $id,
						"firstname" => $firstname,
						"lastname" => $lastname,
						"middlename" => $middlename,
						"dob" => $date_of_birth,
						"image" => $filename,
						"gender" => $gender,
						"session" => $session,
						"course" => $course,
						"address" => $address
					]);

					if ($result) {
						$sql = "UPDATE `guardian` SET `fullname` = :fullname, `phone_no` = :phone WHERE `student_id` = :id";
						$stmt = $conn->prepare($sql);
						$stmt->execute([
							"fullname" => $fullname,
							"phone" => $phone,
							"id" => $id
						]);

						if ($stmt) {
							header("location: ../student-profile.php?alert=upd_s&profile_id=" . $id);
						} else {
							header("location: ../student-profile.php?alert=e&profile_id=" . $id);
						}
					} else {
						header("location: ../student-profile.php?alert=e&profile_id=" . $id);
					}
				} catch (PDOException $e) {
					echo $e;
				}
			} else {
				//header("location: ../student-profile.php?alert=e&q=del_f&profile_id=" . $id);
			}
		} else {
			header("location: ../student-profile.php?alert=up_f&profile_id=" . $id);
		}
	} else {
		try {
			$query = "UPDATE `students` 
				SET `firstname`= :firstname,
				`lastname`= :lastname,
				`middlename`= :middlename,
				`dob` = :dob,
				`address` = :address,
				`session` = :session,
				`gender`= :gender, 
				`course` = :course 
				WHERE `student_id` = :id";
			$result = $conn->prepare($query);
			$result->execute([
				"firstname" => $firstname,
				"lastname" => $lastname,
				"middlename" => $middlename,
				"dob" => $date_of_birth,
				"address" => $address,
				"gender" => $gender,
				"session" => $session,
				"course" => $course,
				"id" => $id
			]);

			if ($result) {
				$sql = "UPDATE `guardian` SET `fullname` = :fullname, `phone_no` = :phone WHERE `student_id` = :id";
				$stmt = $conn->prepare($sql);
				$stmt->execute([
					"fullname" => $fullname,
					"phone" => $phone,
					"id" => $id
				]);

				if ($stmt) {
					header("location: ../student-profile.php?alert=upd_s&profile_id=" . $id);
				} else {
					header("location: ../student-profile.php?alert=e&profile_id=" . $id);
				}
			} else {
				header("location: ../student-profile.php?alert=e&profile_id=" . $id);
			}
		} catch (PDOException $e) {
			echo $e;
		}
	}
}



/* ************************************ DELETE [Delete] ************************************ */
if (isset($_GET["delete_id"])) {
	$id = $_GET["delete_id"];

	$query = "DELETE FROM `students` WHERE `student_id` = ?";
	try {
		$result = $conn->prepare($query);
		$result->execute([$id]);

		if ($result) {
			$sql = "DELETE FROM `guardian` WHERE `student_id` = ?";
			$result = $conn->prepare($sql);
			$result->execute([$id]);

			if ($result) {
				$query = "DELETE FROM `payment_status` WHERE `student_id` = ?";
				$result = $conn->prepare($query);
				$result->execute([$id]);

				if($result) header("location: ../all-students.php?alert=pd_s");
			} else {
				header("location: ../student-profile.php?alert=e&profile_id=" . $id);
			}
		} else {
			header("location: ../student-profile.php?alert=e&profile_id=" . $id);
		}
	} catch (PDOException $e) {
		echo $e;
	}
}



/*************** Truncate **************/
if (isset($_GET["empty"])) {
	try {
		$query = "SELECT * FROM `student`";
		$result = $conn->prepare($query);
		$result->execute();

		while ($row = $result->fetch()) {
			extract($row);

			$path = "../images/students/" . $image;
			unlink($path);
		}

		$stmt1 = $conn->query("TRUNCATE `students`");
		$stmt1->execute();

		if ($stmt1) {
			$stmt2 = $conn->query("TRUNCATE `guardian`");
			$stmt2->execute();

			if ($stmt2) {
				header("location: ../settings.php?alert=st_s");
			}
		}
	} catch (PDOException $e) {
		header("location: ../settings.php?alert=e");
	}
}
