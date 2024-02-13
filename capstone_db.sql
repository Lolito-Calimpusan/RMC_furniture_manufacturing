-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2024 at 10:25 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `capstone_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `approved_orders`
--

CREATE TABLE `approved_orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `products` varchar(255) NOT NULL,
  `grand_total` int(50) NOT NULL,
  `pmode` varchar(150) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `reference_code` varchar(255) NOT NULL,
  `amount_paid` int(50) NOT NULL,
  `proof` varchar(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `orders_date` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `message` text DEFAULT NULL,
  `view` int(11) NOT NULL,
  `approved_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `approved_orders`
--

INSERT INTO `approved_orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `products`, `grand_total`, `pmode`, `sender`, `reference_code`, `amount_paid`, `proof`, `image`, `orders_date`, `status`, `message`, `view`, `approved_date`) VALUES
(37, 49, 'Ruffa mae Cagas ', 'cagasruffa@gmail.com', '09108105607', 'P-2, Barangay Pongtud, Bacuag, Surigao del Norte                                                                                ', 'Dinning chairs(1), Stole chair(1), L-shape with arm(1)', 22529, 'palawan', 'Ruffa mae Coros Cagas', 'WSD-GHK-ZA0', 22529, 'bg.jpg', '5-removebg-preview.png, 1-removebg-preview (1).png, fully_taptid1-removebg-preview.png', '2023-12-24 13:32:17', 'Arrived', '', 0, '2023-12-24 13:32:46'),
(38, 48, 'Lexcel Turfe ', 'turfelexcel@gmail.com', '09952835313', 'P-7, Sitio Poyo, Barangay Poniente, Gigaquit, Surigao del Norte', 'Stole chair(1)', 3200, 'palawan', 'Lexcel Changco Turfe', 'NS2-GH0-ZAW', 3200, 'members.jpg', '1-removebg-preview (1).png', '2023-12-24 18:30:09', 'Arrived', '', 0, '2023-12-24 18:32:38'),
(39, 48, 'Lexcel Turfe ', 'turfelexcel@gmail.com', '09952835313', 'P-7, Sitio Poyo, Barangay Poniente, Gigaquit, Surigao del Norte', 'Dinning chairs(1), Sala set(1)', 23330, 'palawan', 'Lexcel Changco Turfe', '7SD-GHK-ZAW', 23330, 'bg.png', '5-removebg-preview.png, C_arm2.png', '2023-12-24 18:57:40', 'Arrived', '', 0, '2023-12-24 18:58:07'),
(40, 48, 'Lexcel Turfe ', 'turfelexcel@gmail.com', '09952835313', 'P-7, Sitio Poyo, Barangay Poniente, Gigaquit, Surigao del Norte', 'Sofa bed(1), fully taptid(1), L-shape with arm(1)', 51999, 'palawan', 'Lexcel Changco Turfe', '6SM-H8K-ZAW', 51999, 'IMG_1337.JPG', 'L-Shape_box_type.png, fully_taptid3-removebg-preview.png, fully_taptid1-removebg-preview.png', '2023-12-24 19:07:42', 'Arrived', '', 0, '2023-12-24 19:08:51'),
(41, 50, 'Ricca Mae Cagas ', 'cagasriccamae@gmail.com', '09122375562', 'P-2, Barangay Pongtud, Bacuag, Surigao del Norte', 'Stole chair(1)', 3200, 'palawan', 'Ricca mae Coros Cagas', 'NSM-G8K-ZAV', 3200, 'IMG_1379.JPG', '1-removebg-preview (1).png', '2023-12-24 20:24:48', 'Arrived', '', 1, '2023-12-24 20:25:07'),
(42, 54, 'Rex Madelo ', 'madelorex@gmail.com', '09952835312', 'P-4, Barangay Pongtud, Bacuag, Surigao del Norte', 'Sofa bed(1)', 21000, 'palawan', 'Rex B. Madelo', 'WBG-F3W-ZA0', 21000, 'IMG20230814054844.jpg', 'L-Shape_box_type.png', '2023-12-26 13:14:53', 'Arrived', '', 0, '2023-12-26 13:15:47'),
(43, 48, 'Lexcel Turfe ', 'turfelexcel@gmail.com', '09952835313', 'P-7, Sitio Poyo, Barangay Poniente, Gigaquit, Surigao del Norte', 'Dinning chairs(1), fully taptid(1)', 22330, 'palawan', 'Lexcel Changco Turfe', '7SM-GHK-ZAW', 22330, 'IMG_1352.JPG', '5-removebg-preview.png, fully_taptid3-removebg-preview.png', '2023-12-29 18:50:26', 'Arrived', '', 0, '2023-12-29 18:52:50'),
(44, 49, 'Ruffa mae Cagas ', 'cagasruffa@gmail.com', '09108105607', 'P-2, Barangay Pongtud, Bacuag, Surigao del Norte                                                                                ', 'L-shape with arm(1)', 14278, 'palawan', 'Ruffa mae Coros Cagas', 'NMX-XAW-ZAQ', 13999, '-.jpg', 'fully_taptid1-removebg-preview.png', '2024-01-13 21:02:46', 'Arrived', '', 1, '2024-01-13 21:03:33'),
(45, 57, 'Rasty Minglana ', 'minglanarasty@gmail.com', '09108105689', 'P-5, Barangay Serna Surigao City', 'Dinning chairs(2)', 10873, 'palawan', 'Rasty Minglana', 'NSWSPK-ZAQ', 11000, '-.jpg', '5-removebg-preview.png', '2024-02-02 11:41:43', 'Arrived', '', 0, '2024-02-02 11:43:47');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `qty` int(10) NOT NULL,
  `total_price` varchar(100) NOT NULL,
  `product_code` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_name`, `product_price`, `product_image`, `qty`, `total_price`, `product_code`) VALUES
(183, 53, 'Sala set', '18000', 'C_arm2.png', 1, '18000', 'P5'),
(228, 50, 'Sofa bed', '21000', 'L-Shape_box_type.png', 2, '42000', 'P6'),
(233, 49, 'Dinning chairs', '5330', '5-removebg-preview.png', 1, '5330', 'P1'),
(234, 49, 'L-shape with arm', '13999', 'fully_taptid1-removebg-preview.png', 1, '13999', 'P2');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `address` varchar(255) NOT NULL,
  `pmode` varchar(50) NOT NULL,
  `products` varchar(255) NOT NULL,
  `grand_total` varchar(50) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `reference_code` varchar(255) NOT NULL,
  `amount_paid` int(50) NOT NULL,
  `proof` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `orders_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orders_history`
--

CREATE TABLE `orders_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `grand_total` varchar(50) NOT NULL,
  `view` int(11) NOT NULL,
  `orders_date` varchar(255) NOT NULL,
  `delivered_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_history`
