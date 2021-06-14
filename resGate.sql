-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 03, 2021 at 01:50 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `resGate`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrators`
--

CREATE TABLE `administrators` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(10) NOT NULL DEFAULT 'Publisher',
  `last_login` varchar(150) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `assign_instruct` varchar(50) DEFAULT NULL,
  `assign_student` varchar(50) DEFAULT NULL,
  `published_paper` tinyint(4) NOT NULL DEFAULT 0,
  `permitted` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `administrators`
--

INSERT INTO `administrators` (`id`, `full_name`, `email`, `password`, `role`, `last_login`, `status`, `assign_instruct`, `assign_student`, `published_paper`, `permitted`, `deleted`) VALUES
(1, 'Modou Lamin Marong', 'pub@pub.gm', '$2y$10$RRqRaN9Wb8z4qwt8Y35nu.HL0GQP86mdCPVA3BDO/bvn.hHRSOf1G', 'publisher', '2021-05-01 16:10:38', 0, '', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `collaboratory_res`
--

CREATE TABLE `collaboratory_res` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `main_res` int(11) NOT NULL,
  `res_col_topic_id` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `docux_work`
--

CREATE TABLE `docux_work` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `draft_rev_comment`
--

CREATE TABLE `draft_rev_comment` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `rev_id` int(11) NOT NULL,
  `recomment_mesg` text DEFAULT NULL,
  `return_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `draft_uploads`
--

