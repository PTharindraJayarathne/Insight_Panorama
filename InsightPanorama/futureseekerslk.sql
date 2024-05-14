-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 07, 2021 at 03:46 AM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `futureseekerslk`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `logo_dir` varchar(100) DEFAULT NULL,
  `contactNo` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `logo_dir`, `contactNo`, `email`) VALUES
(13, 'Daraz', '1638844809_32bde0883cbdba5d079d', '07442424564', 'Daraz@gmail.com'),
(14, 'Tech-Mart', '1638627816_99f4b834989e0f237c53.jpeg', '0756434567', 'techmart@gmail.com'),
(15, 'NextGen Solutions', NULL, NULL, NULL),
(16, 'Ceylon Traders', '1637398523_9c1bd4e6420ebd4be0b5.png', '01129487600', 'ceylontrade@gmail.com'),
(17, 'Digimail', '', '', ''),
(18, 'Crypto-Z', NULL, NULL, NULL),
(19, 'Clothing-Line', NULL, NULL, NULL),
(20, 'Brandiing', NULL, NULL, NULL),
(21, 'Horizon-Ware', '1638008160_acc401e612808d95a74c.jpg', '941124587954', 'cloudrevel@gmail.com'),
(22, 'Star Labs', '1637562396_ab977402979431dc8653.png', '941124578943', 'starlabs@gmail.com'),
(23, 'Rockstar Games', '1638005958_1d1e4ad1d8b0fb2b8b29.png', '0754567894', 'Rockstar@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` int(10) NOT NULL,
  `company_id` int(10) NOT NULL,
  `user_account_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `jobPosition` varchar(20) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `company_id`, `user_account_id`, `name`, `contactNo`, `jobPosition`, `email`) VALUES
(18, 13, 33, 'Adele Sanchez', '713388997', 'Junior HR Manager', 'mkavinkumarnaidu@gmail.com'),
(19, 14, 34, 'Bruce Jensen', '12338528465', 'HR Manager', 'bruce@gmail.com'),
(20, 15, 35, 'Marny Johns', '+1 (843) 778-7111', 'HR Manager', 'marny@gmail.com'),
(21, 16, 36, 'Zachery Saunders', '94785431829', 'Assistant HR Manager', 'zach@gmail.com'),
(22, 17, 37, 'Lionel Preston', '+1 (785) 414-6764', 'Senior HRM', 'lio@gmail.com'),
(23, 18, 38, 'Grant Wise', '+1 (235) 746-6062', 'HRM', 'wise@gmail.com'),
(24, 19, 39, 'Richard Kline', '+1 (101) 729-4626', 'Senior HRM', 'kline@gmail.com'),
(25, 20, 40, 'Dawn Adams', '+1 (679) 689-9951', 'HR Manager', 'adams@gmail.com'),
(26, 21, 42, 'Bill Kent', '94784519657', 'Assistant HRM', 'bill@gmail.com'),
(27, 22, 44, 'Eobard Thawne', '94784515752', 'Senior HR Manager', 'thawne@gmail.com'),
(28, 23, 45, 'Arthur Morgan', '712345678', 'Senior HR', 'Arthurmorgan@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_jobdetails`
--

CREATE TABLE `jobseeker_jobdetails` (
  `job_seeker_id` int(10) NOT NULL,
  `job_details_id` int(10) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `cv_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobseeker_jobdetails`
--

INSERT INTO `jobseeker_jobdetails` (`job_seeker_id`, `job_details_id`, `dateTime`, `cv_name`) VALUES
(17, 11, '2021-12-07 08:11:43', '1638844890_32a300b55d66473712a9.pdf'),
(17, 14, '2021-12-03 09:33:19', '1638503968_ba474a6ac0e92c8bdac0.pdf'),
(17, 20, '2021-12-03 09:30:49', '1638503968_ba474a6ac0e92c8bdac0.pdf'),
(17, 22, '2021-12-07 08:07:33', '1638615004_f24844f67dcb3b8d1190.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `job_details`
--

CREATE TABLE `job_details` (
  `id` int(10) NOT NULL,
  `employer_id` int(10) NOT NULL,
  `jobCategory` varchar(20) NOT NULL,
  `salary` double DEFAULT NULL,
  `closingDate` datetime NOT NULL DEFAULT current_timestamp(),
  `experience` varchar(20) NOT NULL,
  `typeOfEmployment` varchar(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `jobtitle` varchar(100) NOT NULL,
  `location` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_details`
--

INSERT INTO `job_details` (`id`, `employer_id`, `jobCategory`, `salary`, `closingDate`, `experience`, `typeOfEmployment`, `description`, `dateTime`, `status`, `jobtitle`, `location`) VALUES
(7, 18, 'HHHHH', 123123, '2021-12-11 17:55:00', 'Below 2', 'Fulltime', '1637821340_360b9cd86c7ece44b3c4.pdf', '2021-11-25 11:52:20', 0, 'GGGGG', ''),
(8, 18, 'Accounting', 0, '2021-12-11 05:10:00', '5+', 'Parttime', '1637822161_b6a15cb0e8155703571f.pdf', '2021-11-25 12:06:01', 2, 'Senior Accountant', ''),
(9, 18, 'IT', 123123, '2021-12-11 06:03:00', 'Below 2 years', 'Fulltime', '1637825272_d0e0c1a3ff1ab8d50d5d.pdf', '2021-11-25 12:57:52', 1, 'Nurse', ''),
(10, 18, 'Academic', 0, '2021-12-11 01:17:00', 'Below 2', 'Fulltime', '1637851328_e9d474893fdbd5ca01ac.pdf', '2021-11-25 20:12:08', 0, 'Teacher', ''),
(11, 18, 'Sports', 0, '2021-12-11 02:01:00', '5+ years', 'Fulltime', '1637853979_c67bbc8edc8c374716a4.pdf', '2021-11-25 20:56:19', 1, 'Cricket Coach', ''),
(12, 18, 'Academic', 0, '2021-12-10 01:40:00', 'Below 2', 'Fulltime', '1637856420_17aee8687a1bb7b31cd9.pdf', '2021-11-25 21:37:00', 2, 'Lecturer', ''),
(13, 19, 'Media', 0, '2021-12-11 14:10:00', 'Below 2', 'Fulltime', '1637933694_85178f4babf3768cb6df.pdf', '2021-11-26 19:04:54', 2, 'Cameraman', ''),
(14, 28, 'Banking', 0, '2021-12-10 21:38:00', 'Below 2', 'Fulltime', '1638007387_87a54536947725421fd4.pdf', '2021-11-27 15:33:07', 1, 'Branch Manager', 'Colombo'),
(15, 18, 'Law', 0, '2021-12-31 22:13:00', 'Below 2', 'Fulltime', '1638150206_20f7de200f56365d1f27.pdf', '2021-11-29 07:13:26', 2, 'Secretary', ''),
(16, 18, 'Tourism', 0, '2022-01-08 11:32:00', 'Below 2', 'Fulltime', '1638359823_6cb0cc50b7b434549665.pdf', '2021-12-01 17:27:03', 0, 'Driver', ''),
(17, 28, 'IT', 0, '2021-12-31 12:30:00', 'Below 2', 'Fulltime', '1638453157_7fdf9916d48337b0f276.pdf', '2021-12-02 19:22:37', 1, 'System Engineer', ''),
(18, 28, 'Accounting', 0, '2021-12-24 11:28:00', '5+', 'Parttime', '1638453344_3646c2d27a73bfba695b.pdf', '2021-12-02 19:25:44', 2, 'Assistant Accountant', ''),
(19, 18, 'Healthcare', 0, '2021-12-31 00:00:00', 'Below 2 years', 'Fulltime', '1638458118_ccf43cb7b495b16bd9b6.pdf', '2021-12-02 20:45:18', 0, 'Optic Surgeon', ''),
(20, 18, 'Healthcare', 0, '2021-12-29 13:54:00', '5+ years', 'Fulltime', '1638458373_ca8ea583a57c28a82805.pdf', '2021-12-02 20:49:33', 1, 'Heart Surgeon', 'Trincomalee'),
(21, 18, 'HR', 0, '2022-01-07 03:05:00', '2+ years', 'Parttime', '1638462667_a1c997e448512c3309f2.pdf', '2021-12-02 22:01:07', 0, 'Janitor', 'Mullaitivu'),
(22, 18, 'HR', 0, '2021-12-31 05:34:00', 'Below 2 years', 'Fulltime', '1638511226_602b3e502977b5c8bc92.pdf', '2021-12-03 11:30:26', 1, 'Senior Pastor', 'Gampaha'),
(23, 18, 'Tourism', 0, '2021-12-31 12:40:00', 'Below 2 years', 'Fulltime', '1638716997_3084e92b5fe1aa131675.pdf', '2021-12-05 20:39:57', 2, 'Bartender', 'Kandy');

-- --------------------------------------------------------

--
-- Table structure for table `job_seeker`
--

CREATE TABLE `job_seeker` (
  `id` int(10) NOT NULL,
  `user_account_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `dob` date NOT NULL,
  `currentJobTitle` varchar(40) NOT NULL,
  `cv_file_dir` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`id`, `user_account_id`, `name`, `address`, `email`, `contactNo`, `dob`, `currentJobTitle`, `cv_file_dir`) VALUES
(9, 25, 'Oren Williams', '34, 2nd St, Marine Drive', 'jurezajel@mailinator.com', '+1 (145) 205-6138', '1989-03-22', 'Accounting Assistant', ''),
(10, 26, 'Alex Hunter', '25, Lake Avenue, Colombo 03', 'hunter@gmail.com', '94772248756', '1986-06-21', 'Senior Software Engineer', ''),
(11, 27, 'Alana Ortega', '34/2A, Bakers St, Kandy', 'alana@gmail.com', '+1 (161) 965-6716', '1992-05-21', 'Intern', ''),
(12, 28, 'Sherlock Holmes', '221/B, Baker\'s St, London', 'sherlock@gmail.com', '+1 (594) 468-8044', '1980-07-28', 'Crime Scene Investigator', ''),
(13, 29, 'Cisco Ramon', '32/1A, Central City, DC', 'musharraf.azhar19@gmail.com', '9145789666', '1985-11-15', 'Electrical Engineer', '1638441157_86444d63f51aef158a81.pdf'),
(14, 30, 'Jescie Newton', '45A, Main St, Galle', 'jess@gmail.com', '+1 (871) 772-6037', '1991-02-16', 'Web Developer', ''),
(15, 31, 'Vincent Compton', '87/3A, Gregory St, Kandy', 'vincy@gmail.com', '+1 (816) 391-9463', '1991-08-12', 'Senior Journalist', ''),
(16, 32, 'Alvin Joseph', '45, Vivian St, Colombo 10', 'alvie@gmail.com', '+1 (694) 567-1113', '1989-01-08', 'Event Planner', ''),
(17, 41, 'Barry Allen', '64/5E, Central City, DC', 'barry12@gmail.com', '96777845917', '1989-10-25', 'Crime Scene Investigator', '1638844890_32a300b55d66473712a9.pdf'),
(18, 43, 'Oliver Queen', '45, Main St, DC', 'oliver@gmail.com', '947584795', '1986-05-12', 'Accounting Assistant', '');

-- --------------------------------------------------------

--
-- Table structure for table `system_admin`
--

CREATE TABLE `system_admin` (
  `id` int(10) NOT NULL,
  `user_account_id` int(10) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `system_admin`
--

INSERT INTO `system_admin` (`id`, `user_account_id`, `name`) VALUES
(2, 1, 'Admin1');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(75) NOT NULL,
  `status` int(1) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `username`, `password`, `status`, `type`) VALUES
(1, 'admin1', 'admin1', 0, 'admin'),
(25, 'owill', 'oren123', 2, 'applicant'),
(26, 'ahunter', 'hunt000', 3, 'applicant'),
(27, 'alana', 'ort123', 2, 'applicant'),
(28, 'sher007', 'wordpass007', 1, 'applicant'),
(29, 'cramon', 'ciscovibe', 1, 'applicant'),
(30, 'newtonj', 'jnew345', 3, 'applicant'),
(31, 'vincy0', 'comp110', 3, 'applicant'),
(32, 'alvy10', 'jos10ph', 3, 'applicant'),
(33, 'adele', 'ade001', 1, 'employer'),
(34, 'bruce101', 'Password', 1, 'employer'),
(35, 'johnsm', 'mar009', 1, 'employer'),
(36, 'zacher101', '101saunders', 1, 'employer'),
(37, 'liopres110', 'lionpres0', 3, 'employer'),
(38, 'gwise123', 'wisecrypto', 1, 'employer'),
(39, 'richkl', 'kline340', 1, 'employer'),
(40, 'adamsdaw', 'dawn123', 1, 'employer'),
(41, 'ballen', 'imflash', 1, 'applicant'),
(42, 'billk', 'kent0', 1, 'employer'),
(43, 'oliverq', 'imarrow', 3, 'applicant'),
(44, 'thawne0', 'rflash', 1, 'employer'),
(45, 'Arthur', 'arthur', 1, 'employer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmployerToCompany` (`company_id`),
  ADD KEY `EmployerToUserAccount` (`user_account_id`);

--
-- Indexes for table `jobseeker_jobdetails`
--
ALTER TABLE `jobseeker_jobdetails`
  ADD PRIMARY KEY (`job_seeker_id`,`job_details_id`),
  ADD KEY `JobSeekerJobDetailsToJobDetails` (`job_details_id`);

--
-- Indexes for table `job_details`
--
ALTER TABLE `job_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `JobDetailsToEmployer` (`employer_id`);

--
-- Indexes for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD PRIMARY KEY (`id`),
  ADD KEY `JobSeekerToUserAccount` (`user_account_id`);

--
-- Indexes for table `system_admin`
--
ALTER TABLE `system_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `SystemAdminToUserAccount` (`user_account_id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `job_details`
--
ALTER TABLE `job_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `job_seeker`
--
ALTER TABLE `job_seeker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `system_admin`
--
ALTER TABLE `system_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `employer`
--
ALTER TABLE `employer`
  ADD CONSTRAINT `EmployerToCompany` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `EmployerToUserAccount` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `jobseeker_jobdetails`
--
ALTER TABLE `jobseeker_jobdetails`
  ADD CONSTRAINT `JobSeekerJobDetailsToJobDetails` FOREIGN KEY (`job_details_id`) REFERENCES `job_details` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `JobSeekerJobDetailsToJobSeeker` FOREIGN KEY (`job_seeker_id`) REFERENCES `job_seeker` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_details`
--
ALTER TABLE `job_details`
  ADD CONSTRAINT `JobDetailsToEmployer` FOREIGN KEY (`employer_id`) REFERENCES `employer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `job_seeker`
--
ALTER TABLE `job_seeker`
  ADD CONSTRAINT `JobSeekerToUserAccount` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `system_admin`
--
ALTER TABLE `system_admin`
  ADD CONSTRAINT `SystemAdminToUserAccount` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
