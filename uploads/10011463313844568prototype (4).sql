-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2016 at 05:19 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prototype`
--

-- --------------------------------------------------------

--
-- Table structure for table `approves`
--

CREATE TABLE IF NOT EXISTS `approves` (
  `id` int(11) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `req` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `status` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `a_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `approves`
--

INSERT INTO `approves` (`id`, `ref`, `req`, `username`, `entry_date`, `entry_time`, `status`, `dept`, `a_status`) VALUES
(35, '385', '', 'imad', '2016-05-14', '10:42:00', 'approved', 'Finance', 0),
(36, '385', '', 'imad', '2016-05-14', '01:02:36', 'approved', 'Finance', 0),
(37, '385', 'shakir', 'imad', '2016-05-14', '01:03:51', 'approved', 'Finance', 0),
(38, '385', 'shakir', 'khan', '2016-05-14', '01:15:59', 'approved', '', 0),
(39, '385', 'shakir', 'mian', '2016-05-14', '01:16:46', 'approved', '', 0),
(40, '385', 'shakir', 'imad', '2016-05-14', '01:18:58', 'approved', 'Finance', 0),
(41, '385', 'shakir', 'imad', '2016-05-14', '01:19:18', 'approved', 'Finance', 0),
(42, '385', 'shakir', 'imad', '2016-05-14', '04:01:27', 'approved', 'Finance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ref` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `formsdata`
--

CREATE TABLE IF NOT EXISTS `formsdata` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `ref` int(11) NOT NULL,
  `created_date` date NOT NULL,
  `benif_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `invoice` varchar(255) NOT NULL,
  `due_date` date NOT NULL,
  `description` text NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `Ip` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `formid` int(11) NOT NULL,
  `benif_bank_ac` varchar(255) NOT NULL,
  `benif_bank_name` varchar(255) NOT NULL,
  `pay_currency` varchar(255) NOT NULL,
  `inv_date` date NOT NULL,
  `contract_po` varchar(255) NOT NULL,
  `completion_work` varchar(255) NOT NULL,
  `ledger` varchar(255) NOT NULL,
  `total_amount` int(11) NOT NULL,
  `from_ledger` varchar(255) NOT NULL,
  `to_ledger` varchar(255) NOT NULL,
  `from_bank` varchar(255) NOT NULL,
  `to_bank` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `from_preiod` date NOT NULL,
  `to_period` date NOT NULL,
  `prepay_req_no` int(11) NOT NULL,
  `prepay_amount` int(11) NOT NULL,
  `total_cost` int(11) NOT NULL,
  `diposit_amount` int(11) NOT NULL,
  `suplus_amount` int(11) NOT NULL,
  `perc_increase_prepay` int(11) NOT NULL,
  `reason_surplus` text NOT NULL,
  `Reimbur_amt` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `check_no` varchar(255) NOT NULL,
  `check_amount` int(11) NOT NULL,
  `inv_amt` int(11) NOT NULL,
  `charg_to` varchar(255) NOT NULL,
  `basic_salary` int(11) NOT NULL,
  `basic_salary_arrear` int(11) NOT NULL,
  `phone_allow` int(11) NOT NULL,
  `over_time` int(11) NOT NULL,
  `car_allown` int(11) NOT NULL,
  `over_time_arrears` int(11) NOT NULL,
  `car_allow_arre` int(11) NOT NULL,
  `fule_allow` int(11) NOT NULL,
  `other_allow` int(11) NOT NULL,
  `other_allow_arre` int(11) NOT NULL,
  `fule_all_arre` int(11) NOT NULL,
  `accomod_allow` int(11) NOT NULL,
  `accomo_allow_arre` int(11) NOT NULL,
  `advance_salary` int(11) NOT NULL,
  `leave_salary` int(11) NOT NULL,
  `leave_encash` int(11) NOT NULL,
  `leave_provision` int(11) NOT NULL,
  `airticket_encash` int(11) NOT NULL,
  `grautity_encashment` int(11) NOT NULL,
  `airticket_prov` int(11) NOT NULL,
  `hourly_leave_deduc` int(11) NOT NULL,
  `advance_salary_recovery` int(11) NOT NULL,
  `unpaid_leave_deduc` int(11) NOT NULL,
  `vehicles_other_deduc` int(11) NOT NULL,
  `vehicle_fines_deduc` int(11) NOT NULL,
  `late_coming_deduc` int(11) NOT NULL,
  `form_name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formsdata`
--

INSERT INTO `formsdata` (`id`, `username`, `ref`, `created_date`, `benif_name`, `amount`, `invoice`, `due_date`, `description`, `entry_date`, `entry_time`, `Ip`, `status`, `formid`, `benif_bank_ac`, `benif_bank_name`, `pay_currency`, `inv_date`, `contract_po`, `completion_work`, `ledger`, `total_amount`, `from_ledger`, `to_ledger`, `from_bank`, `to_bank`, `type`, `from_preiod`, `to_period`, `prepay_req_no`, `prepay_amount`, `total_cost`, `diposit_amount`, `suplus_amount`, `perc_increase_prepay`, `reason_surplus`, `Reimbur_amt`, `cus_name`, `check_no`, `check_amount`, `inv_amt`, `charg_to`, `basic_salary`, `basic_salary_arrear`, `phone_allow`, `over_time`, `car_allown`, `over_time_arrears`, `car_allow_arre`, `fule_allow`, `other_allow`, `other_allow_arre`, `fule_all_arre`, `accomod_allow`, `accomo_allow_arre`, `advance_salary`, `leave_salary`, `leave_encash`, `leave_provision`, `airticket_encash`, `grautity_encashment`, `airticket_prov`, `hourly_leave_deduc`, `advance_salary_recovery`, `unpaid_leave_deduc`, `vehicles_other_deduc`, `vehicle_fines_deduc`, `late_coming_deduc`, `form_name`) VALUES
(28, 'shakir', 385, '2016-05-14', 'hum', 122331, '963', '2016-05-13', 'hello this is new form', '2016-05-14', '10:39:00', '::1', 'Requested', 0, '', '', '', '0000-00-00', '', '', '', 0, '', '', '', '', '', '0000-00-00', '0000-00-00', 0, 0, 0, 0, 0, 0, '', 0, '', '', 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Temporary Petty Cash Payment Request Form');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) NOT NULL,
  `ref` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `status` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `ref`, `username`, `notes`, `status`, `filename`, `code`, `entry_date`, `entry_time`) VALUES
(156, 904, 'shakir', 'shakir Generate a Request Req# 904', 'Requested', '', '146320789615464', '2016-05-14', '10:38:00'),
(157, 385, 'shakir', 'shakir Generate a Request Req# 385', 'Requested', '', '146320794022201', '2016-05-14', '10:39:00'),
(158, 385, 'imad', 'imad Approved this request', 'Approved', '', '146320812013313', '2016-05-14', '10:42:00'),
(159, 385, 'imad', 'imad Approved this request', 'Approved', '', '14632165562229', '2016-05-14', '01:02:36'),
(160, 385, 'imad', 'imad Approved this request', 'Approved', '', '14632166313992', '2016-05-14', '01:03:51'),
(161, 385, 'khan', 'khan Approved Request Ref# 385', 'approved', '', '146321735914754', '2016-05-14', '01:15:59'),
(162, 385, 'mian', 'mian Approved Request Ref# 385', 'approved', '', '146321740614544', '2016-05-14', '01:16:46'),
(163, 385, 'imad', 'imad Approved this request', 'Approved', '', '146321753820968', '2016-05-14', '01:18:58'),
(164, 385, 'imad', 'imad Approved Request Ref# 385', 'approved', '', '146321755823357', '2016-05-14', '01:19:18'),
(165, 385, 'imad', 'imad Return Back to Requester ', 'Return Back', '', '146322058825145', '2016-05-14', '02:09:48'),
(166, 385, 'shakir', 'shakir Approved Request Ref# 385', 'Re Submit', '', '146322727518712', '2016-05-14', '04:01:15'),
(167, 385, 'imad', 'imad Approved this request', 'Approved', '', '146322728730167', '2016-05-14', '04:01:27'),
(168, 385, 'imad', 'imad Return Back to Requester ', 'Return Back', '', '14632276664769', '2016-05-14', '04:07:46');

-- --------------------------------------------------------

--
-- Table structure for table `on_hold`
--

CREATE TABLE IF NOT EXISTS `on_hold` (
  `id` int(11) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `req` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `h_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reject`
--

CREATE TABLE IF NOT EXISTS `reject` (
  `id` int(11) NOT NULL,
  `ref` int(11) NOT NULL,
  `req` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `status` varchar(20) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `r_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sent_back`
--

CREATE TABLE IF NOT EXISTS `sent_back` (
  `id` int(11) NOT NULL,
  `ref` varchar(255) NOT NULL,
  `req` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `entry_date` date NOT NULL,
  `entry_time` time NOT NULL,
  `status` varchar(50) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `s_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sent_back`
--

INSERT INTO `sent_back` (`id`, `ref`, `req`, `username`, `entry_date`, `entry_time`, `status`, `dept`, `s_status`) VALUES
(32, '385', 'shakir', 'imad', '2016-05-14', '02:09:48', 'return back', 'Finance', 0),
(33, '385', 'shakir', 'imad', '2016-05-14', '04:07:46', 'return back', 'Finance', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL,
  `ref` int(11) NOT NULL,
  `requester` varchar(255) NOT NULL,
  `requester_id` varchar(11) NOT NULL,
  `req_dept` varchar(255) NOT NULL,
  `approver` varchar(255) NOT NULL,
  `approver_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `final_status` varchar(255) NOT NULL,
  `back_status` varchar(255) NOT NULL,
  `last_activity_user` varchar(255) NOT NULL,
  `last_activity_date` date NOT NULL,
  `last_activity_time` time NOT NULL,
  `next_approver` varchar(255) NOT NULL,
  `next_approver_status` varchar(25) NOT NULL,
  `accountant` varchar(255) NOT NULL,
  `accountant_status` varchar(10) NOT NULL,
  `sr_accountant` varchar(255) NOT NULL,
  `chif_accountant` varchar(255) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `ref`, `requester`, `requester_id`, `req_dept`, `approver`, `approver_id`, `status`, `final_status`, `back_status`, `last_activity_user`, `last_activity_date`, `last_activity_time`, `next_approver`, `next_approver_status`, `accountant`, `accountant_status`, `sr_accountant`, `chif_accountant`, `t_status`) VALUES
