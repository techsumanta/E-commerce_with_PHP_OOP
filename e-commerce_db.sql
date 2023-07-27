-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 24, 2023 at 02:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-commerce_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_username`, `admin_password`, `admin_status`) VALUES
(1, 'Sumanta', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(50) NOT NULL,
  `brand_subcat_id` int(11) NOT NULL,
  `brand_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brand_id`, `brand_title`, `brand_subcat_id`, `brand_status`) VALUES
(64, 'Mudrika', 18, 1),
(65, 'Dhruvi', 18, 1),
(66, 'RUDRAPRAYAG', 18, 1),
(67, 'Zeel Clothing', 17, 1),
(68, 'PURVAJA', 17, 1),
(69, 'FEXEL', 17, 1),
(70, 'MANVAA', 17, 1),
(71, 'ANNI DESIGNER', 16, 1),
(72, 'GosriKi', 16, 1),
(73, 'Vaamsi', 16, 1),
(74, 'BIBA', 16, 1),
(75, 'SIRIL', 15, 1),
(76, 'Satrani', 15, 1),
(77, 'GoSriKi', 15, 1),
(78, 'ANNI DESIGNER', 15, 1),
(79, 'Arrow', 14, 1),
(80, 'Levis', 14, 1),
(81, 'Raymond', 14, 1),
(82, 'Peter England', 14, 1),
(83, 'Levis', 13, 1),
(84, 'Lee', 13, 1),
(85, 'Peter England', 13, 1),
(86, 'Jack &amp; Jones', 13, 1),
(87, 'Allen Solly', 12, 1),
(88, 'Arrow', 12, 1),
(89, 'Jockey', 12, 1),
(90, 'Levis', 12, 1),
(91, 'Dennis Lingo', 11, 1),
(92, 'Allen Solly', 11, 1),
(93, 'Park Avenue', 11, 1),
(94, 'Raymond', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart_master`
--

CREATE TABLE `cart_master` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart_master`
--

INSERT INTO `cart_master` (`cart_id`, `user_id`, `status`) VALUES
(55, 9, 1),
(56, 9, 1),
(57, 9, 1),
(58, 9, 1),
(59, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(11) NOT NULL,
  `cat_title` varchar(50) NOT NULL,
  `cat_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_status`) VALUES
(11, 'Men', 1),
(12, 'Women', 1),
(13, 'Home &amp; Kitchen', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

CREATE TABLE `order_master` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `order_date` varchar(11) NOT NULL,
  `order_amount` int(11) NOT NULL,
  `order_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_master`
--

INSERT INTO `order_master` (`order_id`, `user_id`, `cart_id`, `order_date`, `order_amount`, `order_status`) VALUES
(42, 9, 58, '23:07:2023', 1967, 1),
(43, 9, 59, '24:07:2023', 1857, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_to_delivery`
--

