-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2023 at 06:17 PM
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
-- Database: `pharmazy`
--

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `bid` int(10) NOT NULL,
  `cid` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `bdate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cid` int(10) NOT NULL,
  `uid` int(10) NOT NULL,
  `pid` int(10) NOT NULL,
  `cstatus` varchar(255) NOT NULL,
  `pquan_buy` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `pid` int(10) NOT NULL,
  `pname` varchar(255) NOT NULL,
  `pdetail` text NOT NULL,
  `price` double NOT NULL,
  `ptype` varchar(255) NOT NULL,
  `plike` int(10) NOT NULL,
  `pimg` varchar(255) NOT NULL,
  `pquan_stock` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`pid`, `pname`, `pdetail`, `price`, `ptype`, `plike`, `pimg`, `pquan_stock`) VALUES
(1, 'Blackmores MultiVitamin Active 30 TABS', 'Blackmores แบลคมอร์ส มัลติวิตามิน แอคทีฟ (30 เม็ด) MultiVitamin Active (30 Tab)  คือ วิตามินรวมที่ประกอบด้วย วิตามิน แร่ธาตุ และสารอาหารรวม 23 ชนิด ที่มี ส่วนประกอบของ โคเอนโซม์คิวเทน, ลูทีน,ทอรีน และสารสกัดอาร์ติโชค ช่วยดูแลสุขภาพ เสริมสร้างพลังงานแก่ร่างกาย ต่อต้านอนุมูลอิสระ มีส่วนช่วยในการทำงานของระบบกล้ามเนื้อ เพื่อวัยทำงานที่ต้องการความกระฉับกระเฉง และพร้อมสำหรับการทำงานในแต่ละวัน  ทานครั้งละ 1 เม็ด วันละ 1 ครั้ง หลังอาหาร เช้า ค่ะ', 344.5, 'supplementary-food', 0, 'assets/product/blackmore.jpg', 52),
(2, 'Centrum Dietary Supplement 30 TABS', 'Centrum Dietary Supplement ผลิตภัณฑ์เสริมอาหาร วิตามินและเกลือแร่รวม 22 ชนิด สูตรใหม่ พร้อมเบต้าแคโรทีน ลูทีน และ ไลโคปีน Centrum A to Zinc + Lutein เพราะอาหารและการพักผ่อน ไม่เพียงพอต่อร่างกายจึงควรได้รับอาหารเสริม ประกอบด้วยวิตามินและเกลือแร่รวมถึง 22 ชนิด พร้อมด้วย เบต้า-แคโรทีน, ลูทีน และไลโคปีน ให้วิตามินเอ ในรูปแบบเบต้า-แคโรทีน มีความหลากหลายของวิตามินและเกลือแร่ที่ร่างกายต้องการในแต่ละวัน', 280.34, 'supplementary-food', 0, 'assets/product/centrum.jpg', 23),
(3, 'HOF Colla UC-II 30 TABS', 'HOF Colla UC-II คอลลาเจนสำหรับข้อและกระดูก 30 เม็ด ผลิตภัณฑ์คอลลาเจน ไทพ์ทู สำหรับข้อและกระดูก ช่วยป้องกันการทำลาย และเสริมสร้างกระดูกอ่อนบริเวณข้อต่อ ช่วยลดการอักเสบ และอาการปวดจากข้อกระดูก', 800, 'supplementary-food', 0, 'assets/product/ucii.png', 15),
(4, 'Sara Paracetamol Tablets 500 mg 10 Tab', 'Sara Paracetamol Tablets 500 mg 10 Tab ซาร่า พาราเซตามอล สรรพคุณ ลดไข้ ขนาดและวิธีการใช้:\r\n น้ำหนักน้อยกว่า 34 กก. ให้ปรึกษาแพทย์หรือเภสัชกร\r\n น้ำหนักตั้งแต่ 34 - 50 กินยาครั้งละ 1 เม็ด แต่ละครั้งห่างกันอย่างน้อย 4 ชั่วโมง เฉพาะเวลาปวดหรือมีไข้\r\n น้ำหนักมากกว่า 50 - 67 กินยาครั้งละ หนึ่งเม็ดครึ่ง วันละไม่เกิน 5 ครั้ง แต่ละครั้งห่างกันอย่างน้อย 4 ชั่วโมง เฉพาะเวลาปวดหรือมีไข้\r\n น้ำหนักมากกว่า 67 กินยาครั้งละ 2 เม็ด วันละไม่เกิน 4 ครั้ง แต่ละครั้งห่างกันอย่างน้อย 4 ชั่วโมง เฉพาะเวลาปวดหรือมีไข้', 200.42, 'home-medicine', 0, 'assets/product/sara.jpg', 13),
(5, 'Antacil Gel HH 240 ML', 'Antacil Gel HH แอนตาซิล เยล เอช เอช ลดกรด แสบร้อนกลางอก กรดไหลย้อน ยาสามัญประจำบ้าน สรรพคุณ สำหรับลดกรดและลดแก๊สเคลือบแผลในกระเพาะอาหารและลำไส้เล็กส่วนต้น \r\nบรรเทาอาการปวดท้อง ท้องอืด จุกเสียดแน่น อาหารไม่ย่อย แสบร้อนกลางอกอัน\r\nเนื่องจากกรดไหลย้อนของกรดจากภาวะมีกรดมากเกินในกระเพาะอาหาร\r\nโดยไม่ทำให้เกิดอาการท้องผูก ออกฤทธิ์ภายใน 5 นาที', 55, 'home-medicine', 0, 'assets/product/antacil.png', 36),
(6, 'Eno Orange Flavoured 4.3 g', 'Eno Orange Flavoured อีโน รสส้ม บรรเทาอาการท้องอืด ท้องเฟ้อ 1 ซอง:1 ซอง 4.3 กรัม ลดกรด บรรเทาอาการท้องอืด ท้องเฟ้อเนื่องจากมีกรดมากในกระเพาะอาหาร ขนาดและวิธีใช้\r\nผสมน้ำค่อนแก้วรับประทานหลังหมดฟองฟู่\r\nผู้ใหญ่และเด็กอายุ 12 ปีขึ้นไป ครั้งละ 1 ซอง\r\nรับประทานซ้ำได้อีกภายใน 2 หรือ 3 ชม. ถ้าต้องการ', 15, 'home-medicine', 0, 'assets/product/eno.jpg', 14),
(7, 'CERAVE Foaming Cleanser 236ml.', 'เซราวี CERAVE Foaming Cleanser โฟมทำความสะอาดผิวหน้าและผิวกาย สำหรับผิวธรรมดา-ผิวมัน เป็นสิวง่าย 236ml.(โฟมล้างหน้า) ทำความสะอาดและขจัดความมันส่วนเกินต้นเหตุของการเกิดสิว โดยไม่รบกวนปราการปกป้องผิว ส่วนผสมสำคัญได้แก่ เซราไมด์ที่จำเป็นสามชนิด เสริมเกราะปกป้องผิวแข็งแรง ไฮยาลูโรนิคแอซิด เพื่อผิวชุ่มชื้น และไนอาซินาไมด์ เพื่อลดเลือนรอยแดงจากสิว สูตรปราศจากสบู่ น้ำหอม สูตรไม่ก่อให้เกิดการอุดตัน (Non Comedogenic) และสูตรไฮโปอัลเลอจีนิค ผลิตภัณฑ์ผ่านการทดสอบบนผิวที่บอบบางระคายเคืองง่าย ภายใต้การควบคุมดูแลโดยแพทย์ผู้เชี่ยวชาญทางด้านผิวหนัง และพัฒนาวิจัยค้นคว้าร่วมกับแพทย์ผิวหนัง', 465, 'skin-care', 0, 'assets/product/cerave.jpg', 44);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(10) NOT NULL,
  `u_username` varchar(255) NOT NULL,
  `u_password` varchar(255) NOT NULL,
  `u_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `urole` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `u_username`, `u_password`, `u_name`, `email`, `address`, `phone`, `gender`, `urole`, `create_at`, `avatar`) VALUES
(1, 'user', '$2y$10$WelvYcHgSGg.NgyT2lCGuO3HOIQC.THVE1OoEz91HZ6UFRTpOjRhm', 'user', 'user@user.com', '10/14', '012-345-6789', 'male', 'user', '2023-09-26 20:10:57', '../assets/avatar/261838676_217194513901808_8599102040805275054_n.jpg'),
(2, 'admin', '$2y$10$lNF0/M0uts9Ir6zDeGsdt.37ZCzW6G.5c2aLW7rluMB9M.MmxcDzS', 'admin', 'admin@admin.com', '10/1134', '045-345-2356', 'female', 'admin', '2023-09-26 20:11:36', 'assets/avatar/female.png'),
(3, 'user2', '$2y$10$gDuJhSdxZicFtA.KyInDpuuusPgpuLc5.14.bw3A8hB9axxQp/mwe', 'user2', 'user2@user2.com', '10/1241', '086-231-2344', 'female', 'user', '2023-09-26 20:11:58', 'assets/avatar/female.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bid`),
  ADD KEY `bill_cid` (`cid`),
  ADD KEY `bill_pid` (`pid`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `cart_uid` (`uid`),
  ADD KEY `cart_pid` (`pid`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bill`
--
ALTER TABLE `bill`
  MODIFY `bid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cid` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `pid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bill`
--
ALTER TABLE `bill`
  ADD CONSTRAINT `bill_cid` FOREIGN KEY (`cid`) REFERENCES `cart` (`cid`),
  ADD CONSTRAINT `bill_pid` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_pid` FOREIGN KEY (`pid`) REFERENCES `product` (`pid`),
  ADD CONSTRAINT `cart_uid` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
