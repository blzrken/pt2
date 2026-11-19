CREATE DATABASE IF NOT EXISTS `a223536`;
USE `a223536`;

-- 1. PRODUCTS TABLE
CREATE TABLE IF NOT EXISTS `tbl_products_a223536` (
  `fld_product_num` varchar(255) NOT NULL,
  `fld_product_name` varchar(255) NOT NULL,
  `fld_product_price` float NOT NULL,
  `fld_product_brand` varchar(255) NOT NULL,
  `fld_product_screen_type` varchar(255) NOT NULL,
  `fld_product_storage` varchar(255) NOT NULL,
  `fld_product_quantity` int NOT NULL,
  `fld_product_image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fld_product_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_products_a223536` (`fld_product_num`,`fld_product_name`,`fld_product_price`,`fld_product_brand`,`fld_product_screen_type`,`fld_product_storage`,`fld_product_quantity`,`fld_product_image`) VALUES
('P001','Kindle Paperwhite (11th Gen)',649.00,'Amazon Kindle','E-Ink Carta','16 GB',10,'P001.jpg'),
('P002','Kobo Clara Colour',749.00,'Kobo','E-Ink Kaleido','16 GB',8,'P002.jpg'),
('P003','reMarkable Paper Tablet',1899.00,'reMarkable','Canvas Paper Display','8 GB',5,'P003.jpg'),
('P004','Kobo Libra Colour',1099.00,'Kobo','E-Ink Kaleido','32 GB',7,'P004.jpg'),
('P005','Kindle Oasis (10th Gen)',1199.00,'Amazon Kindle','E-Ink Carta','32 GB',4,'P005.jpg'),
('P006','PocketBook Era Color',1249.00,'PocketBook','E-Ink Kaleido','32 GB',6,'P006.jpg'),
('P007','Sony Digital Paper DPT-RP1',2899.00,'Sony Reader','Canvas Paper Display','16 GB',2,'P007.jpg'),
('P008','Barnes & Noble NOOK GlowLight 4e',499.00,'Barnes & Noble','E-Ink Carta','8 GB',12,'P008.jpg'),
('P009','Kindle Scribe',1799.00,'Amazon Kindle','E-Ink Carta','64 GB',5,'P009.jpg'),
('P010','Kobo Elipsa 2E',1699.00,'Kobo','E-Ink Carta','32 GB',3,'P010.jpg'),
('P011','PocketBook InkPad Color 3',1499.00,'PocketBook','E-Ink Kaleido','32 GB',6,'P011.jpg'),
('P012','reMarkable 2',2199.00,'reMarkable','Canvas Paper Display','8 GB',4,'P012.jpg'),
('P013','Kindle Basic (2024)',459.00,'Amazon Kindle','E-Ink Carta','16 GB',15,'P013.jpg'),
('P014','Kobo Sage',1399.00,'Kobo','E-Ink Carta','32 GB',5,'P014.jpg'),
('P015','Sony Reader PRS-T3',349.00,'Sony Reader','E-Ink Carta','8 GB',3,'P015.jpg'),
('P016','Barnes & Noble NOOK GlowLight 4 Plus',899.00,'Barnes & Noble','E-Ink Carta','32 GB',6,'P016.jpg'),
('P017','PocketBook Verse Pro',799.00,'PocketBook','E-Ink Carta','16 GB',9,'P017.jpg'),
('P018','PocketBook InkPad Eo',2499.00,'PocketBook','E-Ink Kaleido','64 GB',2,'P018.jpg'),
('P019','Kindle Paperwhite Signature Edition',799.00,'Amazon Kindle','E-Ink Carta','32 GB',8,'P019.jpg'),
('P020','Kobo Nia',429.00,'Kobo','E-Ink Carta','8 GB',11,'P020.jpg')
ON DUPLICATE KEY UPDATE `fld_product_name`=`fld_product_name`;

-- 2. CUSTOMERS TABLE
CREATE TABLE IF NOT EXISTS `tbl_customers_a223536` (
  `fld_customer_num` varchar(255) NOT NULL,
  `fld_customer_name` varchar(255) DEFAULT NULL,
  `fld_customer_gender` varchar(255) DEFAULT NULL,
  `fld_customer_phone` varchar(255) DEFAULT NULL,
  `fld_customer_register_date` date DEFAULT NULL,
  PRIMARY KEY (`fld_customer_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_customers_a223536` (`fld_customer_num`,`fld_customer_name`,`fld_customer_gender`,`fld_customer_phone`,`fld_customer_register_date`) VALUES
('C001','Ahmad Faizal','Male','+60123456701','2023-01-15'),
('C002','Siti Nurhaliza','Female','+60123456702','2023-01-22'),
('C003','Lim Wei Jie','Male','+60123456703','2023-02-03'),
('C004','Nur Aisyah','Female','+60123456704','2023-02-18'),
('C005','Rajesh Kumar','Male','+60123456705','2023-03-05'),
('C006','Tan Mei Ling','Female','+60123456706','2023-03-19'),
('C007','Muhammad Hafiz','Male','+60123456707','2023-04-02'),
('C008','Priya Devi','Female','+60123456708','2023-04-21'),
('C009','Wong Chee Keong','Male','+60123456709','2023-05-10'),
('C010','Farah Hanim','Female','+60123456710','2023-05-27')
ON DUPLICATE KEY UPDATE `fld_customer_name`=`fld_customer_name`;

-- 3. STAFFS TABLE
CREATE TABLE IF NOT EXISTS `tbl_staffs_a223536` (
  `fld_staff_num` varchar(255) NOT NULL,
  `fld_staff_name` varchar(255) DEFAULT NULL,
  `fld_staff_phone` varchar(255) DEFAULT NULL,
  `fld_staff_email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fld_staff_num`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_staffs_a223536` (`fld_staff_num`,`fld_staff_name`,`fld_staff_phone`,`fld_staff_email`) VALUES
('S001','Daniel Wong','+60123456801','daniel.wong@example.com'),
('S002','Aminah Yusof','+60123456802','aminah.yusof@example.com'),
('S003','Kumar Selvam','+60123456803','kumar.selvam@example.com'),
('S004','Michelle Chia','+60123456804','michelle.chia@example.com'),
('S005','Hafiz Rahman','+60123456805','hafiz.rahman@example.com')
ON DUPLICATE KEY UPDATE `fld_staff_name`=`fld_staff_name`;

-- 4. ORDERS TABLE
CREATE TABLE IF NOT EXISTS `tbl_orders_a223536` (
  `fld_order_num` int NOT NULL AUTO_INCREMENT,
  `fld_order_date` date DEFAULT NULL,
  `fld_staff_num` varchar(255) DEFAULT NULL,
  `fld_customer_num` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`fld_order_num`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_orders_a223536` (`fld_order_num`,`fld_order_date`,`fld_staff_num`,`fld_customer_num`) VALUES
(1,'2023-11-01','S001','C001'),
(2,'2023-11-03','S002','C003'),
(3,'2023-11-05','S003','C005'),
(4,'2023-11-08','S004','C007'),
(5,'2023-11-12','S005','C009')
ON DUPLICATE KEY UPDATE `fld_order_date`=`fld_order_date`;

-- 5. ORDER DETAILS TABLE
CREATE TABLE IF NOT EXISTS `tbl_orders_details_a223536` (
  `fld_order_detail_num` int NOT NULL AUTO_INCREMENT,
  `fld_order_num` varchar(255) NOT NULL,
  `fld_product_num` varchar(255) NOT NULL,
  `fld_order_detail_quantity` int DEFAULT NULL,
  PRIMARY KEY (`fld_order_detail_num`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbl_orders_details_a223536` (`fld_order_num`,`fld_product_num`,`fld_order_detail_quantity`)
SELECT seed.order_num, seed.product_num, seed.quantity
FROM (
  SELECT '1' AS order_num, 'P001' AS product_num, 2 AS quantity
  UNION ALL SELECT '1', 'P007', 1
  UNION ALL SELECT '2', 'P004', 3
  UNION ALL SELECT '3', 'P011', 2
  UNION ALL SELECT '4', 'P002', 1
  UNION ALL SELECT '4', 'P015', 1
  UNION ALL SELECT '5', 'P008', 2
) AS seed
WHERE NOT EXISTS (
  SELECT 1 FROM `tbl_orders_details_a223536` AS detail
  WHERE detail.fld_order_num = seed.order_num AND detail.fld_product_num = seed.product_num
);