(97, 385, 'shakir', '1001', 'Finance', 'shakir', 1001, 'return_back', 'return_back', 'shakir', 'imad', '2016-05-14', '04:07:46', 'khan', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `desig` varchar(255) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `approver` varchar(255) NOT NULL,
  `approver_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `search` varchar(10) NOT NULL,
  `reports` varchar(10) NOT NULL,
  `admin` int(3) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `username`, `password`, `desig`, `dept`, `email`, `approver`, `approver_id`, `status`, `type`, `search`, `reports`, `admin`) VALUES
(1, '1', 'admin', 'admin', '', '', '', '', 0, '', '', '', '', 1),
(2, '1001', 'shakir', 'shakir', '', 'Finance', 'shakir@gmail.com', 'imad', 0, '0', 'Requester', '', '', 0),
(3, '1002', 'imad', 'imad', '', 'Finance', 'imad@gmail.com', 'khan', 0, '0', 'Approver', '', '', 1),
(4, '1004', 'imran', 'imran', '', 'Accounts', 'imran@gmail.com', '', 0, '0', 'accountant', '', '', 0),
(6, '1006', 'khan', 'khan', '', '', '', 'mian', 0, '', 'approver', '', '', 0),
(7, '1007', 'mian', 'mian', '', '', '', '', 0, '', 'approver', '', '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approves`
--
ALTER TABLE `approves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formsdata`
--
ALTER TABLE `formsdata`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `on_hold`
--
ALTER TABLE `on_hold`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reject`
--
ALTER TABLE `reject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sent_back`
--
ALTER TABLE `sent_back`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approves`
--
ALTER TABLE `approves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `formsdata`
--
ALTER TABLE `formsdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `on_hold`
--
ALTER TABLE `on_hold`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `reject`
--
ALTER TABLE `reject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sent_back`
--
ALTER TABLE `sent_back`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
