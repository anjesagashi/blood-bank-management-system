-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2026 at 07:19 PM
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
-- Database: `blood_bank_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment_statuses`
--

CREATE TABLE `appointment_statuses` (
  `id` int(11) NOT NULL,
  `status_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_statuses`
--

INSERT INTO `appointment_statuses` (`id`, `status_name`) VALUES
(2, 'Approved'),
(4, 'Cancelled'),
(3, 'Completed'),
(1, 'Pending'),
(5, 'Rejected');

-- --------------------------------------------------------

--
-- Table structure for table `blood_centers`
--

CREATE TABLE `blood_centers` (
  `id` int(11) NOT NULL,
  `center_name` varchar(100) NOT NULL,
  `img_src` varchar(255) DEFAULT NULL,
  `city` varchar(100) NOT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `map_link` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_centers`
--

INSERT INTO `blood_centers` (`id`, `center_name`, `img_src`, `city`, `phone_number`, `description`, `map_link`) VALUES
(42, 'Doha Medical Center', 'https://telegrafi.com/media-library/2024-11-466483277-1144812930982692-2808601703029753315-n-jpg.jpg?id=58350221&width=980', 'Podujeve, Kosova', '+38345123456', 'Doha Medical Emergency Center provides fast and reliable care for patients in urgent medical situations. Our expert team ensures compassionate and effective treatment, 24/7.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2178.6368220605373!2d21.19682351651736!3d42.89566162127647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1354af0050a6baf1%3A0xe4c9f1dcc555edd4!2sEmergjenca%20e%20Qytetit!5e0!3m2!1sen!2s!4v1769768371182!5m2!1sen!2s'),
(45, 'QKUK Emergency Center', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoqkgcuRcb7vfiJQamCdoe1t0eFF1AZdJ1bg&s', 'Prishtine, Kosova', '+383 45 123 456', 'QKUK Emergency Center offers immediate and expert care for all critical medical cases. Our dedicated team works around the clock to provide fast and reliable treatment.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4088.8582227869742!2d21.15729445595416!3d42.643556439585566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549e945aaffc69%3A0x5d3cc3761994283e!2sUniversity%20Clinical%20Center%20of%20Kosovo!5e0!3m2!1sen!2s!4v1769769164198!5m2!1sen!2s');

-- --------------------------------------------------------

--
-- Table structure for table `blood_groups`
--

CREATE TABLE `blood_groups` (
  `id` int(11) NOT NULL,
  `group_name` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_groups`
--

INSERT INTO `blood_groups` (`id`, `group_name`) VALUES
(1, 'A+'),
(2, 'A-'),
(7, 'AB+'),
(8, 'AB-'),
(3, 'B+'),
(4, 'B-'),
(5, 'O+'),
(6, 'O-');

-- --------------------------------------------------------

--
-- Table structure for table `blood_inventory`
--

CREATE TABLE `blood_inventory` (
  `id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `blood_group_id` int(11) NOT NULL,
  `quantity_ml` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_inventory`
--

INSERT INTO `blood_inventory` (`id`, `center_id`, `blood_group_id`, `quantity_ml`) VALUES
(1, 42, 1, 400),
(2, 45, 1, 370);

-- --------------------------------------------------------

--
-- Table structure for table `donation_appointments`
--

CREATE TABLE `donation_appointments` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `amount_ml` int(11) DEFAULT 450,
  `scheduled_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donation_appointments`
--

INSERT INTO `donation_appointments` (`id`, `donor_id`, `center_id`, `status_id`, `amount_ml`, `scheduled_date`, `created_at`) VALUES
(1, 41, 42, 4, 360, '2026-01-31', '2026-01-31 17:58:36'),
(2, 41, 42, 2, 400, '2026-02-04', '2026-01-31 18:00:33'),
(3, 41, 42, 3, 400, '2026-01-31', '2026-01-31 18:01:50'),
(4, 41, 45, 3, 370, '2026-01-31', '2026-01-31 18:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `donors`
--

CREATE TABLE `donors` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `blood_group_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donors`
--

INSERT INTO `donors` (`id`, `first_name`, `last_name`, `birthdate`, `blood_group_id`) VALUES
(41, 'User1', 'user', '2026-01-05', 1),
(46, 'User', 'User', '2010-01-05', 4);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) DEFAULT NULL,
  `message_text` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `message_text`, `subject`, `is_read`, `created_at`) VALUES
(4, 41, NULL, 'Dear Admin,\r\n\r\nI am writing to ask about the current requirements for blood donation. I recently traveled abroad and wanted to confirm if there is a waiting period before I can donate again.\r\n\r\nAlso, could you please provide the working hours for the main center this coming Friday?\r\n\r\nBest regards,\r\n\r\nJohn Doe', 'Inquiry regarding blood donation eligibility', 0, '2026-01-31 11:58:03'),
(5, 38, 41, 'Dear Donor,\r\n\r\nThank you for reaching out to us.\r\n\r\nRegarding your travel, generally, there is a waiting period of 28 days if you have visited areas with specific health alerts, but we would need to check the specific country. As for our working hours, the main center is open this Friday from 8:00 AM to 6:00 PM.\r\n\r\nPlease make sure to bring a valid ID and ensure you are well-hydrated before coming.\r\n\r\nBest regards, Blood Bank Administration', 'Re: Inquiry regarding blood donation eligibility', 0, '2026-01-31 11:58:53'),
(6, 38, 41, 'Dear John,\r\n\r\nThank you for your interest in donating!\r\n\r\nTravel: Most international travel requires a 28-day waiting period before you can donate. We will confirm your eligibility through a quick screening on-site.\r\n\r\nWorking Hours: Our main center is open this Friday from 08:00 to 18:00.\r\n\r\nPlease remember to bring your ID and stay hydrated. You can update any of your details anytime via your LifeFlow profile.\r\n\r\nBest regards,\r\n\r\nLifeFlow Admin', 'Re: Inquiry regarding blood donation eligibility', 0, '2026-01-31 14:16:28');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`) VALUES
(1, 'admin'),
(2, 'user'),
(3, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role_id`) VALUES
(38, 'admin', 'admin@gmail.com', '$2y$10$HY2fu7F.OcVddiAAkc5PwerrxHCRJ/He2TnMJBpKsa1YcnWxx0lni', 1),
(40, 'admin2', 'admin2@gmail.com', '$2y$10$0VF3i/9OQdnKuCsSukpEVe8Zf6NAgLfwv1nihGn5Maz7XmoclIofK', 1),
(41, 'user1', 'user1@gmail.com', '$2y$10$b4BfN.y54kIxc07f.oFBcekketmLv6CTg8k.xQ2BTdK.sgGfCQGP2', 2),
(42, 'doha', 'doha@gmail.com', '$2y$10$OrlcSzl2b39DBo6yUJKN1.oGaMQEMhv4NoPy3uyNiMvR1Al14bauu', 3),
(45, 'qkuk', 'qkuk@gmail.com', '$2y$10$2J5OjWAsACumw9bOid9h/.E.maCPpU1PBiz3t7RCvukFlsYtPCx/K', 3),
(46, 'user2', 'user2@gmail.com', '$2y$10$rfHmvMSJ/YEpyFAWJIl2deakQ5F6e1RDwGI0gkIXZkBdAjDqAVlIe', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment_statuses`
--
ALTER TABLE `appointment_statuses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `status_name` (`status_name`);

--
-- Indexes for table `blood_centers`
--
ALTER TABLE `blood_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood_groups`
--
ALTER TABLE `blood_groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_name` (`group_name`);

--
-- Indexes for table `blood_inventory`
--
ALTER TABLE `blood_inventory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_stock` (`center_id`,`blood_group_id`),
  ADD KEY `blood_group_id` (`blood_group_id`);

--
-- Indexes for table `donation_appointments`
--
ALTER TABLE `donation_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `center_id` (`center_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `donors`
--
ALTER TABLE `donors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blood_group_id` (`blood_group_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment_statuses`
--
ALTER TABLE `appointment_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blood_centers`
--
ALTER TABLE `blood_centers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blood_inventory`
--
ALTER TABLE `blood_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `donation_appointments`
--
ALTER TABLE `donation_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blood_centers`
--
ALTER TABLE `blood_centers`
  ADD CONSTRAINT `fk_blood_centers` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `blood_inventory`
--
ALTER TABLE `blood_inventory`
  ADD CONSTRAINT `blood_inventory_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `blood_centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blood_inventory_ibfk_2` FOREIGN KEY (`blood_group_id`) REFERENCES `blood_groups` (`id`);

--
-- Constraints for table `donation_appointments`
--
ALTER TABLE `donation_appointments`
  ADD CONSTRAINT `donation_appointments_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_appointments_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `blood_centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_appointments_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `appointment_statuses` (`id`);

--
-- Constraints for table `donors`
--
ALTER TABLE `donors`
  ADD CONSTRAINT `donors_ibfk_2` FOREIGN KEY (`blood_group_id`) REFERENCES `blood_groups` (`id`),
  ADD CONSTRAINT `fk_donor_users` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
