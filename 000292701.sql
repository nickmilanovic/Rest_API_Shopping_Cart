-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2022 at 09:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `000292701`
--

-- --------------------------------------------------------

--
-- Table structure for table `product_list`
--

CREATE TABLE `product_list` (
  `product_id` int(1) NOT NULL,
  `product_name` varchar(30) DEFAULT NULL,
  `product_category` varchar(15) DEFAULT NULL,
  `product_description` varchar(100) DEFAULT NULL,
  `product_price` double DEFAULT NULL,
  `product_quantity` int(11) DEFAULT NULL,
  `product_cart_quantity` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_list`
--

INSERT INTO `product_list` (`product_id`, `product_name`, `product_category`, `product_description`, `product_price`, `product_quantity`, `product_cart_quantity`) VALUES
(1, 'HOOD', 'BODY', 'Hood of engine bay. The hinged cover over the engine.', 1999.99, 1, 0),
(2, 'WHEEL', 'BODY', 'Standard wheel, tire not included', 599.99, 9, 0),
(3, 'FENDER', 'BODY', 'Aftermarket fibreglass fender', 649.99, 3, 0),
(4, 'WINDSHIELD', 'BODY', 'Safety rated windshield. Guaranteed 10 year lifetime.', 999.99, 2, 0),
(5, 'HEADLIGHT', 'BODY', 'Standard rated LED headlights.', 199.99, 13, 0),
(6, 'FULL ENGINE', 'ENGINE', 'Complete transport truck engine 14.8L, 6 cylinders, 560 HP.', 10999.99, 1, 0),
(7, 'PISTONS', 'ENGINE', 'Component of the engine. Transformation of heat energy into mechanical work.', 9999.99, 2, 0),
(8, 'FUEL PUMP', 'ENGINE', 'Aluminum fuel pump used for fuel injector.', 6999.99, 0, 0),
(9, 'TRANSMISSION', 'ENGINE', 'Complete transmission system for transport truck.', 4999.99, 2, 0),
(10, 'INJECTORS', 'ENGINE', 'Carbon injector connected to fuel pump.', 2999.99, 4, 0),
(11, 'AUXILIARY POWER UNIT', 'ACCESSORY', 'Alternate power supply to use while truck is off.', 12999.99, 1, 0),
(12, 'INVERTER', 'ACCESSORY', 'Convert 24VDC to 120VAC.', 299.99, 5, 0),
(13, 'MICROWAVE', 'ACCESSORY', 'Standard microwave.', 99.99, 2, 0),
(14, 'REMOVABLE STOVE', 'ACCESSORY', 'Stove can be removed from truck and is portable.', 349.99, 3, 0),
(15, 'OUTSIDE LIGHT', 'ACCESSORY', 'Light to assist for trailer hitching when dark.', 199.99, 10, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_list`
--
ALTER TABLE `product_list`
  ADD PRIMARY KEY (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_list`
--
ALTER TABLE `product_list`
  MODIFY `product_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
