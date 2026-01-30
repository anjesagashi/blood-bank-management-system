-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2026 at 11:41 AM
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
(24, 'Doha Medical Emergency', 'https://telegrafi.com/media-library/2024-11-466483277-1144812930982692-2808601703029753315-n-jpg.jpg?id=58350221&width=980', 'Podujeva, Kosovo', '+383 44 123 456', 'Doha Medical Emergency is a trusted medical center offering safe and professional blood donation services. Our trained staff and modern equipment ensure a secure and comfortable experience for all donors.', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2178.6368220605373!2d21.19682351651736!3d42.89566162127647!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1354af0050a6baf1%3A0xe4c9f1dcc555edd4!2sEmergjenca%20e%20Qytetit!5e0!3m2!1sen!2s!4v1769768371182!5m2!1sen!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade'),
(25, 'QKUK Emergency Center', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQoqkgcuRcb7vfiJQamCdoe1t0eFF1AZdJ1bg&s', 'Prishtine, Kosova', '+38345607602', 'Prishtina Emergency Center', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4088.8582227869742!2d21.15729445595416!3d42.643556439585566!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549e945aaffc69%3A0x5d3cc3761994283e!2sUniversity%20Clinical%20Center%20of%20Kosovo!5e0!3m2!1sen!2s!4v1769769164198!5m2!1sen!2s\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade');

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

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `blood_group_id` int(11) NOT NULL,
  `request_urgency` int(11) NOT NULL,
  `needed_amount_ml` decimal(10,0) DEFAULT NULL,
  `collected_amount` decimal(10,0) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests_urgency`
--

CREATE TABLE `blood_requests_urgency` (
  `id` int(11) NOT NULL,
  `urgency_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_requests_urgency`
--

INSERT INTO `blood_requests_urgency` (`id`, `urgency_name`) VALUES
(3, 'high'),
(1, 'low'),
(2, 'medium');

-- --------------------------------------------------------

--
-- Table structure for table `donation_appointments`
--

CREATE TABLE `donation_appointments` (
  `id` int(11) NOT NULL,
  `donor_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `request_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL DEFAULT 1,
  `amount_ml` int(11) DEFAULT 450,
  `scheduled_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(22, 'donor', 'donor', '2026-01-06', 1);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `is_read` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(22, 'donor123', 'donor@gmail.com', '$2y$10$O7I5ZnFh7ZNw2OJiznP2Le/vaedonP8ep9Bsrjmk.lKISCgVW3EYu', 2),
(24, 'dohapodujeve', 'doha@gmail.com', '$2y$10$o1NJIUC5go.0pZ0FkTKI0.RwOQyRCPP/bu8ktAshKPPi7y16oNV86', 3),
(25, 'qkuk123', 'qkuk@gmail.com', '$2y$10$3Mu5x5zCun8beZ4Bf7xaCeWQzz4xslKmr1fG4nQGxBy9R6LTG6Zy.', 3);

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
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `center_id` (`center_id`),
  ADD KEY `blood_group_id` (`blood_group_id`),
  ADD KEY `request_urgency` (`request_urgency`);

--
-- Indexes for table `blood_requests_urgency`
--
ALTER TABLE `blood_requests_urgency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `urgency_name` (`urgency_name`);

--
-- Indexes for table `donation_appointments`
--
ALTER TABLE `donation_appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `donor_id` (`donor_id`),
  ADD KEY `center_id` (`center_id`),
  ADD KEY `request_id` (`request_id`),
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `blood_groups`
--
ALTER TABLE `blood_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blood_inventory`
--
ALTER TABLE `blood_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blood_requests_urgency`
--
ALTER TABLE `blood_requests_urgency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `donation_appointments`
--
ALTER TABLE `donation_appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `donors`
--
ALTER TABLE `donors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- Constraints for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD CONSTRAINT `blood_requests_ibfk_1` FOREIGN KEY (`center_id`) REFERENCES `blood_centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blood_requests_ibfk_2` FOREIGN KEY (`blood_group_id`) REFERENCES `blood_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `blood_requests_ibfk_3` FOREIGN KEY (`request_urgency`) REFERENCES `blood_requests_urgency` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `donation_appointments`
--
ALTER TABLE `donation_appointments`
  ADD CONSTRAINT `donation_appointments_ibfk_1` FOREIGN KEY (`donor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_appointments_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `blood_centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `donation_appointments_ibfk_3` FOREIGN KEY (`request_id`) REFERENCES `blood_requests` (`id`) ON DELETE SET NULL,
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
