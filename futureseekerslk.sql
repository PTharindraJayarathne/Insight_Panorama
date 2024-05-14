-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 31, 2021 at 04:13 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
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
(13, 'Cloudrevel', '1637397978_ee30a060d01bed4ab31d.png', '941124587954', 'cloudrevel@gmail.com'),
(14, 'Tech-Mart', NULL, NULL, NULL),
(15, 'NextGen Solutions', NULL, NULL, NULL),
(16, 'Ceylon Traders', '1637398523_9c1bd4e6420ebd4be0b5.png', '01129487600', 'ceylontrade@gmail.com'),
(17, 'Digimail', '', '', ''),
(18, 'Crypto-Z', NULL, NULL, NULL),
(19, 'Clothing-Line', NULL, NULL, NULL),
(20, 'Brandiing', NULL, NULL, NULL),
(21, 'Horizon-Ware', '1637399397_f69d232488cd7061cd1d.png', '94112548763', 'horizon@gmail.com'),
(22, 'Star Labs', '1637562396_ab977402979431dc8653.png', '941124578943', 'starlabs@gmail.com'),
(23, 'Star Technologies', '1638680626_bae2f384f3f85cfe6327.png', '0771287312', 'mkavinkumarnaidu@gmail.com'),
(24, 'New CBC', NULL, NULL, NULL),
(25, 'Tech Land Pvt', '1638672929_3ebd7092556b42b22e0d.png', '0778272726', 'techland@gmail.com');

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
(18, 13, 33, 'Adele Sexton', '94775486915', 'Senior HR Manager', 'adele@gmail.com'),
(19, 14, 34, 'Bruce Jensen', '+1 (233) 852-8465', 'HR Manager', 'bruce@gmail.com'),
(20, 15, 35, 'Marny Johns', '+1 (843) 778-7111', 'HR Manager', 'marny@gmail.com'),
(21, 16, 36, 'Zachery Saunders', '94785431829', 'Assistant HR Manager', 'zach@gmail.com'),
(22, 17, 37, 'Lionel Preston', '+1 (785) 414-6764', 'Senior HRM', 'lio@gmail.com'),
(23, 18, 38, 'Grant Wise', '+1 (235) 746-6062', 'HRM', 'wise@gmail.com'),
(24, 19, 39, 'Richard Kline', '+1 (101) 729-4626', 'Senior HRM', 'kline@gmail.com'),
(25, 20, 40, 'Dawn Adams', '+1 (679) 689-9951', 'HR Manager', 'adams@gmail.com'),
(26, 21, 42, 'Bill Kent', '94784519657', 'Assistant HRM', 'bill@gmail.com'),
(27, 22, 44, 'Eobard Thawne', '94784515752', 'Senior HR Manager', 'thawne@gmail.com'),
(28, 23, 45, 'Kavinkumar', '776552512', 'Hr Manager', 'mkavinkumarnaidu@gmail.com'),
(29, 24, 46, 'Alex', '07728299232', 'HR Manager', 'alex@gmail.com'),
(30, 25, 47, 'Mohanraj', '775442635', 'HR Executive', 'omgitswolverine@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `jobseeker_jobdetails`
--

CREATE TABLE `jobseeker_jobdetails` (
  `job_seeker_id` int(10) NOT NULL,
  `job_details_id` int(10) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `cv_name` varchar(200) NOT NULL,
  `is_scheduled` varchar(20) NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobseeker_jobdetails`
--

INSERT INTO `jobseeker_jobdetails` (`job_seeker_id`, `job_details_id`, `dateTime`, `cv_name`, `is_scheduled`) VALUES
(12, 121, '2021-12-22 18:14:56', '', 'No'),
(17, 120, '2021-12-22 11:41:35', '1639638570_4416c703ac8e98c81714.pdf', 'Yes'),
(17, 121, '2021-12-23 12:16:00', '1639638570_4416c703ac8e98c81714.pdf', 'No'),
(17, 122, '2021-12-22 16:47:56', '1639638570_4416c703ac8e98c81714.pdf', 'Yes'),
(17, 123, '2021-12-18 10:46:09', '1639638570_4416c703ac8e98c81714.pdf', 'No'),
(17, 129, '2021-12-22 13:56:42', '1639638570_4416c703ac8e98c81714.pdf', 'Yes'),
(18, 121, '2021-12-17 15:43:19', '1639638616_3723966e4814b9e11f47', 'No'),
(18, 122, '2021-12-16 08:59:04', '1639043709_4d4762ba2593b9f7fae1.pdf', 'Yes'),
(18, 123, '2021-12-19 15:33:11', '1639903323_b866a2b3e9815bd5cdb8.pdf', 'No'),
(18, 130, '2021-12-18 15:53:49', '1639638616_3723966e4814b9e11f47', 'No'),
(19, 122, '2021-12-16 08:59:44', '1638680752_650967588508e7d7177d.pdf', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `job_details`
--

CREATE TABLE `job_details` (
  `id` int(10) NOT NULL,
  `employer_id` int(10) NOT NULL,
  `jobCategory` varchar(20) NOT NULL,
  `salary` double NOT NULL,
  `closingDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `experience` varchar(20) NOT NULL,
  `typeOfEmployment` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL,
  `jobtitle` varchar(100) NOT NULL,
  `location` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_details`
--

INSERT INTO `job_details` (`id`, `employer_id`, `jobCategory`, `salary`, `closingDate`, `experience`, `typeOfEmployment`, `description`, `dateTime`, `status`, `jobtitle`, `location`) VALUES
(120, 30, 'IT', 100000, '2021-12-19 13:43:39', '5+ years', 'Fulltime', '1638673322_18bb76dac75ca75e0ce1.pdf', '2021-12-05 08:32:02', 1, 'Senior UI/UX Engineer', 'Kandy'),
(121, 30, 'IT', 28000, '2021-12-05 03:02:23', 'Below 2 years', 'Fulltime', '1638673323_a09fbb2860effd8fa691.pdf', '2021-12-05 08:32:03', 1, 'Quality Assurance Trainee', 'Colombo'),
(122, 28, 'IT', 50000, '2021-12-05 05:12:50', 'Below 2 years', 'Fulltime', '1638681166_37bf46db8a7be2c7c74c.pdf', '2021-12-05 10:42:46', 1, 'Software Developer .NET', 'Galle'),
(123, 30, 'Accounting', 100000, '2021-12-05 05:23:45', '2+ years', 'Fulltime', '1638681608_3ef8fefb50b921604b9b.pdf', '2021-12-05 10:50:08', 1, 'Accounts Executive', 'Galle'),
(124, 30, 'IT', 80000, '2021-12-05 05:23:46', '2+ years', 'Fulltime', '1638681712_97050bc82141e6ecad51.pdf', '2021-12-05 10:51:52', 2, 'Associate Tech Lead', 'Colombo'),
(125, 30, 'IT', 30000, '2021-12-05 05:28:59', 'Below 2 years', 'Fulltime', '1638681756_ec885aa37067341b55c4.pdf', '2021-12-05 10:52:36', 1, 'Business Analyst Intern', 'Colombo'),
(127, 30, 'IT', 35000, '2021-12-05 05:29:00', 'Below 2 years', 'Parttime', '1638682006_1eac4ade77846e4690d6.pdf', '2021-12-05 10:56:46', 2, 'Java Developer Intern', 'Colombo'),
(128, 28, 'IT', 50000, '2021-12-09 05:00:00', 'Below 2 years', 'Fulltime', '1638682135_5eacc4e30e513440fc39.pdf', '2021-12-05 10:58:55', 0, 'Software Developer .NET', 'Galle'),
(129, 28, 'IT', 0, '2021-12-09 04:29:03', '5+ years', 'Fulltime', '1639024123_2b3abc73f50c32cafd91.pdf', '2021-12-09 09:58:43', 1, 'Quality Assurance Engineer', 'Colombo'),
(130, 28, 'IT', 150000, '2021-12-19 13:44:46', '2+ years', 'Fulltime', '1639812506_c1c74cf875167a0634a7.pdf', '2021-12-18 12:58:26', 1, 'Scrum Master', 'Colombo');

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
  `cv_file_dir` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_seeker`
--

INSERT INTO `job_seeker` (`id`, `user_account_id`, `name`, `address`, `email`, `contactNo`, `dob`, `currentJobTitle`, `cv_file_dir`) VALUES
(9, 25, 'Oren Williams', '34, 2nd St, Marine Drive', 'jurezajel@mailinator.com', '+1 (145) 205-6138', '1989-03-22', 'Accounting Assistant', ''),
(10, 26, 'Alex Hunter', '25, Lake Avenue, Colombo 03', 'hunter@gmail.com', '94772248756', '1986-06-21', 'Senior Software Engineer', ''),
(11, 27, 'Alana Ortega', '34/2A, Bakers St, Kandy', 'alana@gmail.com', '+1 (161) 965-6716', '1992-05-21', 'Intern', ''),
(12, 28, 'Sherlock Holmes', '221/B, Baker\'s St, London', 'sherlock@gmail.com', '+1 (594) 468-8044', '1980-07-28', 'Crime Scene Investigator', ''),
(13, 29, 'Cisco Ramon', '32/1A, Central City, DC', 'ciscor@gmail.com', '9145789666', '1985-11-15', 'Electrical Engineer', ''),
(14, 30, 'Jescie Newton', '45A, Main St, Galle', 'jess@gmail.com', '+1 (871) 772-6037', '1991-02-16', 'Web Developer', ''),
(15, 31, 'Vincent Compton', '87/3A, Gregory St, Kandy', 'vincy@gmail.com', '+1 (816) 391-9463', '1991-08-12', 'Senior Journalist', ''),
(16, 32, 'Alvin Joseph', '45, Vivian St, Colombo 10', 'alvie@gmail.com', '+1 (694) 567-1113', '1989-01-08', 'Event Planner', ''),
(17, 41, 'Barry Allen', '64/5A, Central City, DC', 'mkavinkumarnaidu@gmail.com', '77443251', '1989-10-25', 'Crime Scene Investigator', '1639638570_4416c703ac8e98c81714.pdf'),
(18, 43, 'Oliver Queen', '45, Main St, DC', 'omgitswolverine@gmail.com', '774332323', '1986-05-12', 'UI/UX Trainee', '1639903323_b866a2b3e9815bd5cdb8.pdf'),
(19, 48, 'Krishnakumar', '55 1/1 Castle Road Colombo 15', 'officialkavinstrange@gmail.com', '776443298', '2001-06-13', 'Junior Software Developer', '1639638633_ca1600c271fad9900bb1');

-- --------------------------------------------------------

--
-- Table structure for table `reported_accounts`
--

CREATE TABLE `reported_accounts` (
  `id` int(11) NOT NULL,
  `user_account_id` int(11) NOT NULL,
  `reported_user_id` int(11) NOT NULL,
  `remarks` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reported_accounts`
--

INSERT INTO `reported_accounts` (`id`, `user_account_id`, `reported_user_id`, `remarks`) VALUES
(7, 43, 45, 'This person is impoerating someone');

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_meetings`
--

CREATE TABLE `scheduled_meetings` (
  `id` int(11) NOT NULL,
  `job_details_id` int(11) NOT NULL,
  `job_seeker_id` int(11) NOT NULL,
  `meeting_link` varchar(255) DEFAULT NULL,
  `meeting_type` varchar(100) NOT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending',
  `datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `scheduled_meetings`
--

INSERT INTO `scheduled_meetings` (`id`, `job_details_id`, `job_seeker_id`, `meeting_link`, `meeting_type`, `notes`, `status`, `datetime`, `created_datetime`) VALUES
(163, 120, 17, '', 'Walk-In Interview', 'qweqweq', 'Pending', '2021-12-19 06:23:00', '2021-12-23 08:50:55'),
(164, 122, 17, 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_NGMyZjQ0ZDMtY2YzNy00ZTQyLWExYTMtYjJkNGQ4ZWMxNWRl%40thread.v2/0?context=%7b%22Tid%22%3a%2286127bbe-1480-47ae-af35-1fcca1d323e4%22%2c%22Oid%22%3a%22c31905c6-0f73-4a92-90c5-662b33975c8a%22%7d', 'Virtual Interview', 'dsdfsdf', 'Pending', '2021-12-30 09:51:00', '2021-12-23 12:19:01'),
(165, 122, 19, '', 'Walk-In Interview', 'kkmkllmk', 'Pending', '2021-12-26 13:50:00', '2021-12-23 15:10:16'),
(166, 129, 17, 'https://teams.microsoft.com/l/meetup-join/19%3ameeting_NGMyZjQ0ZDMtY2YzNy00ZTQyLWExYTMtYjJkNGQ4ZWMxNWRl%40thread.v2/0?context=%7b%22Tid%22%3a%2286127bbe-1480-47ae-af35-1fcca1d323e4%22%2c%22Oid%22%3a%22c31905c6-0f73-4a92-90c5-662b33975c8a%22%7d', 'Virtual Interview', 'mmlk', 'Pending', '2022-01-23 13:44:00', '2021-12-23 15:10:50');

-- --------------------------------------------------------

--
-- Table structure for table `shared_advert`
--

CREATE TABLE `shared_advert` (
  `id` int(11) NOT NULL,
  `job_details_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `message` varchar(255) DEFAULT NULL,
  `datetime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shared_advert`
--

INSERT INTO `shared_advert` (`id`, `job_details_id`, `sender_id`, `receiver_id`, `status`, `message`, `datetime`) VALUES
(16, 123, 18, 18, 0, 'lmasdmasdas', '2021-12-23 13:26:34'),
(17, 129, 18, 17, 1, 'asdasda', '2021-12-23 13:26:34'),
(18, 123, 17, 18, 0, 'dsadasdasd', '2021-12-23 13:26:34'),
(19, 121, 18, 17, 1, 'asdasdasd', '2021-12-23 13:26:34'),
(20, 121, 17, 17, 0, '', '2021-11-19 13:27:23'),
(21, 122, 17, 18, 0, '', '2021-12-23 13:27:30');

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
(2, 1, 'Admin1'),
(3, 49, 'tester'),
(4, 51, 'Surya'),
(5, 52, 'Loki'),
(6, 53, 'tom');

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
(25, 'owill', 'oren123', 0, 'applicant'),
(26, 'ahunter', 'hunt000', 0, 'applicant'),
(27, 'alana', 'ort123', 1, 'applicant'),
(28, 'sher007', 'wordpass007', 1, 'applicant'),
(29, 'cramon', 'ciscovibe', 0, 'applicant'),
(30, 'newtonj', 'jnew345', 0, 'applicant'),
(31, 'vincy0', 'comp110', 1, 'applicant'),
(32, 'alvy10', 'jos10ph', 0, 'applicant'),
(33, 'adele', 'ade001', 1, 'employer'),
(34, 'bruce101', 'Pa$$w0rd!', 0, 'employer'),
(35, 'johnsm', 'mar009', 2, 'employer'),
(36, 'zacher101', '101saunders', 1, 'employer'),
(37, 'liopres110', 'lionpres0', 0, 'employer'),
(38, 'gwise123', 'wisecrypto', 0, 'employer'),
(39, 'richkl', 'kline340', 0, 'employer'),
(40, 'adamsdaw', 'dawn123', 2, 'employer'),
(41, 'ballen', 'imflash', 1, 'applicant'),
(42, 'billk', 'kent0', 1, 'employer'),
(43, 'oliverq', 'imarrow', 5, 'applicant'),
(44, 'thawne0', 'rflash', 1, 'employer'),
(45, 'kavin143', 'aaAA12!@', 1, 'employer'),
(46, 'alex143', 'aaAA12!@', 1, 'employer'),
(47, 'mohan143', 'aaAA12!@', 1, 'employer'),
(48, 'krish143', 'aaAA12!@', 1, 'applicant'),
(49, 'test1', 'test1', 3, 'admin'),
(50, 'asadas', 'asdasd', 0, 'admin'),
(51, 'surya143', 'aaAA12!@', 3, 'admin'),
(52, 'loki143', 'qqQQ12!@', 3, 'admin'),
(53, 'tom143', 'aaAA12!@', 3, 'admin');

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
-- Indexes for table `reported_accounts`
--
ALTER TABLE `reported_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_account_id` (`user_account_id`),
  ADD KEY `reported_user_id` (`reported_user_id`);

--
-- Indexes for table `scheduled_meetings`
--
ALTER TABLE `scheduled_meetings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_details_id` (`job_details_id`),
  ADD KEY `job_seeker_id` (`job_seeker_id`);

--
-- Indexes for table `shared_advert`
--
ALTER TABLE `shared_advert`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_details_id` (`job_details_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `shared_advert_to_job_seeker_sender` (`sender_id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `job_details`
--
ALTER TABLE `job_details`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `job_seeker`
--
ALTER TABLE `job_seeker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `reported_accounts`
--
ALTER TABLE `reported_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `scheduled_meetings`
--
ALTER TABLE `scheduled_meetings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `shared_advert`
--
ALTER TABLE `shared_advert`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `system_admin`
--
ALTER TABLE `system_admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

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
-- Constraints for table `reported_accounts`
--
ALTER TABLE `reported_accounts`
  ADD CONSTRAINT `reported_accounts_ibfk_1` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`),
  ADD CONSTRAINT `reported_accounts_ibfk_2` FOREIGN KEY (`reported_user_id`) REFERENCES `user_account` (`id`);

--
-- Constraints for table `scheduled_meetings`
--
ALTER TABLE `scheduled_meetings`
  ADD CONSTRAINT `scheduled_meetings_ibfk_1` FOREIGN KEY (`job_details_id`) REFERENCES `jobseeker_jobdetails` (`job_details_id`),
  ADD CONSTRAINT `scheduled_meetings_ibfk_2` FOREIGN KEY (`job_seeker_id`) REFERENCES `jobseeker_jobdetails` (`job_seeker_id`);

--
-- Constraints for table `shared_advert`
--
ALTER TABLE `shared_advert`
  ADD CONSTRAINT `shared_advert_ibfk_1` FOREIGN KEY (`job_details_id`) REFERENCES `job_details` (`id`),
  ADD CONSTRAINT `shared_advert_ibfk_3` FOREIGN KEY (`receiver_id`) REFERENCES `job_seeker` (`id`),
  ADD CONSTRAINT `shared_advert_to_job_seeker_sender` FOREIGN KEY (`sender_id`) REFERENCES `job_seeker` (`id`);

--
-- Constraints for table `system_admin`
--
ALTER TABLE `system_admin`
  ADD CONSTRAINT `SystemAdminToUserAccount` FOREIGN KEY (`user_account_id`) REFERENCES `user_account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
