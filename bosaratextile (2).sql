-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2024 at 07:47 PM
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
-- Database: `bosaratextile`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(45) NOT NULL,
  `brand_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_status`) VALUES
(1, 'Columbia', 1),
(2, 'Tommy Hilfiger', 1),
(3, 'M&S', 1),
(4, 'Victoria\'s Secret', 1),
(5, 'Adidas', 1),
(6, 'deedat', 1),
(7, 'Levi\'s', 1),
(8, 'BOSS', 1),
(9, 'Calvin Klein', 1),
(10, 'GAP', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `sess_id` varchar(100) NOT NULL,
  `stock_stockId` int(11) NOT NULL,
  `item_qty` int(11) NOT NULL DEFAULT 1,
  `addTime` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Triggers `cart`
--
DELIMITER $$
CREATE TRIGGER `RestoreStock` BEFORE DELETE ON `cart` FOR EACH ROW UPDATE stocks SET stock_count = stock_count + old.item_qty WHERE stock_id = old.stock_stockId
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL,
  `category_status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_status`) VALUES
(1, 'Denim', 1),
(2, 'T shirt', 1),
(3, 'Shirt', 1),
(4, 'Frock', 1),
(5, 'Skirts', 1),
(6, 'Blouse', 1),
(7, 'Trousers', 1),
(8, 'Bottoms', 1),
(9, 'Jeans', 1),
(10, 'Short', 1);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

