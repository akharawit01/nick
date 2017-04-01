-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 11, 2017 at 05:36 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nick`
--

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

CREATE TABLE `catagory` (
  `id` smallint(6) NOT NULL,
  `parent` smallint(6) NOT NULL,
  `name` varchar(150) COLLATE utf32_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`id`, `parent`, `name`, `created_at`, `updated_at`) VALUES
(2, 0, 'กระเบื้องผนัง', '2017-02-08 14:43:13', '2017-02-08 14:43:13'),
(5, 0, 'กระเบื้องพื้น', '2017-02-08 14:44:00', '2017-02-08 14:44:00'),
(6, 5, 'กระเบื้องพื้นภายนอก', '2017-02-08 14:44:09', '2017-02-08 14:44:09'),
(7, 5, 'กระเบื้องพื้นภายใน', '2017-02-08 14:44:16', '2017-02-08 14:44:16'),
(8, 2, 'กระเบื้องกลม', '2017-02-10 15:19:58', '2017-02-10 15:19:58'),
(9, 2, 'กระเบื้องพื้นทราย', '2017-02-10 15:20:05', '2017-02-10 15:20:05');

-- --------------------------------------------------------

--
-- Table structure for table `contactus`
--

CREATE TABLE `contactus` (
  `id` int(11) NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `news_id` int(11) NOT NULL,
  `news_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_detail` text COLLATE utf8_unicode_ci NOT NULL,
  `news_cover` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `news_gallery` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `news_sort` smallint(6) NOT NULL,
  `news_display` smallint(6) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`news_id`, `news_title`, `news_detail`, `news_cover`, `news_gallery`, `news_sort`, `news_display`, `created_at`) VALUES
(4, 'THE START OF THE WEB AND WEB DESIGN', '<p><span style="background-color:rgb(255, 255, 255); color:rgb(51, 51, 51); font-family:prompt,sans-serif; font-size:14px">If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden...</span></p>\r\n', '3cab851de1be16815016d01ad6ba0b1e.jpg', '13cab851de1be16815016d01ad6ba0b1e.jpg', 0, 0, '2017-02-08 15:13:28'),
(5, 'substr คือ คำสั่งตัดคำบนภาษา PHP ', '<p><strong>substr คือ</strong>&nbsp;คำสั่งตัดคำบนภาษา PHP ซึ่งมีประโยชน์อย่างมากเวลาที่เราต้องการตัดคำในบางคำจากประโยคเต็ม ๆ&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong>ภาพรวมของคำสั่ง substr php</strong></p>\r\n\r\n<p>1. ใช้สำหรับตัดคำจากประโยคเต็ม ๆ</p>\r\n\r\n<p>2. มีค่า Parameter ที่สำคัญ 3 ค่า คือ ประโยค, เริ่มตัดคำ และจำนวนการตัดคำ</p>\r\n', '0c3e5b3296dfe49bee0fb3d52f7e4e58.jpg', '10c3e5b3296dfe49bee0fb3d52f7e4e58.jpg', 0, 0, '2017-02-10 19:25:10');

-- --------------------------------------------------------

--
-- Table structure for table `photoslide`
--

CREATE TABLE `photoslide` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display` smallint(6) NOT NULL,
  `sort` smallint(6) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photoslide`
--

INSERT INTO `photoslide` (`id`, `name`, `display`, `sort`, `created_at`) VALUES
(4, '0706967daaba4e8e0bca94af99909a055.jpg', 0, 0, '2017-02-08'),
(5, '12b79289e022bec3877b867649749a31e.jpg', 0, 0, '2017-02-08');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `code` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `catagory` int(11) NOT NULL,
  `branch` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `size` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `material` varchar(200) COLLATE utf32_unicode_ci NOT NULL COMMENT 'วัสดุ',
  `faceskin` varchar(200) COLLATE utf32_unicode_ci NOT NULL COMMENT 'ผิวหน้า',
  `color` varchar(200) COLLATE utf32_unicode_ci NOT NULL COMMENT 'สี',
  `pattern` varchar(200) COLLATE utf32_unicode_ci NOT NULL COMMENT 'ลวดลาย',
  `usingpro` varchar(200) COLLATE utf32_unicode_ci NOT NULL COMMENT 'การใช้งาน',
  `packingboxes` varchar(200) COLLATE utf32_unicode_ci NOT NULL COMMENT 'ขนาดบรรจุต่อกล่อง',
  `detail` text COLLATE utf32_unicode_ci NOT NULL COMMENT 'รายละเอียดเพิ่มเติม',
  `cover` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `discount` smallint(6) NOT NULL,
  `display` tinyint(4) NOT NULL,
  `sort` smallint(6) NOT NULL,
  `display_index` tinyint(4) NOT NULL,
  `create_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `code`, `name`, `catagory`, `branch`, `size`, `material`, `faceskin`, `color`, `pattern`, `usingpro`, `packingboxes`, `detail`, `cover`, `price`, `discount`, `display`, `sort`, `display_index`, `create_time`) VALUES