CREATE TABLE `order_to_delivery` (
  `delivery_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `f_name` varchar(50) NOT NULL,
  `l_name` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `phone` int(11) NOT NULL,
  `state` varchar(20) NOT NULL,
  `city` varchar(20) NOT NULL,
  `pincode` int(11) NOT NULL,
  `delivery_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_to_delivery`
--

INSERT INTO `order_to_delivery` (`delivery_id`, `order_id`, `f_name`, `l_name`, `address`, `phone`, `state`, `city`, `pincode`, `delivery_status`) VALUES
(42, 42, 'Sourav', 'Saha', 'Khardaha', 1234567890, 'WB', 'Kolkata', 700110, 1),
(43, 43, 'Sumanta', 'Halder', 'Sodepur', 1234567890, 'WB', 'Kolkata', 700111, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_to_payment`
--

CREATE TABLE `order_to_payment` (
  `order_id` int(11) NOT NULL,
  `payment_req_id` varchar(255) NOT NULL,
  `payment_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_to_payment`
--

INSERT INTO `order_to_payment` (`order_id`, `payment_req_id`, `payment_status`) VALUES
(42, 'pay_MHJ61KuGbpiSil', 1),
(43, 'pay_MHdu3iiHgPxfYN', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_master`
--

CREATE TABLE `product_master` (
  `product_id` int(11) NOT NULL,
  `product_subcat_id` int(11) NOT NULL,
  `product_brand_id` int(11) NOT NULL,
  `product_title` varchar(255) NOT NULL,
  `product_desc` text NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_stock_qty` int(11) NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_master`
--

INSERT INTO `product_master` (`product_id`, `product_subcat_id`, `product_brand_id`, `product_title`, `product_desc`, `product_price`, `product_stock_qty`, `product_image`, `product_status`) VALUES
(10, 11, 91, 'Dennis Lingo Men&#039;s Solid Slim Fit Cotton Casual Shirt with Spread Collar &amp; Full Sleeves', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 489, 4, '1689871746613r39v66lS.-UY741-.jpg', 1),
(11, 11, 91, 'Dennis Lingo Men&#039;s Checkered Slim Fit Cotton Casual Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 599, 4, '168987188561DGAlvxRLL.-UY741-.jpg', 1),
(12, 11, 91, 'Dennis Lingo Men&#039;s Striped Slim Fit Cotton Casual Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 489, 5, '168987197761ZbKLlt0sL.-UY741-.jpg', 1),
(13, 11, 91, 'Dennis Lingo Men&#039;s Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 594, 3, '1689872042418DdaixFBL.jpg', 1),
(14, 11, 92, 'Allen Solly Men&#039;s Regular Fit Formal Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 849, 4, '168987232481uPTB+SIrL.-UX569-.jpg', 1),
(15, 11, 92, 'Allen Solly Men&#039;s Regular Formal Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 899, 5, '1689872469A1441OWp4RL.-UX569-.jpg', 1),
(16, 11, 92, 'Allen Solly Men&#039;s Formal Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 899, 4, '168987311771kguR1d2nL.-UY741-.jpg', 1),
(17, 11, 92, 'Allen Solly Men Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 849, 3, '168987316971X+M8RBF+L.-UY741-.jpg', 1),
(18, 11, 93, 'Park Avenue Men Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 989, 4, '1689873828818stIcyJNL.-UX466-.jpg', 1),
(19, 11, 93, 'Park Avenue Men Shirt&#039;s', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1039, 4, '168987392581D5Q+iJzuL.-UX466-.jpg', 1),
(20, 11, 93, 'Park Avenue Men&#039;s Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1049, 3, '168987401391xJMdULHmL.-UX569-.jpg', 1),
(21, 11, 93, 'Park Avenue Men Formal Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 939, 4, '168987409281r37qPlXaL.-UX466-.jpg', 1),
(22, 11, 94, 'Raymond Blue Slim Fit Cotton Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 899, 4, '168987429381Sq8aCd-2L.-UX466-.jpg', 1),
(23, 11, 94, 'Raymond Dark Violet Slim Fit Cotton Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1019, 4, '168987437581ak76m5xtL.-UX466-.jpg', 1),
(24, 11, 94, 'Raymond Men Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 909, 3, '168987444471j0Ci3f7qL.-UX569-.jpg', 1),
(25, 11, 94, 'Raymond Men Blue Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1031, 3, '168987455281Y0DFFg71L.-UX569-.jpg', 1),
(26, 12, 87, 'Allen Solly Men T-shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 4, '168990963071eUwDk8z+L.-UX569-.jpg', 1),
(27, 12, 87, 'Allen Solly Men&#039;s Regular Fit T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 539, 3, '168990970171nYLEDQboL.-UX569-.jpg', 1),
(28, 12, 87, 'Allen Solly Men&#039;s Casual Fit T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 584, 3, '168990981481HcAHIoHlL.-UX569-.jpg', 1),
(29, 12, 87, 'Allen Solly Men&#039;s Regular High Neck Fit T-shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 629, 4, '168990992261f7aMUn5cL.-UY741-.jpg', 1),
(30, 12, 88, 'Arrow Sports Mint Polo T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 669, 3, '168991015081mSR-jvD0S.-UX466-.jpg', 1),
(31, 12, 88, 'Arrow Men Polo T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 799, 4, '168991025971w8Q7rtN2L.-UX569-.jpg', 1),
(32, 12, 88, 'Arrow Sports Men Maroon Short Sleeve Solid Pique Polo T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 579, 5, '168991034391rwxj1oAkL.-UX569-.jpg', 1),
(33, 12, 88, 'Arrow SMU Sports Solid Half Sleeve Polo T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 579, 4, '168991041381c1kHTy3WL.-UX569-.jpg', 1),
(34, 12, 89, 'Jockey IM21 Men&#039;s Super Combed Supima Cotton Solid Round Neck Half Sleeve T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 749, 4, '168991066071jO3C-exWL.-UY741-.jpg', 1),
(35, 12, 89, 'Jockey Polyester Cotton Mens T-Shirt (S21JOMV02-P)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 849, 3, '168991073671kjtS8PxEL.-UY741-.jpg', 1),
(36, 12, 89, 'Jockey 2717 Men&#039;s Super Combed Cotton Rich Striped Round Neck T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 649, 4, '16899108077165x1Vn-YL.-UY741-.jpg', 1),
(37, 12, 89, 'Jockey MC06 Men&#039;s Super Combed Cotton Sleeved Inner T-Shirt with Extended Length for Easy Tuck', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 439, 3, '168991088171kzpwv3-8L.-UY741-.jpg', 1),
(38, 12, 90, 'Levi&#039;s Men T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 4, '168991103351P2LtcERzL.-UX679-.jpg', 1),
(39, 12, 90, 'Levi&#039;s Men&#039;s Colourblocked Polo Collar T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 629, 3, '168991126971UmyVkYSFL.-UX569-.jpg', 1),
(40, 12, 90, 'Levi&#039;s Men&#039;s Regular T-Shirt (16960-0647_Surf Blue L)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 569, 4, '168991133651RB03BZR4L.-UX679-.jpg', 1),
(41, 12, 90, 'Levi&#039;s Men Fit T-Shirt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 599, 4, '168991141351r0LyIWxCL.-UX679-.jpg', 1),
(42, 13, 83, 'Levi&#039;s Men Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1599, 4, '168992900651BmO8qmN+L.-UX569-.jpg', 1),
(43, 13, 83, 'Levi&#039;s Men&#039;s 511 Slim Fit Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1599, 3, '168992907281cGjm7oyYL.-UX466-.jpg', 1),
(44, 13, 83, 'Levi&#039;s Men Blue Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1789, 4, '1689929191810vX1GAlEL.-UX466-.jpg', 1),
(45, 13, 83, 'Levi&#039;s Men&#039;s 511 Slim Fit Black Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1594, 4, '168992926551LGwT-p+kL.-UX679-.jpg', 1),
(46, 13, 84, 'Lee Men&#039;s Travis Blue Jeans (Slim)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1649, 4, '1689929564516hIQzueQL.-UX679-.jpg', 1),
(47, 13, 84, 'Lee Men&#039;s Bruce Blue Jeans (Skinny)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1979, 4, '168992961051wwMmbm6ML.-UX679-.jpg', 1),
(48, 13, 84, 'Lee Men&#039;s Rodeo Blue Jeans (Regular)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1649, 3, '1689929670416za612USL.-UX679-.jpg', 1),
(49, 13, 84, 'Lee Men&#039;s Slim Fit Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1199, 3, '168992976881UTmG6eByL.-UX569-.jpg', 1),
(50, 13, 85, 'Peter England Men&#039;s Slim Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1259, 3, '1689929975515-ujwzZfL.-UY741-.jpg', 1),
(51, 13, 85, 'Peter England Men&#039;s Tapered Jeans (Navy Blue)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1099, 4, '168993010881tMkvCXlIL.-UX466-.jpg', 1),
(52, 13, 85, 'Peter England Men Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1199, 4, '1689930166617HcDHFgxL.-UY741-.jpg', 1),
(53, 13, 85, 'Peter England Men&#039;s Skinny Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1289, 4, '1689930225618HgVAnzFL.-UY741-.jpg', 1),
(54, 13, 86, 'Jack &amp; Jones Men Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1295, 4, '1689930398619euursGCL.-UY741-.jpg', 1),
(55, 13, 86, 'Jack &amp; Jones Men&#039;s Skinny Fit Cotton Blend Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1589, 3, '1689930505611w+auypoL.-UY741-.jpg', 1),
(56, 13, 86, 'Jack &amp; Jones Men White Denim Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1889, 4, '168993060441ZIyBvapRL.-UX679-.jpg', 1),
(57, 13, 86, 'Jack &amp; Jones Men&#039;s Slim Fit Jeans', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1679, 3, '168993065951X+fQpBcOL.-UY741-.jpg', 1),
(58, 14, 79, 'Arrow Men&#039;s Regular Fit Pants', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 999, 4, '168993161461c8vmA20GL.-UX466-.jpg', 1),
(59, 14, 79, 'Arrow Men Pants', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1249, 3, '168993169361RcIQpgt9L.-UX466-.jpg', 1),
(60, 14, 79, 'Arrow Men Formal Pants', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1289, 3, '168993179281j6sqNk+xL.-UX569-.jpg', 1),
(61, 14, 79, 'Arrow Men Dark Blue Pants', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1079, 4, '168993189481gDfJK4FGL.-UX569-.jpg', 1),
(62, 14, 80, 'Levi&#039;s Men&#039;s Solid Slim Fit Trousers', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1350, 4, '168994579151-wUj+HfgL.-UX679-.jpg', 1),
(63, 14, 80, 'Levi&#039;s Men&#039;s Solid Slim Fit Trousers (Grey)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1350, 3, '1689945904513Ehe7Y6cL.-UX679-.jpg', 1),
(64, 14, 80, 'Levi&#039;s Men&#039;s Solid Slim Tapered Fit Trousers', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1949, 3, '168994599751l-ig8LwWL.-UX679-.jpg', 1),
(65, 14, 80, 'Levi&#039;s Men&#039;s Solid Slim Tapered Fit Trousers (Grey)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1650, 4, '168994607651CLJ9SNrHL.-UX679-.jpg', 1),
(66, 14, 81, 'Raymond Men&#039;s Slim Fit Formal Trousers', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1189, 4, '168994622671xy7HSPQ1L.-UX466-.jpg', 1),
(67, 14, 81, 'Raymond Black Trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1239, 3, '168994629451Tt5B8FH6L.-UX679-.jpg', 1),
(68, 14, 81, 'Raymond Dark Blue Trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1179, 4, '1689946528513FofNngQL.-UX569-.jpg', 1),
(69, 14, 81, 'Raymond Black Fit Trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1089, 4, '1689946638black.jpg', 1),
(70, 14, 82, 'Peter England Grey Trousers', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1399, 4, '1689947008pic1.jpg', 1),
(71, 14, 82, 'Peter England Men Khaki Casual Trousers', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1129, 3, '1689947060pic2.jpg', 1),
(72, 14, 82, 'Peter England Men&#039;s Western Fit Cotton Blend Trouser', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1249, 4, '1689947107pic3.jpg', 1),
(73, 14, 82, 'Peter England Men Brown Casual Trousers', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1049, 4, '1689947171pic4.jpg', 1),
(74, 15, 75, 'SIRIL Women&#039;s Printed Poly Silk Saree with Blouse', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 489, 4, '1689947622pic1.jpg', 1),
(75, 15, 75, 'SIRIL Women&#039;s Warli Printed Silk Blend Saree with Unstitched Blouse Piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 368, 4, '1689947736pic2.jpg', 1),
(76, 15, 75, 'SIRIL Women&#039;s Lace &amp; Printed Chiffon Saree with Blouse', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 565, 4, '1689947812pic3.jpg', 1),
(77, 15, 75, 'SIRIL Women&#039;s Bandhani Printed Georgette Saree with Unstitched Blouse Piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 378, 4, '1689947868pic4.jpg', 1),
(78, 15, 76, 'Satrani Women&#039;s Floral Printed Georgette Saree with Blouse Piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 365, 4, '1689948445pic1.jpg', 1),
(79, 15, 76, 'Satrani Women&#039;s Geometric Printed Poly Silk Saree with Blouse Piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 345, 4, '1689948507pic2.jpg', 1),
(80, 15, 76, 'Satrani Women&#039;S Poly Silk Printed Saree With Blouse Piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 356, 4, '1689948558pic3.jpg', 1),
(81, 15, 76, 'Satrani Women&#039;s Printed Khadi Silk Saree with Blouse Piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 355, 4, '1689948611pic4.jpg', 1),
(82, 15, 77, 'GoSriKi Women&#039;s Georgette Blend Printed Saree With Blouse Piece (MAHA-BLUE-GS_Blue_Free Size)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 389, 4, '1689948912p1.jpg', 1),
(83, 15, 77, 'GoSriKi Women&#039;s Linen Saree', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 369, 4, '1689948979p2.jpg', 1),
(84, 15, 77, 'GoSriKi Women&#039;s Linen Blend Saree With blouse piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 645, 4, '1689949059p3.jpg', 1),
(85, 15, 77, 'GoSriki Women&#039;s Cotton Printed Saree With Blouse Piece (BLACK)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 549, 4, '1689949161p4.jpg', 1),
(86, 15, 78, 'ANNI DESIGNER Women&#039;s Black Color Satin Patta Printed Saree With Blouse Piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 359, 3, '1689949561p1.jpg', 1),
(87, 15, 78, 'ANNI DESIGNER Women&#039;s Black Color Chanderi Silk Jacquard Butta Saree With Blouse Piece', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 445, 4, '1689949600p2.jpg', 1),
(88, 15, 78, 'ANNI DESIGNER Women&#039;s Jute Silk Mirror Work Saree With Blouse Piece (Yellow)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 539, 4, '1689949647p3.jpg', 1),
(89, 15, 78, 'ANNI DESIGNER Silk Saree with Blouse Piece (AD-S181562-FBA_Orange &amp; Multi_Free Size)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 522, 4, '1689949709p4.jpg', 1),
(90, 16, 71, 'ANNI DESIGNER Women&#039;s Cotton Blend Anarkali Solid Kurta with Dupatta (Aadhya Green_S_Green_Small)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 469, 4, '1689950513p1.jpg', 1),
(91, 16, 71, 'ANNI DESIGNER Women&#039;s Rayon Straight Printed Kurta with Pant &amp; Dupatta (Bulgeriya)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 3, '1689950562p2.jpg', 1),
(92, 16, 71, 'ANNI DESIGNER Women&#039;s Cotton Blend Solid Straight Kurta with Pant &amp; with Dupatta (Chora WP)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 569, 4, '1689950624p3.jpg', 1),
(93, 16, 71, 'ANNI DESIGNER Women&#039;s Cotton Blend Traditional Plain Anarkali Kurta and Pant with Dupatta Set (Wipin NW)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 4, '1689950662p4.jpg', 1),
(94, 16, 72, 'GoSriKi Women&#039;s Rayon Floral Printed Straight Kurta with Pants &amp; Dupatta (Shank-Maroon-Nw08-GS)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 5, '1689950877815QW8bkthL.-UX679-.jpg', 1),
(95, 16, 72, 'GoSriKi Women&#039;s Cotton Blend Embroidered Straight Kurta (Stho-White-Nw2-GS)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 469, 5, '168995091651dZ19miAbL.-UY741-.jpg', 1),
(96, 16, 72, 'GoSriKi Women Kurta with Pant &amp; Dupatta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 4, '168995096061Lg+nlVJ0L.-UX679-.jpg', 1),
(97, 16, 72, 'GoSriKi Women&#039;s Cotton Blend Printed Straight Kurta with Pant &amp; Dupatta (Sky Bird-GO)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 4, '168995100461aXAuSKsFL.-UY741-.jpg', 1),
(98, 16, 73, 'Vaamsi Women&#039;s Cotton Blend Floral Block Printed Straight Kurta Pant with Dupatta (VKSKD1099)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 5, '1689951279p1.jpg', 1),
(99, 16, 73, 'Vaamsi Women&#039;s Poly Cotton Floral Printed Straight Kurta Pant With Dupatta (VKSKD1154)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 4, '1689951314p2.jpg', 1),
(100, 16, 73, 'Vaamsi Women&#039;s Cotton Blend Floral Printed Straight Kurta Pant with Dupatta (VKSKD1238)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 699, 4, '1689951365p3.jpg', 1),
(101, 16, 73, 'Vaamsi Women&#039;s Cotton Blend Printed Kurta Trousers and Dupatta Set (VKSKD1133_Grey)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 659, 4, '1689951404p4.jpg', 1),
(102, 16, 74, 'BIBA Printed Band Collar Flared Womens Kurta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1000, 3, '1689960788p1.jpg', 1),
(103, 16, 74, 'BIBA Women&#039;s Cotton Regular Kurti', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1300, 4, '1689960843p2.jpg', 1),
(104, 16, 74, 'BIBA Printed Band Collar Straight Fit Kurta for Womens', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 979, 4, '1689960906p3.jpg', 1),
(105, 16, 74, 'BIBA Printed Band Collar Straight Fit Womens Kurta', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 840, 4, '1689960949p4.jpg', 1),
(106, 17, 67, 'Zeel Clothing Women&#039;s Velvet Semi stitched Lehenga Choli (7204-Purple_Purple_Free Size)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 3571, 4, '1689997865p1.jpg', 1),
(107, 17, 67, 'Zeel Clothing Women&#039;s Organza Floral White Semi-Stitched Lehenga Choli (7611-Wedding-Floral-Lehenga-Latest, White)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 2999, 3, '1689998052p2.jpg', 1),
(108, 17, 67, 'Zeel Clothing Women&#039;s Floral Organza Semi Stitched Lehenga Choli with Dupatta (7026-Floral-Wedding-Latest-Lehenga_Free)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 2609, 4, '1689998137p3.jpg', 1),
(109, 17, 67, 'Zeel Clothing Purple Bridal Semi Stitched Lehenga Choli for Women and Girls (7034-Purple-New-Wedding-Bridal-Heavy-Lehenga;Free Size)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 6589, 4, '1689998193p4.jpg', 1),
(110, 17, 68, 'PURVAJA Women&#039;s Jacquard Semi-Stitched Lehenga choli', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1289, 4, '1689998411p1.jpg', 1),
(111, 17, 68, 'PURVAJA Women&#039;s Faux Silk Semi-stitched Lehenga Choli (Multi-Rivaaz_Multicolored_Free Size)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1456, 4, '1689998487p2.jpg', 1),
(112, 17, 68, 'PURVAJA Women&#039;s Jacquard Semi-Stitched Lehenga choli (Malika)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1231, 4, '1689998553p3.jpg', 1),
(113, 17, 69, 'FEXEL Women&#039;s Soft Net Embroidery Semi Stitched Lehenga Choli', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1299, 4, '1689999028P1.jpg', 1),
(114, 17, 69, 'FEXEL Women&#039;s Net Sequence Embroidery Work Lehenga Choli', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1245, 4, '1689999109P2.jpg', 1),
(115, 17, 69, 'FEXEL Women&#039;s Wear Embroidery Work Net Lehenga Choli', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1195, 4, '1689999159P3.jpg', 1),
(116, 17, 70, 'MANVAA Women&#039;s Velvet Lehenga Choli (DBDR1006_Purple_Free Size)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 3012, 3, '1689999467P1.jpg', 1),
(117, 17, 70, 'MANVAA Women&#039;s Silk Lehenga Choli (NRNI28401_Pink_Freesize)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 2639, 3, '1689999590P2.jpg', 1),
(118, 17, 70, 'MANVAA Women&#039;s Net Lehenga Choli (AKRNX5004_Beige_Free Size)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 1616, 4, '1689999653P3.jpg', 1),
(119, 18, 64, 'Mudrika Women Cotton Long Dresses Anarkali Dress (Multicolour, Free Size)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 699, 4, '1690000569p1.jpg', 1),
(120, 18, 64, 'Mudrika Women Stylish Multicolor Printed Rayon Fit &amp; Flare Anarkali Maxi Gown Dress with Belt', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 569, 4, '1690000623p2.jpg', 1),
(121, 18, 64, 'Mudrika Women&#039;s Full Sleeves Fit and Flare Rayon Printed Long Gown (Free Size Upto XXL)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 549, 4, '1690000663p3.jpg', 1),
(122, 18, 65, 'Dhruvi Cotton Long Maxi Dress for Women Girls | Three Fourth Sleeves | Evening Green', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 605, 4, '1690000815p1.jpg', 1),
(123, 18, 65, 'Dhruvi Women&#039;s Casual Cotton Long Maxi Dress with Pom Pom', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 599, 4, '1690000899p2.jpg', 1),
(124, 18, 65, 'Dhruvi Cotton Long Maxi Dress for Women Girls | Three Fourth Sleeves | Evening Blue', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 708, 4, '1690000951p3.jpg', 1),
(125, 18, 66, 'Rudraprayag Women Maxi Gown', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 2184, 3, '1690001334p1.jpg', 1),
(126, 18, 66, 'RUDRAPRAYAG anarkali net and santoon long suits for women | anarkali suit for women readymade | dress for women semi-stitched | party wear gown for women 2023 | gown in Clothing &amp; Accessories', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 2599, 3, '1690001384p2.jpg', 1),
(127, 18, 66, 'RUDRAPRAYAG Georgette and Santoon Embroidered Semi Stitched Anarkali Gown for Women', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 2089, 3, '1690001424p3.jpg', 1),
(128, 21, 0, 'Divine Casa 100% Cotton Rocca Print Mix N Match Bedsheet Set for Double Size Bed Durable Sheets - Love Bird', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 721, 4, '1690025743p1.jpg', 1),
(129, 21, 0, 'Home Sizzler 144 TC Microfibre Kid&#039;s Giraffe Double Bedsheet with 2 King Size Pillow Covers (Yellow)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 499, 4, '1690025789p2.jpg', 1),
(130, 21, 0, 'La Verne140 TC 100% Cotton King Size Jaipuri Rjasathani Print Bedsheet with 2 Pillow Covers (Purple)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 469, 4, '1690025838p3.jpg', 1),
(131, 21, 0, 'Soniasaa Prime Collection 1 Double Bedsheet with 2 Free Pillow Covers | 154 TC Soft-Touch Skin Friendly Cotton-Blend 220X228 Cm Double Bedsheet for Double Bed', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 399, 3, '1690025891p4.jpg', 1),
(132, 21, 0, 'RajasthaniKart® Pure 100% Cotton Double Bed Sheet with 2 Pillow Covers (Bedsheet for Double Bed Cotton, Yellow Kashmirkalli Jaipuri, King Size,5167)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 425, 4, '1690025933p5.jpg', 1),
(133, 22, 0, 'Homefab India Set of 2 Royal Silky Cream Door Curtains(HF042) 7X4ft.', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 479, 4, '1690026285p1.jpg', 1),
(134, 22, 0, 'Home Sizzler 2 Pieces Geometrical Panel Eyelet Polyester Door Curtains - 7 Feet, Blue(Eyelet)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 449, 3, '1690026326p2.jpg', 1),
(135, 22, 0, 'Blexos Long Door Curtains 9 Feet Long | Yarn Polyester Curtains | Premium Screens for Home Office | Prada for Living Room Bedroom | (Blue, 1pc)', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 399, 4, '1690026402p3.jpg', 1),
(136, 22, 0, 'Home Sizzler 2 Pieces Abstract Flower Eyelet Polyester Window curtains - 5 Feet, Grey', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 459, 4, '1690026455p4.jpg', 1),
(137, 22, 0, 'Home Sizzler 2 Piece Garden Panel Eyelet Polyester Window Curtains - 5 Feet, Brown', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolore laboriosam tempora quos omnis. Autem ipsum iusto laboriosam id error qui deleniti natus dolorum, in voluptas consequatur possimus omnis minima provident.', 499, 4, '1690026516p5.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_to_cart`
--

CREATE TABLE `product_to_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_product_id` int(11) NOT NULL,
  `cart_product_qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_to_cart`
--

INSERT INTO `product_to_cart` (`cart_id`, `cart_product_id`, `cart_product_qty`) VALUES
(55, 138, 1),
(56, 138, 1),
(57, 138, 1),
(58, 43, 1),
(58, 75, 1),
(59, 26, 2),
(59, 27, 1);

-- --------------------------------------------------------

--
-- Table structure for table `site_info`
--

CREATE TABLE `site_info` (
  `site_id` int(11) NOT NULL,
  `site_name` varchar(50) NOT NULL,
  `site_title` varchar(100) NOT NULL,
  `site_logo` varchar(100) NOT NULL,
  `site_desc` varchar(255) NOT NULL,
  `currency_format` varchar(10) NOT NULL,
  `contact_phone` varchar(15) NOT NULL,
  `contact_email` varchar(100) NOT NULL,
  `contact_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_info`
--

INSERT INTO `site_info` (`site_id`, `site_name`, `site_title`, `site_logo`, `site_desc`, `currency_format`, `contact_phone`, `contact_email`, `contact_address`) VALUES
(1, 'My Online Store', 'e-commerce online shopping site', '1689682810Ecommerce-Logo-Design-Graphics-32523051-1.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nesciunt, cupiditate.', 'Rs.', '9674123289', 'email@email.com', '#123, Lorem ipsum dolor');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_cat_id` int(11) NOT NULL,
  `sub_cat_title` varchar(50) NOT NULL,
  `cat_parent_id` int(11) NOT NULL,
  `sub_cat_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_cat_id`, `sub_cat_title`, `cat_parent_id`, `sub_cat_status`) VALUES
(11, 'Shirts', 11, 1),
(12, 'T-shirts', 11, 1),
(13, 'Jeans', 11, 1),
(14, 'Trousers', 11, 1),
(15, 'Sarees', 12, 1),
(16, 'Kurtas', 12, 1),
(17, 'Lehanga', 12, 1),
(18, 'Gowns', 12, 1),
(21, 'Bedsheets', 13, 1),
(22, 'Curtains', 13, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_first_name` varchar(50) NOT NULL,
  `user_last_name` varchar(50) NOT NULL,
  `user_username` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_first_name`, `user_last_name`, `user_username`, `user_password`, `user_status`) VALUES
(9, 'Sumanta', 'Halder', 'sumanta@gmail.com', '30b34f1a55eb1b1950464410c02657ee', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_master`
--
ALTER TABLE `cart_master`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `order_master`
--
ALTER TABLE `order_master`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_to_delivery`
--
ALTER TABLE `order_to_delivery`
  ADD PRIMARY KEY (`delivery_id`);

--
-- Indexes for table `product_master`
--
ALTER TABLE `product_master`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `site_info`
--
ALTER TABLE `site_info`
  ADD PRIMARY KEY (`site_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_cat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `cart_master`
--
ALTER TABLE `cart_master`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_master`
--
ALTER TABLE `order_master`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `order_to_delivery`
--
ALTER TABLE `order_to_delivery`
  MODIFY `delivery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `product_master`
--
ALTER TABLE `product_master`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `site_info`
--
ALTER TABLE `site_info`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
