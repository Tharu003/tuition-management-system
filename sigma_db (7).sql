-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2026 at 01:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigma_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `grade` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `grade`) VALUES
(1, '6'),
(2, '7'),
(3, '8'),
(4, '9'),
(5, '10'),
(6, '11'),
(7, '1/2/3/4/5'),
(8, '3/4/5'),
(9, '6'),
(10, '6');

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `subject`, `message`, `submitted_at`) VALUES
(1, 'Nishara', 'student@gmail.com', 'sinhala', 'dfsrgth', '2025-05-30 07:35:08'),
(2, 'Nisharaa', 'studenwt@gmail.com', 'sinhala', 'hfghy', '2025-05-30 07:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL,
  `subject_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `student_id`, `subject_id`) VALUES
(2, 1, 1),
(3, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_requests`
--

CREATE TABLE `password_requests` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `request_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_requests`
--

INSERT INTO `password_requests` (`id`, `user_email`, `request_time`, `status`) VALUES
(1, 'piyu@gmail.com', '2026-01-17 05:03:20', 'Pending'),
(2, 'piyu@gmail.com', '2026-01-17 05:08:12', 'Pending'),
(3, 'piyu@gmail.com', '2026-01-17 05:14:58', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `payment_month` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `student_id`, `teacher_id`, `subject`, `amount`, `payment_date`, `payment_month`) VALUES
(1, 4, 1, 'Sinhala', 1000.00, '2025-06-11', 'June'),
(2, 5, 1, 'Sinhala', 2000.00, '2025-06-27', 'June'),
(3, 6, 1, 'Sinhala', 1000.00, '2025-06-10', 'June'),
(4, 7, 1, 'Sinhala', 1000.00, '2025-06-26', 'June'),
(5, 4, 2, 'English', 1000.00, '2025-06-25', 'June');

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `st_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `st_id`, `class_id`, `subject_id`, `year`) VALUES
(1, 4, 1, 1, 2025),
(2, 5, 1, 1, 2025),
(3, 6, 1, 1, 2025),
(4, 7, 1, 1, 2025),
(5, 5, 1, 1, 2026),
(6, 6, 1, 1, 2026),
(7, 7, 1, 1, 2026),
(8, 8, 1, 1, 2026);

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `type` enum('pdf','image','link') DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `link_url` text DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`id`, `title`, `description`, `type`, `file_path`, `link_url`, `uploaded_at`) VALUES
(3, 'Sinhala', 'Class Test 1 Paper', 'pdf', '683eb6a09bed4.pdf', NULL, '2025-06-03 08:47:28'),
(4, 'English', 'Class Test Paper 1', 'pdf', '683eb6c4ed86d.pdf', NULL, '2025-06-03 08:48:04'),
(5, 'Maths', 'Class Test Paper 1', 'pdf', '683eb6e203797.pdf', NULL, '2025-06-03 08:48:34'),
(6, 'Science', 'Class test paper 1', 'pdf', '683eb70bd04bd.pdf', NULL, '2025-06-03 08:49:15'),
(7, 'History', 'Class test paper 1', 'pdf', '683eb74b37a34.pdf', NULL, '2025-06-03 08:50:19');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `st_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `whatsapp_no` varchar(15) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_contact` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`st_id`, `full_name`, `address`, `dob`, `whatsapp_no`, `guardian_name`, `guardian_contact`, `email`, `password`, `admission_date`, `user_id`) VALUES
(4, 'nishara', 'galle', '2025-05-13', '123456789', 'Sanjeewa', '987654321', 'a@gmail.com', '1111', NULL, 0),
(5, 'nethmi', 'galle', '2025-05-13', '123456789', 'Sanjeewa', '987654321', 'b@gmail.com', '1112', NULL, 0),
(6, 'dewmini', 'galle', '2025-05-13', '123456789', 'Sanjeewa', '987654321', 'c@gmail.com', '1113', NULL, 0),
(7, 'irushee', 'galle', '2025-05-13', '123456789', 'Sanjeewa', '987654321', 'd@gmail.com', '1114', NULL, 0),
(8, 'ishani', 'galle', '2025-05-13', '123456789', 'Sanjeewa', '987654321', 'e@gmail.com', '1114', NULL, 0),
(9, 'nethmi', 'galle', '2025-05-13', '1111111', 'Sanjeewa', '987654321', 'f@gmail.com', '1112', NULL, 0),
(10, 'nethmi', 'galle', '2025-05-13', '1111111', 'Sanjeewa', '987654321', 'f@gmail.com', '1112', NULL, 0),
(11, 'nethmi', 'galle', '2025-05-13', '1111111', 'Sanjeewa', '987654321', 'g@gmail.com', '1112', NULL, 0),
(12, 'Nishara', 'aaaaaaaaaaaaa', '2025-05-27', '1111111', 'Sanjeewa', '0766801980', 'student@gmail.com', '3444444', NULL, 0),
(13, 'Nishara', 'aaaaaaaaaaaaa', '2025-05-27', '1111111', 'Sanjeewa', '0766801980', 'student@gmail.com', '3444444', NULL, 0),
(14, 'Nishara', 'aaaaaaaaaaaaa', '2025-05-27', '1111111', 'Sanjeewa', '0766801980', 'student@gmail.com', '3444444', NULL, 0),
(15, 'Nishara', 'aaaaaaaaaaaaa', '2025-05-27', '1111111', 'Sanjeewa', '0766801980', 'student@gmail.com', '3444444', NULL, 0),
(16, 'Nishara', 'aaaaaaaaaaaaa', '2025-05-27', '1111111', 'Sanjeewa', '0766801980', 'student@gmail.com', '3444444', NULL, 0),
(17, 'Nishara', 'aaaaaaaaaaaaa', '2025-05-27', '1111111', 'Sanjeewa', '0766801980', 'student@gmail.com', '3444444', NULL, 0),
(18, 'Nishara', 'aaaaaaaaaaaaa', '2025-05-27', '1111111', 'Sanjeewa', '0766801980', 'student@gmail.com', '3444444', NULL, 0),
(19, 'Nishara', 'Galle', '2025-06-27', '111111111111', 'Amil', '0987654321', 'tha@gmail.com', '1111', '2025-06-01', 0),
(20, 'Nishara', 'Galle', '2025-06-27', '111111111111', 'Amil', '0987654321', 'th@gmail.com', '1111', '2025-06-01', 0),
(21, 'Nishara', 'Galle', '2025-06-27', '111111111111', 'Amil', '0987654321', 't@gmail.com', '1111', '2025-06-01', 0),
(22, 'Nishara', 'Galle', '2025-06-27', '111111111111', 'Amil', '0987654321', 'mm@gmail.com', '1111', '2025-06-01', 0),
(23, 'Nishara', 'Galle', '2025-06-27', '111111111111', 'Amil', '0987654321', 'mo@gmail.com', '1111', '2025-06-01', 0),
(24, 'Nishara', 'Galle', '2025-06-27', '111111111111', 'Amil', '0987654321', 'mp@gmail.com', '1111', '2025-06-01', 0),
(25, 'Nishara', 'Galle', '2025-06-27', '111111111111', 'Amil', '0987654321', 'ml@gmail.com', '1111', '2025-06-01', 0),
(26, 'Nishara', 'Galle', '0000-00-00', '111111111111', 'Amil', '0987654321', 'll@gmail.com', '1111', '2025-06-01', 0),
(27, 'Nishara', 'Galle', '0000-00-00', '111111111111', 'Amil', '0987654321', 'pp@gmail.com', '1111', '2025-06-01', 0),
(28, 'Nishara', 'Galle', '0000-00-00', '111111111111', 'Amil', '0987654321', 'pb@gmail.com', '1111', '2025-06-01', 0),
(29, 'Nishara', 'Galle', '0000-00-00', '111111111111', 'Amil', '0987654321', 'po@gmail.com', '1111', '2025-06-01', 0),
(30, 'Nishara', 'Galle', '0000-00-00', '111111111111', 'Amil', '0987654321', 'pu@gmail.com', '1111', '2025-06-01', 0),
(31, 'Nishara', 'Galle', '0000-00-00', '111111111111', 'Amil', '0987654321', 'pppp@gmail.com', '1111', '2025-06-01', 0),
(32, 'Nishara', 'Galle', '2025-07-03', '111111111111', 'amil', '1111111111111', 'abc@gmail.com', '1111', '2025-06-01', 0),
(33, 'Nishara', 'Galle', '2025-07-03', '111111111111', 'amil', '1111111111111', 'abcd@gmail.com', '1111', '2025-06-01', 0),
(34, 'Tharu', 'galle', '2025-06-26', '123456789', 'Amil', '111111111', 'r@gmail.com', '4444', '2025-06-02', 0),
(35, 'Kaveesha', 'Hikkaduwa', '2025-06-12', '111111111', 'Sanjeewa', '0987654321', 'kavee@gmail.com', '2345', '2025-06-10', 0),
(36, 'Kaveesha Nethmi', 'Hikkaduwa', '2025-06-12', '111111111111', 'Sanjeewa', '0987654321', 'kaveesh@gmail.com', '2345', '2025-06-10', 0),
(37, 'Kaveesha Nethmi', 'Hikkaduwa', '2025-06-12', '111111111111', 'Sanjeewa', '0987654321', 'kavees@gmail.com', '2345', '2025-06-12', 0),
(38, 'Nishara De Silva', 'Galle', '2025-07-03', '0770029876', 'Sanjeewa', '098765432', 'nishu@gmail.com', '0000', '2025-06-12', 0),
(39, 'Nishara', 'Galle', '2025-06-16', '111111111111', 'Sanjeewa', '0987654321', 'nisha@gmail.com', '1234', '2025-06-12', 0),
(40, 'Nishara', 'Galle', '2025-06-16', '111111111111', 'Sanjeewa', '0987654321', 'nisha@gmail.com', '1234', '2025-06-12', 0),
(41, 'Chesandu', 'sssss', '2025-06-16', '111111111111', 'Sanjeewa', '0766801980', 'nishara2003@gmail.com', '1234', '2025-06-12', 0),
(42, 'Piyumi', 'Hikkaduwa', '2025-06-18', '111111111111', 'Iresha', '098765432', 'piyu@gmail.com', '1111', '2025-06-12', 0),
(43, 'Nishara ', 'Galle', '2025-06-25', '0987654321', 'Sanjeewa', '098765432', 'nish@gmail.com', '1234', '2025-06-19', 0),
(44, 'Nishara De Silva', 'Galle', '2025-12-17', '0743397871', 'Sanjeewa', '098765432', 'n@gmail.com', '1234', '2025-12-20', 0);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`) VALUES
(1, 'Mathematics'),
(2, 'English'),
(3, 'Science');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contact_no` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `full_name`, `email`, `contact_no`, `dob`, `address`, `password`, `qualification`, `photo`) VALUES
(1, 'Suranjith Vithanage', 'sinhala@gmail.com', '0766801980', '2025-05-21', 'Galle', '$2y$10$Saxt5NLKYLul7GRKKSd9MOXknhwwkqXziVLnanoI/eZnMJ0Xd7J7u', 'Bsc Degree Holder', '1748588369_suranjith.jpg'),
(2, 'Ranil Gunarathna', 'english@gmail.com', '0766801989', '2025-05-21', 'Galle', '$2y$10$WqQFW22NFdGditOrZI.cFOTWKr959XLMGSXGwDsHeDln7cGbtakuq', 'Bsc Degree Holder', '1748588572_ranil.jpg'),
(3, 'Thilina Nayanajith', 'it@gmail.com', '0766801980', '2025-05-19', 'Galle', '$2y$10$ee97bvquxA1EB8x7xC7WTu9vDcC88IPcXTBshnMticzZnqUZtCmzK', 'Bsc Degree Holder', '1748588599_thilina.jpg'),
(4, 'Thushara De Silva', 'commerce@gmail.com', '0766801982', '2025-05-20', 'Galle', '$2y$10$kCIJkJJ6jyv9EUSH.i6hPetagSGypaiRQ9awmRwHROjz0uM.Xf7dC', 'Bsc Degree Holder', '1748588635_thushara.jpg'),
(5, 'Sashika Jayawardhana', 'dancing@gmail.com', '0766801983', '2025-05-05', 'Galle', '$2y$10$71KgUKAKo4cgojku3n3kLOShUKiYzWPA19rIGa0v.xqirpmGDNPdy', 'Bsc Degree Holder', '1748588651_shashika.jpg'),
(6, 'Ravindu Maduranga', 'maths@gmailcom', '0766801984', '2025-05-04', 'Galle', '$2y$10$.wPrDBVXWV83KE4NVt.Cjek9AtB0EFH5.i9CuItISk2vHMZkuIu5S', 'Bsc Degree Holder', '1748588664_ravindu.jpg'),
(7, 'Saranga Piyumal', 'science@gmail.com', '0766801988', '2025-05-21', 'Galle', '$2y$10$5oL/xJmrKOrvcD16xP0tZ.LsgyQ439.b3D/n74s65qF1rrhudRz7.', 'Bsc Degree Holder', '1748588678_saranga.jpg'),
(8, 'Maduranga De Silva', 'art@gmail.com', '0766801987', '2025-05-15', 'Galle', '$2y$10$Q8SLoX.1dMetGtHim7w3quPgUUQDwKAfbmFYjqRCGhhiESSQSRVxu', 'Bsc Degree Holder', '1748588689_maduranga.jpg'),
(9, 'Nimali Mendis', 'music@gmail.com', '0766801985', '2025-05-15', 'Galle', '$2y$10$Mxoy4TkybkxfKP9Tql4ituFt9QjvSEygtfhUbNrEs1JQom46r0xtK', 'Bsc Degree Holder', '1748588701_nimali.jpg'),
(10, 'Darshi Nadeeshani', 'penglish@gmail.com', '0766801986', '2025-05-21', 'Galle', '$2y$10$PRIgAczGAirHGnydBOd0q.77zDI9Yzh78k2IXC/5AhKVpL17tFF7G', 'Bsc Degree Holder', '1748588714_darshi.jpg'),
(11, 'Sanjeewa De Silva', 'sch@gmail.com', '0766801984', '2025-05-21', 'Galle', '$2y$10$B4crNuXN7/KCG/eQZEaHZekVYVtBex67ltNbTCPtpLIC92iP2LN/u', 'Bsc Degree Holder', '1748588727_sanjeewa.jpg'),
(18, 'Nishara De Silva', 'nishara@gmail.com', '098765432', '2025-06-20', 'Galle', '$2y$10$iNfqb8hOnVArmLzsXWUnkeLgnxpVpb5tT7BDBgiNNIizL3sJV8jly', 'Bsc Degree Holder', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teach_sub_reg`
--

