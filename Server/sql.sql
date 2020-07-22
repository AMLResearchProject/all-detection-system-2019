-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 22, 2020 at 03:02 AM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `genisys`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessConfs`
--

CREATE TABLE `accessConfs` (
  `id` int(11) NOT NULL,
  `jid` varchar(255) NOT NULL,
  `jdn` varchar(255) NOT NULL,
  `jdl` varchar(255) NOT NULL,
  `jdf` varchar(255) NOT NULL,
  `jdz` varchar(255) NOT NULL,
  `jdmu` varchar(255) NOT NULL,
  `jdmp` varchar(255) NOT NULL,
  `API` varchar(255) NOT NULL,
  `MAC` varchar(255) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `Port` varchar(255) NOT NULL,
  `Graph` varchar(255) NOT NULL,
  `Dlib` varchar(255) NOT NULL,
  `TestingPath` varchar(255) NOT NULL,
  `ValidPath` varchar(255) NOT NULL,
  `socketIP` varchar(255) NOT NULL,
  `socketPort` varchar(255) NOT NULL,
  `StreamIP` varchar(255) NOT NULL,
  `StreamPort` varchar(255) NOT NULL,
  `Threshold` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aml_classifications`
--

CREATE TABLE `aml_classifications` (
  `id` int(11) NOT NULL,
  `timeStart` int(11) NOT NULL,
  `timeEnd` int(11) NOT NULL DEFAULT '0',
  `timeTotal` int(11) NOT NULL DEFAULT '0',
  `processed` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `aml_classifications_data`
--

CREATE TABLE `aml_classifications_data` (
  `id` int(11) NOT NULL,
  `classification` decimal(10,2) NOT NULL DEFAULT '0.00',
  `filename` varchar(255) NOT NULL,
  `response` varchar(255) NOT NULL,
  `confidence` decimal(10,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `authConfs`
--

CREATE TABLE `authConfs` (
  `id` int(255) NOT NULL,
  `jid` varchar(255) NOT NULL,
  `jdn` varchar(255) NOT NULL,
  `jdl` varchar(255) NOT NULL,
  `jdf` varchar(255) NOT NULL,
  `jdz` varchar(255) NOT NULL,
  `jdmu` varchar(255) NOT NULL,
  `jdmp` varchar(255) NOT NULL,
  `API` varchar(255) NOT NULL,
  `NetworkPath` varchar(255) NOT NULL,
  `MAC` varchar(255) NOT NULL,
  `IP` varchar(255) NOT NULL,
  `Port` varchar(255) NOT NULL,
  `Graph` varchar(255) NOT NULL,
  `Dlib` varchar(255) NOT NULL,
  `TestingPath` varchar(255) NOT NULL,
  `ValidPath` varchar(255) NOT NULL,
  `Threshold` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bannedIPs`
--

CREATE TABLE `bannedIPs` (
  `id` int(11) NOT NULL,
  `app` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bannedVisitors`
--

CREATE TABLE `bannedVisitors` (
  `id` int(11) NOT NULL,
  `app` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homeVisitors`
--

CREATE TABLE `homeVisitors` (
  `id` int(11) NOT NULL,
  `app` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `app` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `loginsF`
--

CREATE TABLE `loginsF` (
  `id` int(11) NOT NULL,
  `app` int(11) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `nluConfs`
--

CREATE TABLE `nluConfs` (
  `id` int(11) NOT NULL,
  `fqdn` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `mac` varchar(255) NOT NULL,
  `Activation` varchar(255) NOT NULL,
  `Threshold` varchar(255) NOT NULL,
  `logsPath` varchar(255) NOT NULL,
  `TFLearn_Logs` varchar(255) NOT NULL,
  `TFLearn_LogsLevel` varchar(255) NOT NULL,
  `TFLearn_ModelPath` varchar(255) NOT NULL,
  `TFLearn_ModelInfo` varchar(255) NOT NULL,
  `Regression` varchar(255) NOT NULL,
  `FcLayers` varchar(255) NOT NULL,
  `FcUnits` varchar(255) NOT NULL,
  `Epochs` varchar(255) NOT NULL,
  `BatchSize` varchar(255) NOT NULL,
  `ShowMetric` varchar(255) NOT NULL,
  `EntityExtractor` varchar(255) NOT NULL,
  `MitieLocation` varchar(255) NOT NULL,
  `MitieModelLocation` varchar(255) NOT NULL,
  `EntitiesDat` varchar(255) NOT NULL,
  `MitieThreshold` varchar(255) NOT NULL,
  `deviceLocation` varchar(255) NOT NULL,
  `deviceFloor` varchar(255) NOT NULL,
  `deviceZone` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `deviceMuser` varchar(255) NOT NULL,
  `deviceMpass` varchar(255) NOT NULL,
  `deviceName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `version` varchar(50) NOT NULL,
  `apiURL` varchar(255) NOT NULL,
  `nluID` varchar(255) NOT NULL,
  `nluAddress` varchar(255) NOT NULL,
  `tassID` varchar(255) NOT NULL,
  `tassAddress` varchar(255) NOT NULL,
  `tassDevices` int(11) NOT NULL,
  `jwUid` varchar(255) NOT NULL,
  `jumpwayAPI` varchar(255) NOT NULL,
  `jumpwayLocation` varchar(255) NOT NULL,
  `jumpwayZone` varchar(255) NOT NULL,
  `JumpWayDevice` varchar(255) NOT NULL,
  `JumpWayDeviceName` varchar(255) NOT NULL,
  `JumpWayDeviceZone` varchar(255) NOT NULL,
  `JumpWayDeviceMqttUser` varchar(255) NOT NULL,
  `JumpWayDeviceMqttPass` varchar(255) NOT NULL,
  `JumpWayAppID` varchar(255) NOT NULL,
  `JumpWayAppName` varchar(255) NOT NULL,
  `JumpWayAppMAC` varchar(255) NOT NULL,
  `JumpWayAppPublic` varchar(255) NOT NULL,
  `JumpWayAppSecret` varchar(255) NOT NULL,
  `JumpWayMqttUser` varchar(255) NOT NULL,
  `JumpWayMqttPass` varchar(255) NOT NULL,
  `WSapp` varchar(255) NOT NULL,
  `WSMQTTuser` varchar(255) NOT NULL,
  `WSMQTTpass` varchar(255) NOT NULL,
  `WSAppPub` varchar(255) NOT NULL,
  `WSAppPriv` varchar(255) NOT NULL,
  `phpmyadmin` varchar(255) NOT NULL,
  `meta_title` varchar(255) NOT NULL,
  `meta_description` text NOT NULL,
  `meta_keywords` text NOT NULL,
  `domainString` varchar(255) NOT NULL,
  `faID` varchar(255) NOT NULL,
  `faAddress` varchar(255) NOT NULL,
  `amlID` varchar(255) NOT NULL,
  `amlAddress` varchar(255) NOT NULL,
  `nluEngine` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `version`, `apiURL`, `nluID`, `nluAddress`, `tassID`, `tassAddress`, `tassDevices`, `jwUid`, `jumpwayAPI`, `jumpwayLocation`, `jumpwayZone`, `JumpWayDevice`, `JumpWayDeviceName`, `JumpWayDeviceZone`, `JumpWayDeviceMqttUser`, `JumpWayDeviceMqttPass`, `JumpWayAppID`, `JumpWayAppName`, `JumpWayAppMAC`, `JumpWayAppPublic`, `JumpWayAppSecret`, `JumpWayMqttUser`, `JumpWayMqttPass`, `WSapp`, `WSMQTTuser`, `WSMQTTpass`, `WSAppPub`, `WSAppPriv`, `phpmyadmin`, `meta_title`, `meta_description`, `meta_keywords`, `domainString`, `faID`, `faAddress`, `amlID`, `amlAddress`, `nluEngine`) VALUES
(1, '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessConfs`
--
ALTER TABLE `accessConfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aml_classifications`
--
ALTER TABLE `aml_classifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aml_classifications_data`
--
ALTER TABLE `aml_classifications_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `authConfs`
--
ALTER TABLE `authConfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bannedIPs`
--
ALTER TABLE `bannedIPs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app` (`app`),
  ADD KEY `ip` (`ip`),
  ADD KEY `time` (`time`);

--
-- Indexes for table `bannedVisitors`
--
ALTER TABLE `bannedVisitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app` (`app`),
  ADD KEY `ip` (`ip`),
  ADD KEY `time` (`time`);

--
-- Indexes for table `homeVisitors`
--
ALTER TABLE `homeVisitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app` (`app`),
  ADD KEY `ip` (`ip`),
  ADD KEY `time` (`time`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app` (`app`),
  ADD KEY `ip` (`ip`),
  ADD KEY `time` (`time`);

--
-- Indexes for table `loginsF`
--
ALTER TABLE `loginsF`
  ADD PRIMARY KEY (`id`),
  ADD KEY `app` (`app`),
  ADD KEY `ip` (`ip`),
  ADD KEY `time` (`time`);

--
-- Indexes for table `nluConfs`
--
ALTER TABLE `nluConfs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tassDevices` (`tassDevices`),
  ADD KEY `tassID` (`tassID`),
  ADD KEY `JumpWayLocation` (`jumpwayLocation`),
  ADD KEY `JumpWayZone` (`jumpwayZone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessConfs`
--
ALTER TABLE `accessConfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `aml_classifications`
--
ALTER TABLE `aml_classifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `aml_classifications_data`
--
ALTER TABLE `aml_classifications_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `authConfs`
--
ALTER TABLE `authConfs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `bannedIPs`
--
ALTER TABLE `bannedIPs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `bannedVisitors`
--
ALTER TABLE `bannedVisitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `homeVisitors`
--
ALTER TABLE `homeVisitors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `loginsF`
--
ALTER TABLE `loginsF`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `nluConfs`
--
ALTER TABLE `nluConfs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=0;