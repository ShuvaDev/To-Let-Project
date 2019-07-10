-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2019 at 05:38 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `to-let`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `name`, `username`, `password`, `email`, `mobile_number`) VALUES
(1, 'S.R. Shuva Dev', 'admin', '202cb962ac59075b964b07152d234b70', 's.r.shuvadeb@gmail.com', '01883661903');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `cat_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `cat_id`, `cat_name`, `cat_image`) VALUES
(1, 1, 'Mess', 'eb5e855243.png'),
(2, 1, 'Hostel', '4e085ccc18.png'),
(3, 1, 'Sub-Let', '1fd1915791.png'),
(4, 1, 'Flat', 'f65b30b6a3.png'),
(5, 1, 'Office', 'edeb94926f.png'),
(6, 1, 'Land/Plot', 'f6f2f0d5e7.png'),
(7, 1, 'Commercial Space', 'f80e7db863.png'),
(8, 1, 'Garage', 'e2d678c173.png'),
(9, 1, 'Others', '8cacbf9610.png'),
(10, 2, 'Private Car', 'car.png'),
(11, 2, 'Minibus', 'minibus.png'),
(12, 2, 'Truck', 'truck.png'),
(13, 2, 'Motor Bike', 'bike.png'),
(14, 2, 'Others', 'other.png'),
(15, 3, 'Tution', 'tution.png'),
(16, 3, 'Full-Time Job', 'full_time_job.png'),
(17, 3, 'Part-Time Job', 'part_time_job.png'),
(18, 3, 'Services', 'service.png'),
(19, 3, 'Others', 'other.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8 NOT NULL,
  `comment_sender_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `parent_comment_id`, `comment`, `comment_sender_name`, `date`, `post_id`) VALUES