(23, 'DD0128', 'NotZa11', 6, 'อโลฮ่า', '40 x 40', 'เซรามิก', 'หน้าหยาบ', 'น้ำตาล', 'กลุ่มลายกราฟฟิค', 'ปูพื้นภายนอก', '9', '', 'efe324ab849070efbd3aadaafff001de.jpg', '55.00', 0, 0, 0, 0, '2017-02-09 14:29:03'),
(24, 'AF1101', 'กราเวลเนเชอรัล KD A', 7, 'DURAGRES', '16X16', 'เซรามิก', 'หิน', 'น้ำตาล', 'หิน', 'ปูพื้น', '6', '<p>กระเบื้อง พื้น 16X16 กราเวลเนเชอรัล KD A</p>\r\n\r\n<ul>\r\n	<li>ชื่อรหัสสินค้า :KD-160 กราเวล เนเชอรัล</li>\r\n	<li>ประเภทกระเบื้อง :กระเบื้องเคลือบ</li>\r\n	<li>การใช้งาน :ปูพื้น</li>\r\n	<li>ขนาด :16 x 16 นิ้ว&nbsp;</li>\r\n	<li>ผิวหน้า :ผิวมัน</li>\r\n	<li>สี :น้ำตาล</li>\r\n	<li>ประเภทลาย :หิน</li>\r\n	<li>การบรรจุต่อกล่อง :6 แผ่น</li>\r\n	<li>พื้นที่ต่อกล่องโดยประมาณ&nbsp;1 ตร.ม</li>\r\n	<li>กระเบื้องแต่ละแผ่นภายในกล่องจะ Random สีเป็นเทคนิคการนำภาพจริงลงมาพิมบนกระเบื้อง สีสันสดใสลักษณะจำเพาะของดูราเกรส</li>\r\n</ul>\r\n', '08fc58e5677fe5b8bc4ef56f5739a16b.jpg', '299.00', 0, 0, 0, 0, '2017-02-10 15:00:27'),
(25, '308922', 'NotZa11', 8, 'อโลฮ่า', '40 x 40', 'เซรามิก', 'หน้าหยาบ', 'น้ำตาล', 'กลุ่มลายกราฟฟิค', 'ปูพื้นภายนอก', '9', '', 'dc68134e598b92eebe8f91248449e878.jpg', '169.00', 10, 0, 0, 0, '2017-02-10 19:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `producttag`
--

CREATE TABLE `producttag` (
  `id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `t_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `producttag`
--

INSERT INTO `producttag` (`id`, `p_id`, `t_id`) VALUES
(26, 23, 3),
(27, 23, 2),
(32, 24, 3),
(33, 24, 2),
(34, 25, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf32_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `tag`
--

INSERT INTO `tag` (`id`, `name`) VALUES
(2, 'เหล็ก'),
(3, 'หลังคา');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf32_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf32_unicode_ci NOT NULL,
  `fname` varchar(150) COLLATE utf32_unicode_ci NOT NULL,
  `lname` varchar(150) COLLATE utf32_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `branch` varchar(200) COLLATE utf32_unicode_ci NOT NULL,
  `acompanytaxid` varchar(150) COLLATE utf32_unicode_ci NOT NULL,
  `address` text COLLATE utf32_unicode_ci NOT NULL,
  `province` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf32_unicode_ci NOT NULL,
  `postcode` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `tel` varchar(100) COLLATE utf32_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `create_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `fname`, `lname`, `company`, `branch`, `acompanytaxid`, `address`, `province`, `country`, `postcode`, `tel`, `type`, `create_time`) VALUES
(1, 'admin@admin.com', '1234', 'อัครวิทย์', 'อาญาคำ', 'admin1', 'อโลฮ่า', 'admin1', 'สันป่าสัก', 'เชียงใหม่', 'Thailand', '50150', '+66844067469', 0, '2017-02-08 00:00:00'),
(2, 'akharawitbuzzwoo@gmail.com', '11111111', 'อัครวิทย์', 'อาญาคำ', '', '', '', 'สันป่าสัก', 'เชียงใหม่', 'Thailand', '50150', '+66844067469', 1, '2017-02-09 14:48:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `catagory`
--
ALTER TABLE `catagory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contactus`
--
ALTER TABLE `contactus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `photoslide`
--
ALTER TABLE `photoslide`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producttag`
--
ALTER TABLE `producttag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `catagory`
--
ALTER TABLE `catagory`
  MODIFY `id` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `contactus`
--
ALTER TABLE `contactus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `photoslide`
--
ALTER TABLE `photoslide`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `producttag`
--
ALTER TABLE `producttag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tag`
--
ALTER TABLE `tag`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