CREATE TABLE `teach_sub_reg` (
  `teacher_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `schedule` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teach_sub_reg`
--

INSERT INTO `teach_sub_reg` (`teacher_id`, `class_id`, `subject_id`, `schedule`) VALUES
(1, 1, 1, 'Monday 4.00 P.M- 6.00 P.M'),
(1, 2, 1, 'Saturday 3.00 P.M - 5.00 P.M'),
(1, 3, 1, 'Monday 5.00 P.M - 7.00 P.M'),
(1, 4, 1, 'Friday 7.00 P.M - 9.00 P.M'),
(2, 1, 2, 'Friday 5.00 P.M - 7.00 P.M'),
(2, 2, 2, 'Wednesday 3.00 P.M - 5.00 P.M'),
(2, 3, 2, 'Wednesday 5.00 P.M - 7.00 P.M'),
(2, 4, 2, 'Friday 3.00 P.M - 5.00 P.M'),
(2, 5, 2, 'Friday 7.00 P.M - 9.00 P.M'),
(2, 6, 2, 'Wednesday 7.00 P.M - 9.00 P.M');

-- --------------------------------------------------------

--
-- Table structure for table `te_teach_sub`
--

CREATE TABLE `te_teach_sub` (
  `teacher_id` int(20) NOT NULL,
  `subject_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','teacher') NOT NULL,
  `status` enum('approved','pending') DEFAULT 'pending',
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `whatsapp_no` varchar(20) DEFAULT NULL,
  `guardian_name` varchar(100) DEFAULT NULL,
  `guardian_contact` varchar(20) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `address`, `dob`, `whatsapp_no`, `guardian_name`, `guardian_contact`, `admission_date`, `profile_pic`) VALUES
(1, 'Chesandu', 'nishara2003@gmail.com', '1234', 'student', 'approved', 'sssss', '2025-06-16', '111111111111', 'Sanjeewa', '0766801980', '2025-06-12', NULL),
(2, 'Piyumi', 'piyu@gmail.com', '1111', 'student', 'approved', 'Hikkaduwa', '2025-06-18', '111111111111', 'Iresha', '098765432', '2025-06-12', 'profile_2_1754635527.png'),
(3, 'Nishara ', 'nish@gmail.com', '1234', 'student', 'approved', 'Galle', '2025-06-25', '0987654321', 'Sanjeewa', '098765432', '2025-06-19', ''),
(4, 'Admin', 'admin@gmail.com', 'admin123', 'teacher', 'approved', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'Nishara De Silva', 'n@gmail.com', '1234', 'student', 'pending', 'Galle', '2025-12-17', '0743397871', 'Sanjeewa', '098765432', '2025-12-20', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `password_requests`
--
ALTER TABLE `password_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`st_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `teach_sub_reg`
--
ALTER TABLE `teach_sub_reg`
  ADD PRIMARY KEY (`teacher_id`,`class_id`,`subject_id`);

--
-- Indexes for table `te_teach_sub`
--
ALTER TABLE `te_teach_sub`
  ADD PRIMARY KEY (`teacher_id`,`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `password_requests`
--
ALTER TABLE `password_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `st_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`) ON DELETE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`st_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