--

INSERT INTO `orders_history` (`id`, `user_id`, `products`, `grand_total`, `view`, `orders_date`, `delivered_date`) VALUES
(7, 49, 'Dinning chairs(1), Stole chair(1), L-shape with arm(1)', '22529', 1, '2023-12-24 13:32:17', '2023-12-24 13:34:22'),
(8, 48, 'Stole chair(1)', '3200', 1, '2023-12-24 18:30:09', '2023-12-24 18:37:22'),
(9, 48, 'Dinning chairs(1), Sala set(1)', '23330', 1, '2023-12-24 18:57:40', '2023-12-24 19:01:54'),
(10, 54, 'Sofa bed(1)', '21000', 1, '2023-12-26 13:14:53', '2023-12-26 13:17:07'),
(11, 48, 'Sofa bed(1), fully taptid(1), L-shape with arm(1)', '51999', 1, '2023-12-24 19:07:42', '2023-12-29 18:50:54'),
(12, 48, 'Dinning chairs(1), fully taptid(1)', '22330', 1, '2023-12-29 18:50:26', '2023-12-29 18:54:08'),
(13, 57, 'Dinning chairs(2)', '10873', 1, '2024-02-02 11:41:43', '2024-02-02 11:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `orders_success`
--

CREATE TABLE `orders_success` (
  `id` int(11) NOT NULL,
  `orders_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `products` varchar(255) NOT NULL,
  `grand_total` int(50) NOT NULL,
  `amount_paid` int(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `date_orders_success` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_success`
--

INSERT INTO `orders_success` (`id`, `orders_id`, `user_id`, `products`, `grand_total`, `amount_paid`, `status`, `date_orders_success`) VALUES
(35, 37, 49, 'Dinning chairs(1), Stole chair(1), L-shape with arm(1)', 22529, 22529, '', '2023-12-24 20:08:36'),
(36, 38, 48, 'Stole chair(1)', 3200, 3200, '', '2023-12-24 20:08:47'),
(37, 40, 48, 'Sofa bed(1), fully taptid(1), L-shape with arm(1)', 51999, 51999, '', '2023-12-24 20:08:51'),
(38, 39, 48, 'Dinning chairs(1), Sala set(1)', 23330, 23330, '', '2023-12-24 20:09:03'),
(39, 41, 50, 'Stole chair(1)', 3200, 3200, '', '2023-12-24 20:27:32'),
(40, 42, 54, 'Sofa bed(1)', 21000, 21000, '', '2023-12-26 13:17:19'),
(41, 43, 48, 'Dinning chairs(1), fully taptid(1)', 22330, 22330, '', '2023-12-29 18:54:59'),
(42, 44, 49, 'L-shape with arm(1)', 14278, 13999, '', '2024-01-20 12:44:44'),
(43, 45, 57, 'Dinning chairs(2)', 10873, 11000, '', '2024-02-02 11:45:15');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_desc` varchar(255) NOT NULL,
  `product_price` varchar(50) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `product_code` varchar(10) NOT NULL,
  `category` varchar(50) NOT NULL,
  `most_saled` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `product_name`, `product_desc`, `product_price`, `product_image`, `product_code`, `category`, `most_saled`) VALUES
(13, 'Dinning chairs', '3pcs, color violet ', '5330', '5-removebg-preview.png', 'P1', 'dinning', NULL),
(14, 'L-shape with arm', '10x5 width, color red ', '13999', 'fully_taptid1-removebg-preview.png', 'P2', 'living', NULL),
(15, 'King Bed', '56ft length 45ft width, Color black', '19999', '4-removebg-preview.png', 'P3', 'bed', NULL),
(16, 'Stole chair', '1pc, Color Navy blue', '3200', '1-removebg-preview (1).png', 'P4', 'others', NULL),
(18, 'Sala set', 'Color yellow orange', '18000', 'C_arm2.png', 'P5', 'living', NULL),
(19, 'Sofa bed', 'Color: Navy', '21000', 'L-Shape_box_type.png', 'P6', 'living', NULL),
(20, 'fully taptid', 'Color: Navy', '17000', 'fully_taptid3-removebg-preview.png', 'P7', 'living', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL,
  `date_registered` datetime NOT NULL DEFAULT current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`id`, `fname`, `lname`, `age`, `gender`, `address`, `phone`, `image`, `email`, `password`, `otp`, `role`, `date_registered`, `status`) VALUES
(1, 'Lolito', 'Calimpusan', '22', 'Male', '                                            P-2, Barangay Pongtud, Bacuag, Surigao del Norte                                        ', '09952835313', 'user.png', 'calimpusanlolito@gmail.com', '6fd2ebeb9ac7ed517230a934bdf4a22b', NULL, 'Admin', '2023-10-16 18:58:33', 'show'),
(48, 'Lexcel', 'Turfe', '18', 'Female', 'P-7, Sitio Poyo, Barangay Poniente, Gigaquit, Surigao del Norte', '09952835313', 'IMG20210814151200.jpg', 'turfelexcel@gmail.com', 'cf9adbd8edf9816ab6d4409d616bc68b', NULL, 'User', '2023-12-04 17:48:24', 'show'),
(49, 'Ruffa mae', 'Cagas', '18', 'Male', 'P-2, Barangay Pongtud, Bacuag, Surigao del Norte                                                                                ', '09108105607', 'received_665507384416918.jpeg', 'cagasruffa@gmail.com', 'e20929c01dfd1ea32a6feb4398b3dbdd', NULL, 'User', '2023-12-04 18:04:35', 'show'),
(50, 'Ricca Mae', 'Cagas', '14', 'Female', 'P-2, Barangay Pongtud, Bacuag, Surigao del Norte', '09122375562', 'IMG_20231202_102351.jpg', 'cagasriccamae@gmail.com', '3fb89aa023ee4b28f007668fb48a8e64', NULL, 'User', '2023-12-04 18:34:13', 'show'),
(51, 'Rejoy', 'Macula', '23', 'Male', 'P-2, Barangay Pongtud, Bacuag, Surigao del Norte', '09773707261', 'user.png', 'macularejoy@gmail.com', 'dbea9ccdbd44676ae49001ce2cdca8a1', NULL, 'User', '2023-12-05 12:13:18', 'show'),
(52, 'Michael', 'Antecristo', '30', 'Male', 'Nemco Surigao City', '09952835313', '-.jpg', 'antecristomichael@gmail.com', '9d00bffe0c67e69085f4f199948cd24d', NULL, 'User', '2023-12-11 12:07:23', 'show'),
(53, 'Lovely Jean', 'Boiser', '9', 'Female', 'P-3, Barangay Pongtud, Bacuag, Surigao del Norte', '09109102783', 'user.png', 'boiserlovely@gmail.com', 'ed48ad695bdf2f4aaaa89a92fbf102de', NULL, 'User', '2023-12-17 11:03:10', 'show'),
(54, 'Rex', 'Madelo', '18', 'Male', 'P-4, Barangay Pongtud, Bacuag, Surigao del Norte', '09952835313', 'IMG20230814064043.jpg', 'madelorex@gmail.com', '6180db78e18f627b9e232a31375d8acd', NULL, 'User', '2023-12-26 13:12:47', 'show'),
(55, 'Jella', 'Pedrablanca', '22', 'Female', 'P-2 bad;ladj', '323242', '', 'antecristomichael@gmail.com', 'dsdsd', NULL, NULL, '2023-12-29 17:33:13', 'hide'),
(56, 'Ronnie', 'Coros', '42', 'Male', 'P-5, Barangay Serna, Surigao City', '09108205789', 'user.png', 'corosronnie@gmail.com', 'ca67d145edcd0b8018430eeea7c77cab', NULL, 'User', '2024-01-20 12:16:24', 'show'),
(57, 'Rasty', 'Minglana', '22', 'Male', 'P-5, Barangay Serna Surigao City', '09108105689', 'user.png', 'minglanarasty@gmail.com', 'ee41c53b07366b18aa8eeee2786860db', NULL, 'User', '2024-02-02 11:38:23', 'show');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved_orders`
--
ALTER TABLE `approved_orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_history`
--
ALTER TABLE `orders_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_success`
--
ALTER TABLE `orders_success`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_orders`
--
ALTER TABLE `approved_orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `orders_history`
--
ALTER TABLE `orders_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `orders_success`
--
ALTER TABLE `orders_success`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