(1, 0, 'This mess is very good!', 'S.R. Shuva Dev', '2019-06-08 05:29:00', 1),
(2, 0, 'Nice mess!', 'Ayan Das', '2019-06-08 05:29:34', 1),
(3, 0, 'Awesome Mess', 'Didarul Islam', '2019-06-08 05:30:21', 3),
(4, 2, 'Thank You!', 'Admin', '2019-06-08 05:30:46', 1),
(5, 0, 'This coaching center is very good!', 'Shuva', '2019-06-08 06:23:12', 14),
(6, 0, 'This Coaching center is very good!', 'Shanto Das', '2019-06-08 06:43:51', 16),
(7, 0, 'Nice car', 'Miraz', '2019-06-08 07:03:03', 13),
(8, 0, 'Nice', 'Dipto Dey', '2019-06-08 08:30:18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE `tbl_contact` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `firstname`, `lastname`, `email`, `body`, `status`, `date`) VALUES
(1, 'S.R. Shuva', 'Dev', 's.r.shuvadeb@gmail.com', 'This is test message!', 1, '2019-06-03 04:42:05'),
(2, 'S.R. Shanto', 'Dev', 'shanto@gmail.com', 'Hello! I am shanto!', 0, '2019-06-03 04:43:02'),
(3, 'Didarul', 'Islam', 'didar@gmail.com', 'Hello! I am didar!', 0, '2019-06-08 14:53:18');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact_info`
--

CREATE TABLE `tbl_contact_info` (
  `id` int(11) NOT NULL,
  `phone_1` varchar(255) NOT NULL,
  `phone_2` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_contact_info`
--

INSERT INTO `tbl_contact_info` (`id`, `phone_1`, `phone_2`, `email`) VALUES
(1, '01883661903', '01871141725', 'info@to-let.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_footer`
--

CREATE TABLE `tbl_footer` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_footer`
--

INSERT INTO `tbl_footer` (`id`, `text`) VALUES
(1, 'All right reserved by TO-LET');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_image`
--

CREATE TABLE `tbl_image` (
  `id` int(11) NOT NULL,
  `img_random_num` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_image`
--

INSERT INTO `tbl_image` (`id`, `img_random_num`, `user_id`, `post_image`) VALUES
(1, '8d5d3b43', 1, '8d5d3b4369advertisement.jpg'),
(2, 'c6c1af78', 1, 'c6c1af78a5mess1.jpeg'),
(3, 'c6c1af78', 1, 'c6c1af78a5mess2.jpeg'),
(4, 'c6c1af78', 1, 'c6c1af78a5mess3.jpg'),
(5, '6a952c58', 2, '6a952c5818ba (1).jpeg'),
(6, '6a952c58', 2, '6a952c5818ba (2) (1).jpeg'),
(7, 'ca99fa89', 4, 'ca99fa894bba (3).jpeg'),
(8, 'ca99fa89', 4, 'ca99fa894bba (4).jpeg'),
(9, 'e05b17af', 4, 'e05b17af7cba (5).jpeg'),
(10, 'e05b17af', 4, 'e05b17af7cba (6).jpeg'),
(11, 'e05b17af', 4, 'e05b17af7cba (8).jpeg'),
(12, 'ba4aad81', 4, 'ba4aad81c6hos (14).jpeg'),
(13, 'ba4aad81', 4, 'ba4aad81c6hos.jpeg'),
(14, '2fc23344', 4, '2fc233446eflat (2) (2).jpeg'),
(15, '6057d435', 5, '6057d43596bachelor-room-design-sun-bachelor-sitting-room-design.jpg'),
(16, '96090153', 5, '96090153beba (8).jpeg'),
(17, '8ff28659', 5, '8ff286597bflat (2).jpeg'),
(18, 'ec4ec9e6', 6, 'ec4ec9e637flatjpg3.jpg'),
(19, '4e625c57', 6, '4e625c57e4hos (5).jpeg'),
(20, 'b1ab2f10', 1, 'b1ab2f10d1images (3).jpeg'),
(21, 'b184822b', 1, 'b184822b36tution (4) (1).jpeg'),
(22, '6d45b4f8', 1, '6d45b4f8fdtution (4) (3).jpeg'),
(23, '9002c220', 1, '9002c220f1tution (1).jpeg'),
(24, 'ae8513a0', 1, 'ae8513a01dbus (4) (1).jpeg'),
(25, '446c3818', 1, '446c381881car11 (4) (1).jpeg'),
(26, '87935fc9', 1, '87935fc948car11 (4).jpeg'),
(27, '8bc484e6', 1, '8bc484e6a8bus (4) (4).jpeg'),
(28, '1fb10535', 1, '1fb10535ebbus11 (4).jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page`
--

CREATE TABLE `tbl_page` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` text NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_page`
--

INSERT INTO `tbl_page` (`id`, `title`, `body`, `name`) VALUES
(2, 'About Us ', '<p>Hello everyone! Welcome to to-let. We are student of chittagong polytechnic institute.</p>', 'About Us');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_post`
--

CREATE TABLE `tbl_post` (
  `id` int(11) NOT NULL,
  `cat` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `short_details` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `random_num` varchar(255) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_post`
--

INSERT INTO `tbl_post` (`id`, `cat`, `user_id`, `title`, `month`, `price`, `address`, `short_details`, `date`, `random_num`, `status`) VALUES
(1, 1, 1, 'Roommate wanted ', 'January', '1500', '2no Gate,Tulatuli,Chittagong', 'One seat available form current june month or next month bachelor rent 1500 (Gas, Water, Security Guard included) Facilities : Fully tilled floor. 24/7 Gas & Water, Full time security guard.', '2019-06-06 07:29:20', '8d5d3b43', 0),
(2, 1, 1, 'One room available', 'November', '4500', 'Agrabad, Chittagong', '<p>One seat available form current november month or next month bachelor rent 1500 (Gas, Water, Security Guard included) Facilities : Fully tilled floor. 24/7 Gas &amp; Water, Full time security guard.</p>', '2019-06-06 07:47:20', 'c6c1af78', 0),
(3, 1, 2, 'One seat available', 'August', '2000', 'Muradpur, Chittagong', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2019-06-08 05:08:51', '6a952c58', 0),
(4, 1, 4, 'One room available', 'December', '6000', 'Bayezid, Chittagong', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2019-06-08 05:19:46', 'ca99fa89', 0),
(5, 1, 4, 'Roomate wanted ', 'November', '8000', '2no Gate, Chittagong', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2019-06-08 05:20:52', 'e05b17af', 0),
(6, 2, 4, 'One seat available', 'November', '2000', 'New Market, Dhaka', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2019-06-08 05:21:59', 'ba4aad81', 0),
(7, 4, 4, 'Flat for sale', 'November', '100000', 'Muradpur, Chittagong', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', '2019-06-08 05:22:51', '2fc23344', 0),
(8, 1, 5, 'One room available', 'August', '4500', 'Baby Super Market, Chittagong', 't is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here.', '2019-06-08 05:24:20', '6057d435', 0),
(9, 1, 5, 'Roomate wanted', 'September', '2000', 'Dhanmondi, Dhaka', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here,', '2019-06-08 05:33:26', '96090153', 0),
(10, 4, 5, 'Flat', 'November', '1200000', 'Bakolia, Chittagong', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here,', '2019-06-08 05:34:56', '8ff28659', 0),
(11, 4, 6, 'Flat for sale', 'November', '2000000', 'New Market, Chittagong', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia', '2019-06-08 05:36:25', 'ec4ec9e6', 0),
(12, 2, 6, 'One room available', 'August', '5000', 'East Nasirabad, Chittagong', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia', '2019-06-08 05:41:25', '4e625c57', 0),
(13, 10, 1, 'Car for rent', 'November', '8000', 'New Market, Chittagong', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum', '2019-06-08 06:01:33', 'b1ab2f10', 0),
(14, 15, 1, 'Coaching center', 'October', '2000', 'Chakbazar, Chittagong', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum', '2019-06-08 06:04:35', 'b184822b', 0),
(15, 15, 1, 'Tutor wanted?', 'March', '3500', 'Muradpur, Chittagong', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum', '2019-06-08 06:05:15', '6d45b4f8', 0),
(16, 15, 1, 'Ielts Coaching', 'October', '12000', '2no Gate, Chittagong', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum', '2019-06-08 06:06:04', '9002c220', 0),
(17, 11, 1, 'Bus available', 'November', '6000', 'Banskhali, Chittagong', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2019-06-08 06:08:44', 'ae8513a0', 0),
(18, 10, 1, 'Car Wanted?', 'November', '10000', 'Agrabad, Chittagong', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2019-06-08 06:18:12', '446c3818', 0),
(19, 10, 1, 'BMW', 'November', '12000', 'New Market, Chittagong', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2019-06-08 06:18:54', '87935fc9', 0),
(20, 11, 1, 'School Bus', 'December', '12000', '2no Gate, Chittagong', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2019-06-08 06:19:37', '8bc484e6', 0),
(21, 11, 1, 'Bus for rent', 'August', '8000', 'Bayezid, Chittagong', 'The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', '2019-06-08 06:20:10', '1fb10535', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_social`
--

CREATE TABLE `tbl_social` (
  `id` int(11) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `google_plus` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_social`
--

INSERT INTO `tbl_social` (`id`, `facebook`, `google_plus`, `linkedin`, `youtube`, `twitter`) VALUES
(1, 'https://www.facebook.com', 'https://www.google_plus.com', 'https://www.linkedin.com', 'https://www.youtube.com', 'https://www.twitter.com');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_theme`
--

CREATE TABLE `tbl_theme` (
  `id` int(11) NOT NULL,
  `theme` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_theme`
--

INSERT INTO `tbl_theme` (`id`, `theme`) VALUES
(1, 'orange');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `vkey` varchar(32) NOT NULL,
  `verified` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `name`, `email`, `mobile_number`, `password`, `vkey`, `verified`) VALUES
(1, 'S.R. Shuva Dev', 's.r.shuvadeb@gmail.com', '01883661903', 'fcea920f7412b5da7be0cf42b8c93759', 'b10abb3919829f96d97a998a4d912ce6', 1),
(2, 'Ayan Das', 'ayan@gmail.com', '01889234752', 'e10adc3949ba59abbe56e057f20f883e', 'fd96e5358fa0c01a88240b81ad783b69', 1),
(3, 'Shanto Dev', 'shanto@gmail.com', '01829823841', 'e10adc3949ba59abbe56e057f20f883e', '40465fb118219ae28d62aecbf2bca502', 1),
(4, 'Didarul Islam', 'didar@gmail.com', '01878012943', 'e10adc3949ba59abbe56e057f20f883e', 'c4f01d46e8f644b794e3dee98c54e796', 1),
(5, 'Dipta Dey', 'dipto@gmail.com', '01738248239', 'e10adc3949ba59abbe56e057f20f883e', 'cf332f58a77b12fc6365deaa35a1c52c', 1),
(6, 'Md. Miraz', 'miraz@gmail.com', '01837849274', 'e10adc3949ba59abbe56e057f20f883e', '674e06a6dd22272a28a2c22581b935d9', 1),
(7, 'Jobeda Chowdhury', 'jobeda@gmail.com', '01338942834', 'e10adc3949ba59abbe56e057f20f883e', 'd1148ebca26d035687011bc110eca79e', 1),
(8, 'user', 'user@gmail.com', '01834782749', 'e10adc3949ba59abbe56e057f20f883e', '33bfcf91191c2a9d7a16fe2dd06635eb', 1),
(9, 'Md. Yusuf', 'yusuf@gmail.com', '01629090158', 'e10adc3949ba59abbe56e057f20f883e', 'b6f9dd18da44ffa668e4d5a071d5948e', 1),
(10, 'Md. Jubayer', 'jubayer@gmail.com', '01883842849', 'e10adc3949ba59abbe56e057f20f883e', 'd191a0a6a9f50431384388ba58daa64d', 1),
(11, 'Ramjan Ali', 'ramjan@gmail.com', '01583948948', 'e10adc3949ba59abbe56e057f20f883e', 'a5674d34d437fbf1419af044e13a0fc7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `title_slogan`
--

CREATE TABLE `title_slogan` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slogan` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `title_slogan`
--

INSERT INTO `title_slogan` (`id`, `title`, `slogan`, `logo`) VALUES
(1, 'TO-LET', 'Make your life easy', 'logo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_contact_info`
--
ALTER TABLE `tbl_contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_footer`
--
ALTER TABLE `tbl_footer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_image`
--
ALTER TABLE `tbl_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_page`
--
ALTER TABLE `tbl_page`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_post`
--
ALTER TABLE `tbl_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_social`
--
ALTER TABLE `tbl_social`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_theme`
--
ALTER TABLE `tbl_theme`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `title_slogan`
--
ALTER TABLE `title_slogan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_contact`
--
ALTER TABLE `tbl_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_contact_info`
--
ALTER TABLE `tbl_contact_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_footer`
--
ALTER TABLE `tbl_footer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_image`
--
ALTER TABLE `tbl_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_page`
--
ALTER TABLE `tbl_page`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_post`
--
ALTER TABLE `tbl_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_social`
--
ALTER TABLE `tbl_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_theme`
--
ALTER TABLE `tbl_theme`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `title_slogan`
--
ALTER TABLE `title_slogan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