CREATE TABLE `collections` (
  `collection_id` int(11) NOT NULL,
  `collection_name` varchar(45) NOT NULL,
  `collection_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collections`
--

INSERT INTO `collections` (`collection_id`, `collection_name`, `collection_status`) VALUES
(1, 'Male Collection', 1),
(2, 'Female Collection', 1),
(3, 'Kids Collection', 1),
(4, 'other', 1);

-- --------------------------------------------------------

--
-- Table structure for table `collection_types`
--

CREATE TABLE `collection_types` (
  `collection_type_id` int(11) NOT NULL,
  `collection_type_name` varchar(45) NOT NULL,
  `collection_type_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `collection_types`
--

INSERT INTO `collection_types` (`collection_type_id`, `collection_type_name`, `collection_type_status`) VALUES
(1, 'Casual', 1),
(2, 'Formal', 1),
(3, 'Essentials', 1),
(4, 'Accessories', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_fname` varchar(45) NOT NULL,
  `customer_lname` varchar(45) NOT NULL,
  `customer_addr1` varchar(45) NOT NULL,
  `customer_addr2` varchar(45) NOT NULL,
  `customer_addr3` varchar(45) NOT NULL,
  `customer_postal_id` int(11) NOT NULL,
  `customer_gender` char(1) NOT NULL,
  `customer_nic` varchar(45) NOT NULL,
  `customer_cno` varchar(20) NOT NULL,
  `customer_img` varchar(250) DEFAULT NULL,
  `customer_reg_date` datetime NOT NULL DEFAULT current_timestamp(),
  `customer_last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `customer_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_fname`, `customer_lname`, `customer_addr1`, `customer_addr2`, `customer_addr3`, `customer_postal_id`, `customer_gender`, `customer_nic`, `customer_cno`, `customer_img`, `customer_reg_date`, `customer_last_update`, `customer_status`) VALUES
(2, 'Nuwan', 'Abesuriya', '105', 'abc', 'efg', 12600, 'F', '962341556v', '0112056789', '1631452142_userImg.jpg', '2021-09-12 18:37:39', '2024-07-29 17:39:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `customer_login`
--

CREATE TABLE `customer_login` (
  `login_id` int(11) NOT NULL,
  `login_email` varchar(100) NOT NULL,
  `login_password` varchar(60) NOT NULL,
  `login_status` tinyint(1) NOT NULL DEFAULT 1,
  `customer_customerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customer_login`
--

INSERT INTO `customer_login` (`login_id`, `login_email`, `login_password`, `login_status`, `customer_customerId`) VALUES
(2, 'samplemail698@gmail.com', 'cc2f73a5ee4d1991bb41fa22166541cb33fb09c8', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `faq_id` int(11) NOT NULL,
  `faq_content` text NOT NULL,
  `faq_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `faq_answer` varchar(400) NOT NULL DEFAULT 'Pending',
  `faq_cus_name` varchar(100) NOT NULL,
  `faq_cus_email` varchar(100) NOT NULL,
  `faq_value` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1=low, 2=mid, 3=high, 4=secure',
  `faq_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`faq_id`, `faq_content`, `faq_time`, `faq_answer`, `faq_cus_name`, `faq_cus_email`, `faq_value`, `faq_status`) VALUES
(1, 'hello', '2021-09-16 12:27:26', 'Pending', 'abcd', 'abcd@gmail.com', 1, 1),
(2, 'Hello', '2021-09-16 12:43:58', 'Pending', 'example', 'abcd@gmail.com', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` text DEFAULT NULL,
  `feedback_starcount` int(5) NOT NULL DEFAULT 0,
  `feedback_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_customerId` int(11) NOT NULL,
  `invoice_invoiceId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedbacks`
--

INSERT INTO `feedbacks` (`feedback_id`, `feedback_content`, `feedback_starcount`, `feedback_time`, `customer_customerId`, `invoice_invoiceId`) VALUES
(3, 'Good Job', 5, '2021-09-24 14:07:26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `invoice_id` int(11) NOT NULL,
  `invoice_number` varchar(45) NOT NULL,
  `invoice_total` decimal(10,2) NOT NULL,
  `invoice_dis` decimal(10,2) NOT NULL DEFAULT 0.00,
  `invoice_net_total` decimal(10,2) NOT NULL,
  `invoice_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `customer_customerId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`invoice_id`, `invoice_number`, `invoice_total`, `invoice_dis`, `invoice_net_total`, `invoice_time`, `customer_customerId`) VALUES
(1, 'INV20210926_0001', 4000.00, 0.00, 4200.00, '2021-09-26 15:17:49', 1),
(2, 'INV20211002_0001', 3200.00, 0.00, 3400.00, '2021-10-02 11:26:41', 1),
(3, 'INV20211002_0002', 3800.00, 0.00, 4000.00, '2021-10-02 11:29:28', 1),
(4, 'INV20211002_00003', 3200.00, 0.00, 3400.00, '2021-10-02 13:01:10', 2),
(5, 'INV20240729_00001', 19900.00, 0.00, 20100.00, '2024-07-29 17:44:55', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `order_cusFname` varchar(60) NOT NULL,
  `order_cusLname` varchar(60) NOT NULL,
  `order_cusAddr1` varchar(100) NOT NULL,
  `order_cusAddr2` varchar(100) NOT NULL,
  `order_cusAddr3` varchar(100) NOT NULL,
  `order_cusPostalcode` int(5) NOT NULL,
  `order_cusContact` varchar(15) NOT NULL,
  `order_cusEmail` varchar(100) NOT NULL,
  `order_status` tinyint(1) DEFAULT 1 COMMENT '1-new order\r\n2-processing \r\n3-ready to delivery\r\n4-dispatch\r\n5-devilered',
  `customer_customerId` int(11) NOT NULL,
  `invoice_invoiceId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `order_cusFname`, `order_cusLname`, `order_cusAddr1`, `order_cusAddr2`, `order_cusAddr3`, `order_cusPostalcode`, `order_cusContact`, `order_cusEmail`, `order_status`, `customer_customerId`, `invoice_invoiceId`) VALUES
(4, '2021-10-02', 'abcd', 'efgh', '105', 'abc', 'efg', 12600, '0112056789', 'samplemail698@gmail.com', 1, 2, 4),
(5, '2024-07-29', 'Nuwan', 'Abesuriya', '105', 'abc', 'efg', 12600, '0112056789', 'samplemail698@gmail.com', 1, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `order_has_product`
--

CREATE TABLE `order_has_product` (
  `order_orderId` int(11) NOT NULL,
  `product_productId` int(11) NOT NULL,
  `product_qty` int(11) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `sub_total` decimal(10,2) NOT NULL DEFAULT 0.00,
  `size_sizeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_has_product`
--

INSERT INTO `order_has_product` (`order_orderId`, `product_productId`, `product_qty`, `product_price`, `sub_total`, `size_sizeId`) VALUES
(1, 2, 1, 3200.00, 3200.00, 10),
(1, 10, 1, 3200.00, 3200.00, 3),
(2, 4, 2, 3800.00, 7600.00, 10),
(2, 11, 1, 4600.00, 4600.00, 2),
(3, 4, 1, 3800.00, 3800.00, 10),
(3, 6, 1, 3800.00, 3800.00, 5),
(4, 2, 1, 3200.00, 3200.00, 10),
(4, 10, 1, 4000.00, 4000.00, 4),
(5, 1, 2, 3200.00, 6400.00, 2),
(5, 5, 3, 4500.00, 13500.00, 2),
(8, 9, 2, 3300.00, 6600.00, 2),
(8, 10, 1, 4000.00, 4000.00, 4),
(9, 6, 1, 3900.00, 3900.00, 3);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_color` varchar(45) NOT NULL,
  `product_discription` varchar(100) NOT NULL,
  `category_categoryId` int(11) NOT NULL,
  `brand_brandId` int(11) NOT NULL,
  `sub_category_subCategoryId` int(11) DEFAULT NULL,
  `collection_collectionId` int(11) NOT NULL,
  `collection_type_collectionTypeId` int(11) NOT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `product_color`, `product_discription`, `category_categoryId`, `brand_brandId`, `sub_category_subCategoryId`, `collection_collectionId`, `collection_type_collectionTypeId`, `product_status`) VALUES
(1, 'Levis Black T Shirt', 'Black', '100% Cotton', 2, 7, 9, 1, 1, 1),
(2, 'Levis Blue Demin', 'Blue', '100% Cotton', 1, 7, NULL, 1, 1, 1),
(3, 'Levis BWR T Shirt', 'Mullite Color BWR', '100% cotton', 2, 7, 8, 2, 1, 1),
(4, 'Tommy Navy Blue Shirt', 'Navy Blue ', '90% cotton 10% spand', 10, 2, NULL, 1, 1, 1),
(5, 'Levis white Tshirt', 'white', '100% cotton', 2, 7, NULL, 1, 1, 1),
(6, 'Tommy Blue Frock', 'blue', '100% cotton', 4, 2, 18, 2, 2, 1),
(8, 'VS Yellow Frock', 'yellow', '100% cotton', 4, 4, 18, 2, 2, 1),
(9, 'GPA Blue Blouse', 'Blue', '100% cotton', 6, 10, 22, 2, 2, 1),
(10, 'Adidas Ashes Bottom', 'Ashes', '100% cotton', 8, 5, 16, 1, 1, 1),
(11, 'pink Tshirt ', 'pink', '100%cotton', 2, 2, 9, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_has_size`
--

CREATE TABLE `product_has_size` (
  `product_productId` int(11) NOT NULL,
  `size_sizeId` int(11) NOT NULL,
  `sell_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `barcode` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_has_size`
--

INSERT INTO `product_has_size` (`product_productId`, `size_sizeId`, `sell_price`, `barcode`) VALUES
(1, 2, 3200.00, 1184500012),
(1, 3, 3200.00, 1184500013),
(1, 4, 3200.00, 1184500014),
(2, 8, 3200.00, 1184500028),
(2, 9, 3200.00, 1184500029),
(2, 10, 3200.00, 1184500210),
(2, 11, 3200.00, 1184500211),
(2, 12, 3200.00, 1184500212),
(3, 2, 3200.00, 1184500032),
(3, 3, 3200.00, 1184500033),
(3, 4, 3200.00, 1184500034),
(4, 9, 3200.00, 1184500049),
(4, 10, 3200.00, 1184500410),
(4, 11, 3200.00, 1184500411),
(5, 2, 3200.00, 1184500052),
(5, 3, 3200.00, 1184500053),
(5, 4, 3200.00, 1184500054),
(5, 5, 3200.00, 1184500055),
(6, 3, 3200.00, 1184500063),
(6, 4, 3200.00, 1184500064),
(6, 5, 3200.00, 1184500065),
(6, 6, 3200.00, 1184500066),
(7, 9, 3200.00, 1184500079),
(7, 10, 3200.00, 1184500710),
(7, 11, 3200.00, 1184500711),
(7, 12, 3200.00, 1184500712),
(7, 13, 3200.00, 1184500713),
(7, 14, 3200.00, 1184500714),
(8, 3, 3200.00, 1184500083),
(8, 4, 3200.00, 1184500084),
(8, 5, 3200.00, 1184500085),
(8, 6, 3200.00, 1184500086),
(9, 2, 3200.00, 1184500092),
(9, 3, 3200.00, 1184500093),
(9, 4, 3200.00, 1184500094),
(9, 5, 3200.00, 1184500095),
(10, 2, 3200.00, 1184500102),
(10, 3, 3200.00, 1184500103),
(10, 4, 3200.00, 1184500104),
(11, 2, 4000.00, 1802317002);

-- --------------------------------------------------------

--
-- Table structure for table `product_image`
--

CREATE TABLE `product_image` (
  `img_id` int(11) NOT NULL,
  `img_name` text NOT NULL,
  `product_productId` int(11) NOT NULL,
  `img_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `product_image`
--

INSERT INTO `product_image` (`img_id`, `img_name`, `product_productId`, `img_status`) VALUES
(1, 'levis_black_tshirt.jpg', 1, 1),
(2, 'levis_blue_denim.jpg', 2, 1),
(3, 'levis_bwr_tshirt.jpg', 3, 1),
(4, 'tommy_navy_blue_shirt.jpeg', 4, 1),
(5, 'levis_white_tshirt.jpg', 5, 1),
(6, 'tommy_blue_frock.jpg', 6, 1),
(8, 'vs_yellow_frock.jpg', 8, 1),
(9, 'gpa_blue_blouse.jpg', 9, 1),
(10, 'addidas_ashes_bottom.jpg', 10, 1),
(11, 'pink_tshirtjpg.jpg', 11, 1),
(12, 'levis_black_tshirt.jpg', 1, 1),
(13, 'levis_black_tshirt.jpg', 1, 1),
(14, 'levis_blue_denim.jpg', 2, 1),
(15, 'levis_blue_denim.jpg', 2, 1),
(16, 'levis_bwr_tshirt.jpg', 3, 1),
(17, 'levis_bwr_tshirt.jpg', 3, 1),
(18, 'tommy_navy_blue_shirt.jpeg', 4, 1),
(19, 'tommy_navy_blue_shirt.jpeg', 4, 1),
(20, 'levis_white_tshirt.jpg', 5, 1),
(21, 'levis_white_tshirt.jpg', 5, 1),
(22, 'tommy_blue_frock.jpg', 6, 1),
(23, 'tommy_blue_frock.jpg', 6, 1),
(26, 'vs_yellow_frock.jpg', 8, 1),
(27, 'vs_yellow_frock.jpg', 8, 1),
(28, 'gpa_blue_blouse.jpg', 9, 1),
(29, 'gpa_blue_blouse.jpg', 9, 1),
(30, 'addidas_ashes_bottom.jpg', 10, 1),
(31, 'addidas_ashes_bottom.jpg', 10, 1),
(32, 'pink_tshirtjpg.jpg', 11, 1),
(33, 'pink_tshirtjpg.jpg', 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int(11) NOT NULL,
  `size_name` varchar(45) NOT NULL,
  `size_status` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `size_name`, `size_status`) VALUES
(1, 'XS', 1),
(2, 'S', 1),
(3, 'M', 1),
(4, 'L', 1),
(5, 'XL', 1),
(6, 'XXL', 1),
(7, 'XXXL', 1),
(8, '26', 1),
(9, '28', 1),
(10, '30', 1),
(11, '32', 1),
(12, '34', 1),
(13, '36', 1),
(14, '38', 1),
(15, '40', 1),
(16, '42', 1),
(17, '44', 1),
(18, '46', 1),
(19, '48', 1),
(20, '50', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `stock_id` int(11) NOT NULL,
  `stock_count` int(11) NOT NULL,
  `stock_sell_price` decimal(10,2) NOT NULL DEFAULT 0.00,
  `stock_status` tinyint(1) NOT NULL DEFAULT 1,
  `size_sizeId` int(11) NOT NULL,
  `product_productId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`stock_id`, `stock_count`, `stock_sell_price`, `stock_status`, `size_sizeId`, `product_productId`) VALUES
(1, 98, 3200.00, 1, 2, 1),
(4, 120, 3500.00, 1, 3, 8),
(5, 120, 3200.00, 1, 4, 8),
(6, 120, 3400.00, 1, 5, 8),
(7, 120, 3800.00, 1, 6, 8),
(8, 100, 3500.00, 1, 8, 2),
(9, 99, 4000.00, 1, 9, 2),
(10, 99, 3200.00, 1, 10, 2),
(11, 100, 3200.00, 1, 11, 2),
(12, 100, 4200.00, 1, 12, 2),
(13, 80, 3300.00, 1, 2, 9),
(14, 80, 3300.00, 1, 3, 9),
(15, 80, 3200.00, 1, 4, 9),
(16, 80, 4400.00, 1, 5, 9),
(17, 50, 3000.00, 1, 2, 3),
(18, 50, 3000.00, 1, 3, 3),
(19, 50, 3200.00, 1, 4, 3),
(20, 49, 3900.00, 1, 3, 6),
(21, 50, 3200.00, 1, 4, 6),
(22, 49, 3800.00, 1, 5, 6),
(23, 50, 3200.00, 1, 6, 6),
(24, 57, 4500.00, 1, 2, 5),
(25, 60, 3200.00, 1, 3, 5),
(26, 60, 3600.00, 1, 4, 5),
(27, 60, 3000.00, 1, 5, 5),
(28, 49, 3200.00, 1, 9, 4),
(29, 50, 3800.00, 1, 10, 4),
(30, 50, 4400.00, 1, 11, 4),
(31, 50, 4000.00, 1, 2, 10),
(32, 50, 3200.00, 1, 3, 10),
(33, 50, 4000.00, 1, 4, 10),
(34, 50, 3200.00, 1, 9, 7),
(35, 50, 3500.00, 1, 10, 7),
(36, 50, 3200.00, 1, 11, 7),
(37, 50, 3500.00, 1, 12, 7),
(38, 50, 3200.00, 1, 13, 7),
(39, 50, 3700.00, 1, 14, 7),
(40, 50, 4600.00, 1, 2, 11),
(41, 50, 4200.00, 1, 3, 11);

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `sub_category_id` int(11) NOT NULL,
  `sub_category_name` varchar(45) NOT NULL,
  `category_categoryId` int(11) NOT NULL,
  `sub_cat_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`sub_category_id`, `sub_category_name`, `category_categoryId`, `sub_cat_status`) VALUES
(1, 'Long Sleeves', 3, 1),
(2, 'Short sleeves', 3, 1),
(8, 'Collar', 2, 1),
(9, 'C Collar', 2, 1),
(10, 'V Collar', 2, 1),
(11, 'Half collar', 2, 1),
(12, 'Half collar (Shirt)', 3, 1),
(13, 'Short', 7, 1),
(14, 'Umbrella ', 4, 1),
(15, 'Demin Jeans', 1, 1),
(16, 'Long', 8, 1),
(17, 'Strapless', 4, 1),
(18, 'Shift', 4, 1),
(19, 'Slit', 5, 1),
(20, 'pencil', 5, 1),
(21, 'Silm Fit', 7, 1),
(22, 'Blouses', 6, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`sess_id`,`stock_stockId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `collections`
--
ALTER TABLE `collections`
  ADD PRIMARY KEY (`collection_id`);

--
-- Indexes for table `collection_types`
--
ALTER TABLE `collection_types`
  ADD PRIMARY KEY (`collection_type_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD PRIMARY KEY (`login_id`),
  ADD UNIQUE KEY `login_email` (`login_email`),
  ADD KEY `CusLogin_CusId` (`customer_customerId`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`invoice_id`,`invoice_number`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_has_product`
--
ALTER TABLE `order_has_product`
  ADD PRIMARY KEY (`order_orderId`,`product_productId`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_has_size`
--
ALTER TABLE `product_has_size`
  ADD PRIMARY KEY (`product_productId`,`size_sizeId`),
  ADD UNIQUE KEY `barcode` (`barcode`);

--
-- Indexes for table `product_image`
--
ALTER TABLE `product_image`
  ADD PRIMARY KEY (`img_id`),
  ADD KEY `fk_ProductImg_ProductId` (`product_productId`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `collections`
--
ALTER TABLE `collections`
  MODIFY `collection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `collection_types`
--
ALTER TABLE `collection_types`
  MODIFY `collection_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `customer_login`
--
ALTER TABLE `customer_login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `faq_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_image`
--
ALTER TABLE `product_image`
  MODIFY `img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_login`
--
ALTER TABLE `customer_login`
  ADD CONSTRAINT `CusLogin_CusId` FOREIGN KEY (`customer_customerId`) REFERENCES `customers` (`customer_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_image`
--
ALTER TABLE `product_image`
  ADD CONSTRAINT `fk_ProductImg_ProductId` FOREIGN KEY (`product_productId`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

DELIMITER $$
--
-- Events
--
CREATE DEFINER=`root`@`localhost` EVENT `ClearCart` ON SCHEDULE EVERY 5 SECOND STARTS '2021-09-20 16:28:48' ON COMPLETION NOT PRESERVE ENABLE DO DELETE FROM cart WHERE 
TIMESTAMPDIFF(MINUTE, cart.addTime, CURRENT_TIMESTAMP) >= 60$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