CREATE TABLE `draft_uploads` (
  `upload_id` int(11) NOT NULL,
  `res_topic` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `name_docu` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  `accept_draft` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notify_mesg`
--

CREATE TABLE `notify_mesg` (
  `notify_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `mesg` text NOT NULL,
  `viewed` tinyint(4) DEFAULT 0,
  `mesg_data` timestamp NULL DEFAULT current_timestamp(),
  `sender_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `propose_topic`
--

CREATE TABLE `propose_topic` (
  `topic_id` int(11) NOT NULL,
  `topic_category` tinyint(4) DEFAULT 0,
  `user_ids` int(11) NOT NULL,
  `res_field` varchar(75) NOT NULL,
  `sub_field` varchar(75) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `short_note` text NOT NULL,
  `interested_rev` varchar(75) DEFAULT NULL,
  `submit_topic` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `published` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `publications`
--

CREATE TABLE `publications` (
  `pub_id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `rev_id` int(11) NOT NULL,
  `date_pub` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `report_uploads`
--

CREATE TABLE `report_uploads` (
  `upload_id` int(11) NOT NULL,
  `res_topic` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `name_docu` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `report_accept` int(11) NOT NULL DEFAULT 0,
  `downloads` int(11) NOT NULL,
  `report_rev_comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `researchers`
--

CREATE TABLE `researchers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(15) NOT NULL DEFAULT 'researcher',
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `join_data` timestamp NULL DEFAULT current_timestamp(),
  `last_login` varchar(25) DEFAULT NULL,
  `permitted` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `researchers`
--

INSERT INTO `researchers` (`id`, `full_name`, `email`, `password`, `role`, `status`, `join_data`, `last_login`, `permitted`, `deleted`) VALUES
(10, 'Modou Lamin Marong', 'researcher@resgate.com', '$2y$10$lOB9OYFznGP2VHYjOzZrFOD9OKcCGo/bLSCgjqAPC4GYTRS9kdpkK', 'researcher', 1, '2021-02-24 20:38:39', '2021-05-01 15:20:18', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `res_area`
--

CREATE TABLE `res_area` (
  `id` int(11) NOT NULL,
  `category` varchar(50) NOT NULL,
  `root_id` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `res_area`
--

INSERT INTO `res_area` (`id`, `category`, `root_id`) VALUES
(15, 'Physical Sciences', 0),
(16, 'Animal husbanding', 0),
(17, 'Natural sciences', 0),
(18, 'Artistics', 0),
(19, 'ict', 0);

-- --------------------------------------------------------

--
-- Table structure for table `res_profile`
--

CREATE TABLE `res_profile` (
  `res_id` int(11) NOT NULL,
  `path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `res_rev_process`
--

CREATE TABLE `res_rev_process` (
  `id` int(11) NOT NULL,
  `date_assig` timestamp NOT NULL DEFAULT current_timestamp(),
  `researcher_id` int(11) NOT NULL,
  `rev_id` int(11) NOT NULL,
  `abst_accept` int(11) NOT NULL DEFAULT 0,
  `report_accept` int(11) NOT NULL DEFAULT 0,
  `published` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `res_uploads`
--

CREATE TABLE `res_uploads` (
  `upload_id` int(11) NOT NULL,
  `res_topic` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `name_docu` varchar(255) NOT NULL,
  `size` varchar(100) NOT NULL,
  `abst_accept` int(11) NOT NULL DEFAULT 0,
  `downloads` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reviewers`
--

CREATE TABLE `reviewers` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(75) DEFAULT 'Reviewer',
  `last_login` varchar(150) DEFAULT '0000-00-00 00:00:00',
  `join_data` timestamp NULL DEFAULT current_timestamp(),
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `permitted` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `rev_field` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviewers`
--

INSERT INTO `reviewers` (`id`, `full_name`, `email`, `password`, `role`, `last_login`, `join_data`, `status`, `permitted`, `deleted`, `rev_field`) VALUES
(9, 'Mr Reviewer', 'rev@resgate.edu.gm', '$2y$10$lbF35HuBHcxAp0iQpOy9AuwJlVn1u9WvN7iHx1vGKAWnKvu81hpd2', 'Reviewer', '2021-05-01 15:33:15', '2021-03-11 13:23:05', 0, 1, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `review_interest`
--

CREATE TABLE `review_interest` (
  `id` int(11) NOT NULL,
  `reviewer_id` varchar(20) NOT NULL,
  `topic_interested_id` varchar(20) NOT NULL,
  `published` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rev_comments`
--

CREATE TABLE `rev_comments` (
  `id` int(11) NOT NULL,
  `res_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `rev_id` int(11) NOT NULL,
  `recommend_mesg` text DEFAULT NULL,
  `return_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `topic_category`
--

CREATE TABLE `topic_category` (
  `id` int(11) NOT NULL,
  `topic_category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `topic_category`
--

INSERT INTO `topic_category` (`id`, `topic_category`) VALUES
(1, 'Personalize paper'),
(2, 'Collaborated Paper');

-- --------------------------------------------------------

--
-- Table structure for table `upload_type`
--

CREATE TABLE `upload_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload_type`
--

INSERT INTO `upload_type` (`type_id`, `type_name`) VALUES
(1, 'Abstract File Uploads'),
(2, 'Draft File Uploads'),
(3, 'Final Report Uploads');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrators`
--
ALTER TABLE `administrators`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `collaboratory_res`
--
ALTER TABLE `collaboratory_res`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `docux_work`
--
ALTER TABLE `docux_work`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_rev_comment`
--
ALTER TABLE `draft_rev_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `draft_uploads`
--
ALTER TABLE `draft_uploads`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `notify_mesg`
--
ALTER TABLE `notify_mesg`
  ADD PRIMARY KEY (`notify_id`);

--
-- Indexes for table `propose_topic`
--
ALTER TABLE `propose_topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`pub_id`);

--
-- Indexes for table `report_uploads`
--
ALTER TABLE `report_uploads`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `researchers`
--
ALTER TABLE `researchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `res_area`
--
ALTER TABLE `res_area`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `res_profile`
--
ALTER TABLE `res_profile`
  ADD PRIMARY KEY (`res_id`);

--
-- Indexes for table `res_rev_process`
--
ALTER TABLE `res_rev_process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `res_uploads`
--
ALTER TABLE `res_uploads`
  ADD PRIMARY KEY (`upload_id`);

--
-- Indexes for table `reviewers`
--
ALTER TABLE `reviewers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_interest`
--
ALTER TABLE `review_interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rev_comments`
--
ALTER TABLE `rev_comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topic_category`
--
ALTER TABLE `topic_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `upload_type`
--
ALTER TABLE `upload_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrators`
--
ALTER TABLE `administrators`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `collaboratory_res`
--
ALTER TABLE `collaboratory_res`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `docux_work`
--
ALTER TABLE `docux_work`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `draft_rev_comment`
--
ALTER TABLE `draft_rev_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `draft_uploads`
--
ALTER TABLE `draft_uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notify_mesg`
--
ALTER TABLE `notify_mesg`
  MODIFY `notify_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `propose_topic`
--
ALTER TABLE `propose_topic`
  MODIFY `topic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `publications`
--
ALTER TABLE `publications`
  MODIFY `pub_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `report_uploads`
--
ALTER TABLE `report_uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `researchers`
--
ALTER TABLE `researchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `res_area`
--
ALTER TABLE `res_area`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `res_profile`
--
ALTER TABLE `res_profile`
  MODIFY `res_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `res_rev_process`
--
ALTER TABLE `res_rev_process`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `res_uploads`
--
ALTER TABLE `res_uploads`
  MODIFY `upload_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `reviewers`
--
ALTER TABLE `reviewers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `review_interest`
--
ALTER TABLE `review_interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rev_comments`
--
ALTER TABLE `rev_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `topic_category`
--
ALTER TABLE `topic_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `upload_type`
--
ALTER TABLE `upload_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
