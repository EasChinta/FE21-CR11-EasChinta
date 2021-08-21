-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 21, 2021 at 12:25 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fswd13_CR11_PetAdoption_EasChinta`
--
CREATE DATABASE IF NOT EXISTS `fswd13_CR11_PetAdoption_EasChinta` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `fswd13_CR11_PetAdoption_EasChinta`;

-- --------------------------------------------------------

--
-- Table structure for table `animals`
--

CREATE TABLE `animals` (
  `animal_id` int(11) UNSIGNED NOT NULL,
  `location_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(500) NOT NULL,
  `hobbies` varchar(255) NOT NULL,
  `age` varchar(10) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` enum('available','adopted') DEFAULT 'available',
  `type` enum('small','large') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `animals`
--

INSERT INTO `animals` (`animal_id`, `location_id`, `name`, `description`, `hobbies`, `age`, `picture`, `status`, `type`) VALUES
(20, 1, 'Catt', 'dada', 'did', '2', 'https://timesofindia.indiatimes.com/photo/67586673.cms', 'adopted', 'small'),
(21, 1, 'Doggo', 'Hyper', 'run...', '1', 'https://post.medicalnewstoday.com/wp-content/uploads/sites/3/2020/02/322868_1100-800x825.jpg', 'available', 'small'),
(23, 1, 'Freddie', 'Cure boy', 'Playing, running, sleeping', '1', 'https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fstatic.onecms.io%2Fwp-content%2Fuploads%2Fsites%2F28%2F2020%2F10%2F13%2Fcorgi-dog-POPDOGNAME1020.jpg', 'adopted', 'small'),
(24, 1, 'Rexy', 'Rex the police dog', 'Solving crimes', '6', 'https://i.pinimg.com/originals/01/0c/23/010c23f328a5a8cbd2ffbd0a02ef2303.jpg', 'adopted', 'large'),
(25, 1, 'Maya', 'Cute cat ', 'Chilling', '5', 'https://c.files.bbci.co.uk/12A9B/production/_111434467_gettyimages-1143489763.jpg', 'adopted', 'small'),
(26, 1, 'Tom', 'Funny cat', 'Chilling', '9', 'https://icatcare.org/app/uploads/2018/07/Elderly-cats.png', 'available', 'small'),
(27, 1, 'Penny', 'Old Doggo', 'Sleeping around', '12', 'https://tractive.com/blog/wp-content/uploads/2020/02/how-to-deal-with-panting-shaking-seizures-in-old-dogs.jpg', 'adopted', 'large'),
(28, 1, 'Bobby', 'Old doggo', 'Likes to play', '14', 'https://i0.wp.com/www.myolddogbook.com/wp-content/uploads/2015/10/Fiona-cropped.png?fit=516%2C431', 'adopted', 'large'),
(30, 1, 'Hank', 'Very funny boy', 'Sleeping and screaming', '6', 'https://images.unsplash.com/photo-1491604612772-6853927639ef?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTd8fGRvZ3N8ZW58MHx8MHx8&ixlib=rb-1.2.1&w=1000&q=80', 'available', 'large'),
(31, 1, 'Sunshine', 'Garden owners only !', 'Chilling in the sun', '11', 'https://media.istockphoto.com/photos/cat-wearing-sunglasses-outdoors-picture-id1255198816?k=6&m=1255198816&s=612x612&w=0&h=AX5_Zjj9fAKRZ365doxIouG9Q-Rq8DZw0j1JcGmGMpQ=', 'available', 'small'),
(32, 1, 'Ted', 'Loves snuggles 24/7', 'couch potato', '7', 'https://cdn.pixabay.com/photo/2017/11/09/21/41/cat-2934720__340.jpg', 'available', 'small'),
(33, 1, 'Oliver', 'adventurer & explorer', 'out and about a lot', '13', 'https://cdn.pixabay.com/photo/2018/11/29/23/34/cat-3846780__340.jpg', 'available', 'small'),
(34, 1, 'Luna', 'little diva', 'dancing and singing', '2', 'https://cdn.pixabay.com/photo/2014/10/01/10/46/cat-468232__340.jpg', 'available', 'small'),
(35, 1, 'ED Sheeran', 'stubborn little sweetheart', 'snuggles\r\ntreats \r\nbiting toes', '1', 'https://cdn.pixabay.com/photo/2018/05/30/19/29/kitten-3442257__340.jpg', 'adopted', 'small'),
(36, 1, 'Billy', 'always cold\r\nquiet boy', 'Netflix and Chill', '32', 'https://cdn.pixabay.com/photo/2015/06/08/15/02/pug-801826__480.jpg', 'available', 'small'),
(37, 1, 'Cindy & Mindy', 'Sisters\r\nAdoption in pair only!', 'Fighting about treats\r\nrace running', '1', 'https://cdn.pixabay.com/photo/2016/10/31/14/55/rottweiler-1785760__340.jpg', 'available', 'small'),
(38, 1, 'Tigreal', 'adventurer with a kind soul', 'sneaking up on people to scare them', '4', 'https://cdn.pixabay.com/photo/2021/01/30/15/14/akita-5964180__340.jpg', 'available', 'large'),
(39, 1, 'Odette', 'graceful Lady with special demands', 'Staring at Bees', '9', 'https://cdn.pixabay.com/photo/2017/12/29/10/23/nature-3047194_960_720.jpg', 'available', 'large'),
(40, 1, 'Esmeralda', 'Very well trained', 'Jumping', '3', 'https://cdn.pixabay.com/photo/2019/08/30/15/05/dog-4441585__340.jpg', 'available', 'large'),
(41, 1, 'Nana', 'Always here to help with special needs\r\nTrained first aid dog', 'Looking out for kids and owners', '10', 'https://cdn.pixabay.com/photo/2020/05/02/09/59/pup-5120625__340.jpg', 'available', 'small');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) UNSIGNED NOT NULL,
  `city` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `city`, `zip`, `address`) VALUES
(1, 'Vienna', '1030', 'Rennwegstrasse 64/1');

-- --------------------------------------------------------

--
-- Table structure for table `pet_adoption`
--

CREATE TABLE `pet_adoption` (
  `adoption_id` int(11) UNSIGNED NOT NULL,
  `animal_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `date_collected` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pet_adoption`
--

INSERT INTO `pet_adoption` (`adoption_id`, `animal_id`, `user_id`, `date_collected`) VALUES
(32, 24, 15, '2021-08-20'),
(33, 27, 15, '2021-08-20'),
(34, 25, 21, '2021-08-20'),
(35, 26, 27, '2021-08-20'),
(36, 35, 27, '2021-08-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `status` varchar(4) NOT NULL DEFAULT 'user',
  `phone_number` varchar(25) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `password`, `email`, `picture`, `status`, `phone_number`, `address`) VALUES
(8, 'Jim', 'Morrison', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'jim@gmail.com', '6120c8ab3eafb.jpg', 'adm', '43431415', 'USA'),
(15, 'Edward', 'Norton', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'norton@gmail.com', '611ff550e9fee.jpg', 'user', '1231223123', 'USA'),
(21, 'Eas', 'Chinta', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'eas@gmail.com', '6120c31725afc.jpg', 'user', '066801231231', 'AUSTRIA'),
(27, 'Natalie', 'Nats', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'nati@gmail.com', '6120c31f61f69.jpg', 'user', '241254124', 'Vienna'),
(38, 'Maxi', 'L', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'example1@gmail.com', '6120c970edcc8.jpeg', 'user', '123123', 'vienna'),
(39, 'Hank', 'Goodboy', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'hank@gmail.com', '6120cb2d7de76.jpg', 'user', '12323123', 'AMERICA'),
(40, 'Tanja', 'Punkt', '96cae35ce8a9b0244178bf28e4966c2ce1b8385723a96a6b838858cdd6ca0a1e', 'tanja.p@gmx.at', '6120cc498097d.jpg', 'user', '0664565653', 'Lorergasse 8021');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `animals`
--
ALTER TABLE `animals`
  ADD PRIMARY KEY (`animal_id`),
  ADD KEY `location_id` (`location_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD PRIMARY KEY (`adoption_id`),
  ADD KEY `animal_id` (`animal_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `animals`
--
ALTER TABLE `animals`
  MODIFY `animal_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  MODIFY `adoption_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `animals`
--
ALTER TABLE `animals`
  ADD CONSTRAINT `animals_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pet_adoption`
--
ALTER TABLE `pet_adoption`
  ADD CONSTRAINT `pet_adoption_ibfk_1` FOREIGN KEY (`animal_id`) REFERENCES `animals` (`animal_id`),
  ADD CONSTRAINT `pet_adoption_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
