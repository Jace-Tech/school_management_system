-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2021 at 11:17 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ghschool`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` varchar(50) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `book_path` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `book_name`, `image`, `book_path`, `quantity`, `date`) VALUES
('c8g9v8k1a5', 'Math', 'c8g9v8k1a5.jpg', 'c8g9v8k1a5.pdf', 30, '2021-09-15'),
('i8r9j1a3f7', 'Math', 'i8r9j1a3f7.jpg', 'i8r9j1a3f7.pdf', 20, '2021-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `counter`
--

CREATE TABLE `counter` (
  `message_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` varchar(15) NOT NULL,
  `course_name` varchar(200) NOT NULL,
  `subjects` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`subjects`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `subjects`) VALUES
('6979', 'Science', '[\"English Language\",\"Mathematics\",\"Igbo\",\"Biology\",\"Chemistry\",\"Physics\",\"Computer Science\",\"Animal Husbandry\",\"Civic Education\",\"Economics\"]');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` varchar(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `event` varchar(200) NOT NULL,
  `image` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forgot_password`
--

CREATE TABLE `forgot_password` (
  `pass_id` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forgot_password`
--

INSERT INTO `forgot_password` (`pass_id`, `email`, `pin`) VALUES
('8216156', 'jacealex151@gmail.com', '30101586'),
('9759852', 'jacealex151@gmail.com', '83540236');

-- --------------------------------------------------------

--
-- Table structure for table `guardian`
--

CREATE TABLE `guardian` (
  `id` int(11) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `phone_no` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guardian`
--

INSERT INTO `guardian` (`id`, `student_id`, `fullname`, `phone_no`) VALUES
(1, 'ED980381', 'Mr. Alexander', '09052541151'),
(2, 'CC32206', 'Jace Alexander', '0877898656'),
(3, 'EA114660', 'Jace Alexander', '0877898656'),
(4, 'BA285370', 'Jace Raphael Alexander', '+2348169822483');

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE `inbox` (
  `message_id` varchar(20) NOT NULL,
  `sender` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `date_received` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `name`, `email`, `image`, `password`) VALUES
('ADMIN', 'Jace', 'jace@gmail.com', 'images/teachers/pexels-lukas-296115.jpg3131.jpg', '$2y$10$i1S8ulPQ4VIhgWOStBxGFefqyS227QZ0c6YVDWZSUAI7vZfxn6Ym6');

-- --------------------------------------------------------

--
-- Table structure for table `payment_status`
--

CREATE TABLE `payment_status` (
  `payment_id` varchar(50) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `session` varchar(50) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_status`
--

INSERT INTO `payment_status` (`payment_id`, `student_id`, `status`, `session`, `date`) VALUES
('v6j6u2f8', 'BA285370', 'paid', '22', '2021-09-15');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `image` varchar(150) NOT NULL,
  `address` varchar(200) NOT NULL,
  `session` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `course` varchar(100) NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `firstname`, `lastname`, `middlename`, `dob`, `image`, `address`, `session`, `gender`, `course`, `date_registered`) VALUES
('BA285370', 'Mike', 'Alexander', 'Raphael', '2021-01-04', 'wallpaperflare.com_wallpaper(9).jpg35000.jpg', 'Behind Devotion Hotel, Sparkling Junction, Jos', 'SS1', 'male', '6979', '2021-09-15 11:32:14'),
('EA114660', 'Jace', 'Alexander', 'Emmanuel', '2021-01-20', 'IMG_3887.jpeg125423.jpeg', 'No.51 Agbani Road, Aptech Enugu', 'SS1', 'male', '6979', '2021-09-10 09:34:51');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` varchar(20) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `phone_no` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `dob` date NOT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `firstname`, `lastname`, `middlename`, `image`, `gender`, `phone_no`, `address`, `dob`, `date_registered`) VALUES
('XY940199', 'Jace', 'Alexander', 'Raphael', 'IMG_3887.jpeg26795.jpeg', 'male', '+2348169822483', 'Behind Devotion Hotel, Sparkling Junction, Jos', '2021-09-06', '2021-09-10 09:37:24');

-- --------------------------------------------------------

--
-- Table structure for table `uniform`
--

CREATE TABLE `uniform` (
  `uniform_id` varchar(50) NOT NULL,
  `uniform_name` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uniform`
--

INSERT INTO `uniform` (`uniform_id`, `uniform_name`, `image`, `section`, `quantity`, `date`) VALUES
('h4b7e2w3d1', 'Short', 'h4b7e2w3d1.jpg', 'sss', 10, '2021-09-29');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `counter`
--
ALTER TABLE `counter`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `forgot_password`
--
ALTER TABLE `forgot_password`
  ADD PRIMARY KEY (`pass_id`);

--
-- Indexes for table `guardian`
--
ALTER TABLE `guardian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inbox`
--
ALTER TABLE `inbox`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_status`
--
ALTER TABLE `payment_status`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `uniform`
--
ALTER TABLE `uniform`
  ADD PRIMARY KEY (`uniform_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `guardian`
--
ALTER TABLE `guardian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
