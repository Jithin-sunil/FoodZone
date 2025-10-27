-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2025 at 06:46 PM
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
-- Database: `db_foodzone`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(100) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email`, `admin_password`) VALUES
(1, 'Admin', 'admin@gmail.com', 'Admin@123');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_status` int(11) DEFAULT 0,
  `booking_amount` int(11) DEFAULT NULL,
  `booking_date` varchar(50) DEFAULT NULL,
  `deliveryboy_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_status`, `booking_amount`, `booking_date`, `deliveryboy_id`, `user_id`) VALUES
(1, 6, 300, '2025-10-15', NULL, 1),
(2, 1, 200, '2025-10-15', NULL, 2),
(3, 2, 300, '2025-10-15', NULL, 2),
(4, 1, 400, '2025-10-15', NULL, 2),
(5, 0, NULL, '2025-10-15', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_qty` int(11) DEFAULT 1,
  `cart_status` int(11) DEFAULT 0,
  `booking_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_qty`, `cart_status`, `booking_id`, `food_id`) VALUES
(1, 3, 1, 1, 1),
(2, 2, 1, 2, 1),
(3, 3, 1, 3, 1),
(4, 4, 1, 4, 1),
(5, 1, 0, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(100) DEFAULT NULL,
  `complaint_content` varchar(200) DEFAULT NULL,
  `complaint_reply` varchar(200) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_days`
--

CREATE TABLE `tbl_days` (
  `days_id` int(11) NOT NULL,
  `days_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_days`
--

INSERT INTO `tbl_days` (`days_id`, `days_name`) VALUES
(1, 'Monday');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_deliveryboy`
--

CREATE TABLE `tbl_deliveryboy` (
  `deliveryboy_id` int(11) NOT NULL,
  `deliveryboy_name` varchar(100) DEFAULT NULL,
  `deliveryboy_email` varchar(100) DEFAULT NULL,
  `deliveryboy_contact` varchar(100) DEFAULT NULL,
  `deliveryboy_photo` varchar(200) DEFAULT NULL,
  `deliveryboy_proof` varchar(200) DEFAULT NULL,
  `deliveryboy_password` varchar(100) DEFAULT NULL,
  `deliveryboy_status` int(11) DEFAULT 0,
  `place_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_deliveryboy`
--

INSERT INTO `tbl_deliveryboy` (`deliveryboy_id`, `deliveryboy_name`, `deliveryboy_email`, `deliveryboy_contact`, `deliveryboy_photo`, `deliveryboy_proof`, `deliveryboy_password`, `deliveryboy_status`, `place_id`) VALUES
(1, 'Vishnu', 'vishnu@gmail.com', '191919', 'OIP.jpeg', 'Proof-of-Delivery-Layout-Template-edit-online.png', 'vishnu@123', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(1, 'IDUKKI');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `food_id` int(11) NOT NULL,
  `food_name` varchar(100) DEFAULT NULL,
  `food_details` varchar(200) DEFAULT NULL,
  `food_photo` varchar(200) DEFAULT NULL,
  `food_price` int(11) DEFAULT NULL,
  `foodcategory_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `food_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`food_id`, `food_name`, `food_details`, `food_photo`, `food_price`, `foodcategory_id`, `restaurant_id`, `food_status`) VALUES
(1, 'New', 'Hey', 'Biri.jpeg', 100, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foodcategory`
--

CREATE TABLE `tbl_foodcategory` (
  `foodcategory_id` int(11) NOT NULL,
  `foodcategory_name` varchar(100) DEFAULT NULL,
  `foodtype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_foodcategory`
--

INSERT INTO `tbl_foodcategory` (`foodcategory_id`, `foodcategory_name`, `foodtype_id`) VALUES
(1, 'Meals', 1),
(2, 'Veg-Biriyani', 1),
(3, 'Chicken-Biriyani', 2),
(4, 'Noodles', 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_foodtype`
--

CREATE TABLE `tbl_foodtype` (
  `foodtype_id` int(11) NOT NULL,
  `foodtype_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_foodtype`
--

INSERT INTO `tbl_foodtype` (`foodtype_id`, `foodtype_name`) VALUES
(1, 'Vegitarian'),
(2, 'Non-Vegitarian'),
(3, 'Chineese');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `place_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `district_id`, `place_name`) VALUES
(1, 1, 'Thodupuzha'),
(2, 1, 'Muttom'),
(3, 1, 'Kattappana');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_rating`
--

CREATE TABLE `tbl_rating` (
  `rating_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `food_id` int(11) DEFAULT NULL,
  `rating_data` int(11) DEFAULT NULL,
  `rating_content` varchar(200) DEFAULT NULL,
  `rating_datetime` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_rating`
--

INSERT INTO `tbl_rating` (`rating_id`, `user_id`, `restaurant_id`, `food_id`, `rating_data`, `rating_content`, `rating_datetime`) VALUES
(1, 1, NULL, 1, 4, 'Hey', '2025-10-15 23:06:20');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restaurant`
--

CREATE TABLE `tbl_restaurant` (
  `restaurant_id` int(11) NOT NULL,
  `restaurant_name` varchar(100) DEFAULT NULL,
  `restaurant_address` varchar(200) DEFAULT NULL,
  `place_id` int(11) DEFAULT NULL,
  `restaurant_contact` varchar(100) DEFAULT NULL,
  `restaurant_email` varchar(100) DEFAULT NULL,
  `restaurant_password` varchar(100) DEFAULT NULL,
  `restaurant_type` varchar(100) DEFAULT NULL,
  `restaurant_photo` varchar(200) DEFAULT NULL,
  `restaurant_proof` varchar(200) DEFAULT NULL,
  `restaurant_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_restaurant`
--

INSERT INTO `tbl_restaurant` (`restaurant_id`, `restaurant_name`, `restaurant_address`, `place_id`, `restaurant_contact`, `restaurant_email`, `restaurant_password`, `restaurant_type`, `restaurant_photo`, `restaurant_proof`, `restaurant_status`) VALUES
(1, 'Kaifan Kuzhimandhi', 'Kaifan Thodupuzha', 1, '10101', 'Kaifan@gmail.com', 'kaifan@123', '3 Star', 'kaifan.avif', 'proof.avif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restauranttiming`
--

CREATE TABLE `tbl_restauranttiming` (
  `restauranttiming_id` int(11) NOT NULL,
  `restaurant_id` int(11) DEFAULT NULL,
  `days_id` int(11) DEFAULT NULL,
  `opening_time` varchar(50) DEFAULT NULL,
  `closing_time` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_restauranttiming`
--

INSERT INTO `tbl_restauranttiming` (`restauranttiming_id`, `restaurant_id`, `days_id`, `opening_time`, `closing_time`) VALUES
(1, 1, 1, '07:00', '10:00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restauranttype`
--

CREATE TABLE `tbl_restauranttype` (
  `restauranttype_id` int(11) NOT NULL,
  `restauranttype_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_restauranttype`
--

INSERT INTO `tbl_restauranttype` (`restauranttype_id`, `restauranttype_name`) VALUES
(1, '3 Star'),
(2, '5 Star'),
(3, '7 Star');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `user_gender` varchar(50) DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_contact` varchar(100) DEFAULT NULL,
  `user_password` varchar(100) DEFAULT NULL,
  `user_address` varchar(200) DEFAULT NULL,
  `user_photo` varchar(200) DEFAULT NULL,
  `user_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_gender`, `user_email`, `user_contact`, `user_password`, `user_address`, `user_photo`, `user_status`) VALUES
(1, 'Abhnav raju', 'male', 'Abhinavraju@gmail.com', '7654321', 'Abhinav2123', 'Thodupuzha ', 'abhinav.jpg.jpeg', 0),
(2, 'Jibin', 'male', 'jibin@gmail.com', '0865644', '123', 'VPM', 'thotti.jpg', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_days`
--
ALTER TABLE `tbl_days`
  ADD PRIMARY KEY (`days_id`);

--
-- Indexes for table `tbl_deliveryboy`
--
ALTER TABLE `tbl_deliveryboy`
  ADD PRIMARY KEY (`deliveryboy_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`food_id`);

--
-- Indexes for table `tbl_foodcategory`
--
ALTER TABLE `tbl_foodcategory`
  ADD PRIMARY KEY (`foodcategory_id`);

--
-- Indexes for table `tbl_foodtype`
--
ALTER TABLE `tbl_foodtype`
  ADD PRIMARY KEY (`foodtype_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  ADD PRIMARY KEY (`rating_id`);

--
-- Indexes for table `tbl_restaurant`
--
ALTER TABLE `tbl_restaurant`
  ADD PRIMARY KEY (`restaurant_id`);

--
-- Indexes for table `tbl_restauranttiming`
--
ALTER TABLE `tbl_restauranttiming`
  ADD PRIMARY KEY (`restauranttiming_id`);

--
-- Indexes for table `tbl_restauranttype`
--
ALTER TABLE `tbl_restauranttype`
  ADD PRIMARY KEY (`restauranttype_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_days`
--
ALTER TABLE `tbl_days`
  MODIFY `days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_deliveryboy`
--
ALTER TABLE `tbl_deliveryboy`
  MODIFY `deliveryboy_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `food_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_foodcategory`
--
ALTER TABLE `tbl_foodcategory`
  MODIFY `foodcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_foodtype`
--
ALTER TABLE `tbl_foodtype`
  MODIFY `foodtype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_rating`
--
ALTER TABLE `tbl_rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_restaurant`
--
ALTER TABLE `tbl_restaurant`
  MODIFY `restaurant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_restauranttiming`
--
ALTER TABLE `tbl_restauranttiming`
  MODIFY `restauranttiming_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_restauranttype`
--
ALTER TABLE `tbl_restauranttype`
  MODIFY `restauranttype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
