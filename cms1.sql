-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2020 at 04:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(4) NOT NULL,
  `category_title` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_title`) VALUES
(1, 'JavaScript'),
(2, 'BootStrap\r\n'),
(3, 'PHP'),
(6, 'CSS'),
(58, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(50) NOT NULL,
  `comment_date` date NOT NULL,
  `comment_email` varchar(50) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(50) NOT NULL DEFAULT 'Approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_category_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_user` varchar(32) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` varchar(255) NOT NULL,
  `post_comment_count` int(11) NOT NULL,
  `post_status` varchar(11) NOT NULL DEFAULT 'Draft',
  `post_tags` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_user`, `post_date`, `post_image`, `post_content`, `post_comment_count`, `post_status`, `post_tags`) VALUES
(109, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Published', 'CSS, ananthu'),
(110, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Published', 'CSS, ananthu'),
(111, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Draft', 'CSS, ananthu'),
(112, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Draft', 'CSS, ananthu'),
(113, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Draft', 'CSS, ananthu'),
(114, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Draft', 'CSS, ananthu'),
(115, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Draft', 'CSS, ananthu'),
(116, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Draft', 'CSS, ananthu'),
(117, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Draft', 'CSS, ananthu'),
(118, 6, 'Post for CSS', 'Ananthu', '2020-10-01', 'css.jfif', 'khaguhadks', 0, 'Draft', 'CSS, ananthu');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `user_role` varchar(50) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_image` text NOT NULL,
  `user_date` date NOT NULL,
  `user_salt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_role`, `user_firstname`, `user_lastname`, `user_password`, `user_email`, `user_image`, `user_date`, `user_salt`) VALUES
(4, 'Charloate', 'Admin', 'HUXGkk', 'SV', '123456', 'sananthu47@gmail.com', 'ha.jpg', '2020-09-19', ''),
(7, 'Ananthu 123', 'Subscriber', 'Ananthu', 'SV', '123456', 'anthu21147@gmail.com', 'randomguy.jpg', '2020-09-21', ''),
(8, 'Gulabo', 'Subscriber', 'Ananthu', 'SV', '123456', 'ananthu@gmail.com', 'randomguy.jpg', '2020-09-24', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
