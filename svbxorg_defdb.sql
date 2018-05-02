-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 01, 2018 at 02:25 PM
-- Server version: 5.6.38-log
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `svbxorg_defdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activityID` int(11) UNSIGNED NOT NULL,
  `actDesc` varchar(50) NOT NULL,
  `actHrs` tinyint(4) NOT NULL,
  `idrID` int(11) UNSIGNED NOT NULL,
  `numResources` tinyint(3) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activityID`, `actDesc`, `actHrs`, `idrID`, `numResources`) VALUES
(9, 'NCR 211 pulling wire and megging 2 electricians', 8, 3, 0),
(10, 'NCR 211 Pulling Wire and Megging Wire', 1, 3, 0),
(11, 'NCR 241 Grounding Double Lug, and Silica Bronze ha', 0, 3, 0),
(12, 'NCR 211', 8, 3, 0),
(13, 'mounting the PA speaker above the ceiling in the S', 8, 3, 0),
(14, 'Cleaning Grout on Concourse level', 8, 4, 0),
(15, 'Best is removing wall panels', 8, 4, 0),
(16, 'Polishing hand rails', 8, 4, 0),
(17, 'making adjustments to B9A fixtures', 2, 5, 0),
(18, 'Grounding CTR1', 3, 5, 0),
(19, 'Camera Removal and pulling 5 Camera feeds', 3, 5, 0),
(20, 'Installing warning strips', 3, 6, 0),
(21, 'Installing SAB ceiling', 1, 6, 0),
(22, 'Cleaning Interface', 8, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Build`
--

CREATE TABLE `Build` (
  `BuildID` int(11) NOT NULL,
  `Build` decimal(2,2) NOT NULL,
  `BuildType` varchar(12) NOT NULL,
  `Changes` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `CDL`
--

CREATE TABLE `CDL` (
  `DefID` int(10) UNSIGNED NOT NULL,
  `OldID` varchar(24) DEFAULT NULL,
  `Location` int(11) NOT NULL,
  `SpecLoc` varchar(55) NOT NULL,
  `Severity` int(11) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Spec` varchar(255) DEFAULT NULL,
  `DateCreated` date NOT NULL,
  `Status` int(11) NOT NULL,
  `IdentifiedBy` varchar(24) NOT NULL,
  `SystemAffected` int(11) NOT NULL,
  `GroupToResolve` int(11) NOT NULL,
  `ActionOwner` varchar(55) DEFAULT NULL,
  `EvidenceType` int(11) DEFAULT NULL,
  `EvidenceLink` varchar(255) DEFAULT NULL,
  `DateClosed` date DEFAULT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Comments` varchar(1000) DEFAULT NULL,
  `Updated_by` varchar(25) DEFAULT NULL,
  `Created_by` varchar(25) DEFAULT NULL,
  `SafetyCert` int(11) NOT NULL,
  `RequiredBy` int(11) NOT NULL,
  `DueDate` date DEFAULT NULL,
  `ClosureComments` varchar(1000) DEFAULT NULL,
  `Pics` int(11) DEFAULT NULL,
  `Repo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CDL`
--

INSERT INTO `CDL` (`DefID`, `OldID`, `Location`, `SpecLoc`, `Severity`, `Description`, `Spec`, `DateCreated`, `Status`, `IdentifiedBy`, `SystemAffected`, `GroupToResolve`, `ActionOwner`, `EvidenceType`, `EvidenceLink`, `DateClosed`, `LastUpdated`, `Comments`, `Updated_by`, `Created_by`, `SafetyCert`, `RequiredBy`, `DueDate`, `ClosureComments`, `Pics`, `Repo`) VALUES
(1, '', 1, 'TCR Cabinet 27', 3, 'Lock on cabinet is missing', '0', '2018-03-14', 1, 'Mike Robertson', 9, 1, 'Aldridge/Rosendin', 0, '', NULL, '2018-03-22 21:04:04', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(2, '', 1, 'CTR-1, Cab 27-1', 2, 'Speaker cables not landed, other speaker wires doubled up on Term. Blocks', '0', '2018-03-14', 1, 'Mike Robertson', 9, 8, 'Aldridge/Rosendin', 0, '', NULL, '2018-03-22 21:06:40', '', 'rburns', 'rburns', 2, 6, '2018-03-31', '', 0, 0),
(3, '', 1, 'CTR-2 cab27-1', 2, 'Speaker wires doubled up on terminal blocks', '0', '2018-03-21', 1, 'Mike Robertson', 9, 8, '', 0, '', NULL, '2018-03-22 21:08:11', '', 'rburns', 'rburns', 2, 3, '2018-03-31', '', 0, 0),
(4, '', 1, 'CTR-3 cab 27-3', 2, 'Speaker wires doubled up on terminal blocks', '0', '2018-03-21', 1, 'Mike Robertson', 9, 8, '', 0, '', NULL, '2018-03-22 21:05:09', '', 'rburns', 'rburns', 1, 3, '2018-03-31', '', 0, 0),
(5, '', 2, 'TCR, cab 27', 2, 'Speaker wires doubled up on terminal blocks', '0', '2018-03-21', 1, 'Mike Robertson', 9, 8, '', 0, '', NULL, '2018-03-22 21:09:12', '', 'rburns', 'rburns', 2, 3, '2018-03-31', '', 0, 0),
(6, '', 2, 'CTR-1, Cab 27-1', 2, 'Speaker wires doubled up on terminal blocks', '0', '2018-03-21', 1, 'Mike Robertson', 9, 8, '', 0, '', NULL, '2018-03-22 21:17:10', '', 'rburns', 'rburns', 2, 3, '2018-03-03', '', 0, 0),
(7, '', 1, 'Concourse North', 2, 'Four Cameras mounted too low, Cameras need to be at 11\' high.', '0', '2018-03-21', 1, 'Mike Robertson', 18, 8, '', 0, '', NULL, '2018-03-22 21:32:05', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(8, '', 1, 'Concourse South', 2, 'Five cameras mounted too low, requirement is 11 foot to bottom of dome.', '0', '2018-03-21', 1, 'Mike Robertson', 18, 8, '', 0, '', NULL, '2018-03-22 21:11:37', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(9, '', 2, 'Concourse North', 2, 'Five cameras are too low, need to be 11 foot to the bottom of the dome.', '0', '2018-03-21', 1, 'Mike Robertson', 18, 8, '', 0, '', NULL, '2018-03-22 21:11:51', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(10, '', 2, 'South Concourse', 2, 'Eight cameras too low, need to be 11 foot to bottom of dome.', '0', '2018-03-21', 1, 'Mike Robertson', 18, 8, '', 0, '', NULL, '2018-03-22 21:11:44', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(11, '', 2, 'All elevators', 3, 'Commercial issue stopping A/R working inside the elevators.', '0', '2018-03-21', 1, 'Mike Robertson', 18, 22, 'Joe Bayat', 0, '', NULL, '2018-03-22 21:12:02', '', 'rburns', 'rburns', 2, 6, '2018-03-31', '', 0, 0),
(12, '', 1, 'Ancillary building', 2, 'Bike storage not installed yet', '0', '2018-03-21', 1, 'Mike Robertson', 18, 8, '', 0, '', NULL, '2018-03-22 21:12:12', '', 'rburns', 'rburns', 2, 7, '2018-03-31', '', 0, 0),
(13, '', 2, 'All camera locations', 1, 'Camera mountings are not rigid enough.', '0', '2018-03-21', 1, 'Mike Robertson', 18, 8, '', 0, '', NULL, '2018-03-22 21:12:21', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(14, '', 1, 'All camera locations', 1, 'Camera mountings not rigid enough.', '0', '2018-03-21', 1, 'Mike Robertson', 18, 8, '', 0, '', NULL, '2018-03-22 21:12:30', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(15, '', 1, 'All elevators', 3, 'Commercial issue preventing AR from working inside elevator cabs.', '0', '2018-03-21', 1, 'Mike Robertson', 18, 22, '', 0, '', NULL, '2018-03-22 21:12:37', '', 'rburns', 'rburns', 2, 3, '2018-03-31', '', 0, 0),
(16, '', 1, 'Doors', 1, 'Many door movements = False alarms', '0', '2018-03-21', 1, 'Mike Robertson', 19, 8, '', 0, '', NULL, '2018-03-22 21:12:45', '', 'rburns', 'rburns', 2, 3, '2018-03-31', '', 0, 0),
(17, '', 1, 'S26', 3, 'Front panel door on controllers missing', '0', '2018-03-21', 1, 'Mike Robertson', 19, 8, '', 0, '', NULL, '2018-03-22 21:12:52', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(18, '', 2, 'Generator Yard Access Control', 2, 'No access control hdwe installed on gate', '0', '2018-03-21', 1, 'Mike Robertson', 19, 8, '', 0, '', NULL, '2018-03-22 21:13:24', '', 'rburns', 'rburns', 2, 3, '2018-03-31', '', 0, 0),
(19, '', 1, 'Ancillary building, VTA Comm Rm', 1, 'No enclosure or fiber splice box installed.', '0', '2018-03-21', 1, 'Mike Robertson', 19, 8, '', 0, '', NULL, '2018-03-22 21:13:01', '', 'rburns', 'rburns', 2, 6, '2018-03-31', '', 0, 0),
(20, '', 1, 'Concourse', 2, 'Mounting of VMS not sturdy enough.', '0', '2018-03-21', 1, 'Mike Robertson', 20, 8, '', 0, '', NULL, '2018-03-22 21:13:41', '', 'rburns', 'rburns', 2, 8, '2018-03-31', '', 0, 0),
(21, '', 1, 'DSU', 1, 'DSU\'s shave broken comms fibers.', '0', '2018-03-21', 1, 'Mike Robertson', 21, 8, '', 0, '', NULL, '2018-03-22 21:18:11', '', NULL, 'rburns', 2, 3, '2018-03-31', '', NULL, 0),
(22, '', 2, 'TCR', 3, 'Systemwide HMIs using Windows XP, an unsupported operating system.', '0', '2018-03-22', 1, 'Bryan Lamoreaux', 3, 3, '', 0, '', NULL, '2018-03-22 22:38:17', '', NULL, 'bryanlamoreaux', 0, 4, '0000-00-00', '', NULL, 0),
(23, '', 1, 'Fire Pump Controller', 1, '1.	ATS#1 and Fire Pump Controller did not transfer from Normal to Emergency Power within 10 seconds or less, as per NFPA 110.  (The transfer time was recorded as 11 seconds. )', '0', '2018-03-26', 1, 'Nicholas Pappas', 4, 1, 'AR', 0, '', NULL, '2018-03-26 14:33:11', '', NULL, 'rburns', 0, 60, '2018-04-05', '', NULL, 0),
(24, '', 1, 'Fire Pump Controller', 3, '2.	When transferring from Normal to Emergency the Fire Pump Controller, Phase Reversal Alarm is initiated. ', '0', '2018-03-26', 1, 'Nicholas Pappas', 4, 1, 'AR', 0, '', NULL, '2018-03-26 14:34:37', '', NULL, 'rburns', 0, 60, '2018-04-05', '', NULL, 0),
(25, '', 1, 'Station Electrical Room', 3, 'The energy analyzer does not appear to be instantaneously recording the load. ', '0', '2018-03-26', 1, 'Nicholas Pappas', 1, 1, '', 0, '', NULL, '2018-03-26 14:36:05', 'Identified during the Milpitas Generator Testing event.', NULL, 'rburns', 0, 60, '2018-04-05', '', NULL, 0),
(26, '', 1, 'Station Electrical Room', 3, 'A data logger was not present to measure voltage overshoot, frequency overshoot and seconds to return to steady state, as required by the submitted test procedures.  See page 5 of 9, procedure #1.  When this test is performed it will require a loadbank. ', '0', '2018-03-26', 1, 'Nicholas Pappas', 1, 1, '', 0, '', NULL, '2018-03-26 14:37:30', 'Identified during Milpitas Generator Testing event.', NULL, 'rburns', 0, 60, '2018-04-05', '', NULL, 0),
(27, '', 1, 'Station Electrical Room', 2, 'The following alarms were not tested for, per the test plan: low oil pressure fault shutdown, overspeed fault shutdown protection, high temperature fault shutdown, low water fault shutdown, high engine shutdown and low oil pressure fault warning. (Eric, Kohler Technician, indicated that because this is an EMC-controlled engine, he was not aware of a way to test for these conditions.) Proper operation needs to be verified.  Was operation for these alarms tested for in the factory? ', '0', '2018-03-26', 1, 'Nicholas Pappas', 1, 1, '', 0, '', NULL, '2018-03-26 14:40:26', 'Identified during the Milpitas Generator Testing event', NULL, 'rburns', 0, 50, '2018-04-05', '', NULL, 0),
(28, '', 1, 'Generator Yard', 2, 'Generator battery was not secured. ', '0', '2018-03-26', 1, 'Nicholas Pappas', 1, 1, '', 0, '', NULL, '2018-03-26 14:41:58', 'Identified during the Milpitas Generator test Event.', NULL, 'rburns', 0, 50, '2018-04-05', '', NULL, 0),
(29, '', 1, 'Station Electrical Room', 2, 'Main breaker incidentally trips when upstream breaker is transferred to open.  ', '0', '2018-03-26', 1, 'Nicholas Pappas', 1, 1, '', 0, '', NULL, '2018-03-26 14:47:26', 'Recorded during Milpitas Generator Testing Event', NULL, 'rburns', 0, 50, '2018-04-05', '', NULL, 0),
(30, '', 1, 'Generator Yard', 2, 'No Generator noise test was performed.  This was a factory required test that was agreed to be performed in the field. ', '0', '2018-03-26', 1, 'Nicholas Pappas', 1, 1, '', 0, '', NULL, '2018-03-26 14:50:04', 'Observed during Milpitas Generator Revenue Tests.', NULL, 'rburns', 0, 60, '2018-04-05', '', NULL, 0),
(31, '', 1, 'SPD', 3, 'Cabinet is improperly grounded - does not meet NEC 2010 300.12 requirements. AR to resolve.', '0', '2018-04-05', 1, 'Bryan Lamoreaux', 3, 3, '', 0, '', NULL, '2018-04-05 20:25:35', '', NULL, 'bryanlamoreaux', 0, 10, '0000-00-00', '', NULL, 0),
(32, '', 2, 'Station Agent Booth', 3, 'The window with the talk through amplifier on the paid side of the Station Agent Booth needs to be pulled out rotated 180 degrees and placed back in. The current state of the window has the talk through amplifier over top of the counter in the station agent booth, it needs to be in a location where the Agent inside can walk up to talk through it. Rotating the window 180 degrees will resolve the issue.', '0', '2018-04-10', 1, 'Saxon Vandevanter', 5, 22, '', 4, '', NULL, '2018-04-25 21:15:41', '', 'svandevanter', 'svandevanter', 0, 10, '2018-04-13', 'The window at Berryessa has been rotated to the correct location. Karim wrote the letter of direction.\r\nThis item can be closed.', 0, 2),
(33, '', 1, 'milpitas & berryessa Station Agent Booths', 2, 'Both Station agent booths do not have the counter top access holes in the counter tops needed by HSQ to route equipment wire through.', '0', '2018-04-10', 1, 'Saxon Vandevanter', 3, 11, '', 0, '', NULL, '2018-04-25 21:16:48', '', 'svandevanter', 'svandevanter', 0, 10, '2018-04-20', '', 0, 0),
(34, '', 1, 'milpitas & berryessa Stations', 1, 'The Fire telephones are not to BFS stanards. They are needing a strobe light and locks on the boxes to meet BFS standards', '0', '2018-04-10', 1, 'Saxon Vandevanter', 23, 23, '', NULL, '', NULL, '2018-04-10 18:43:15', '', NULL, 'svandevanter', 0, 10, '2018-04-20', '', NULL, 0),
(35, 'SWA-1', 5, 'AC House', 3, 'HMI alarm does not state \"test\" as per SI NO 4: SWA 34.5kV Breaker 252-1 Position - Test', '0', '2018-04-25', 2, 'Amy Fauria', 14, 14, 'Kapsch', 6, 'N/A', NULL, '2018-04-25 23:16:43', '', 'rburns', 'rburns', 0, 20, '2018-04-25', 'Transferred in from SVBX TPSS Field Testing Discrepancy List - 3 16 18, already shown as closed via Standard Field Test (Code 2).', 0, 0),
(36, 'SWA-2', 5, 'AC House', 3, 'HMI alarm does not state \"disconnect\" as per SI NO 4: SWA 34.5kV Breaker 252-1 Position - Disconnect', '0', '2018-04-25', 2, 'Amy Fauria', 14, 14, 'Kapsch', 6, 'N/A', NULL, '2018-04-25 23:17:07', '', 'rburns', 'rburns', 2, 20, '2018-04-25', 'Transferred in from SVBX TPSS Field Testing Discrepancy List - 3 16 18, already shown as closed via Standard Field Test (Code 2).', 0, 0),
(37, 'SWA-3', 5, 'AC House', 3, 'HMI alarm does not state \"test\" as per SI NO 4: SWA 34.5kV Breaker 252-2 Position - Test', '0', '2018-04-25', 2, 'Amy Fauria', 14, 14, 'Kapsch', 6, 'N/A', NULL, '2018-04-25 23:16:18', 'SI NO 4: SWA 34.5kV Breaker 252-2 Position - Test', NULL, 'rburns', 2, 20, '2018-04-25', 'Transferred in from SVBX TPSS Field Testing Discrepancy List - 3 16 18, already shown as closed via Standard Field Test (Code 2).', NULL, 0),
(38, 'SWA-4', 5, 'AC House', 3, 'HMI alarm does not state \"disconnect\" as per SI NO 11: SWA 34.5kV Breaker 252-2 Position - Disconnect', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to change text to include \"test\", \"disconnected\", and \"connected\". Also, confirm visibility on the screen. ', NULL, 0),
(39, 'SWA-5', 5, 'AC House', 3, 'HMI alarm does not state \"test\" as per SL NO 16: SWA 34.5kV Breaker 252-8 Position - Test', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to change text to include \"test\", \"disconnected\", and \"connected\". Also, confirm visibility on the screen. ', NULL, 0),
(40, 'SWA-6', 5, 'AC House', 3, 'HMI alarm does not state \"disconnect\" as per SL NO 17: SWA 34.5kV Breaker 252-8 Position - Disconnect', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to change text to include \"test\", \"disconnected\", and \"connected\". Also, confirm visibility on the screen. ', NULL, 0),
(41, 'SWA-7', 5, 'AC House', 3, 'No alarm recorded on HMI as per SL NO 18: SWA 34.5kV Switchgear in Local Control', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '\"Local Control\" should come in to the HMI as alarm and cleared when in remote position.', NULL, 0),
(42, 'SWA-8', 5, 'DC House', 3, 'No alarm recorded on HMI as per SL NO 20: SWA 1000VDC Switchgear in Local Control', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '\"Local Control\" should come in to the HMI as alarm and cleared when in remote position.', NULL, 0),
(43, 'SWA-9', 5, 'DC House', 3, 'Comes as \"loss of communication\" See item 148 as per SL NO 37: SWA Control Power Trouble - Transformer Rectifier Unit 1', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Powell to validate installation was done correctly and retest. ', NULL, 0),
(44, 'SWA-10', 5, 'DC House', 3, '\"Z01\" text not showing on HMI as per SL NO 43: SWA Rectifier Z01 GND Fault Circuit Control Power Failure', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to change text to include \"Z01\" on the HMI.', NULL, 0),
(45, 'SWA-11', 5, 'DC House', 3, 'TEXT CURRENTLY SAYS UNIT 1 FOR UNIT 2.  as per SL NO 59: SWA Control Power Trouble - Transformer Rectifier Unit 1', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'BART', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'BART TO CHANGE TEXT TO MATCH UPDATED IO LIST. TEXT CURRENTLY SAYS UNIT 1 FOR UNIT 2. ', NULL, 0),
(46, 'SWA-12', 5, 'DC House', 3, '\"Z02\" text not showing on HMI as per SL NO 65: SWA Rectifier Z02 GND Fault Circuit Control Power Failure', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to change text to include \"Z02\" on the HMI.', NULL, 0),
(47, 'SWA-13', 5, 'AC House', 3, '\"Communication trouble\" text at ICS as per SL NO 105: SWA Control Power Trouble - 34.5kV Switchgear 252-8', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'BART/Powell', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Jeff to investigate and change/provide direction if needed. Redlines from BART to be sent to Powell for wire changes and additions.', NULL, 0),
(48, 'SWA-14', 5, 'AC House', 3, 'Fire alarm generate trouble alarm local. Alarm should be at PTC & HMI as per SL NO 111: SWA AC House L01 Power Loss Alarm', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Powell to configure the fire alarm to annunciate for both ac power loss and battery power loss. This should be combined under the fire alarm trouble alarm. ', NULL, 0),
(49, 'SWA-15', 5, 'AC House', 3, 'Could not be verified due to UON shutdown as per SL NO 112: SWA AC House P01 Power Loss Alarm', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'retest', NULL, 0),
(50, 'SWA-16', 5, 'AC House', 3, 'MECHANICAL ISSUE AT THE ATS IS NOT ALLOWING FOR PROPER TRANSFER OF POWER as per SL NO 113: SWA Automatic Transfer Switch 480 V AC Power Source On', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/GE', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'GE FIXED AND TESTED MANUAL ISSUE - WILL BE SIGNED ON 3/22/18', NULL, 0),
(51, 'SWA-17', 5, 'AC House', 3, 'There is only one unit. No need to verify. as per SL NO 120: SWA AC House Unit 2 Loss of Ventillation', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'delete point', NULL, 0),
(52, 'SWA-18', 5, 'DC House', 3, 'TEXT INCORRECT AT HMI as per SL NO 123: SWA ETTS Blue Light Station Trip', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH TO CHANGE TEXT PER IO LIST', NULL, 0),
(53, 'SWA-19', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 124: SWA ETTS BLS Line Fault Equipment Trouble (Hardware)', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(54, 'SWA-20', 5, 'DC House', 3, 'To be tested as part of ETTS. KAPSCH TO PUSH POINT FROM C02 AND CONFIRM CORRECT TEXT CHANGE. as per SL NO 125: SWA Transfer Trip Rail Zone (SL07)', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(55, 'SWA-21', 5, 'DC House', 3, 'To be tested as part of ETTS. KAPSCH TO PUSH POINT FROM C02 AND CONFIRM CORRECT TEXT CHANGE. as per SL NO 126: SWA Transfer Trip Rail Zone (SR05)', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(56, 'SWA-22', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 127: SWA Emergency Trip Rail Zone (SL07)', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(57, 'SWA-23', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 128: SWA Emergency Trip Rail Zone (SR05)', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(58, 'SWA-24', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 129: SWA 2505 Trouble Alarm IOM_ETTC_TRP Alarm', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(59, 'SWA-25', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 130: SWA 2505 Trouble Alarm IOM_ETTC_ETP Alarm', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'DELETED FROM IO LIST', NULL, 0),
(60, 'SWA-26', 5, 'DC House', 3, 'Commincation to SWS ETTC WAS TESTED BUT BAUD RATE AND OTHER CHANGES PER RFI RESPONSE WAS NOT MADE BY KAPSCH as per SL NO 131: SWA ETTC Port 2 Channel A Fail', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH TO UPDATE BAUD RATE AND IMPLEMENT ALL CHANGES PER RFI RESPONSE FROM VTA IN ORDER TO TEST FUNCTIONALITY.', NULL, 0),
(61, 'SWA-27', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 132: SWA ETTC Port 3 Channel B Fail', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(62, 'SWA-28', 5, 'DC House', 3, 'COMES IN WITH OTHER ALARMS. as per SL NO 133: SWA Battery System Voltage Problem', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Powell to retest and make sure the alarms are received individually.', NULL, 0),
(63, 'SWA-29', 5, 'AC House', 3, 'Alarms reversed with SL 139 at ICS & EBP. as per SL NO 138: SWA AC Input Failure Alarm', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Powell to retest and make sure the alarms are received individually.', NULL, 0),
(64, 'SWA-30', 5, 'DC House', 3, 'Alarms reversed with SL 138 at ICS & EBP. as per SL NO 139: SWA DC Output Failure Alarm', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Powell to retest and make sure the alarms are received individually.', NULL, 0),
(65, 'SWA-31', 5, 'DC House', 3, 'Received daily nuisance alarm as per SL NO 70: SWA G01-3 Bypass Switch Closed', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'BART', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Jeff to investigate once the power is back on. ', NULL, 0),
(66, 'SWA-32', 5, 'DC House', 3, 'FAILED. LOCKED OUT. GENERATED AS NUISANCE ALARM. as per SL NO 71: SWA G01 System Trouble', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'ALL', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Jeff to investigate once the power is back on. POWELL TO INVESTIGATE WHY LOCKED OUT.', NULL, 0),
(67, 'SWA-33', 5, 'DC House', 3, 'Received as \"Control power trouble\" at HMI as per SL NO 77: SWA 1000VDC Main Breaker 172-1 Control Power Failure', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to update on HMI the alarm text per the IO list. Jeff to investigate at PTC.', NULL, 0),
(68, 'SWA-34', 5, 'DC House', 3, 'Received as \"Control power trouble\" at HMI as per SL NO 81: SWA 1000VDC Main Breaker 172-4 Control Power Failure', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to update on HMI the alarm text per the IO list. Jeff to investigate at PTC.', NULL, 0),
(69, 'SWA-42', 5, 'DC House', 3, 'HMI alarm does not state \"test\" as per SL NO 95: SWA 1000VDC FDR Breaker 172-3 Position - Test', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to update on HMI the alarm text per the IO list. Jeff to investigate at PTC.', NULL, 0),
(70, 'SWA-43', 5, 'DC House', 3, 'HMI alarm does not state \"disconnect\" as per SL NO 96: SWA 1000VDC FDR Breaker 172-3 Position - Disconnected', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to update on HMI the alarm text per the IO list. Jeff to investigate at PTC.', NULL, 0),
(71, 'SWA-44', 5, 'AC House', 3, '\"Communication trouble\" text at ICS as per SL NO 103: SWA Control Power Trouble - 34.5kV Switchgear 252-1', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'CONFIRM WIRING IS CORRECT AND KAPSCH TO VALIDATE POINTS', NULL, 0),
(72, 'SWA-45', 5, 'AC House', 3, '\"Communication trouble\" text at ICS as per SL NO 104: SWA Control Power Trouble - 34.5kV Switchgear 252-2', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'CONFIRM WIRING IS CORRECT AND KAPSCH TO VALIDATE POINTS', NULL, 0),
(73, 'SWA-46', 5, 'AC House', 3, 'HMI text is incorrect - missing word \"transformer\" in alarm description as per SL NO 147: SWA Transformer X02 Communication Trouble', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH TO CHANGE TEXT PER IO LIST', NULL, 0),
(74, 'SWA-47', 5, 'AC House', 3, 'Incorrectly named on ICS & EBP as X02 loss (SL 147) as per SL NO 148: SWA Rectifier Z01 Loss of Communication or Loss of Control Power', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to match tag name with description', NULL, 0),
(75, 'SWA-48', 5, 'DC House', 3, 'Received daily nuisance alarm as per SL NO 150: SWA Battery Charger Communication Trouble', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'BART', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Jeff to investigate once the power is back on. ', NULL, 0),
(76, 'SWA-49', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 153: SWA ETTC BLS Trip From SR05 North', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(77, 'SWA-50', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 154: SWA ETTC BLS Trip From SR05 South', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(78, 'SWA-51', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 155: SWA ETTC BLS Trip From SL07 North', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(79, 'SWA-52', 5, 'DC House', 3, 'To be tested as part of ETTS. as per SL NO 156: SWA ETTC BLS Trip From SL07 South', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested during ETTS', NULL, 0),
(80, 'SWA-53', 5, 'AC House', 3, 'To be tested. as per SL NO 157: SWA AUX Transformer X10 Winding High Temp Alarm', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'To be tested.', NULL, 0),
(81, 'SWA-54', 5, 'AC House and DC House', 3, 'This EBP functionality has not been added to the software. It is not required per contract. VTA to give clear direction if required.  as per SL NO 171-184: \"Command Fail\" and \"Uncommanded Change\" Alarms for all AC and DC breakers.', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Delete from the points list and the program.', NULL, 0),
(82, 'SWA-55', 5, 'AC House and DC House', 3, 'Descriptions inverted for Transformer X01/Rectifier Z01 Communication Alarms as per SWA-C02-Prerequisite', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Validate that the tag names and descriptions match and change if necessary.', NULL, 0),
(83, 'SWA-56', 5, 'AC House and DC House', 3, 'Descriptions inverted for Battery Charger AC Input Fail / DC Output Fail Alarms as per SWA-C02-Prerequisite', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'DISCREPANCY ADDED AS SWA-73-74', NULL, 0),
(84, 'SWA-57', 5, 'DC House', 3, 'Control Power Loss on Rectifier Cabinets created a locked port on Network Switch. Connection was moved to spare port to continue testing.  as per SWA-C02-P1', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Investigate the issue and resolve. ', NULL, 0),
(85, 'SWA-58', 5, 'AC House', 3, 'When Close command is issued by EBP workstation for Breakers 252-1, 252-2, and 252-8, the breakers do not close. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Retest.', NULL, 0),
(86, 'SWA-59', 5, 'AC House', 3, 'EBP does not allow you to issue a Close command while 243 Switch is in Local position. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Item is closed.', NULL, 0),
(87, 'SWA-60', 5, 'AC House', 3, 'EBP functionality to close breakers has not been verified. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Retest.', NULL, 0),
(88, 'SWA-61', 5, 'DC House', 3, 'When Close command is issued by EBP workstation for Breakers 172-1 and 172-4, the breakers do not close. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Retest.', NULL, 0),
(89, 'SWA-62', 5, 'DC House', 3, 'EBP does not allow you to issue a Close command while 143 Switch is in Local position in relation to 172-1 and 172-4. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Item is closed.', NULL, 0),
(90, 'SWA-63', 5, 'DC House', 3, 'EBP functionality to close breakers has not been verified, in relation to 172-1 and 172-4. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Retest.', NULL, 0),
(91, 'SWA-64', 5, 'DC House', 3, 'When Close command is issued by EBP workstation for Breakers 172-2 and 172-3, the breakers do not close. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Retest.', NULL, 0),
(92, 'SWA-65', 5, 'DC House', 3, 'EBP does not allow you to issue a Close command while 143 Switch is in Local positionin relation to 172-2 and 172-3. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Item is closed.', NULL, 0),
(93, 'SWA-66', 5, 'DC House', 3, 'EBP functionality to close breakers has not been verified in relation to 172-2 and 172-3. as per SWA-C02-P3', 'SWA SIT Procedure Functional Test', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Retest.', NULL, 0),
(94, 'SWA-67', 5, 'AC House', 3, 'CANT GET LOSS OF CONTROL POWER FOR AC BREAKERS as per SL ITEMS 103, 104, AND 105.', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Add a breaker and wiring based on BART redlines. ', NULL, 0),
(95, 'SWA-68', 5, 'DC House', 3, 'Cathode positions have no points on the IO points list.  as per ', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Add IO points for position status for cathode breakers.', NULL, 0),
(96, 'SWA-69', 5, 'AC House', 3, 'INCONSISTENT BETWEEN HMI/ICS as per SL NO 124', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH TO CHANGE TEXT PER IO LIST', NULL, 0),
(97, 'SWA-70', 5, 'AC House', 3, 'TEXT DESCRIPTION IN IO LIST INCORRECT as per SL NO 125-128', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(98, 'SWA-71', 5, 'AC House', 3, 'ETTC PORT 2 CHANNEL A AND ETTC PORT 3 CHANNEL B FAILS - ALARM NOT GENERATED - INVESTIGATE AND CORRECT AT ALL SITES as per SL NO 131-132', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(99, 'SWA-72', 5, 'AC House', 3, 'HARDWARE NOT YET INSTALLED - ALARM WAS SHOWN TO MATCH IO TEXT. DELETE POINT. as per SL NO 129', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'no action', NULL, 0),
(100, 'SWA-73', 5, 'AC House', 3, 'TO BE RETESTED FOR TEXT CORRECTION as per SI NO 115', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Powell to retest and make sure the alarms are received individually.', NULL, 0),
(101, 'SWA-74', 5, 'AC House', 3, 'TO BE RETESTED FOR TEXT CORRECTION as per SI NO 116', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Powell to retest and make sure the alarms are received individually.', NULL, 0),
(102, 'SWA-75', 5, 'AC House', 3, 'TO BE RETESTED FOR TEXT CORRECTION as per SI NO 117', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Test needs to be conducted', NULL, 0),
(103, 'SWA-76', 5, 'AC House', 3, 'TO BE RETESTED FOR TEXT CORRECTION as per SI NO 118', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Test needs to be conducted', NULL, 0),
(104, 'SWA-77', 5, 'AC House', 3, 'TO BE RETESTED FOR TEXT CORRECTION as per SI NO 119', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(105, 'SWA-78', 5, 'AC House', 3, 'ITEM TO BE DELETED FROM IO LIST as per SI NO 120', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(106, 'SWA-79', 5, 'AC House', 3, 'TO BE RETESTED FOR TEXT CORRECTION as per SI NO 121', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(107, 'SWA-80', 5, 'AC House', 3, 'TO BE RETESTED FOR TEXT CORRECTION as per SI NO 122', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(108, 'SWA-81', 5, 'AC House', 3, '\"CONFIRM 286 LOCKOUT CANNOT BE RESET WHEN RECTIFIER TRANSFORMER ALARMS (THAT INITIATE LOCKOUT ARE STILL ACTIVE): FOR X01 AND X02\" ', 'FUNCTIONAL TEST', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'POWELL/KAPSCH to retest prior to round two regression test', NULL, 0),
(109, 'SWA-82', 5, 'DC House', 3, '\"CONFIRM IPR LOSS OF COMMUNICATION IS A SEPARATE ALARM FROM LOSS OF CONTROL POWER\"', 'FUNCTIONAL TEST', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'POWELL/KAPSCH to retest prior to round two regression test', NULL, 0),
(110, 'SWA-83', 5, 'AC House', 3, 'SWA TRANSFORMER X02 LOSS OF VOLTAGE AC POWER ALARM as per SI NO 54', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(111, 'SWA-84', 5, 'AC House', 3, 'TEXT INCORRECT AT HMI as per SI NO 143', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'POWELL/KAPSCH to retest prior to round two regression test', NULL, 0),
(112, 'SWA-85', 5, 'AC House', 3, 'TEXT INCORRECT AT HMI as per SL NO 147: SWA Transformer X01 Communication Trouble', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'POWELL/KAPSCH to retest prior to round two regression test', NULL, 0),
(113, 'SWA-86', 5, 'AC House', 3, 'MAIN TIE MAIN FUNCTION DOES NOT WORK PROPERLY - NORMALLY OPEN BREAKER CLOSES WITH UNDERVOLTAGE CONDITION ON NORMALLY CLOSED BREAKER IN INTERLOCKING POSITION, ISSUE FOUND DURING REGRESSION TEST', 'SWA-C02-P4', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'A/R', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'REDO MAIN TIE MAIN TEST after KAPSCH correction', NULL, 0),
(114, 'SWA-87', 5, 'DC House', 3, 'ANALOGS ON C02 PANEL ARE NOT FUNCTIONING - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, GENERAL ISSUE', 'SWA-C02-P2', '2018-04-30', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'HMI Logic to be updated and retested', NULL, 0),
(115, 'SWA-88', 5, 'DC House', 3, 'HMI CURRENT STATUS SCREEN DOES NOT REPORT AC VOLTAGE VALUES - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN as per HMI SCREEN', 'GENERAL', '2018-04-30', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'HMI Logic to be updated an retested', NULL, 0),
(116, 'SWA-89', 5, 'DC House', 3, 'RECTIFIER CONTROL POWER TROUBLE ALARM IS MISSING DUE TO INCONSISTENT/INCOMPLETE WIRING  ADD EVERYWHERE EXCEPT SSL', '', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(117, 'SWA-90', 5, 'DC House', 3, '\"SWA CONTROL POWER TROUBLE RECTIFIER Z01 AND Z02\" SHOULD REPLACE CURRENT NAMING CONVENTION FOR SI NO 59 AND OTHER ONE as per ADD EVERYWHERE EXCEPT SXC', '', '2018-04-30', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(118, 'SWA-91', 5, 'DC House', 3, 'UPDATE MIMIC PANEL TO INCLUDE NORMALLY OPEN OR NORMALLY CLOSED AS NEEDED. ', 'PUNCHLIST', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(119, 'SWA-92', 5, 'DC House', 3, 'TRANSFER TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION as per SKR TRANSFER TRIP ZONE (SL09), D05 (172-05)', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(120, 'SWA-93', 5, 'DC House', 3, 'EMERGENCY TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION', 'SWA SIT Procedure IO List', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(121, 'SWA-94', 5, 'DC House', 3, 'NGD (G01) DID NOT REPORT TROUBLE ALARM WHEN SYSTEM OK LAMP WAS SHOWING FAULT DUE TO DC POWER NOT AVAILABLE.  as per ', 'GENERAL', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(122, 'SWA-95', 5, 'DC House', 3, 'NEED TO TEST NGD SWITCH POSITION INDICATION', 'GENERAL', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(123, 'SWA-96', 5, 'DC House', 3, 'NGD CONTROL POWER OR SUMMARY (DC POWER) NEEDS TO BE ADDED TO THE NGD TROUBLE ALARM - CURRENTLY WHEN DC POWER ALONE IS LOST, THERE IS AN ALARM AT THE NGD BUT NOT ANNUNCIATED REMOTELY', 'GENERAL', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'HMI/RTAC Logic to be updated TO GENERATE SUMMARY ALARM WITH DC POWER LOST ONLY GENERATING SAID ALARM - TO BE retested', NULL, 0),
(124, 'SWA-97', 5, 'DC House', 3, 'LOCAL BLS TRIP GENERATES EMERGENCY TRIP ALARMS AT PTC ONLY. SHOULD BE AT HMI AS WELL. as per ', 'GENERAL', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'HMI to be updated to display alarm correctly - TO BE TESTED ON 3/24', NULL, 0),
(125, 'SWA-98', 5, 'DC House', 3, '186 AND 286 LOCKOUT LIGHTS DO NOT BLINK AT THE C02 PANEL, THIS IS A PUNCHLIST ITEM', 'GENERAL', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', '', NULL, 0),
(126, 'SWA-99', 5, 'DC House', 3, '186 LOCKOUT DOES NOT RESET AFTER LOCAL BLS IS HIT UNTIL RTAC IS RESTARTED. THIS IS NOT TYPICAL.', 'GENERAL', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'KAPSCH to retest and correct issue', NULL, 0),
(127, 'SWA-100', 5, 'AC House', 3, 'AC PHASE ROTATION IS NOT Reading correctly', 'GENERAL', '2018-04-30', 2, 'Amy Fauria', 14, 14, 'Powell', NULL, NULL, NULL, '2018-04-26 17:56:58', NULL, NULL, NULL, 2, 0, '2018-04-30', 'Punchlist item - moved to punchlist.', NULL, 0),
(128, '', 19, 'Guideway at SHR has Radiax proximity to Wet standpipe', 3, 'Although there is RFI#3057  regarding the installation of the Radiax in the guideway, which is very specific, BART wants to revisit this section of cable because they feel it is not installed appropriately.', 'RFI#3057 was closed on 9-28-16', '2018-04-26', 1, 'Wayne Blake', 28, 28, 'Wayne Blake', NULL, '', NULL, '2018-04-26 18:30:29', 'There are photos available to show the installation as it currently exists.', NULL, 'wblake', 0, 60, '2018-05-31', '', NULL, 0),
(129, '', 15, 'Dixon Landing Wayside and 4 more locations', 2, 'NCR-239 radio cabinet heating issues.  SDL radio is getting extremely hot due to solar heating.  Issue also effects SCADA at SDL', '', '2018-04-26', 1, 'Wayne Blake', 28, 28, 'Wayne Blake', NULL, '', NULL, '2018-04-26 18:35:17', 'There are actually 5 locations where this is a problem.\r\nSDL, SPD, STZ, SHR, and SLT', NULL, 'wblake', 0, 60, '2018-05-31', '', NULL, 0),
(130, '', 3, 'ALL facilities with Radio equipment installed', 3, 'All Dali t30 installations are lacking the contractually required sample ports.  This component is a required part for each and every t30 unit.', '', '2018-04-26', 1, 'Wayne Blake', 28, 28, 'Wayne Blake', NULL, '', NULL, '2018-04-26 18:38:43', 'HSQ and A/R were supplied by VTA with a cut-sheet for the part that meets this criteria.  they just need to get the submittal back to me.', NULL, 'wblake', 0, 60, '2018-05-31', '', NULL, 0),
(131, '', 3, 'ALL facilities with Radio equipment installed', 1, 'The SIT2 procedure was submitted by HSQ on 4-4-18, I still have not seen the documentation show up in Aconex.  Cannot proceed with SIT2 until I recieve this', '', '2018-04-26', 1, 'Wayne Blake', 28, 28, 'Wayne Blake', NULL, '', NULL, '2018-04-26 18:41:01', '', NULL, 'wblake', 0, 40, '2018-04-27', '', NULL, 0),
(132, 'SKR-1', 6, 'DC House', 3, 'The alarm could not be generated. , SL NO 33: SKR Transformer x01 loss of voltage 125 VDC seal-in relay.', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Powell/KAPSCH to diagnose why the breaker does not initiate the alarm. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(133, 'SKR-2', 6, 'AC House', 3, 'Turning off the breaker does not initiate the alarm., SL NO 37: SKR control power trouble - transformer rectifier unit 1', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Powell/KAPSCH to diagnose why the breaker does not initiate the alarm. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(134, 'SKR-3', 6, 'DC House', 3, 'The alarm could not be generated. , SL NO 55: SKR Transformer X02 loss of voltage 125 VDC seal-in relay.', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Powell/KAPSCH to diagnose why the breaker does not initiate the alarm. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(135, 'SKR-4', 6, 'AC House', 3, 'Turning off the breaker does not initiate the alarm. Also, the description should say \"unit 2\"., SL NO 59: SKR control power trouble - transformer rectifier unit [2]', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Powell/KAPSCH to diagnose why the breaker does not initiate the alarm. KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(136, 'SKR-5', 6, 'DC House', 3, 'Turning off the breaker does not initiate the alarm. Text reads \"Ground ckt power fail\" at HMI>, SL NO 74: SKR loss of voltage 125 VDC at enclosure ground protection ckt.', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Powell/KAPSCH to diagnose why the breaker does not initiate the alarm. KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(137, 'SKR-6', 6, 'DC House', 3, 'Text reads \"SKR control power trouble - DC switchgear 172-10\" at HMI, SL NO 81: SKR 1000 VDC main breaker 172-10 control power failure', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(138, 'SKR-7', 6, 'AC House', 3, 'This alarm could not be verified as power was cut to UON when power was cut to P01., SL NO 172: SKR AC house P01 power loss alarm', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Retest', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(139, 'SKR-8', 6, 'AC House', 3, 'Text reads \"HVAC power fail\" at HMI, SL NO 179: SKR AC house unit 1 loss of ventilation', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(140, 'SKR-9', 6, 'DC House', 3, 'This alarm could not be generated., SL NO 203: SKR loss of battery air flow', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(141, 'SKR-10', 6, 'AC House', 3, 'This alarm comes together with SL 207 & 201., SL NO 206: SKR AC input failure alarm', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(142, 'SKR-11', 6, 'AC House', 3, 'Received this alarm when generating loss of power alarm also., SL NO 221: SKR transformer X02 comunication trouble', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(143, 'SKR-12', 6, 'AC House', 3, 'Text reads \"Communication trouble\" at HMI, SL NO 222: SKR rectifier Z01 loss of communication or loss of control power', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(144, 'SKR-13', 6, 'AC House', 3, 'Text reads \"Communication trouble\" at HMI, SL NO 223: SKR rectifier Z02 loss of communication or loss of control power', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(145, 'SKR-14', 6, 'AC House', 3, 'Text reads \"ETTC offline\" at HMI, SL NO 226: SKR ETTS communication trouble', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0);
INSERT INTO `CDL` (`DefID`, `OldID`, `Location`, `SpecLoc`, `Severity`, `Description`, `Spec`, `DateCreated`, `Status`, `IdentifiedBy`, `SystemAffected`, `GroupToResolve`, `ActionOwner`, `EvidenceType`, `EvidenceLink`, `DateClosed`, `LastUpdated`, `Comments`, `Updated_by`, `Created_by`, `SafetyCert`, `RequiredBy`, `DueDate`, `ClosureComments`, `Pics`, `Repo`) VALUES
(146, 'SKR-15', 6, 'AC House & DC House', 3, 'This EBP functionality has not been added to the software. It is not required per contract. VTA to give clear direction if required. , SL NO 251-276: \"Command Fail\" and \"Uncommanded Change\" Alarms for all AC and DC breakers.', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Delete from the points list and the program.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(147, 'SKR-16', 6, 'AC House', 3, 'This procedure does not generate an alarm for 2B \"Verify that the communication status is offline (a communication failure alarm is generated by the EBP System)\" but the graphic for SKR is greyed out and not functioning. , SKR-C02-P1', 'SKR SIT Procedure Functional Test', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(148, 'SKR-17', 6, 'AC House', 3, 'EBP DOES NOT HAVE \"CLOSE\" BUTTONG FOR \"VERIFY THAT THE BREAKER DOES NOT CLOSE\" for item 5 in AC breakers., SKR-C02-P3', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Delete from the points list and the program.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(149, 'SKR-18', 6, 'AC House', 3, 'Breakers  set 4 and 8, and set 6 and 9 should not close because there is interlocking between each set of two. POWELL BELIEVES THIS IS A DESIGN ISSUE AND BREAKERS WORK PER DESIGN. , SKR-C02-P3', 'SKR SIT Procedure IO List', '2017-08-31', 2, 'Amy Fauria', 14, 14, 'BART', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MEET FOR RESOLUTION', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(150, 'SKR-19', 6, 'AC House', 3, 'EBP DOES NOT HAVE \"CLOSE\" BUTTONG FOR \"VERIFY THAT THE BREAKER DOES NOT CLOSE\" for item 5 in DC cathode breakers., SKR-C02-P3', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Delete from the points list and the program.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(151, 'SKR-20', 6, 'AC House', 3, 'EBP DOES NOT HAVE \"CLOSE\" BUTTONG FOR \"VERIFY THAT THE BREAKER DOES NOT CLOSE\" for item 5 in DC feeder breakers., SKR-C02-P3', 'SKR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:27:30', 'Delete from the points list and the program.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(152, 'SKR-21', 6, '', 3, 'NO BLS ID ALARM FOR REMOTE BLS - NON TRACTION POWER SCADA ISSUE - UPDATE SCADA VIA SEPARATE TEST, SKR-ETTS-P2', 'SKR ETTS Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(153, 'SKR-22', 6, '', 3, 'NORMALLY OPEN BREAKERS CLOSE WHEN THEY SHOULDN’T BE ALLOWED TO BASED ON INTERLOCKING, SKR-ETTS-P2', 'SKR ETTS Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:30', 'CARRIED OVER TO SKR-18', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(154, 'SKR-23', 6, '', 3, 'BREAKER 9 CLOSED SO NOT DE-ENERGIZED, NON TRANSFER TRIP TEST - SKR-ETTS-P2 - NUMBER 7', 'SKR ETTS Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(155, 'SKR-24', 6, '', 3, 'NO DESCRIPTION AT HMI, SL NO 184', 'SKR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(156, 'SKR-25', 6, '', 3, 'NO DESCRIPTION AT HMI, SL NO 185', 'SKR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(157, 'SKR-26', 6, '', 3, 'NO ALARM AT HMI, SL NO 196-197', 'SKR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(158, 'SKR-27', 6, '', 3, 'TEXT INCORRECT AT HMI, SL NO 198-200', 'SKR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(159, 'SKR-28', 6, '', 3, 'TEXT INCORRECT AT HMI, SI NO 32', 'SKR SIT Procedure IO List', '1900-01-00', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(160, 'SKR-29', 6, '', 3, 'REPLACE ETP MTL 5514D UNIT WITH ETP MTL 5514, FOUND DURING ETTS TESTING', 'SKR ETTS Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to reinstall MTLs', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(161, 'SKR-30', 6, '', 3, 'ETTC PORT 2 CHANNEL A AND ETTC PORT 3 CHANNEL B FAILS - ALARM NOT GENERATED - INVESTIGATE AND CORRECT AT ALL SITES, FOUND DURING ETTS TESTING', 'SKR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(162, 'SKR-31', 6, '', 3, '\"CONFIRM 286 LOCKOUT CANNOT BE RESET WHEN RECTIFIER TRANSFORMER ALARMS (THAT INITIATE LOCKOUT ARE STILL ACTIVE): FOR X01 AND X02\", ', '', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'POWELL/KAPSCH to retest prior to round two regression test', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(163, 'SKR-32', 6, '', 3, '\"CONFIRM IPR LOSS OF COMMUNICATION IS A SEPARATE ALARM FROM LOSS OF CONTROL POWER\", ', '', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'POWELL/KAPSCH to retest prior to round two regression test', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(164, 'SKR-33', 6, '', 3, 'TEXT INCORRECT AT HMI, SI NO 54', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(165, 'SKR-34', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 173', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(166, 'SKR-35', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 174', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(167, 'SKR-36', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 176', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(168, 'SKR-37', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 178', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(169, 'SKR-38', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 179', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(170, 'SKR-39', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 180', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(171, 'SKR-40', 6, '', 3, 'DELETE POINT, SI NO 181', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(172, 'SKR-41', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 183', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(173, 'SKR-42', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 184', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(174, 'SKR-43', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 185', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(175, 'SKR-44', 6, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 188', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(176, 'SKR-45', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 190', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(177, 'SKR-46', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 191', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(178, 'SKR-47', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 192', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(179, 'SKR-48', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 193', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(180, 'SKR-49', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 194', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(181, 'SKR-50', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 195', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(182, 'SKR-51', 6, '', 3, 'ALARM COMES IN WITH SI NO 201, SI NO 207', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(183, 'SKR-52', 6, '', 3, 'TEXT INCORRECT AT HMI, SI NO 211', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(184, 'SKR-53', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 227', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(185, 'SKR-54', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 228', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(186, 'SKR-55', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 229', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:30', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(187, 'SKR-56', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 230', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(188, 'SKR-57', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 231', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(189, 'SKR-58', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 232', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(190, 'SKR-59', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 233', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(191, 'SKR-60', 6, '', 3, 'ALARM MISSING FROM HMI, SI NO 234', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'MAP TO HMI', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(192, 'SKR-61', 6, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 235', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(193, 'SKR-62', 6, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 236', 'SKR SIT Procedure IO List', '2017-08-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'KAPSCH to update text per the IO list and match tag name with description. ', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(194, 'SKR-63', 6, '', 3, 'MAIN TIE MAIN FUNCTION DOES NOT WORK PROPERLY - NORMALLY OPEN BREAKER CLOSES WITH UNDERVOLTAGE CONDITION ON NORMALLY CLOSED BREAKER IN INTERLOCKING POSITION, ISSUE FOUND DURING REGRESSION TEST', 'SKR-C02-P4', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'A/R', NULL, NULL, NULL, '2018-04-27 19:27:31', 'REDO MAIN TIE MAIN TEST after KAPSCH correction', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(195, 'SKR-64', 6, 'DC', 3, 'Analog DC Bus voltage meter operates incorrectly with the needle repeatedly moving back and forth when no voltage present. - KAPSCH TO CHECK, ANALOGS ON C02 PANEL ARE NOT FUNCTIONING', 'SKR-C02-P2', '1900-01-00', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'KAPSCH REPLACED ANALOGS - NEEDS WITNESS TESTING', NULL, NULL, 2, 30, '2018-05-31', 'Closed', NULL, 0),
(196, 'SKR-65', 6, '', 3, 'ETTP ENCLOSURE DOOR IS RUSTING. NEEDS TO BE CLEANED AND REPAINTED., ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(197, 'SKR-66', 6, '', 3, 'WIRES AT C02 TB1E THAT DO NOT HAVE WIRE LABELS - POWELL TO CHECK, ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(198, 'SKR-67', 6, '', 3, 'BATTERY AIR FLOW SWITCH DOES NOT GENERATE ALARM. WIRES LABELED IN C02 LAND ON TB1E-35 AND 36 BUT ASSOCIATED DRAWING SHOWS DIFFERENT TERMINATION. - RETEST, ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(199, 'SKR-68', 6, '', 3, 'TOC ISSUE AT 252-2., ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(200, 'SKR-69', 6, '', 3, '2440 IS LISTED IN DWG RATHER THAN 2411 FOR RECTIFIER CONTROL - POWELL/KAPSCH TO REDLINE IN FINAL AS-BUILT DRAWINGS, PUNCHLIST', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', 'Punchlist item - moved to punchlist.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(201, 'SKR-70', 6, '', 3, 'SKR FEEDER BREAKER LOSS OF CONTROL POWER DOES NOT REPORT TO HMI. DOES REPORT TO PTC. CATHODE BREAKER DOES WORK, ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(202, 'SKR-71', 6, '', 3, 'WITH SKR D05 AND D08 CLOSED, DC4 CAN BE CLOSED. D08 REMAINS CLOSED DURING PROCEDURE. D08 SHOULD TRIP AFTER D04 CLOSES. SAME PROBLEM EXISTS FOR SKR D09 AND SME D08., ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(203, 'SKR-72', 6, '', 3, 'Z01 AND Z02 CONTROL CUBICLES DOES NOT HAVE THE ADDITIONAL CIRCUIT BREAKERS. , ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(204, 'SKR-73', 6, '', 3, 'CURRENT STATUS SCREEN FEEDER BREAKER AMPERAGE IS OFF EXCEPT FOR D02, ', '', '1900-01-00', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'Powell to retrieve data from current status screen and coordinate with internal engineering and KAPSCH to find issue and apply resolution. ', NULL, NULL, 2, 30, '2018-05-31', 'Kapsch: This has been resolved.  It needs to be tested.  This happened after ETTC modification.  Need train to run to verify.', NULL, 0),
(205, 'SKR-74', 6, '', 3, 'RECTIFIER CONTROL POWER TROUBLE ALARM IS MISSING DUE TO INCONSISTENT/INCOMPLETE WIRING , ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(206, 'SKR-75', 6, '', 3, 'UPDATE MIMIC PANEL TO INCLUDE NORMALLY OPEN OR NORMALLY CLOSED AS NEEDED., ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(207, 'SKR-76', 6, 'DC', 3, 'NGD (G01) DID NOT REPORT TROUBLE ALARM WHEN SYSTEM OK LAMP WAS SHOWING FAULT DUE TO DC POWER NOT AVAILABLE. , ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(208, 'SKR-77', 6, 'DC', 3, 'NEED TO TEST NGD SWITCH POSITION INDICATION, ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(209, 'SKR-78', 6, 'DC', 3, 'ANALOGS ON C02 PANEL ARE NOT FUNCTIONING - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, GENERAL ISSUE', 'SWA-C02-P2', '1900-01-00', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '2018-05-31', 'Closed', NULL, 0),
(210, 'SKR-79', 6, 'DC', 3, 'HMI CURRENT STATUS SCREEN DOES NOT REPORT AC VOLTAGE VALUES - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, HMI SCREEN', 'GENERAL', '1900-01-00', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '2018-05-31', 'Closed', NULL, 0),
(211, 'SKR-80', 6, 'DC', 3, 'NGD CONTROL POWER OR SUMMARY (DC POWER) NEEDS TO BE ADDED TO THE NGD TROUBLE ALARM - CURRENTLY WHEN DC POWER ALONE IS LOST, THERE IS AN ALARM AT THE NGD BUT NOT ANNUNCIATED REMOTELY, ', '', '1900-01-00', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'HMI/RTAC Logic to be updated TO GENERATE SUMMARY ALARM WITH DC POWER LOST ONLY GENERATING SAID ALARM - TO BE retested', NULL, NULL, 2, 30, '2018-05-31', 'Not done yet per Mark Pfeiffer\'s request.', NULL, 0),
(212, 'SKR-81', 6, '', 3, 'BATTERY AIR FLOW SWITCH DOES GENERATE ALARM. WIRES LABELED IN C02 LAND ON TB1E-35 AND 36 BUT ASSOCIATED DRAWING SHOWS DIFFERENT TERMINATION. - UPDATE TO DRAWING LEFT, PUNCHLIST', 'GENERAL', '1900-01-00', 2, 'Amy Fauria', 14, 14, 'POWELL', NULL, NULL, NULL, '2018-04-27 19:27:31', 'Punchlist item - moved to punchlist.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(213, 'SKR-81', 6, 'DC', 3, 'SKR D05 is not interlocking properly with D02 and D06 similar to sxc and sbe. , ', '', '2018-03-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:27:31', 'THE ISLAND BREAKER SHOULD TRIP WHENEVER ANY OF THE ADJACENT BREAKERS TRIP', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(214, 'SRR-1', 7, 'AC House', 3, 'IPR shows alarm but HMI, ICS, & EBP do not., SL NO 40: SRR 34.5kV BREAKER 252-10 IPR OVERCURRENT TRIPPED', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(215, 'SRR-2', 7, 'AC House', 3, 'IPR shows alarm but HMI, ICS, & EBP do not., SL NO 47: SRR 34.5kV BREAKER 252-11 IPR OVERCURRENT TRIPPED', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(216, 'SRR-3', 7, 'AC House', 3, 'INCORRECT TEXT AT ICS, EBP, AND HMI. RETEST WITH NEW CONFIG., SL NO 48: SRR CONTROL POWER TROUBLE - 34.5kV SWITCHGEAR 252-11', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(217, 'SRR-4', 7, 'AC House', 3, 'IPR shows alarm but HMI, ICS, & EBP do not., SL NO 54: SRR 34.5kV BREAKER 252-12 IPR OVERCURRENT TRIPPED', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(218, 'SRR-5', 7, 'AC House', 3, 'INCORRECT TEXT AT ICS, EBP, AND HMI. RETEST WITH NEW CONFIG., SL NO 55: SRR CONTROL POWER TROUBLE - 34.5kV SWITCHGEAR 252-12', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(219, 'SRR-6', 7, 'AC House', 3, 'THE ALARM TEXT IS SAME AS SL 89., SL 110: SRR RECTIFIER DIODE Z02 HIGH TEMP ALARM', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(220, 'SRR-7', 7, 'DC House', 3, 'SL NO 126: NO ALARM WAS GENERATED., LOSS OF 125VDC AT ENCLOSURE GROUND PROTECTION CKT. ', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(221, 'SRR-8', 7, 'DC House', 3, 'NO ALARM WAS GENERATED., SL NO 141: SRR 1000VDC FDR BREAKER 172-2 MPR O/C TRIP', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(222, 'SRR-9', 7, 'AC House', 3, 'THIS ALARM DOES NOT EXIST ON THE IO CHECKOFF SHEET AND ONLY APPEARS ON THE HMI., SRR TRANSFORMER X02 LOW OIL LEVEL TRIP', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'DELEte from the points list and the program.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(223, 'SRR-10', 7, 'AC House', 3, 'SL NO 174: THE EXIT SIGN LIGHT DOES NOT TURN ON AS REQUIRED., SRR AC HOUSE L01 POWER LOSS ALARM', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(224, 'SRR-11', 7, 'AC House', 3, 'THIS ALARM COULD NOT BE GENERATED. , SL NO 179: SRR BATTERY SYSTEM VOLTAGE PROBLEM', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(225, 'SRR-12', 7, 'AC House', 3, 'THIS ALARM IS GENERATED AT VARIOUS TIMES WITHOUT PROCEDURE., SL NO 180: SRR BATTERY CHARGER OVERLOAD', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(226, 'SRR-13', 7, 'AC House', 3, 'INCORRECT TEXT AT ICS, EBP, AND HMI., SL NO 186: SRR DC OUTPUT FAILURE ALARM', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(227, 'SRR-14', 7, 'AC House', 3, 'SL NO 213: THE NETWORK SWITCH IS NOT COMMUNICATING/RESETTING., SRR IOM-DC COMMUNICATION TROUBLE', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(228, 'SRR-15', 7, 'AC House', 3, 'THE NETWORK SWITCH IS NOT COMMUNICATING/RESETTING., SL NO 227: SRR PRP 2440 COMMUNICATION TROUBLE', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(229, 'SRR-16', 7, 'AC House', 3, 'SL NO 261-286: This EBP functionality has not been added to the software. It is not required per contract. VTA to give clear direction if required. , \"Command Fail\" and \"Uncommanded Change\" Alarms for all AC and DC breakers.', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Delete from the points list and the program.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(230, 'SRR-17', 7, 'AC House', 3, '252-10, 252-11, AND 252-12 IPR OVERCURRENT ALARMS COULD NOT GENERATED., SRC/SRR C02-PREREQUISITE', 'SRR SIT Procedure Functional Test', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Powell/KAPSCH to diagnose why the alarm is not generated. Add if necessary.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(231, 'SRR-18', 7, 'AC House', 3, 'IPR CAN BE COMMUNICATED WITH FROM THE PTC IPR STATIONS BUT THE COMMAND WINDOW IS NOT RECEIVING TEXT COMMANDS., SRC/SRR C02-P1', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(232, 'SRR-19', 7, 'AC House', 3, '252-10 CLOSES WHEN LOCKOUT RELAY 286 IS IN A LOCKOUT STATE. WE CAN VERIFY 252-10 WILL NOT CLOSE WHEN 386T IS ACTIVATED (LOCKOUT STATE). TEST TO BE REDONE WITH EPS ON SITE., SRC/SRR C02-P2', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Discuss at next meeting', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(233, 'SRR-20', 7, 'AC House', 3, 'EBP DOES NOT HAVE \"CLOSE\" BUTTONG FOR \"VERIFY THAT THE BREAKER DOES NOT CLOSE\"., SRC/SRR C02-P4', 'SRR SIT Procedure IO List', '2017-02-08', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Delete from the points list and the program.', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(234, 'SRR-21', 7, 'AC House', 3, 'REMOTE BLS CAUSES THIS ALARM, SL NO 197', 'SRR SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(235, 'SRR-22', 7, 'AC House', 3, 'REMOTE BLS CAUSES THIS ALARM - NOT RECEIVED AT PTC, SL NO 198', 'SRR SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(236, 'SRR-23', 7, 'AC House', 3, 'ALARM COULD NOT BE VERIFIED , SL NO 224', 'SRR SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(237, 'SRR-24', 7, 'AC House', 3, 'REPLACE ETP MTL 5514D UNIT WITH ETP MTL 5514, FOUND DURING ETTS TESTING', 'SRR ETTS Procedure Functional Test', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(238, 'SRR-25', 7, 'AC House', 3, 'ETTC PORT 2 CHANNEL A AND ETTC PORT 3 CHANNEL B FAILS - ALARM NOT GENERATED - INVESTIGATE AND CORRECT AT ALL SITES, FOUND DURING ETTS TESTING', 'SRR SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(239, 'SRR-26', 7, 'AC House', 3, 'SWA 252-1 & SHO 252-1 CLOSE WHEN SRC 252-10 AND SRR 252-11 ARE CLOSED AND SRR 252-12 IS OPEN., FOUND DURING REGRESSION TESTING', 'SRR SIT Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(240, 'SRR-27', 7, 'AC House', 3, 'SME 252-2, SHO 252-2, & SBE 252-2 CLOSE WHEN SRC 252-10 AND SRR 252-12 ARE CLOSED AND SRR 252-11 IS OPEN., FOUND DURING REGRESSION TESTING', 'SRR SIT Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(241, 'SRR-28', 7, 'AC House', 3, 'TEXT INCORRECT AT HMI, SI NO 84', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(242, 'SRR-29', 7, 'AC House', 3, 'SI NO 89: VERIFIED, SI NO 89', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(243, 'SRR-30', 7, 'AC House', 3, 'TEXT INCORRECT AT HMI, SI NO 106', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(244, 'SRR-31', 7, 'AC House', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 111', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(245, 'SRR-32', 7, 'AC House', 3, 'SI NO 185: TO BE RETESTED FOR TEXT CORRECTION, SI NO 185', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(246, 'SRR-33', 7, 'AC House', 3, 'SI NO 188: INCORRECT TEXT AT HMI, SI NO 188', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(247, 'SRR-34', 7, 'AC House', 3, 'SI NO 189: TO BE RETESTED FOR TEXT CORRECTION, SI NO 189', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(248, 'SRR-35', 7, 'AC House', 3, 'SI NO 190: TO BE RETESTED FOR TEXT CORRECTION, SI NO 190', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(249, 'SRR-36', 7, 'AC House', 3, 'SI NO 191: TO BE RETESTED FOR TEXT CORRECTION, SI NO 191', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(250, 'SRR-37', 7, 'AC House', 3, 'SI NO 192: TO BE RETESTED FOR TEXT CORRECTION, SI NO 192', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(251, 'SRR-38', 7, 'AC House', 3, 'SI NO 193: TO BE RETESTED FOR TEXT CORRECTION, SI NO 193', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(252, 'SRR-39', 7, 'AC House', 3, 'SI NO 194: TO BE RETESTED FOR TEXT CORRECTION, SI NO 194', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(253, 'SRR-40', 7, 'AC House', 3, 'SI NO 195: TO BE RETESTED FOR TEXT CORRECTION, SI NO 195', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(254, 'SRR-41', 7, 'AC House', 3, 'TEXT CORRECTION TO BE VERIFIED, SI NO 196', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(255, 'SRR-42', 7, 'AC House', 3, 'TEXT CORRECTION TO BE VERIFIED AND REMOTE BLS CAUSES THIS ALARM, SI NO 197', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(256, 'SRR-43', 7, 'AC House', 3, 'TEXT CORRECTION TO BE VERIFIED AND REMOTE BLS CAUSES THIS ALARM, SI NO 198', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '2018-05-31', '', NULL, 0),
(257, 'SRR-44', 7, 'AC House', 3, 'not PGE ITEMS - TO BE TESTED, SI NO 230 - 343 in local alarm', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', 'During SIT, move 343 selector switch between local and remote for alarm to annunciate. ', NULL, NULL, 2, 30, '2018-05-31', 'N/A', NULL, 0),
(258, 'SRR-45', 7, 'AC House', 3, 'TO BE TESTED ONCE CHANGE ISSUED. THIS NEEDS A DESIGN CHANGE, SI NO 231 - 343 in remote alarm ', 'SRR SIT Procedure IO List', '2017-08-04', 1, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', 'During SIT, move 343 selector switch between local and remote for alarm to annunciate. ', NULL, NULL, 2, 30, '2018-05-31', 'N/A', NULL, 0),
(259, 'SRR-46', 7, 'AC House', 3, 'EPS TO PERFORM, SI NO 232', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(260, 'SRR-47', 7, 'AC House', 3, 'PGE ITEMS - AR IS AWAITING DIRECTION - WAITING FOR DL 190 R1 TO PRICE, SI NO 233 - GE L90 alarm in PGE house in yard. ', 'SRR SIT Procedure IO List', '2017-08-04', 1, 'Amy Fauria', 14, 14, 'PGE', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Awaiting resolution to RFI for cable terminations to PGE equipment.', NULL, NULL, 2, 30, '0000-00-00', 'N/A', NULL, 0),
(261, 'SRR-48', 7, 'AC House', 3, 'PGE ITEMS - AR IS AWAITING DIRECTION - WAITING FOR DL 190 R1 TO PRICE, SI NO 234 - SEL-311L alarm in PGE house in yard.', 'SRR SIT Procedure IO List', '2017-08-04', 1, 'Amy Fauria', 14, 14, 'PGE', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Awaiting resolution to RFI for cable terminations to PGE equipment.', NULL, NULL, 2, 30, '0000-00-00', 'N/A', NULL, 0),
(262, 'SRR-49', 7, 'AC House', 3, 'EPS TO PERFORM, SI NO 235', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(263, 'SRR-50', 7, 'AC House', 3, 'EPS TO PERFORM, SI NO 236', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(264, 'SRR-51', 7, 'AC House', 3, 'EPS TO PERFORM, SI NO 237', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(265, 'SRR-52', 7, 'AC House', 3, 'EPS TO PERFORM, SI NO 238', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', 'DELEte from the points list and the program.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(266, 'SRR-53', 7, 'AC House', 3, 'EPS TO PERFORM, SI NO 239', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(267, 'SRR-54', 7, 'AC House', 3, 'EPS TO PERFORM, SI NO 240', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(268, 'SRR-55', 7, 'AC House', 3, 'EPS TO PERFORM, SI NO 241', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'EPS', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(269, 'SRR-56', 7, 'AC House', 3, 'ATS CANNOT PROPERLY TRANSFER POWER BACK - COULD NOT TEST, SI NO 242 - auto transfer switch alarm', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'GE FIXED AND TESTED ATS ISSUE - WILL BE SIGNED ON 3/22/18', NULL, NULL, 2, 30, '0000-00-00', 'Powell March 2018', NULL, 0),
(270, 'SRR-57', 7, 'AC House', 3, 'X10 winding high temp to be tested, SI NO 243', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(271, 'SRR-58', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 244', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(272, 'SRR-59', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 245', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(273, 'SRR-60', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 246', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(274, 'SRR-61', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 247', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(275, 'SRR-62', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 248', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(276, 'SRR-63', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 249', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(277, 'SRR-64', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 250', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(278, 'SRR-65', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 251', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(279, 'SRR-66', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 252', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(280, 'SRR-67', 7, 'AC House', 3, 'NEW ITEMS TO BE TESTED, SI NO 253', 'SRR SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(281, 'SRR-68', 7, 'AC House', 3, 'MAIN TIE MAIN FUNCTION DOES NOT WORK PROPERLY - NORMALLY OPEN BREAKER CLOSES WITH UNDERVOLTAGE CONDITION ON NORMALLY CLOSED BREAKER IN INTERLOCKING POSITION, ISSUE FOUND DURING REGRESSION TEST', 'SRR-C02-P4', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'A/R', NULL, NULL, NULL, '2018-04-27 19:45:30', 'REDO MAIN TIE MAIN TEST after KAPSCH correction', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(282, 'SRR-69', 7, 'DC House', 3, 'GENERAL, ANALOGS ON C02 PANEL ARE NOT FUNCTIONING', 'SRR-C02-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(283, 'SRR-70', 7, 'AC House', 3, 'SRR MISSING PEN FOR MPR AT D05, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(284, 'SRR-71', 7, 'AC House', 3, 'SRR RECTIFIERS DO NOT HAVE CONTROL POWER MODIFIED, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(285, 'SRR-72', 7, 'AC House', 3, 'BLS WAYSIDE TRIPS AND FAULT ALARMS MUST BE REDONE. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(286, 'SRR-73', 7, 'AC House', 3, 'BATTERY CHARGER OVERLOAD ALARM EXISTS AT SRR BUT NOT SKR, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(287, 'SRR-74', 7, 'AC House', 3, 'SRC/SRR LOCAL BLS DID NOT TRIP HC02 BASED BREAKERS, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(288, 'SRR-75', 7, 'AC House', 3, 'UPDATE MIMIC PANEL TO INCLUDE NORMALLY OPEN OR NORMALLY CLOSED AS NEEDED., ', 'PUNCHLIST', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(289, 'SRR-76', 7, 'DC House', 3, 'TRANSFER TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, i.e. SKR TRANSFER TRIP ZONE (SL09), D05 (172-05)', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(290, 'SRR-77', 7, 'DC House', 3, 'EMERGENCY TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, ', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(291, 'SRR-78', 7, 'DC House', 3, 'NGD (G01) DID NOT REPORT TROUBLE ALARM WHEN SYSTEM OK LAMP WAS SHOWING FAULT DUE TO DC POWER NOT AVAILABLE. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(292, 'SRR-79', 7, 'DC House', 3, 'NEED TO TEST NGD SWITCH POSITION INDICATION, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(293, 'SRR-80', 7, 'DC House', 3, 'ANALOGS ON C02 PANEL ARE NOT FUNCTIONING - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, GENERAL ISSUE', 'SWA-C02-P2', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(294, 'SRR-81', 7, 'DC House', 3, 'HMI CURRENT STATUS SCREEN DOES NOT REPORT AC VOLTAGE VALUES - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, HMI SCREEN', 'GENERAL', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(295, 'SRR-82', 7, 'DC House', 3, 'SLC & SRC CABLE VOLTAGE STATUS SHOULD DEPEND ON 252-1 & 252-2 PTS - SLC AND SRC VOLTAGE PRESENT COLORS SHOULD BE DERIVED FROM THE \'NOT UNDERVOLTAGE\' ALARM OF BREAKERS 252-1 AND 252-2 - UPDATE GRAPHIC, HMI SCREEN', 'GENERAL', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'KAPSCH to update graphic after updating logic. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(296, 'SRR-83', 7, 'DC House', 3, 'SLC & SRC CABLE VOLTAGE STATUS SHOULD DEPEND ON 252-1 & 252-2 PTS - SLC AND SRC VOLTAGE PRESENT COLORS SHOULD BE DERIVED FROM THE \'NOT UNDERVOLTAGE\' ALARM OF BREAKERS 252-1 AND 252-2 - UPDATE LOGIC, ', 'GENERAL', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'KAPSCH to update logic. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(297, 'SRR-84', 7, 'DC House', 3, 'BLOCKING PANEL WIRING INTERCONNECT TO BE VERIFIED AGAINST DRAWING., ', 'GENERAL', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL', NULL, NULL, NULL, '2018-04-27 19:45:30', 'Punchlist item - moved to punchlist.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(298, 'SRR-85', 7, 'DC House', 3, 'NGD CONTROL POWER OR SUMMARY (DC POWER) NEEDS TO BE ADDED TO THE NGD TROUBLE ALARM - CURRENTLY WHEN DC POWER ALONE IS LOST, THERE IS AN ALARM AT THE NGD BUT NOT ANNUNCIATED REMOTELY, ', 'GENERAL', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:45:30', 'HMI/RTAC Logic to be updated TO GENERATE SUMMARY ALARM WITH DC POWER LOST ONLY GENERATING SAID ALARM - TO BE retested', NULL, NULL, 2, 30, '0000-00-00', 'Kapsch made the change but reversed it per Mark Pfeiffer\'s request.', NULL, 0),
(299, 'SRR-86', 7, 'DC House', 3, 'LTC TESTING, ', 'GENERAL', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'AR', NULL, NULL, NULL, '2018-04-27 19:45:30', 'LTC to be tested and data collected to be sent to BART. BART to respond with change. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(300, 'SRR-87', 7, 'YARD', 3, '186 LOCKOUT DOES NOT RESET AFTER LOCAL BLS IS HIT UNTIL RTAC IS RESTARTED. THIS IS NOT TYPICAL., ', 'GENERAL', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:45:30', 'KAPSCH to diagnose issue and apply change as needed. ', NULL, NULL, 2, 30, '0000-00-00', 'Kapsch: This has been resolved and tested.', NULL, 0),
(301, 'SME-1', 8, 'AC', 3, 'ALARM WAS NOT WITNESSED DURING SIT, 1. AC SECTIONALIZING BREAKERS 252-03, 252-04 LOCKOUT RELAYS NOT INSTALLED IN STATION AT TIME OF FUNCTIONAL TEST', 'SME-C02-PREREQUISITE', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'Discuss at next meeting', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(302, 'SME-2', 8, 'AC', 3, 'ALARM WAS NOT WITNESSED DURING SIT, 2. AC SECTIONALIZING BREAKERS 252-03, 252-04 OVERCURRENT TRIP NOT WITNESSED AT TIME OF FUNCTIONAL TEST', 'SME-C02-PREREQUISITE', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'Powell and KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'Discuss at next meeting', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(303, 'SME-5', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 4. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 252-1, 252-2, AND 252-8.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(304, 'SME-6', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 5. VERIFY THAT THE BREAKER DOES NOT CLOSE: 252-1, 252-2, AND 252-8.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(305, 'SME-7', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 54. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0);
INSERT INTO `CDL` (`DefID`, `OldID`, `Location`, `SpecLoc`, `Severity`, `Description`, `Spec`, `DateCreated`, `Status`, `IdentifiedBy`, `SystemAffected`, `GroupToResolve`, `ActionOwner`, `EvidenceType`, `EvidenceLink`, `DateClosed`, `LastUpdated`, `Comments`, `Updated_by`, `Created_by`, `SafetyCert`, `RequiredBy`, `DueDate`, `ClosureComments`, `Pics`, `Repo`) VALUES
(306, 'SME-8', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 55. VERIFY THAT THE BREAKER DOES NOT CLOSE: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(307, 'SME-9', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 62. INITIATE A REMOTE TRIP COMMAND FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(308, 'SME-10', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 63. VERIFY THAT THE BREAKER IS OPENED: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(309, 'SME-11', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 71. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(310, 'SME-12', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 72. VERIFY THAT THE BREAKER IS CLOSED: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(311, 'SME-13', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 73. VERIFY THAT THE CLOSE INDICATOR IS SHOWING (RED): 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(312, 'SME-14', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 74. INITIATE A REMOTE TRIP COMMAND FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(313, 'SME-15', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 75. VERIFY THAT THE BREAKER IS OPENED: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(314, 'SME-16', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 76. VERIFY THAT THE TRIP INDICATOR IS SHOWING (GREEN): 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(315, 'SME-17', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 79. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(316, 'SME-18', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 80. VERIFY THAT THE BREAKER IS CLOSED: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(317, 'SME-19', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 86. INITIATE A REMOTE CLOSE COMMAND FOR CORRESPONDING BREAKERS FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(318, 'SME-20', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 87. VERIFY THE BREAKER STATUS: 252-3 (DOES NOT CLOSE) AND 252-4 (CLOSED).', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(319, 'SME-21', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 92. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(320, 'SME-22', 8, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED. BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 93. VERIFY THAT THE BREAKER DOES NOT CLOSE: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(321, 'SME-23', 8, 'AC', 3, 'ALARM DOES NOT SHOW UP ON THE ICS AND EBP., 83. FORCE LOCKOUT RELAY 286-3 INTO LOCKOUT STATE. 286-4 LOCKOUT RELAY IS RESET.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(322, 'SME-24', 8, 'AC', 3, 'ALARM DOES NOT SHOW UP ON THE ICS AND EBP., 89. FORCE LOCKOUT RELAY 286-4 INTO LOCKOUT STATE. 286-3 LOCKOUT RELAY IS RESET.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(323, 'SME-25', 8, 'AC', 3, 'BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 101. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(324, 'SME-26', 8, 'AC', 3, 'BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 102. VERIFY THAT THE BREAKER DOES NOT CLOSE: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(325, 'SME-27', 8, 'AC', 3, 'BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 113. INITIATE A REMOTE TRIP COMMAND FROM THE EBP IN THE PTC: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(326, 'SME-28', 8, 'AC', 3, 'BREAKERS 252-3 AND 252-4 ARE NOT PRESENT ON THE EBP GRAPHICAL INTERFACE., 115. VERIFY THAT THE BREAKER DOES NOT OPEN: 252-3 AND 252-4.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(327, 'SME-29', 8, 'DC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 4. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 172-1 AND 172-9.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(328, 'SME-30', 8, 'DC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 5. VERIFY THAT THE BREAKER DOES NOT CLOSE: 172-1 AND 172-9.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(329, 'SME-31', 8, 'DC', 3, 'TEST POSITION ALARM WAS NOT SHOWN AT THE ICS AND EBP., 38. RACK THE BREAKER INTO TEST POSTION. ', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(330, 'SME-32', 8, 'DC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 55. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 172-2, 172-3, 172-4, 172-5, 172-6, 172-7 AND 172-8.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(331, 'SME-33', 8, 'DC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 56. VERIFY THAT THE BREAKER DOES NOT CLOSE: 172-2, 172-3, 172-4, 172-5, 172-6, 172-7 AND 172-8.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(332, 'SME-34', 8, 'DC', 3, 'ISSUE IS GENERATED WHEN TOO MANY TRIP COMMANDS ARE SENT IN A SMALL AMOUNT OF TIME. , BREAKERS 2, 4, AND 6 AUTO-RECLOSE LOCKOUT RECEIVED AT HMI @C02 WHEN REMOTE TRIP INITIATED.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(333, 'SME-35', 8, 'DC', 3, 'ISSUE IS GENERATED WHEN TOO MANY TRIP COMMANDS ARE SENT IN A SMALL AMOUNT OF TIME. , BREAKER 172-08 MPR GETS HARD LOCKOUT AND AUTO-RECLOSE LOCK WHEN TRIP COMMAND IS SENT FROM ICS AND 143 IN LOCAL TRIP COMMAND SENT MULTIPLE TIMES IN A ROW.', 'SME-C02-P3', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(334, 'SME-36', 8, 'DC', 3, 'TRANSFER DID NOT OCCUR WHEN AN UNDERVOLTAGE WAS INITIATED ON 252-1 (N.C.), 9. INITIATE AN UNDER-VOLTAGE CONDITION FOR AC BREAKER 252-1.', 'SME-C02-P4', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(335, 'SME-37', 8, 'DC', 3, 'WHEN 252-1 WAS OPENED MANUALLY AND 252-2 WAS CLOSED, BREAKER 252-2 OPENS AND 252-1 CLOSES. UNDER THIS CONDITION, 252-2 SHOULD REMAIN OPEN., GENERAL ISSUE', 'SME-C02-P4', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(336, 'SME-38', 8, 'AC', 3, '\"NO MATH VARIABLES\" TEXT APPEARS ON IPR, SL NO. 6: SME 34.5KV BREAKER 252-01 IPR OVERCURRENT TRIPPED', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(337, 'SME-39', 8, 'AC', 3, 'EBP DOES NOT SHOW BREAKERS 252-3 AND 252-4 GRAPHICALLY., SL NO. 13: SME 34.5KV BREAKER 252-03 CLOSED', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(338, 'SME-40', 8, 'AC', 3, 'EBP DOES NOT SHOW BREAKERS 252-3 AND 252-4 GRAPHICALLY., SL NO. 14: SME 34.5KV BREAKER 252-03 OPEN', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(339, 'SME-41', 8, 'AC', 3, 'NO 286-3 LOCKOUT RECEIVED, SL NO. 18: SME 34.5KV BREAKER 252-03 IPR OVERCURRENT TRIPPED', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'KAPSCH TO TEST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(340, 'SME-42', 8, 'AC', 3, 'EBP DOES NOT SHOW BREAKERS 252-3 AND 252-4 GRAPHICALLY., SL NO. 19: SME 34.5KV BREAKER 252-04 CLOSED.', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(341, 'SME-43', 8, 'AC', 3, 'EBP DOES NOT SHOW BREAKERS 252-3 AND 252-4 GRAPHICALLY., SL NO. 20: SME 34.5KV BREAKER 252-04 OPEN.', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(342, 'SME-44', 8, 'AC', 3, 'NO 286-4 LOCKOUT RECEIVED, SL NO. 24: SME 34.5KV BREAKER 252-04 IPR OVERCURRENT TRIPPED', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'KAPSCH TO TEST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(343, 'SME-45', 8, 'AC', 3, 'TEXT DOES NOT SHOW BUT FUNCTIONS PROPERLY, SL NO. 36: SME 286-3 LOCKOUT RELAY ACTIVATED', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'KAPSCH TO TEST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(344, 'SME-46', 8, 'AC', 3, 'TEXT DOES NOT SHOW BUT FUNCTIONS PROPERLY, SL NO. 37: SME 286-4 LOCKOUT RELAY ACTIVATED', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'KAPSCH TO TEST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(345, 'SME-47', 8, 'AC', 3, '286 LOCKOUT WAS RESET DURING ALARM., SL NO. 41: SME TRANSFORMER X01 SUDDEN PRESSURE TRIP.', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(346, 'SME-48', 8, 'AC', 3, 'HMI DOES NOT SHOW UNIT NUMBER., SL NO. 57: SME RECTIFIER Z01 GND FAULT CIRCUIT CONTROL POWER FAILURE', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(347, 'SME-49', 8, 'AC', 3, 'HMI DOES NOT SHOW UNIT NUMBER., SL NO. 79: SME RECTIFIER Z02 GND FAULT CIRCUIT CONTROL POWER FAILURE', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(348, 'SME-50', 8, 'AC', 3, 'REVERSED WIRING WITH SL NO. 61. FIXED AND REDONE IN THE FIELD., SME TRANSFORMER X02 WINDING HIGH TEMP ALARM. ', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CLOSED', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(349, 'SME-51', 8, 'AC', 3, 'HMI READS \"UNIT 1\", SL NO. 73: SME CONTROL POWER TROUBLE - TRANSFORMER RECTIFIER UNIT 2', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(350, 'SME-52', 8, 'AC', 3, 'HMI READS \"CONTROL POWER TROUBLE\", SL NO. 91: SME 1000VDC MAIN BREAKER 172-1 CONTROL POWER FAILURE', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(351, 'SME-53', 8, 'AC', 3, 'HMI READS \"CONTROL POWER TROUBLE\", SL NO. 95: SME 1000VDC MAIN BREAKER 172-09 CONTROL POWER FAILURE', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(352, 'SME-54', 8, 'AC', 3, 'SHOULD 286 OR 186 LOCKOUT ACTIVATE? INVESTIGATE., SL NO. 96: SME 1000VDC MAIN BREAKER 172-09 REVERSE CURRENT TRIP', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(353, 'SME-55', 8, 'AC', 3, 'FAIL., SL NO. 180: SME DC OUTPUT FAILURE ALARM', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(354, 'SME-56', 8, 'AC', 3, 'REVERSED WITH SL NO. 189., SL NO. 187: SME DC HOUSE UNIT 1 LOSS OF VENTILLATION.', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(355, 'SME-57', 8, 'AC', 3, 'HMI READS \"HVAC POWER FAIL\" AND REVERSED WITH SL NO. 187., SL NO. 189: SME DC HOUSE UNIT 2 LOSS OF VENTILLATION.', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(356, 'SME-58', 8, 'AC', 3, 'FAIL, SL NO. 188: SME DC HOUSE HIGH TEMP ALARM', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CONNECT WIRE AND REDO', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(357, 'SME-59', 8, 'AC', 3, 'HMI READS \"HVAC POWER FAIL\"., SL NO. 190: SME AC HOUSE UNIT 1 LOSS OF VENTILLATION.', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(358, 'SME-60', 8, 'AC', 3, 'NOT PERFORMED., SL NO. 193: SME AUTOMATIC TRANSFER SWITCH 480 V AC POWER SOURCE ON.', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'PERFORM WHEN CLOSING DISCREPANCIES.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(359, 'SME-61', 8, 'AC', 3, 'NOT PERFORMED., SL NO. 194: SME AUX TRANSFORMER X10 WINDING HIGH TEMP ALARM.', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'PERFORM WHEN CLOSING DISCREPANCIES.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(360, 'SME-62', 8, 'AC', 3, 'FAIL., SL NO. 244: SME 34.5KV BKR 252-3 LINE UNDERVOLTAGE ', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(361, 'SME-63', 8, 'AC', 3, 'FAIL., SL NO. 245: SME 34.5KV BKR 252-4 LINE UNDERVOLTAGE ', 'SME SIT Procedure IO List', '2017-05-16', 2, 'Amy Fauria', 14, 14, 'B/P', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(362, 'SME-64', 8, '', 3, 'S305-S308 TRIPS TO SRR&SME DOES NOT MATCH PROCEDURE PER TRIP TABLE (BREAKERS SRR 172-4, SRR 172-5, SME 172-2, AND SME 172-3)., ', 'SME-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'PROPER FUNCTION NOTED ON ETTS TEST AND DISCREPANCY CLOSED PER MEETING WITH BART/VTA', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(363, 'SME-65', 8, '', 3, 'SME BREAKER 172-5 DOES NOT INTERLOCK CORRECTLY WITH ADJACENT CONTACT RAIL BREAKERS SHOULD ONLY CLOSE IF 2 ADJACENT BREAKERS ARE CLOSED (172-2 AND 172-6) AND TRIP WITH EITHER BREAKER., ', 'SME-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(364, 'SME-66', 8, '', 3, '\"EETC OFFLINE\" TEXT ON HMI, SL NO 213', 'SME SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(365, 'SME-67', 8, '', 3, 'MISSING CONTACT RAIL DE-ENERGIZED POINTS ON IO LIST ARRIVED AT HMI, ICS, AND EBP, GENERAL ISSUE', 'SME SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(366, 'SME-68', 8, '', 3, 'REPLACE ETP MTL 5514D UNIT WITH ETP MTL 5514, FOUND DURING ETTS TESTING', 'SME ETTS Procedure Functional Test', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(367, 'SME-69', 8, '', 3, 'ETTC PORT 2 CHANNEL A AND ETTC PORT 3 CHANNEL B FAILS - ALARM NOT GENERATED - INVESTIGATE AND CORRECT AT ALL SITES, FOUND DURING ETTS TESTING', 'SME SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(368, 'SME-70', 8, '', 3, 'TEXT IS INCORRECT AT HMI, SI NO 46', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(369, 'SME-71', 8, '', 3, 'TEXT IS INCORRECT AT HMI, SI NO 68', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(370, 'SME-72', 8, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 78', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(371, 'SME-73', 8, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 78', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(372, 'SME-74', 8, '', 3, 'TEXT IS INCORRECT AT HMI, SI NO 186', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(373, 'SME-75', 8, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 192', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(374, 'SME-76', 8, '', 3, 'TEXT IS INCORRECT AT HMI, SI NO 212', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(375, 'SME-77', 8, '', 3, 'ALARM NOT RECEIVED AT HMI, SI NO 226', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(376, 'SME-78', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 228', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(377, 'SME-79', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 229', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(378, 'SME-80', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 230', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(379, 'SME-81', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 231', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(380, 'SME-82', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 237', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(381, 'SME-83', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 239', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(382, 'SME-84', 8, '', 3, 'TEXT IS INCORRECT AT HMI, SI NO 240', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(383, 'SME-85', 8, '', 3, 'TEXT IS INCORRECT AT HMI, SI NO 241', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(384, 'SME-86', 8, '', 3, 'TEXT IS INCORRECT AT HMI, SI NO 242', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(385, 'SME-87', 8, '', 3, 'TEXT IS INCORRECT AT HMI, SI NO 243', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'CHANGE TEXT PER IO LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(386, 'SME-88', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 244', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(387, 'SME-89', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 245', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(388, 'SME-90', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 246', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(389, 'SME-91', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 247', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(390, 'SME-92', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 248', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(391, 'SME-93', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 249', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(392, 'SME-94', 8, '', 3, 'FAIL, SI NO 250', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(393, 'SME-95', 8, '', 3, 'FAIL, SI NO 251', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(394, 'SME-96', 8, '', 3, 'FAIL, SI NO 252', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(395, 'SME-97', 8, '', 3, 'FAIL, SI NO 253', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(396, 'SME-98', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 254', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(397, 'SME-99', 8, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 255', 'SME SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(398, 'SME-100', 8, '', 3, 'CABLE PULLED BUT NOT TERMINATED - LOSS OF COMMS TO 3530 NOT TESTED AND NEED TO TEST BREAKER STATUS INPUTS TO 3530 CONTROLLER, SI NO 256', 'SME SIT Procedure IO List', '2017-08-04', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'PROGRAM UNDERVOLTAGE ALARMS TO CLOSE OUT ISSUE', NULL, NULL, 2, 30, '0000-00-00', 'Powell: Blocking Scheme.  Will follow up', NULL, 0),
(399, 'SME-101', 8, '', 3, 'MAIN TIE MAIN FUNCTION DOES NOT WORK PROPERLY - NORMALLY OPEN BREAKER CLOSES WITH UNDERVOLTAGE CONDITION ON NORMALLY CLOSED BREAKER IN INTERLOCKING POSITION, ISSUE FOUND DURING REGRESSION TEST', 'SME-C02-P4', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'A/R', NULL, NULL, NULL, '2018-04-27 19:51:07', 'REDO MAIN TIE MAIN TEST after KAPSCH correction', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(400, 'SME-102', 8, 'DC', 3, 'GENERAL, ANALOGS ON C02 PANEL ARE NOT FUNCTIONING', 'SME-C02-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(401, 'SME-103', 8, '', 3, 'DWG 109733-3007-07 REV 2 ONLY SHOWS ONE AC HOUSE HVAC UNIT - POWELL/KAPSCH TO REDLINE FOR FINAL AS-BUILTS, PUNCHLIST', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL', NULL, NULL, NULL, '2018-04-27 19:51:07', 'Powell to update drawing', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(402, 'SME-104', 8, '', 3, 'X10 ON WRONG SIDE OF BUS, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(403, 'SME-105', 8, '', 3, 'SME D05 SHOULD NOT CLOSE WITHOUT D04 AND D06 CLOSED., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(404, 'SME-106', 8, '', 3, 'MOD FOR Z01 AND Z02 TO SEPARATE CONTROL POWER TO SEL2411 IS NOT DONE, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(405, 'SME-107', 8, '', 3, 'ADD TEXT TO HMI AND C02 TO INDICATE SOURCE LOCATION OF 34.5KV , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(406, 'SME-108', 8, '', 3, 'RECTIFIER CONTROL POWER TROUBLE ALARM MISSING WIRING, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(407, 'SME-109', 8, 'DC', 3, 'TRANSFER TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, SKR TRANSFER TRIP ZONE (SL09), D05 (172-05)', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(408, 'SME-110', 8, 'DC', 3, 'EMERGENCY TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, ', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(409, 'SME-111', 8, 'DC', 3, 'NGD (G01) DID NOT REPORT TROUBLE ALARM WHEN SYSTEM OK LAMP WAS SHOWING FAULT DUE TO DC POWER NOT AVAILABLE. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(410, 'SME-112', 8, 'DC', 3, 'NEED TO TEST NGD SWITCH POSITION INDICATION, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(411, 'SME-113', 8, 'DC', 3, 'ANALOGS ON C02 PANEL ARE NOT FUNCTIONING - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, GENERAL ISSUE', 'SWA-C02-P2', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(412, 'SME-114', 8, 'DC', 3, 'HMI CURRENT STATUS SCREEN DOES NOT REPORT AC VOLTAGE VALUES - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, HMI SCREEN', 'GENERAL', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(413, 'SME-115', 8, '', 3, 'BLOCKING PANEL WIRING INTERCONNECT TO BE VERIFIED AGAINST DRAWING., PUNCHLIST', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL', NULL, NULL, NULL, '2018-04-27 19:51:07', 'Punchlist item - moved to punchlist.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(414, 'SME-116', 8, 'DC', 3, 'NGD CONTROL POWER OR SUMMARY (DC POWER) NEEDS TO BE ADDED TO THE NGD TROUBLE ALARM - CURRENTLY WHEN DC POWER ALONE IS LOST, THERE IS AN ALARM AT THE NGD BUT NOT ANNUNCIATED REMOTELY, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'HMI/RTAC Logic to be updated TO GENERATE SUMMARY ALARM WITH DC POWER LOST ONLY GENERATING SAID ALARM - TO BE retested', NULL, NULL, 2, 30, '0000-00-00', 'Kapsch made the change but reversed it per Mark Pfeiffer\'s request.', NULL, 0),
(415, 'SME-117', 8, '', 3, 'SME D05 is not interlocking properly with D02 and D06 similar to sxc and sbe. , ', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:51:07', 'POWELL TO INTERLOCK ISLAND BREAKER WITH PHYSICAL WIRING CHANGE - KAPSCH TO ADD LOGIC THEREAFTER. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(416, 'SME-118', 8, '', 3, 'SME D08 DOES NOT INTERLOCK PROPERLY WITH D03 AND D04, ', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:51:07', 'VTA TO ISSUE CHANGE ORDER FOR DESIGN AND PROGRAMMING FOR INTERLOCKING TO WORK AS NEEDED.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(417, 'SHO-1', 9, 'DC', 3, 'DC NOT TESTED - DUPLICATE ITEM, ANALOGS ON C02 PANEL ARE NOT FUNCTIONING', 'SHO-C02-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Kapsch: This has been resolved and demoed to VTA/BART.', NULL, 0),
(418, 'SHO-2', 9, 'AC', 3, 'GENERAL, CATHODE BREAKER POSITION ALARMS ARE MISSING AT THE HMI', 'SHO-C02-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'ADD PER DESIGN', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(419, 'SHO-3', 9, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 4. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 252-1, 252-2, AND 252-8.', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(420, 'SHO-4', 9, 'AC', 3, 'WHEN SELECTOR SWITCH 243 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 5. VERIFY THAT THE BREAKER DOES NOT CLOSE: 252-1, 252-2, AND 252-8.', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(421, 'SHO-5', 9, 'AC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 4. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 172-1 AND 172-6.', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(422, 'SHO-6', 9, 'AC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 5. VERIFY THAT THE BREAKER DOES NOT CLOSE: 172-1 AND 172-6.', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(423, 'SHO-7', 9, 'AC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 13. VERIFY THAT THE BREAKER RECEIVES THE CALL TO TRIP AND THE BREAKER IS OPENED: 172-1 AND 172-6.', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(424, 'SHO-8', 9, 'AC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 55. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 172-2, 172-3, 172-4, AND 172-5.', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(425, 'SHO-9', 9, 'AC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 56. VERIFY THAT THE BREAKER DOES NOT CLOSE: 172-2, 172-3, 172-4, AND 172-5.', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(426, 'SHO-10', 9, 'AC', 3, 'CHANGE TEXT FROM \"SELECTOR SWITCH 243\" TO \"SELECTOR SWITCH 143\". - ADMIN ITEM FOR KAPSCH, 95 AND 98', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'Punchlist item - moved to punchlist.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(427, 'SHO-11', 9, 'AC', 3, 'STEPS 95-97 SHOULD BE ADDED AFTER STEP 100. - ADMIN ITEM FOR KAPSCH, STEPS 95-97', 'SHO-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'Punchlist item - moved to punchlist.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(428, 'SHO-12', 9, 'AC', 3, '286 LOCKOUT CAN BE CLEARED WHILE ALARM IS STILL ACTIVE. THIS IS TRUE FOR ALL ALARMS THAT ACTIVATE 286., SL NO 25: SHO TRANSFORMER X01 WINDING HIGH TEMP TRIP', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(429, 'SHO-13', 9, 'AC', 3, 'BREAKERS TRIPEED WITH THIS ALARM, SL NO 30: SHO TRANSFORMER X01 LOW OIL LEVEL ALARM', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(430, 'SHO-14', 9, 'AC', 3, 'INCORRECTLY GENERATED 286 LOCKOUT, SL NO 35: SHO RECTIFIER Z01 DOOR OPEN TRIP', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(431, 'SHO-15', 9, 'AC', 3, 'INCORRECTLY GENERATED 286 LOCKOUT, SL NO 37: SHO RECTIFIER DIODE Z01 HIGH TEMP ALARM ', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(432, 'SHO-16', 9, 'AC', 3, 'INCORRECTLY GENERATED 286 LOCKOUT, SL NO 43: SHO RECTIFIER DIODE Z01 HIGH TEMP TRIP', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(433, 'SHO-17', 9, 'AC', 3, 'INCORRECTLY GENERATED 286 LOCKOUT, SL NO 46: SHO RECTIFIER Z01 ENCLOSURES ALIVE TRIP', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(434, 'SHO-18', 9, 'AC', 3, 'TEXT SHOULD READ \"SR10\", SL NO 121: SHO CONTACT RAIL SECTION )SR07) DE-ENERGIZED (MPR-2)', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(435, 'SHO-19', 9, 'AC', 3, 'TEXT SHOULD READ \"SL12\", SL NO 122: SHO CONTACT RAIL SECTION (SL09) DE-ENERGIZED (MPR-3)', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(436, 'SHO-20', 9, 'AC', 3, 'MESSAGE DIFFERENT BETWEEN C02, ICS, AND EBP - HMI OK, SL NO 123: SHO CONTACT RAIL SECTION (SL10) DE-ENERGIZED (MPR-4)', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'ALL', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(437, 'SHO-21', 9, 'AC', 3, 'MESSAGE DIFFERENT BETWEEN C02, ICS, AND EBP - HMI OK, SL NO 124: SHO CONTACT RAIL SECTION (SR08) DE-ENERGIZED (MPR-5)', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'ALL', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(438, 'SHO-22', 9, 'AC', 3, 'HMI MISSING TEXT \"L02\", SL NO 130: SHO DC HOUSE L02 120VAC PANEL UNDERVOLATGE', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(439, 'SHO-23', 9, 'AC', 3, 'HMI MISSING TEXT \"L01\", SL NO 133: SHO AC HOUSE L01 POWER LOSS ALARM', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(440, 'SHO-24', 9, 'AC', 3, 'THERE IS ONLY ONE UNIT IN THE AC HOUSE, SL NO 142: SHO AC HOUSE UNIT 2 LOSS OF VENTILLATION', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'ALL', NULL, NULL, NULL, '2018-04-27 19:54:12', 'DELETE FROM IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(441, 'SHO-25', 9, 'AC', 3, 'WIRING ISSUE. SENSOR TO BE REPLACED., SL NO 161: SHO LOSS OF BATTERY AIR FLOW', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(442, 'SHO-26', 9, 'AC', 3, 'LISTED AS DC IN EBP & ICS - TAG NAME AND DESCRIPTION ARE SWAPPED., SL NO 164: SHO AC INPUT FAILURE ALARM', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(443, 'SHO-27', 9, 'AC', 3, 'LISTED AS AC IN EBP & ICS - TAG NAME AND DESCRIPTION ARE SWAPPED., SL NO 165: SHO DC OUTPUT FAILURE ALARM', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(444, 'SHO-28', 9, 'AC', 3, 'LISTED AS \"X02\" AT EBP AND ICS - CORRECT BREAKERS DO NOT TRIP., SL NO 176: SHO RECTIFIER Z01 LOSS OF COMMUNICATION OR LOSS OF CONTROL POWER', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(445, 'SHO-29', 9, '', 3, 'COMMUNICATION NOT WORKING TO SXC , NUMBERS 13 15, 18, AND 19', 'SHO-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(446, 'SHO-30', 9, '', 3, 'HMI TEXT READS \"SL11\", SL NO 154', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(447, 'SHO-31', 9, '', 3, 'REPLACE ETP MTL 5514D UNIT WITH ETP MTL 5514, FOUND DURING ETTS TESTING', 'SHO ETTS Procedure Functional Test', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(448, 'SHO-32', 9, '', 3, 'ETTC PORT 2 CHANNEL A AND ETTC PORT 3 CHANNEL B FAILS - ALARM NOT GENERATED - INVESTIGATE AND CORRECT AT ALL SITES, FOUND DURING ETTS TESTING', 'SHO SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(449, 'SHO-33', 9, '', 3, 'INCORRECT TEXT AT HMI, SI NO 33', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(450, 'SHO-34', 9, '', 3, 'INCORRECT TEXT AT HMI, SI NO 56', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(451, 'SHO-35', 9, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 134', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(452, 'SHO-36', 9, '', 3, 'ATS TRANSFER OF POWER IS NOT WORKING PROPERLY - TO BE TESTED DURIN SIT, SI NO 135 - Auto Transfer of Switch', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'GE FIXED AND TESTED ATS ISSUE - WILL BE SIGNED ON 3/22/18', NULL, NULL, 2, 30, '0000-00-00', 'Powell will analyze further', NULL, 0),
(453, 'SHO-37', 9, '', 3, 'VERIFIED, SI NO 137', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(454, 'SHO-38', 9, '', 3, 'FAIL, SI NO 138', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(455, 'SHO-39', 9, '', 3, 'VERIFIED, SI NO 139', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(456, 'SHO-40', 9, '', 3, 'INCORRECT TEXT AT HMI, SI NO 140', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH/BART TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(457, 'SHO-41', 9, '', 3, 'VERIFIED, SI NO 141', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(458, 'SHO-42', 9, '', 3, 'INCORRECT TEXT AT HMI AND PTC \"EMERGRENCY\", SI NO 151', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH/BART TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(459, 'SHO-43', 9, '', 3, 'INCORRECT TEXT AT HMI AND PTC \"EMERGRENCY\", SI NO 152', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH/BART TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0);
INSERT INTO `CDL` (`DefID`, `OldID`, `Location`, `SpecLoc`, `Severity`, `Description`, `Spec`, `DateCreated`, `Status`, `IdentifiedBy`, `SystemAffected`, `GroupToResolve`, `ActionOwner`, `EvidenceType`, `EvidenceLink`, `DateClosed`, `LastUpdated`, `Comments`, `Updated_by`, `Created_by`, `SafetyCert`, `RequiredBy`, `DueDate`, `ClosureComments`, `Pics`, `Repo`) VALUES
(460, 'SHO-44', 9, '', 3, 'INCORRECT TEXT AT HMI AND PTC \"EMERGRENCY\", SI NO 153', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH/BART TO CHANGE TEXT.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(461, 'SHO-45', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 157', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(462, 'SHO-46', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 158', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(463, 'SHO-47', 9, '', 3, 'VERIFIED, SI NO 169', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(464, 'SHO-48', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 182', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(465, 'SHO-49', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 183', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(466, 'SHO-50', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 184', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(467, 'SHO-51', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 185', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(468, 'SHO-52', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 186', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(469, 'SHO-53', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 187', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(470, 'SHO-54', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 188', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(471, 'SHO-55', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 189', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(472, 'SHO-56', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 190', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(473, 'SHO-57', 9, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 191', 'SHO SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(474, 'SHO-58', 9, '', 3, 'BLS ID NOT RECEIVED, REMOTE EMERGENCY BLS TRIP - BETWEEN SXC AND SHO - ITEM 51', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(475, 'SHO-59', 9, '', 3, 'MAIN TIE MAIN FUNCTION DOES NOT WORK PROPERLY - NORMALLY OPEN BREAKER CLOSES WITH UNDERVOLTAGE CONDITION ON NORMALLY CLOSED BREAKER IN INTERLOCKING POSITION, ISSUE FOUND DURING REGRESSION TEST', 'SHO-C02-P4', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'A/R', NULL, NULL, NULL, '2018-04-27 19:54:12', 'REDO MAIN TIE MAIN TEST after KAPSCH correction', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(476, 'SHO-60', 9, '', 3, 'HMI COMPUTER AND RTAC SHOULD BE ON SEPARATE BREAKER INSIDE THE C02, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(477, 'SHO-61', 9, '', 3, 'AC HOUSE POWER PANELS DO NOT HAVE LABELS. 208/120 PANEL SCHEDULE IS INCORRECT., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(478, 'SHO-62', 9, '', 3, 'BATTERY ROOM INTERIOR DOOR DOES NOT CLOSE PROPERLY., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(479, 'SHO-63', 9, '', 3, 'ADD LABELS TO C02 TO INDICATE N.O. AND N.C. FOR BREAKERS, ', 'PUNCHLIST', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(480, 'SHO-64', 9, '', 3, 'SHO D04 TRANSFER TRIP FAILED. WON\'T RECLOSE. , SN160', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(481, 'SHO-65', 9, '', 3, 'NO ALARM TO HMI WHEN NETWORK SWITCH HAS NO POWER. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(482, 'SHO-66', 9, '', 3, 'RECEIVED BLANK ALARM WHEN REBOOTED RTAC., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(483, 'SHO-67', 9, '', 3, 'NGD SWITCH POSITION STATUS DOES NOT APPEAR ON OVERVIEW OR CURRENT STATUS PAGE., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(484, 'SHO-68', 9, '', 3, '172-1 AND 172-6 LOSS OF CONTROL POWER DOES NOT TRIP BREAKER., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(485, 'SHO-69', 9, '', 3, 'ATS DID NOT TRANSFER BACK TO NORMAL SOURCE WHEN PGE RESTORED DUE TO THE OUT OF SYNC ROTATION BETWEEN SOURCES. THIS STEP NEEDS TO BE RETESTED. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(486, 'SHO-70', 9, '', 3, 'ANALOG DC BUS METER ON C02 DOES NOT WORK., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(487, 'SHO-71', 9, '', 3, 'RECTIFIER SHUNTS FOR Z02 IS NOT SET RIGHT. MAX VALUE IS 3109A WHILE Z01 IS 6031A., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(488, 'SHO-72', 9, '', 3, 'RECTIFIER SHUNTS FOR Z02 IS NOT SET RIGHT. MAX VALUE IS 3109A WHILE Z01 IS 6031A., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(489, 'SHO-73', 9, '', 3, 'RECTIFIER CONTROL POWER TROUBLE ALARM IS MISSING, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(490, 'SHO-74', 9, 'DC', 3, 'TRANSFER TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, SKR TRANSFER TRIP ZONE (SL09), D05 (172-05)', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(491, 'SHO-75', 9, 'DC', 3, 'EMERGENCY TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, ', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(492, 'SHO-76', 9, 'DC', 3, 'ANALOGS ON C02 PANEL ARE NOT FUNCTIONING - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, GENERAL ISSUE', 'SWA-C02-P2', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(493, 'SHO-77', 9, 'DC', 3, 'HMI CURRENT STATUS SCREEN DOES NOT REPORT AC VOLTAGE VALUES - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, HMI SCREEN', 'GENERAL', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(494, 'SHO-78', 9, 'DC', 3, 'NGD CONTROL POWER OR SUMMARY (DC POWER) NEEDS TO BE ADDED TO THE NGD TROUBLE ALARM - CURRENTLY WHEN DC POWER ALONE IS LOST, THERE IS AN ALARM AT THE NGD BUT NOT ANNUNCIATED REMOTELY, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'HMI/RTAC Logic to be updated TO GENERATE SUMMARY ALARM WITH DC POWER LOST ONLY GENERATING SAID ALARM - TO BE retested', NULL, NULL, 2, 30, '0000-00-00', 'Not done yet per Mark Pfeiffer\'s request.', NULL, 0),
(495, 'SHO-79', 9, 'DC', 3, 'NO EMERGENCY TRIP ALARMS, STEMMING FROM SHO, ARRIVE AT SXC OR PTC - AR SENT TEST REPORT TO KAPSCH - KAPSCH DID NOT MAP ALARMS AND THEY DID NOT ALARM AT SXC OR PTC AS OF 3.26.18, ', 'SHO-ETTS-P2 SUBSECTION: BETWEEN SXC AND SHO NUMBER 45', '2018-03-03', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:54:12', 'KAPSCH TO MAP/UPDATE ALARM', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(496, 'SXC-1', 10, 'DC', 3, 'WHEN SELECTOR SWITCH 143 IS PLACED IN LOCAL POSITION, EBP DOES NOT HAVE A CLOSE BUTTON SO A COMMAND CANNOT BE ISSUED., 55. INITIATE A REMOTE CLOSE COMMAND FROM THE EBP IN THE PTC: 172-2, 172-3, 172-4, 172-5, 172-6, 172-7 AND 172-8.', 'SXC-C02-P3', '2017-06-07', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', 'ITEM FUNCTIONS AS REQUIRED. ITEM IS CLOSED. ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(497, 'SXC-2', 10, 'DC', 3, 'EBP SHOWS LOCAL ONLY. HMI DOES NOT SHOW ALARM., SL NO 1: SXC 1000VDC SWITCHGEAR IN LOCAL CONTROL', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:55:59', 'BART/VTA TO INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(498, 'SXC-3', 10, 'DC', 3, 'HMI DOES NOT SHOW ALARM., SL NO 2: SXC 1000VDC SWITCHGEAR IN REMOTE CONTROL', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(499, 'SXC-4', 10, 'DC', 3, '\"MPR\" MISSING FROM TEXT AT HMI, SI NO 9: SXC 1000VDC FEEDER BREAKER 172-1 MPR TROUBLE', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(500, 'SXC-5', 10, 'DC', 3, '\"MPR\" MISSING FROM TEXT AT HMI, SI NO 18: SXC 1000VDC FEEDER BREAKER 172-2 MPR TROUBLE', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(501, 'SXC-6', 10, 'DC', 3, '\"MPR\" MISSING FROM TEXT AT HMI, SI NO 27: SXC 1000VDC FEEDER BREAKER 172-3 MPR TROUBLE', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(502, 'SXC-7', 10, 'DC', 3, '\"MPR\" MISSING FROM TEXT AT HMI, SI NO 36: SXC 1000VDC FEEDER BREAKER 172-4 MPR TROUBLE', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(503, 'SXC-8', 10, 'DC', 3, '\"MPR\" MISSING FROM TEXT AT HMI, SI NO 45: SXC 1000VDC FEEDER BREAKER 172-5 MPR TROUBLE', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(504, 'SXC-9', 10, 'DC', 3, 'ALARM COULD NOT BE GENERATED. INVESTIGATE. , SI NO 61: SXC BATTERY CHARGER OVERLOAD.', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(505, 'SXC-10', 10, 'DC', 3, 'TEXT READS \"FIRE ALARM PANEL ALARM\" AT THE HMI. , SL NO 69: SXC FIE ALARM PANEL SUMMARY ALARM.', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(506, 'SXC-11', 10, 'DC', 3, 'DC OUTPUT FAILURE ALSO PRODUCES THIS ALARM. , SL NO 98: BATTERY CHARGER OFFLINE', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(507, 'SXC-12', 10, 'DC', 3, 'TO BE RETESTED, SL NO 99: EBP COMMUNICATION TROUBLE.', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(508, 'SXC-13', 10, 'DC', 3, 'TO BE RETESTED, SL NO 100: ICS COMMUNICATION TROUBLE.', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(509, 'SXC-14', 10, 'DC', 3, 'SECOND SOURCE TO THE ATS MISSING PER MARK P. , SL NO 101: SXC AUTOMATIC TRANSFER SWITCH 480 V AC POWER SOURCE ON. ', 'SXC SIT Procedure IO List', '2017-06-07', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 19:55:59', 'BART/VTA TO GIVE DIRECTION', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(510, 'SXC-15', 10, '', 3, 'SHO TO SXC COMMUNICATION NOT FUNCTIONING, ', 'SXC-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(511, 'SXC-16', 10, '', 3, 'NOT PER TRIP TABLE - BLS NOT INSTALLED, 39-43', 'SXC-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', 'NOT REQUIRED AT THIS TIME', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(512, 'SXC-17', 10, '', 3, 'SR12 EMERGENCY TRIP MISSING FROM ICS/EBP & IO LIST, LOCAL EMERGENCY BLS TRIP - ITEM 33', 'SXC SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(513, 'SXC-18', 10, '', 3, 'SL15 EMERGENCY TRIP MISSING FROM ICS/EBP & IO LIST, LOCAL EMERGENCY BLS TRIP - ITEM 33', 'SXC SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(514, 'SXC-19', 10, '', 3, 'TEXT BETWEEN PTC AND HMI DOES NOT MATCH, SI NO 84', 'SXC SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(515, 'SXC-20', 10, '', 3, 'NAME SHOULD INCLUDE SR 13 IN DESCRIPTION, SI NO 85', 'SXC SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(516, 'SXC-21', 10, '', 3, 'RECEIVED FOR S2 PTS - HMI, ICS, AND EBP NOT CHECKED OFF, SI NO 86', 'SXC SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(517, 'SXC-22', 10, '', 3, 'REPLACE ETP MTL 5514D UNIT WITH ETP MTL 5514, FOUND DURING ETTS TESTING', 'SXC ETTS Procedure Functional Test', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(518, 'SXC-23', 10, '', 3, 'ETTC PORT 2 CHANNEL A AND ETTC PORT 3 CHANNEL B FAILS - ALARM NOT GENERATED - INVESTIGATE AND CORRECT AT ALL SITES, FOUND DURING ETTS TESTING', 'SXC SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(519, 'SXC-24', 10, '', 3, 'INCORRECT TEXT AT HMI, SI NO 57', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(520, 'SXC-25', 10, '', 3, 'INCORRECT TEXT AT HMI, SI NO 58', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(521, 'SXC-26', 10, '', 3, 'ALARM IS NOT AT HMI, SI NO 74', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(522, 'SXC-27', 10, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 75', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(523, 'SXC-28', 10, '', 3, 'ALARM IS NOT AT HMI, SI NO 80', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(524, 'SXC-29', 10, '', 3, 'ALARM IS NOT AT HMI, SI NO 81', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(525, 'SXC-30', 10, '', 3, 'ALARM IS NOT AT HMI, SI NO 82', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(526, 'SXC-31', 10, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 83', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(527, 'SXC-32', 10, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 84', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(528, 'SXC-33', 10, '', 3, 'INCORRECT TEXT AT HMI, SI NO 85', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(529, 'SXC-34', 10, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 86', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(530, 'SXC-35', 10, '', 3, 'ALARM IS NOT AT HMI, SI NO 87', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(531, 'SXC-36', 10, '', 3, 'ALARM IS NOT AT HMI, SI NO 88', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(532, 'SXC-37', 10, '', 3, 'ALARM IS NOT AT HMI, SI NO 89', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(533, 'SXC-38', 10, '', 3, 'ALARM IS NOT AT HMI, SI NO 90', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(534, 'SXC-39', 10, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 99', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(535, 'SXC-40', 10, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 100', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(536, 'SXC-41', 10, '', 3, 'INCORRECT TEXT AT HMI, SI NO 102', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(537, 'SXC-42', 10, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 103', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(538, 'SXC-43', 10, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 104', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(539, 'SXC-44', 10, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 105', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(540, 'SXC-45', 10, '', 3, 'INCORRECT TEXT AT HMI, SI NO 106', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(541, 'SXC-46', 10, '', 3, 'INCORRECT TEXT AT HMI, SI NO 107', 'SXC SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(542, 'SXC-47', 10, 'DC', 3, 'ID ALARM DID NOT SHOW AT PTC, EMERGENCY BLS TRIP - BETWEEN SXC AND SBE/S3 TRACK - ITEM 38', 'SXC ETTS Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(543, 'SXC-48', 10, 'DC', 3, 'KEEPING PTS ACTIVE FOR LONG ENOUGH TO PERFORM THIS TEST RESULTS IN MPR HARD LOCKOUT FOR EFFECTED BREAKERS - PER MP, CAN BE VERIFIED ONCE 3RD IS ENERGIZED, PLATFORM TRIP: BERRYESSA STATION - PLATFORM TRIP (S1 TRACK) - ITEM 12', 'SXC ETTS Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(544, 'SXC-49', 10, 'DC', 3, 'KEEPING PTS ACTIVE FOR LONG ENOUGH TO PERFORM THIS TEST RESULTS IN MPR HARD LOCKOUT FOR EFFECTED BREAKERS - PER MP, CAN BE VERIFIED ONCE 3RD IS ENERGIZED, PLATFORM TRIP: BERRYESSA STATION - PLATFORM TRIP (S2 TRACK) - ITEM 24', 'SXC ETTS Procedure Functional Test', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(545, 'SXC-50', 10, '', 3, 'MAIN TIE MAIN FUNCTION DOES NOT WORK PROPERLY - NORMALLY OPEN BREAKER CLOSES WITH UNDERVOLTAGE CONDITION ON NORMALLY CLOSED BREAKER IN INTERLOCKING POSITION, ISSUE FOUND DURING REGRESSION TEST', 'SXC-C02-P4', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'A/R', NULL, NULL, NULL, '2018-04-27 19:55:59', 'REDO MAIN TIE MAIN TEST after KAPSCH correction', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(546, 'SXC-51', 10, 'DC', 3, 'GENERAL, ANALOGS ON C02 PANEL ARE NOT FUNCTIONING', 'SXC-C02-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(547, 'SXC-52', 10, '', 3, 'SECOND SOURCE TO THE ATS MISSING PER MARK P. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(548, 'SXC-53', 10, '', 3, 'BATTERY CHARGER TEST NOT COMPLETE COULD NOT GENERATE PROPER ALARM PER MANUFACTURERS INSTRUCTIONS , DC OUTPUT FAILURE ALARM', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(549, 'SXC-54', 10, '', 3, 'RECTIFIER CONTROL POWER TROUBLE ALARM IS MISSING DUE TO INCONSISTENT/INCOMPLETE WIRING , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(550, 'SXC-55', 10, 'DC', 3, 'TRANSFER TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, SKR TRANSFER TRIP ZONE (SL09), D05 (172-05)', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(551, 'SXC-56', 10, 'DC', 3, 'EMERGENCY TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, ', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(552, 'SXC-57', 10, 'DC', 3, 'ANALOGS ON C02 PANEL ARE NOT FUNCTIONING - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, GENERAL ISSUE', 'SWA-C02-P2', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(553, 'SXC-58', 10, 'DC', 3, 'HMI CURRENT STATUS SCREEN DOES NOT REPORT AC VOLTAGE VALUES - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, HMI SCREEN', 'GENERAL', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(554, 'SXC-59', 10, 'DC', 3, 'NGD CONTROL POWER (DC POWER) NEEDS TO BE ADDED TO THE NGD TROUBLE ALARM - PER MOHAN AND MARK P. SUMMARY ALARM WITH POINTS FROM NGD WILL CLOSE ISSUE, NO NGD AT SXC', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 19:55:59', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(555, 'SXC-59', 10, 'DC', 3, 'NO WAYSIDE BLS ALARMS @ HMI - AR SENT TEST REPORT TO KAPSCH, ', '', '2018-03-03', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'KAPSCH TO ADD TO HMI', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(556, 'SXC-60', 10, 'DC', 3, 'BLS S429 TRIPPED BREAKERS PER TRIP TABLE - AR SENT TEST REPORT TO KAPSCH - RELATED EMERGENCY TRIP ZONE ALARMS MISSING AT SHO VIA SXC AND AT SBE/PTC VIA SXC, ', '', '2018-03-03', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'KAPSCH TO MAP/UPDATE ALARM', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(557, 'SXC-61', 10, 'DC', 3, 'PTS1 AND 2 TRIP EXACTLY THE OPPOSITE OF TRIP TABLE - PTS 1 TRIPS S2 CONTACT RAIL AND PTS 2 TRIPS S1 CONTACT RAIL. - AR SENT TEST REPORT TO KAPSCH, ', '', '2018-03-03', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'KAPSCH TO PROGRAM TO MATCH FIELD WIRING', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(558, 'SXC-62', 10, 'DC', 3, 'WRONG ALARM CAME INTO ICS FOR BLS S503 AND S505 - INDICATED ONLY RAIL ZONES SR14 AND SL16 AND NOT: SL15, SR12, OR SL14 @ SXC - AR SENT TEST REPORT TO KAPSCH, ', '', '2018-03-03', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'KAPSCH TO UPDATE IO POINT DESCRIPTIONS', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(559, 'SXC-63', 10, 'DC', 3, 'NO EMERGENCY TRIP ALARMS ON BLS TRIP AT HMI OR PTC @ SBE ONLY - AR SENT TEST REPORT TO KAPSCH, ', '', '2018-03-03', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'KAPSCH TO CHECK ALARM MAPPING', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(560, 'SXC-64', 10, 'DC', 3, 'WAYSIDE BLS\' CAME IN AS INCORRECT @ HMI - AR SENT TEST REPORT TO KAPSCH, ', '', '2018-03-03', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 19:55:59', 'KAPSCH TO CHECK CORRECT HMI TEXT', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(561, 'SBE-1', 11, 'AC', 3, '172-4 IS NOT GRAPHICALLY REPRESENTED ON THE EBP WHEN IN CLOSED CONDITION. , 72 AND 13: INITIATE A REMOTE TRIP COMMAND FROM THE EBP IN THE PTC.', 'SBE-C02-P3', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 20:00:33', 'BART/VTA TO INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(562, 'SBE-2', 11, 'AC', 3, 'NORMALLY CLOSED BREAKERS ARE SWITCHED TO 252-2., GENERAL DISCREPANCY', 'SBE-C02-P4', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:33', 'KAPSCH TO REPROGRAM NORMALLY CLOSED BREAKERS PER DESIGN REQUIREMENTS.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(563, 'SBE-3', 11, 'AC', 3, 'HMI TEXT READS \"Z01 UNDERVOLTAGE\", SL NO 37: SBE CONTROL POWER TROUBLE - TRANSFORMER RECTIFIER UNIT 1', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:33', 'POWELL TO INVESTIGATE IF WIRING ISSUE. KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(564, 'SBE-4', 11, 'AC', 3, 'UNIT 1 SHOULD BE CHANGED TO UNIT 2 IN THE TEXT, SL NO 59: SBE CONTROL POWER TROUBLE - TRANSFORMER RECTIFIER UNIT 1', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:33', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(565, 'SBE-5', 11, 'AC', 3, 'HMI TEXT READS \"POWER FAIL\", SL NO 74: SBE LOSS OF 1258VDC AT ENCLOSURE GROUND PROTECTION CKT.', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:33', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(566, 'SBE-6', 11, 'AC', 3, 'NO ALARM AT HMI, SL NO 77: SBE 1000VDC MAIN BREAKER 172-1 CONTROL POWER FAILURE', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'IS THIS AN ADDRESS ISSUE?', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(567, 'SBE-7', 11, 'AC', 3, 'NO ALARM AT HMI, SL NO 81: SBE 1000VDC MAIN BREAKER 172-7 CONTROL POWER FAILURE', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'IS THIS AN ADDRESS ISSUE?', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(568, 'SBE-8', 11, 'AC', 3, 'SECOND UNIT DOES NOT EXIST., SL NO 151: SBE AC HOUSE UNIT 2 LOSS OF VENTILLATION', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO DELETE TEXT FROM IO LIST AND PROGRAM.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(569, 'SBE-9', 11, 'AC', 3, 'ALARM COULD NOT BE GENERATED. INVESTIGATE, SL NO 169: SBE DC OUTPUT FAILURE ALARM ', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(570, 'SBE-10', 11, 'AC', 3, 'HMI TEXT READS \"MPR OFFLINE\", SL NO 174: SBE BKR 172-02 MPR COMMUNICATION TROUBLE', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(571, 'SBE-11', 11, 'AC', 3, 'HMI TEXT READS \"MPR OFFLINE\", SL NO 175: SBE BKR 172-03 MPR COMMUNICATION TROUBLE', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(572, 'SBE-12', 11, 'AC', 3, 'HMI TEXT READS \"MPR OFFLINE\", SL NO 176: SBE BKR 172-04 MPR COMMUNICATION TROUBLE', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(573, 'SBE-13', 11, 'AC', 3, 'HMI TEXT READS \"MPR OFFLINE\", SL NO 177: SBE BKR 172-05 MPR COMMUNICATION TROUBLE', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(574, 'SBE-14', 11, 'AC', 3, 'HMI TEXT READS \"MPR OFFLINE\", SL NO 178: SBE BKR 172-06 MPR COMMUNICATION TROUBLE', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(575, 'SBE-15', 11, 'AC', 3, 'ICS AND EBP TEXT IS INCORRECT., SL NO 180: SBE TRANSFORMER X02 COMMUNICATION TROUBLE', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 20:00:34', 'BART/VTA TO INVESTIGATE', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(576, 'SBE-16', 11, 'AC', 3, 'ICS AND EBP TEXT IS INCORRECT. ALARM DOES NOT RESET. BREAKERS 252-01, 252-08, AND 172-01 WILL NOT CLOSE DURING THIS ALARM. , SL NO 181: SBE RECTIFIER Z01 LOSS OF COMMUNICATION OR LOSS OF CONTROL POWER', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'ALL', NULL, NULL, NULL, '2018-04-27 20:00:34', 'BART/VTA TO INVESTIGATE TEXT ISSUE. POWELL/KAPSCH TO INVESTIGATE WHY ALARM DOES NOT REST AND WHY BREAKERS WILL NOT CLOSE DURING THIS ALARM.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(577, 'SBE-17', 11, '', 3, 'MISSING EMERGENCY AND TRANSFER TRIP ALARMS FROM SEVERAL SECTIONS OF CONTACT RAIL. NEED TO BE ADDED TO IO LIST. , ', 'SBE-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(578, 'SBE-18', 11, '', 3, 'AT SXC 172-03 TRIPPED AND SL14 DE-ENERGIZED., ZONE SL15 - ITEM 3', 'SBE-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', 'FUNCTIONS AS EXPECTED - TEST NOTES FUNCTION', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(579, 'SBE-19', 11, '', 3, 'BREAKER CLOSED AND CONTACT RAIL DE-ENERGIZED WHEN CONDITION CLEARED., ZONE SL15 - ITEM 3', 'SBE-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', 'FUNCTIONS AS EXPECTED - TEST NOTES FUNCTION', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(580, 'SBE-20', 11, '', 3, 'AT SBE SR13 DE-ENERGIZED, ZONE SR12 - ITEM 8', 'SBE-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', 'FUNCTIONS AS EXPECTED - TEST NOTES FUNCTION', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(581, 'SBE-21', 11, '', 3, 'BLS S508 ID NOT SHOWN - \"SBE ETTS BLS TRIP\" READ, LOCAL EMERGENCY BLS TRIP - ITEM 15', 'SBE-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', 'FUNCTIONS AS EXPECTED - TEST NOTES FUNCTION', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(582, 'SBE-22', 11, '', 3, '172-4 AND CONTACT RAIL SR13 DEENERGIZED, NON TRANSFER TRIP TEST - ITEM 7', 'SBE-ETTS-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(583, 'SBE-23', 11, '', 3, 'NO ALARMS RECEIVED, SL NO 160-162', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(584, 'SBE-24', 11, '', 3, 'INVESTIGATE ALARMS, SL NO 186-189', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(585, 'SBE-25', 11, '', 3, 'ETTC PORT 2 CHANNEL A AND ETTC PORT 3 CHANNEL B FAILS - ALARM NOT GENERATED - INVESTIGATE AND CORRECT AT ALL SITES, FOUND DURING ETTS TESTING', 'SBE SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(586, 'SBE-26', 11, '', 3, 'INCORRECT TEXT AT HMI, SI NO 32', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(587, 'SBE-27', 11, '', 3, 'INCORRECT TEXT AT HMI, SI NO 54', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(588, 'SBE-28', 11, '', 3, 'ATS ISSUE WITH POWER AUTO TRANSFER BACK - POWELL TO FIX. EQUIPMENT FAILURE WITH CONTROLLER AND BROKEN LEVER HINGE ., SI NO 143', 'SBE SIT Procedure IO List', '2017-08-04', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'ATS FUNCTIONAL AND SCADA TEST COMPLETE. GE TO INSTALL CONTROLLER AND LEVER', NULL, NULL, 2, 30, '0000-00-00', 'Powell March 2018', NULL, 0),
(589, 'SBE-29', 11, '', 3, 'AUX TRANSFORMER ISSUE RELATED TO ATS - POWELL TO FIX, SI NO 144', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'TO BE TESTED', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(590, 'SBE-30', 11, '', 3, 'INCORRECT TEXT AT HMI, SI NO 146', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(591, 'SBE-31', 11, '', 3, 'INCORRECT TEXT AT HMI, SI NO 147', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(592, 'SBE-32', 11, '', 3, 'INCORRECT TEXT AT HMI, SI NO 148', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(593, 'SBE-33', 11, '', 3, 'INCORRECT TEXT AT HMI, SI NO 149', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(594, 'SBE-34', 11, '', 3, 'UNABLE TO GENERATE , SI NO 150', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(595, 'SBE-35', 11, '', 3, 'INCORRECT TEXT AT HMI, SI NO 160', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(596, 'SBE-36', 11, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 168', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(597, 'SBE-37', 11, '', 3, 'TO BE RETESTED FOR TEXT CORRECTION, SI NO 173', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'TO BE RETESTED FOR TEXT CORRECTION', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(598, 'SBE-38', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 186', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(599, 'SBE-39', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 187', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(600, 'SBE-40', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 188', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(601, 'SBE-41', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 189', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(602, 'SBE-42', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 190', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(603, 'SBE-43', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 191', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(604, 'SBE-44', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 192', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(605, 'SBE-45', 11, '', 3, 'INCORRECT TEXT, SI NO 193', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO CHANGE TEXT PER IO LIST.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(606, 'SBE-46', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 194', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'NEW ITEMS TO BE TESTED', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(607, 'SBE-47', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 195', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'NEW ITEMS TO BE TESTED', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(608, 'SBE-48', 11, '', 3, 'NEW ITEMS TO BE TESTED, SI NO 196', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'NEW ITEMS TO BE TESTED', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(609, 'SBE-49', 11, '', 3, 'S3 TRACK DC DISCONNECT SWITCH PS02 CLOSED, SI NO 197', 'SBE SIT Procedure IO List', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'DUPLICATE ITEM - CLOSED', NULL, NULL, 2, 30, '0000-00-00', 'Powell will analyze further', NULL, 0),
(610, 'SBE-50', 11, '', 3, 'MAIN TIE MAIN FUNCTION DOES NOT WORK PROPERLY - NORMALLY OPEN BREAKER CLOSES WITH UNDERVOLTAGE CONDITION ON NORMALLY CLOSED BREAKER IN INTERLOCKING POSITION, ISSUE FOUND DURING REGRESSION TEST', 'SBE-C02-P4', '2017-08-04', 2, 'Amy Fauria', 14, 14, 'A/R', NULL, NULL, NULL, '2018-04-27 20:00:34', 'REDO MAIN TIE MAIN TEST after KAPSCH correction', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(611, 'SBE-51', 11, 'DC', 3, 'GENERAL - DC POWER COULD NOT BE MEASURED, ANALOGS ON C02 PANEL ARE NOT FUNCTIONING', 'SBE-C02-P2', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'INVESTIGATE ', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(612, 'SBE-52', 11, '', 3, 'NORTHSIDE AC HOUSE DOOR JAMS, PUNCHLIST', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', 'Powell to replace door and fix hinges. ', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(613, 'SBE-53', 11, '', 3, 'MISSING NORMALLY OPEN (N.O.) AND NORMALLY CLOSED (N.C.) LABELS ON C02 FOR BREAKERS 252-1 AND 252-2, RESPECTIVELY., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(614, 'SBE-54', 11, '', 3, 'SXC PLATFORM TRIPS DO NOT REPORT TO SBE, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(615, 'SBE-55', 11, '', 3, 'SBE WAYSIDE TRIP ALARMS FOR SL16 AND SR14 REPORTS TO SXC INSTEAD OF SBE, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(616, 'SBE-56', 11, '', 3, 'RECTIFIER CONTROL POWER TROUBLE ALARM IS MISSING, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(617, 'SBE-57', 11, '', 3, 'UPDATE MIMIC PANEL TO INCLUDE NORMALLY OPEN OR NORMALLY CLOSED AS NEEDED., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(618, 'SBE-58', 11, 'DC', 3, 'TRANSFER TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, SKR TRANSFER TRIP ZONE (SL09), D05 (172-05)', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(619, 'SBE-59', 11, 'DC', 3, 'EMERGENCY TRIP TEXT DESCRIPTIONS TO REVISED TO INCLUDE INCIDENT BREAKER IDENTIFICATION, ', 'SWA SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(620, 'SBE-60', 11, 'DC', 3, 'NGD (G01) DID NOT REPORT TROUBLE ALARM WHEN SYSTEM OK LAMP WAS SHOWING FAULT DUE TO DC POWER NOT AVAILABLE. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(621, 'SBE-61', 11, 'DC', 3, 'NEED TO TEST NGD SWITCH POSITION INDICATION, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(622, 'SBE-62', 11, 'DC', 3, 'ANALOGS ON C02 PANEL ARE NOT FUNCTIONING - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, GENERAL ISSUE', 'SWA-C02-P2', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(623, 'SBE-63', 11, 'DC', 3, 'HMI CURRENT STATUS SCREEN DOES NOT REPORT AC VOLTAGE VALUES - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, HMI SCREEN', 'GENERAL', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(624, 'SBE-64', 11, 'DC', 3, 'REMOTE BLS\' (PASSED THROUGH SXC) NEED TO ALARM AT TPSS SBE - POTENTIAL CHANGE, ', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH to program changes for alarm to annunciate at SBE via SXC. ', NULL, NULL, 2, 30, '0000-00-00', 'Not done, no ETTC at SBE', NULL, 0),
(625, 'SBE-65', 11, 'DC', 3, 'C02 MIMIC PANEL NEEDS TO BE MODIFIED TO INCLUDE SE02 , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', 'Mimic panel will be updated with labels. WITH SE02 TRACK EXTENSION', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(626, 'SBE-66', 11, 'DC', 3, 'HMI GRAPHIC NEEDS TO BE MODIFIED TO INCLUDE SE02. SE02 SHOULD SHOW AS ENERGIZED IF \'(CONTACT RAIL SECTION SL16 ENERGIZED AND PS01 CLOSED) OR (CONTACT RAIL SECTION SR14 ENERGIZED AND PS02)\'. ANY OTHER STATE SHOULD SHOW SE02 AS DEENERGIZED. THIS LOGIC CAN BE CREATED WITH IO POINTS: SI NOS 131, 132, 195, AND 197., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:00:34', 'HMI will be updated to reflect changes. ', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(627, 'SBE-67', 11, 'DC', 3, 'NGD CONTROL POWER OR SUMMARY (DC POWER) NEEDS TO BE ADDED TO THE NGD TROUBLE ALARM - CURRENTLY WHEN DC POWER ALONE IS LOST, THERE IS AN ALARM AT THE NGD BUT NOT ANNUNCIATED REMOTELY, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'HMI/RTAC Logic to be updated TO GENERATE SUMMARY ALARM WITH DC POWER LOST ONLY GENERATING SAID ALARM - TO BE retested', NULL, NULL, 2, 30, '0000-00-00', 'Not done yet per Mark Pfeiffer\'s request.', NULL, 0),
(628, 'SBE-68', 11, 'DC', 3, 'Update text to read: \"SBE CONTACT RAIL SECTION (SE02) DC DISCONNECT SWITCH PS01 OPEN\", SI No 194', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'Currently the text is incorrect and is deployed without \'open\' and \'close\' at the end of the text. Instead, alarm ends with \'status\'. Text is not updated at ICS and PTC.', NULL, NULL, 2, 30, '0000-00-00', 'Change Order', NULL, 0),
(629, 'SBE-69', 11, 'DC', 3, 'Update text to read: \"SBE CONTACT RAIL SECTION (SE02) DC DISCONNECT SWITCH PS01 CLOSED\", SI No 195', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'Currently the text is incorrect and is deployed without \'open\' and \'close\' at the end of the text. Instead, alarm ends with \'status\'. Text is not updated at ICS and PTC.', NULL, NULL, 2, 30, '0000-00-00', 'Change Order', NULL, 0),
(630, 'SBE-70', 11, 'DC', 3, 'Update text to read: \"SBE CONTACT RAIL SECTION (SE02) DC DISCONNECT SWITCH PS02 OPEN\", SI No 196', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'Currently the text is incorrect and is deployed without \'open\' and \'close\' at the end of the text. Instead, alarm ends with \'status\'. Text is not updated at ICS and PTC.', NULL, NULL, 2, 30, '0000-00-00', 'Change Order', NULL, 0);
INSERT INTO `CDL` (`DefID`, `OldID`, `Location`, `SpecLoc`, `Severity`, `Description`, `Spec`, `DateCreated`, `Status`, `IdentifiedBy`, `SystemAffected`, `GroupToResolve`, `ActionOwner`, `EvidenceType`, `EvidenceLink`, `DateClosed`, `LastUpdated`, `Comments`, `Updated_by`, `Created_by`, `SafetyCert`, `RequiredBy`, `DueDate`, `ClosureComments`, `Pics`, `Repo`) VALUES
(631, 'SBE-71', 11, 'DC', 3, 'Update text to read: \"SBE CONTACT RAIL SECTION (SE02) DC DISCONNECT SWITCH PS02 CLOSED\", SI No 197', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'Currently the text is incorrect and is deployed without \'open\' and \'close\' at the end of the text. Instead, alarm ends with \'status\'. Text is not updated at ICS and PTC.', NULL, NULL, 2, 30, '0000-00-00', 'Change Order', NULL, 0),
(632, 'SBE-72', 11, 'DC', 3, 'Add text to read: \"SBE CONTACT RAIL SECTION (SE02) DE-ENERGIZED\", SI No 198', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 20:00:34', 'Alarm not received at PTC. ', NULL, NULL, 2, 30, '0000-00-00', 'Change Order', NULL, 0),
(633, 'SBE-73', 11, 'DC', 3, 'NO WAYSIDE BLS ALARMS @ HMI, ', '', '2018-03-03', 1, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:00:34', 'KAPSCH TO ADD TO HMI', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(634, 'SSL-1', 12, 'AC', 3, 'POWELL COULD NOT GENERATE ALARM, SI NO 52: BATTERY CHARGER OVERLOAD', 'SSL SIT Procedure IO List', '2017-08-31', 2, 'Amy Fauria', 14, 14, 'POWELL', NULL, NULL, NULL, '2018-04-27 20:02:04', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(635, 'SSL-2', 12, 'AC', 3, 'NO COMMUNICATION CABLE PRESENT - DELETE IO POINT, SI NO 75', 'SSL SIT Procedure IO List', '2017-08-31', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'KAPSCH to delete point at RTAC and OCC database AND UPDATE OCC DATABASE FOR CONTROL MANAGEMENT', NULL, NULL, 2, 30, '0000-00-00', 'Kapsch:  The deletion part is new addition.  This will be done.', NULL, 0),
(636, 'SSL-3', 12, 'AC', 3, 'NO COMMUNICATION CABLE PRESENT - DELETE IO POINT, SI NO 76', 'SSL SIT Procedure IO List', '2017-08-31', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'KAPSCH to delete point at RTAC and OCC database AND UPDATE OCC DATABASE FOR CONTROL MANAGEMENT', NULL, NULL, 2, 30, '0000-00-00', 'Kapsch:  The deletion part is new addition.  This will be done.', NULL, 0),
(637, 'SSL-4', 12, 'AC', 3, 'ALL SLP ALARMS ARE PREFIXED WITH SSL, SLP ALARMS IN IO LIST', 'SSL SIT Procedure IO List', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'KAPSCH TO REVISE LIST', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(638, 'SSL-5', 12, 'AC', 3, 'NITROGEN TROUBLE ALARM DOES NOT GENERATE WITH LOW BOTTLE PRESSURE, FUNCTIONAL TEST', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'BART/VTA', NULL, NULL, NULL, '2018-04-27 20:02:04', 'REQUIRES CHANGE FROM BART', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(639, 'SSL-6', 12, 'AC', 3, 'WITH 34.5 PT RACKED OUT AND FUSES OPEN, NO UNDERVOLTAGE ALARM PRESENT. THUS 252-10 UNDERVOLTAGE DOESN\'T EXIST., FUNCTIONAL TEST AND IO ALARM', '', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'POWELL AND KAPSCH TO ADD IO POINT', NULL, NULL, 2, 30, '0000-00-00', 'March 2018', NULL, 0),
(640, 'SSL-7', 12, 'AC', 3, '371 OIL TEMP ALARM AND TRIP REVERSED. TRIP COMES FIRST. PROBLEM WAS CORRECTED. FIELD WIRING CHANGES., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'POWELL AND KAPSCH TO AS-BUILT DRAWINGS', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(641, 'SSL-8', 12, 'AC', 3, '252-10 SECONDARY CONTACT CONNECTOR HAS DAMAGED CLASP., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL', NULL, NULL, NULL, '2018-04-27 20:02:04', 'FOLLOW UP WITH LORA', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(642, 'SSL-9', 12, 'AC', 3, 'HMI NEEDS UPDATE TO SHOW X10 TRANSFORMER, HMI DISPLAY', 'NA', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'KAPSCH TO ADD AUX TRANSFORMER ON HMI', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(643, 'SSL-10', 12, 'AC', 3, 'ATS TRANSFER ALARM DID NOT APPEAR AT HMI, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'ALARM WAS WITNESSED BY MARK 9/12/17 DURING ATS TESTING', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(644, 'SSL-11', 12, 'AC', 3, 'ATS DID NOT TRANSFER BACK WITH SOURCES AVAILABLE, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', 'FUNCTIONALITY WAS WITNESSED BY MARK P ON 9/12/17 DURING ATS TESTING', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(645, 'SSL-12', 12, 'AC', 3, 'ADD ALARM FOR SECOND SOURCE TO ATS NOT AVAILABLE, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(646, 'SSL-13', 12, 'AC', 3, 'BATTERY CHARGER COMMUNICATION IS PRESENT BUT CHARGER IS ON., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'ALL', NULL, NULL, NULL, '2018-04-27 20:02:04', 'DISCUSS AT NEXT MEETING', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(647, 'SSL-14', 12, 'AC', 3, 'COMMUNICATION CABLE AT RTAC END IS NOT PROPERLY TERMINATED. NO STRAIN RELIEF IS PRESENT. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(648, 'SSL-15', 12, 'AC', 3, '34.5 KV BUS SHOWS ENEGIZED (ON HMI GRAPHIC) WHEN BREAKERS ARE CLOSED IN TEST AND DISCONNECTED POSITIONS. LOGIC SHOULD INCLUDE BREAKER POSITION AS WELL AS BREAKER STATUS. THIS PROBLEM OCCURS WITH H1 AND H2 FOR ALL LOCATIONS. , ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(649, 'SSL-16', 12, 'AC', 3, 'NEED TO SEPARATE BREAKER CONTROL POWER FROM IPR POWER. LOSS POSITION STATUS WHILE RACKING OUT BREAKER., ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(650, 'SSL-17', 12, 'AC', 3, '343 SELECTOR SWITCH AT BREAKER IS REPORTING \"UNDETERMINED\" ON HMI, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(651, 'SSL-18', 12, 'AC', 3, 'BURNT WIRE PT-10 TBAC-N1, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(652, 'SSL-19', 12, 'AC', 3, '24V DC/DC CONVERTER UNIT 1 DISPLAY IS DEFECTIVE, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', '', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(653, 'SSL-20', 12, 'AC', 3, 'ANALOGS ON C02 PANEL ARE NOT FUNCTIONING - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, GENERAL ISSUE', 'SWA-C02-P2', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'Powell/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(654, 'SSL-21', 12, 'AC', 3, 'HMI CURRENT STATUS SCREEN DOES NOT REPORT AC VOLTAGE VALUES - DID NOT TEST CURRENTS @ ALL STATIONS - PER MP NEED 3 CAR TRAIN RUN, HMI SCREEN', 'GENERAL', '2018-04-27', 1, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'HMI Logic to be updated and retested', NULL, NULL, 2, 30, '0000-00-00', 'Closed', NULL, 0),
(655, 'SSL-22', 12, 'AC', 3, 'BLOCKING PANEL WIRING INTERCONNECT TO BE VERIFIED AGAINST DRAWING., PUNCHLIST', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'Punchlist item - moved to punchlist.', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(656, 'SSL-23', 12, 'AC', 3, 'NGD CONTROL POWER (DC POWER) NEEDS TO BE ADDED TO THE NGD TROUBLE ALARM, NO NGD AT SSL', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, '', NULL, NULL, NULL, '2018-04-27 20:02:04', 'delete - no NGD at SSL', NULL, NULL, 2, 30, '0000-00-00', '', NULL, 0),
(657, 'SSL-24', 12, 'AC', 3, '343 SELECTOR SWITCH AT BREAKER IS REPORTING \"UNDETERMINED\" ON HMI, ', '', '2018-04-27', 2, 'Amy Fauria', 14, 14, 'AR/POWELL/KAPSCH', NULL, NULL, NULL, '2018-04-27 20:02:04', 'GOLEY TO DL FOR MISSING WIRE.', NULL, NULL, 2, 30, '0000-00-00', 'The is a field wiring issue.  The signal is coming from field.', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `CertifiableElement`
--

CREATE TABLE `CertifiableElement` (
  `CE_ID` int(11) NOT NULL,
  `CertifiableElement` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `CertifiableElement`
--

INSERT INTO `CertifiableElement` (`CE_ID`, `CertifiableElement`) VALUES
(1, 'Mechanical'),
(2, 'Remote Wayside Facilities & Security');

-- --------------------------------------------------------

--
-- Table structure for table `Contract`
--

CREATE TABLE `Contract` (
  `ContractID` int(11) NOT NULL,
  `Contract` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Contract`
--

INSERT INTO `Contract` (`ContractID`, `Contract`) VALUES
(4, 'C671'),
(1, 'C700'),
(5, 'C700AR'),
(3, 'C730'),
(2, 'C742');

-- --------------------------------------------------------

--
-- Table structure for table `ElementGroup`
--

CREATE TABLE `ElementGroup` (
  `EG_ID` int(11) NOT NULL,
  `ElementGroup` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ElementGroup`
--

INSERT INTO `ElementGroup` (`EG_ID`, `ElementGroup`) VALUES
(1, 'Guideway'),
(2, 'Remote Wayside Facilities & Security');

-- --------------------------------------------------------

--
-- Table structure for table `equipAct_link`
--

CREATE TABLE `equipAct_link` (
  `equipActID` int(11) UNSIGNED NOT NULL,
  `equipID` int(11) UNSIGNED NOT NULL,
  `activityID` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipID` int(11) UNSIGNED NOT NULL,
  `equipTotal` tinyint(3) UNSIGNED NOT NULL,
  `equipDesc` varchar(50) NOT NULL,
  `idrID` int(11) UNSIGNED NOT NULL,
  `equipNotes` varchar(125) DEFAULT NULL,
  `LocationID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `EvidenceType`
--

CREATE TABLE `EvidenceType` (
  `EviTypeID` int(11) NOT NULL,
  `EviType` varchar(25) DEFAULT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `EvidenceType`
--

INSERT INTO `EvidenceType` (`EviTypeID`, `EviType`, `Update_TS`, `Updated_by`) VALUES
(1, 'Duplicate Item', '2018-03-05 19:25:46', 'rburns'),
(2, 'Photograph', '2018-03-05 19:26:12', 'rburns'),
(3, 'Test Results', '2018-03-05 19:26:26', 'rburns'),
(4, 'Letter', '2018-03-05 19:26:14', 'rburns'),
(5, 'Request For Information', '2018-03-06 16:41:13', 'rburns'),
(6, 'Clarification in Comments', '2018-03-05 19:26:17', 'rburns'),
(8, 'Change Request', '2018-03-06 01:17:47', 'rburns');

-- --------------------------------------------------------

--
-- Table structure for table `IDR`
--

CREATE TABLE `IDR` (
  `idrID` int(11) UNSIGNED NOT NULL,
  `UserID` int(11) NOT NULL,
  `idrDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ContractID` int(11) NOT NULL,
  `weather` varchar(20) NOT NULL,
  `shift` varchar(10) NOT NULL,
  `EIC` varchar(30) DEFAULT NULL,
  `watchman` varchar(30) DEFAULT NULL,
  `rapNum` varchar(20) DEFAULT NULL,
  `sswpNum` varchar(20) DEFAULT NULL,
  `tcpNum` varchar(20) DEFAULT NULL,
  `locationID` int(11) NOT NULL,
  `opDesc` varchar(50) NOT NULL,
  `approvedBy` int(11) DEFAULT NULL,
  `editableUntil` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `IDR`
--

INSERT INTO `IDR` (`idrID`, `UserID`, `idrDate`, `ContractID`, `weather`, `shift`, `EIC`, `watchman`, `rapNum`, `sswpNum`, `tcpNum`, `locationID`, `opDesc`, `approvedBy`, `editableUntil`) VALUES
(3, 39, '2018-04-24 05:00:00', 1, '72 degrees Mostly Su', '8', NULL, NULL, NULL, NULL, NULL, 1, 'Aldridge Rosedin ', NULL, '0000-00-00 00:00:00'),
(4, 39, '2018-04-24 05:00:00', 1, '72 degrees Mostly Su', '8', NULL, NULL, NULL, NULL, NULL, 1, 'SSH', NULL, '0000-00-00 00:00:00'),
(5, 39, '2018-04-24 05:00:00', 1, '72 degrees mostly su', '8', NULL, NULL, NULL, NULL, NULL, 2, 'Aldridge/Rosedin', NULL, '0000-00-00 00:00:00'),
(6, 39, '2018-04-24 05:00:00', 1, '72 degrees Mostly Su', '8', NULL, NULL, NULL, NULL, NULL, 2, 'SSH', NULL, '0000-00-00 00:00:00'),
(7, 39, '2018-04-25 05:00:00', 1, '73 degrees Sunny', '8', NULL, NULL, NULL, NULL, NULL, 1, 'SSH', NULL, '0000-00-00 00:00:00'),
(8, 39, '2018-04-25 05:00:00', 1, '73 degrees Sunny', '8', NULL, NULL, NULL, NULL, NULL, 1, 'Aldridge/Rosedin', NULL, '0000-00-00 00:00:00'),
(9, 39, '2018-04-25 05:00:00', 1, '73 degrees Sunny', '8', NULL, NULL, NULL, NULL, NULL, 2, 'SSH', NULL, '0000-00-00 00:00:00'),
(10, 39, '2018-04-25 05:00:00', 1, '73 degrees Sunny', '8', NULL, NULL, NULL, NULL, NULL, 1, 'Aldridge/Rosedin', NULL, '0000-00-00 00:00:00'),
(11, 39, '2018-04-26 05:00:00', 1, '70 degrees Mostly Su', '8', NULL, NULL, NULL, NULL, NULL, 1, 'Milpitas Station', NULL, '0000-00-00 00:00:00'),
(12, 39, '2018-04-26 05:00:00', 1, '70 degrees Mostly Su', '8', NULL, NULL, NULL, NULL, NULL, 2, 'Berryessa Station', NULL, '0000-00-00 00:00:00'),
(13, 39, '2018-04-27 05:00:00', 1, '56 degrees partly cl', '8', NULL, NULL, NULL, NULL, NULL, 2, 'Berryessa sttation', NULL, '0000-00-00 00:00:00'),
(14, 39, '2018-04-27 05:00:00', 1, '56 degrees partly cl', '8', NULL, NULL, NULL, NULL, NULL, 1, 'Milpitas Station', NULL, '0000-00-00 00:00:00'),
(15, 39, '2018-04-27 05:00:00', 1, '56 degrees partly cl', '8', NULL, NULL, NULL, NULL, NULL, 1, 'Milpitas Station', NULL, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `idrComments`
--

CREATE TABLE `idrComments` (
  `idrCommentID` int(11) UNSIGNED NOT NULL,
  `commentDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `userID` int(11) NOT NULL,
  `idrID` int(11) UNSIGNED NOT NULL,
  `comment` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `labor`
--

CREATE TABLE `labor` (
  `laborID` int(11) UNSIGNED NOT NULL,
  `laborTotal` tinyint(3) UNSIGNED NOT NULL,
  `laborDesc` varchar(50) NOT NULL,
  `idrID` int(11) UNSIGNED NOT NULL,
  `laborNotes` varchar(125) DEFAULT NULL,
  `LocationID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labor`
--

INSERT INTO `labor` (`laborID`, `laborTotal`, `laborDesc`, `idrID`, `laborNotes`, `LocationID`) VALUES
(3, 2, 'Electricians are fixing the Ground test stations w', 3, NULL, 0),
(4, 2, 'Electricians are pulling new wire for lighting and', 3, NULL, 0),
(5, 2, 'Electricians are finishing the install of the SAB ', 3, NULL, 0),
(6, 2, 'Tile Cleaning', 4, NULL, 0),
(7, 2, 'Removing wall Panels', 4, NULL, 0),
(8, 2, 'Polishing Stainless Steel hand rails', 4, NULL, 0),
(9, 2, 'Adjusting B9A fixtures', 5, NULL, 0),
(10, 2, 'Grounding CTR1', 5, NULL, 0),
(11, 2, 'Camera Removal and pulling 5 West Camera feeds', 5, NULL, 0),
(12, 2, 'Installing Warning Strips', 6, NULL, 0),
(13, 2, 'Installing SAB ceiling', 6, NULL, 0),
(14, 1, 'Cleaning Interface', 6, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `laborAct_link`
--

CREATE TABLE `laborAct_link` (
  `laborActID` int(11) UNSIGNED NOT NULL,
  `laborID` int(11) UNSIGNED NOT NULL,
  `activityID` int(11) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `laborAct_link`
--

INSERT INTO `laborAct_link` (`laborActID`, `laborID`, `activityID`) VALUES
(4, 3, 10),
(3, 3, 9),
(5, 3, 11),
(6, 4, 12),
(7, 5, 13),
(8, 6, 14),
(9, 7, 15),
(10, 8, 16),
(11, 9, 17),
(12, 10, 18),
(13, 11, 19),
(14, 12, 20),
(15, 13, 21),
(16, 14, 22);

-- --------------------------------------------------------

--
-- Table structure for table `Location`
--

CREATE TABLE `Location` (
  `LocationID` int(11) NOT NULL,
  `LocationName` varchar(255) NOT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Location`
--

INSERT INTO `Location` (`LocationID`, `LocationName`, `Update_TS`, `Updated_by`) VALUES
(1, 'S40 Milpitas Station', '2018-04-02 23:38:18', 'ckingbailey'),
(2, 'S50 Berryessa Station', '2018-04-02 23:38:10', 'ckingbailey'),
(3, 'Project Test Center', '2018-03-05 04:43:08', 'rburns'),
(5, 'TPSS SWA', '2018-03-22 23:00:07', 'rburns'),
(6, 'TPSS SKR', '2018-03-22 23:01:14', 'rburns'),
(7, 'TPSS SRR', '2018-03-22 23:01:21', 'rburns'),
(8, 'TPSS SME', '2018-03-22 23:00:34', 'rburns'),
(9, 'TPSS SHO', '2018-03-22 23:00:42', 'rburns'),
(10, 'TPSS SXC', '2018-03-22 23:00:19', 'rburns'),
(11, 'TPSS SBE', '2018-03-22 22:59:43', 'rburns'),
(12, 'SWS SSL', '2018-03-22 23:04:43', 'rburns'),
(13, 'HVSS SRC', '2018-03-22 23:01:43', 'rburns'),
(14, 'HVSS SLP', '2018-03-22 23:01:59', 'rburns'),
(15, 'TCH S24', '2018-03-22 23:03:16', 'rburns'),
(16, 'TCH S26', '2018-03-22 23:03:28', 'rburns'),
(17, 'TCH S28', '2018-03-22 23:03:36', 'rburns'),
(18, 'TCR S40', '2018-03-22 23:03:53', 'rburns'),
(19, 'TCH S44', '2018-03-22 23:04:08', 'rburns'),
(20, 'GBS SXC', '2018-03-22 23:05:05', 'rburns'),
(21, 'TCR S50', '2018-03-22 23:05:21', 'rburns'),
(22, 'Operations Control Center', '2018-03-22 23:10:55', 'rburns');

-- --------------------------------------------------------

--
-- Table structure for table `Pictures`
--

CREATE TABLE `Pictures` (
  `PicID` int(11) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `UserID` int(11) NOT NULL,
  `DefID` int(11) NOT NULL,
  `DateUploaded` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `recoveryemails_enc`
--

CREATE TABLE `recoveryemails_enc` (
  `ID` bigint(20) UNSIGNED ZEROFILL NOT NULL,
  `UserID` bigint(20) NOT NULL,
  `Key` varchar(32) NOT NULL,
  `expDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recoveryemails_enc`
--

INSERT INTO `recoveryemails_enc` (`ID`, `UserID`, `Key`, `expDate`) VALUES
(00000000000000000001, 0, '39d874148d62f9a22faeb6d976deeca9', '2018-03-11 04:26:07'),
(00000000000000000002, 0, '9227aa1f2eca49f6e33260365c259989', '2018-03-08 05:47:02'),
(00000000000000000003, 0, '8f89c43ba2e215d2690a1fda66037570', '2018-03-08 05:48:36'),
(00000000000000000004, 1, 'c30d72b58909f662b72e61c6e76bb320', '2018-03-08 05:53:16'),
(00000000000000000005, 14, 'af2d3c1bdc7294bdca02dac1fc919f88', '2018-03-12 07:10:57'),
(00000000000000000006, 14, '3bf51666a4e9321e77550d584e2f847f', '2018-03-12 07:21:38'),
(00000000000000000007, 14, 'd6442026d44ce216d2563715851bc529', '2018-03-12 07:23:35'),
(00000000000000000008, 14, 'c13a5ff5dc2757468fe935e2811afb37', '2018-03-12 07:43:27'),
(00000000000000000009, 14, 'f156725ef694b3eb70d8c83d20ab435a', '2018-03-12 07:45:31'),
(00000000000000000010, 14, 'e526ba77dad15467e56182ffef666b34', '2018-03-12 07:56:50'),
(00000000000000000011, 14, '3081c385a963205cca540ba9567fadb1', '2018-03-12 07:57:54'),
(00000000000000000012, 14, 'af9e438b3bbf40a391bd323a640593d7', '2018-03-12 07:59:59'),
(00000000000000000013, 14, '7c01383d64207a028e42505001339092', '2018-03-12 08:01:59'),
(00000000000000000014, 14, '0abc6a19f1ea0c17c8e51bd04cb49cf8', '2018-03-12 08:05:07'),
(00000000000000000015, 14, '72ff455c14422e44716f7908c2553fdb', '2018-03-12 08:14:34'),
(00000000000000000016, 14, '7e32d295373d37e785cf0668b9f2e538', '2018-03-12 08:17:50'),
(00000000000000000017, 14, '6516bf0e012c19596cfbc690ddf1d44a', '2018-03-12 08:18:21'),
(00000000000000000018, 14, '9a9473e49466abbf78aee17c64f21feb', '2018-03-12 08:19:20'),
(00000000000000000019, 14, 'c0d126be4cd0ceadf49d778878d8d32d', '2018-03-12 08:20:09'),
(00000000000000000020, 14, '0aafe58aa6a703b635a2d68514bad40c', '2018-03-12 08:21:28'),
(00000000000000000021, 14, '39ff1cb5d15abf72bc9903be618af997', '2018-03-12 16:54:56'),
(00000000000000000022, 14, '77cfb405085539d1a5cb1af879f90c13', '2018-03-13 22:50:02'),
(00000000000000000023, 26, 'b2950eef42ddac509f7bc64fdcf774e6', '2018-04-16 11:53:14');

-- --------------------------------------------------------

--
-- Table structure for table `Repo`
--

CREATE TABLE `Repo` (
  `RepoID` int(11) NOT NULL,
  `Repo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Repo`
--

INSERT INTO `Repo` (`RepoID`, `Repo`) VALUES
(1, 'SharePoint'),
(2, 'Aconex');

-- --------------------------------------------------------

--
-- Table structure for table `RequiredBy`
--

CREATE TABLE `RequiredBy` (
  `ReqByID` int(11) NOT NULL,
  `RequiredBy` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `RequiredBy`
--

INSERT INTO `RequiredBy` (`ReqByID`, `RequiredBy`) VALUES
(10, 'FIT'),
(20, 'FFT'),
(30, 'SIT1'),
(40, 'SIT2'),
(50, 'SIT3'),
(60, 'Revenue Service');

-- --------------------------------------------------------

--
-- Table structure for table `SafetyCert`
--

CREATE TABLE `SafetyCert` (
  `CertID` int(11) NOT NULL,
  `Item` varchar(12) NOT NULL,
  `DesignCode` varchar(225) NOT NULL,
  `DesignSpec` varchar(225) NOT NULL,
  `ContractNo` int(11) NOT NULL,
  `ControlNo` int(11) NOT NULL,
  `ElementGroup` int(2) NOT NULL,
  `CertElement` int(2) NOT NULL,
  `Requirement` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `SafetyCert`
--

INSERT INTO `SafetyCert` (`CertID`, `Item`, `DesignCode`, `DesignSpec`, `ContractNo`, `ControlNo`, `ElementGroup`, `CertElement`, `Requirement`) VALUES
(1, 'GW.180.00', 'Facility Design Criteria, 3.1.11 - Architecture - Wayside Facilities', '4.E, Page 5', 1, 180, 1, 2, 'Roadways to be used by emergency fire fighting equipment shall be a minimum of 20 feet wide and are subject to review and approval by the local fire protection jurisdiction.'),
(2, 'GW.180.01', 'Facility Design Criteria, 3.1.11 - Architecture - Wayside Facilities', '4.E, Page 5', 1, 180, 1, 0, 'Roadways to be used by emergency fire fighting equipment shall be a minimum of 20 feet wide and are subject to review and approval by the local fire protection jurisdiction.'),
(3, 'GW.180.02', 'Facility Design Criteria, 3.1.11 - Architecture - Wayside Facilities', '3.4.A, Page 4', 1, 180, 1, 0, 'Facility sites shall be provided with a solid fence or wall.'),
(4, 'GW.180.03', 'Facility Design Criteria, 3.1.6 - Architecture - Passenger Station Sites', '6.C, Page 30', 1, 180, 1, 0, 'Unattended parking areas shall be adequately lit for security. '),
(5, 'GW.170.01', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '4.1.A, Page 8', 1, 170, 1, 0, 'Depth of Installation - Cover in Areas other than Trackway: Minimum cover over uncased pipe or over casings shall be 3 feet at areas subject to vehicular traffic, unlined ditches, and other unpaved surfaces, and 2 feet at lined ditches. Additional cover shall be provided where necessary to comply with the utility owner\'s policy or local design conditions.'),
(6, 'GW.170.02', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '4.1.B, Page 9', 1, 170, 1, 0, 'Cover Under Trackway: Minimum clearance between top of uncased pipe, top of casing pipe, or top of concrete encasement and BART System top of rails shall be 6 feet 6 inches unless otherwise approved or required by the District.'),
(7, 'GW.170.03', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1, Page 13', 1, 170, 1, 0, ' PIPELINES FOR FLAMMABLE SUBSTANCES                                                                                                Carrier Pipe\nThe following requirements for carrier pipe apply to pipelines crossing under both at grade and aerial sections of BART System tracks. These requirements apply for a\nminimum horizontal distance of 50 feet from centerline of outside tracks. When casing is required, these requirements apply for a minimum horizontal distance of 50\nfeet from centerline of outside tracks or 25 feet beyond the ends of casing, whichever is greater.'),
(8, 'GW.170.04', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.1, Page 13', 1, 170, 1, 0, 'Gas Lines. Gas line systems include natural, manufactured, or liquefied petroleum gas. Each new gas line system and each system in which a line has been relocated or\nreplaced, or the part of the gas line system that has been relocated within the District\'s right-of-way or street right-of-way, shall be designed, installed, and tested in\naccordance with the current standards of the utility owner and:'),
(9, 'GW.170.05', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.1.A, Page 13', 1, 170, 1, 0, 'Title 49 CFR Part 192, Transportation of Natural and Other Gas by Pipeline:\nMinimum Federal Safety Standards.'),
(10, 'GW.170.06', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.1.B, Page 13', 1, 170, 1, 0, 'ASME B31.8, Gas Transmission and Distribution Piping Systems.\n'),
(11, 'GW.170.07', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.1.C, Page 13', 1, 170, 1, 0, 'The State of California Public Utilities Commission, General Order No. 112- D, Rules Governing Design, Construction Testing, Maintenance and Operation of Utility Gas Gathering, Transmission and Distribution Piping\nSystems, except that allowable stresses for the design of steel pipe shall conform to the following requirements:\n                                                                                                          Steel gas lines installed within the District\'s right-of-way which are designed to operate at a pressure which will produce a hoop stress in the pipe equal to 30 percent Specific Minimum Yield Stress (SMYS) or greater shall be\nsubjected to a hydrostatic test to a pressure of at least 1.5 times the maximum allowable operating pressure for a period of at least 8 hours.'),
(12, 'GW.170.08', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.1.D, Page 13', 1, 170, 1, 0, 'Steel carrier pipes shall be protectively coated and provided with a cathodic protection system in conformance with the corrosion control requirements of Appendices under District Technical Manuals or the utility owner'),
(13, 'GW.170.09', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.1.E, Page 13', 1, 170, 1, 0, 'Inspection of welding on pipelines installed within the District\'s right-of-way shall be in conformity with Title 49 Code of Federal Regulations, Part 192, Transportation of Natural and Other Gas by Pipeline: Minimum Federal\nSafety Standards, Articles 192.241 and 192.243. Steel pipelines of 6 inches in diameter or greater, and operating at a pressure which will produce a hoop stress of 20 percent of the SMYS or greater, shall have all girth welds tested\nnondestructively over their entire circumference.'),
(14, 'GW.170.10', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.2, Page 13', 1, 170, 1, 0, 'Liquid Petroleum Pipelines. Each new liquid-petroleum-products pipeline system and each pipeline in which a pipe has been relocated or replaced, or the part of a pipeline system that has been relocated within the District\'s right-of-way or street right-of-way, shall be designed, installed, and tested in accordance with applicable sections of the following:'),
(15, 'GW.170.11', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.2.A, Page 14', 1, 170, 1, 0, 'ASME B31.5, Liquid Transportation Systems for Hydrocarbons, Liquid Petroleum Gas, Anhydrous Ammonia and Alcohols - ASME B31.4.'),
(16, 'GW.170.12', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.2.B, Page 14', 1, 170, 1, 0, 'API Recommended Practice (PR 1102) for Steel Pipelines Crossing Railroads and Highways.'),
(17, 'GW.170.13', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.2.C, Page 14', 1, 170, 1, 0, 'Title 49 Code of Federal Regulations Part 195, Transportation of Hazardous Liquids by Pipeline and shall conform to the following: \n                                                                                                       1. Pipelines installed within the District\'s right-of-way or street right-of way shall have 100 percent of all girth welds tested nondestructively as specified in Part 195.234 (e)(2).\n2. Carrier pipes located longitudinally in or crossing BART\'s right-of-way, within casing, shall be subjected to hydrostatic testing in compliance with Part 195.302.\n3. Carrier pipes shall be protectively coated and wrapped in the manner specified in Part 195.238.\n4. The facility shall be provided with a cathodic protection system as specified in Part 195.242.\n5. Carrier pipe installed with a casing shall be manufactured to a specification acceptable to Part 195.112 or Part 195.114 or both and designed to operate at a stress level per Part 195.106, 195.108 and 195.110.\n'),
(18, 'GW.170.14', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.1.2.D, Page 14', 1, 170, 1, 0, 'Liquid-petroleum lines in proximity or crossing BART underground structures shall also conform to the requirements of NFPA 130.'),
(19, 'GW.170.15', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..2.A, Page 14', 1, 170, 1, 0, 'Casings shall comply with the requirements in Article 5.2 except as modified herein.\n'),
(20, 'GW.170.16', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..2.B, Page 14', 1, 170, 1, 0, 'Casing pipes and joints shall be of metal in accordance with the requirements specified in Article 5.2. For large or high-pressure mains which require periodic inspection and where otherwise appropriate, reinforced concrete\nutility tunnels may be used.'),
(21, 'GW.170.17', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..2.C, Page 14', 1, 170, 1, 0, 'Ductile iron pipe may be used for a casing provided the method of installation is by open trench. Ductile iron pipe shall conform to AWWA C151, Ductile Iron Pipe, Centrifugally Cast, for Water or Other Liquids. The pipe shall be of the mechanical joint type or plain-end pipe with compression-type couplings. The strength of ductile iron pipe to sustain external loads shall be computed in\naccordance with AWWA C150, Thickness Design of Ductile Iron Pipe.\n'),
(22, 'GW.170.18', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..2.D, Page 15', 1, 170, 1, 0, 'Casing pipe shall be sized as required under Article 5.2 and the following additional requirements:\r\n\r\n1. For flexible casing pipe, a maximum vertical deflection of the casing pipe of 3 percent of its diameter plus 1/2-inch clearance shall be provided so that no loads from the BART System trackways, vehicular traffic, or casing pipe itself are transmitted to the carrier pipe.\r\n2. When insulators are used on the carrier pipe, the inside diameter of the casing pipe shall be:\r\nAt least 2 inches greater than the outside diameter of the carrier pipe for pipe less than 8 inches in diameter,\r\nAt least 3-1/4-inches greater for carrier pipe to 8 to 16 inches (inclusive) in diameter, and\r\nAt least 4-1/2-inches greater for carrier pipe 18 inches in diameter and over.\r\n'),
(23, 'GW.170.19', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..2.E, Page 15', 1, 170, 1, 0, 'Casing pipe shall be tested for contacts with carrier pipe and contacts shall be eliminated.\n'),
(24, 'GW.170.20', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..2.F, Page 15', 1, 170, 1, 0, 'Casing pipe shall extend to the greater of the following distances, measured at right angles to centerline of track:\n                                                                                                           1. A minimum distance of 1 foot outside the fenced portion of the BART System right-of-way, or wherever practicable, a minimum distance of 1 foot outside the BART System right-of-way. Also refer to Article 3.2B.3 herein.\n2. A minimum distance of 25 feet each side from centerline of outside track when end of casing is sealed.\n3. A minimum distance of 45 feet from centerline of outside track when end of casing is open\n'),
(25, 'GW.170.21', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.3.A, Page 15', 1, 170, 1, 0, 'Where ends of casing are below ground they shall be suitably sealed to outside of carrier pipe.\n'),
(26, 'GW.170.22', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..3.B, Page 15', 1, 170, 1, 0, 'Where ends of casing are at or above ground surface and above high-water level, they may be left open, provided drainage is afforded in such a manner that leakage will be conducted away from BART and other railway tracks or\nstructures. Where proper drainage is not provided, the ends of casing shall be sealed.'),
(27, 'GW.170.23', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6.3.C, Page 15-16', 1, 170, 1, 0, 'Casing pipe, when sealed, shall be properly vented. Vent pipes shall be of sufficient diameter, but in no case less than 2 inches in diameter, shall be attached near end of casing, and shall project through the ground surface\noutside the BART System right-of-way at a distance of not less than 6 inches from the right-of-way line or not less than 45 feet (measured at right angles) from centerline of nearest tracks.\n'),
(28, 'GW.170.24', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..2.D, Page 16', 1, 170, 1, 0, 'Vent pipe, or pipes, shall extend not less than 4 feet above ground surface. Top of vent pipe shall be fitted with downturned elbow properly screened, or a relief valve. Vents in locations subject to high water shall be extended above the maximum elevation of high water and shall be adequately supported and protected.\n\n'),
(29, 'GW.170.25', 'Facility Design Criteria, 3.2.6 Civil-Utilities', '6..2.E, Page 16', 1, 170, 1, 0, 'Vent pipes shall have vertical separation of at least 8 feet from aerial electric wires, carrying 750 volts or less and 12 feet from aerial electric wires carrying over 750 volts'),
(30, 'GW.120.01', 'Facility Design Criteria, 3.2.5\nCivil - \nTrackway', '8.7A.1,3, Page 25', 1, 120, 1, 0, 'Derails. Derails shall be installed as follows: \n1. On spur tracks, sidings, or transfer tracks where grades slope toward mainline or other tracks subject to automatic train operations.  \n3. Where maintenance of way equipment storage tracks are connected directly to tracks subject to automatic train operations, regardless of grades.\n'),
(31, 'GW.110.01', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.1, Page 2', 1, 110, 1, 0, 'FENCING. Fencing of at-grade right-of-way is the principal means of protecting BART passengers as well as pedestrians and vehicles outside the BART right-of-way from the hazards of high speed trains and the electric third rail.  Security provided by the fence for at-grade sections is subject to the approval of the CPUC and to its authority to make changes and additions if, in its opinion, fencing is not adequate.  Right-of-way fencing shall conform to the requirements of CPUC General Order No. 95, Rule 79.4, except as herein amended.'),
(32, 'GW.110.02', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.3, Page 3', 1, 110, 1, 0, 'Maximum-Security Fencing. Fencing used to deny access to BART trackways and fencing used to maintain \nsecurity of BART System property which requires a high degree of security, shall be 8 feet high consisting of 7 feet of chain-link fabric topped by three strands of barbed \nwire, 12 inches high, or combinations of walls or barriers with chain-link fabric and barbed wire with a total height of 8 feet.  Chain link fabric shall be attached to posts, \ntension wires and rails on the side facing away from BART property.  Refer to Article 2.11 for requirements for greater fencing height at high voltage and other facilities.  \nRefer to Article 2.15 for minimum-security fencing requirements.  '),
(33, 'GW.110.03', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.1, Page 2', 1, 110, 1, 0, 'FENCING. Fencing of at-grade right-of-way is the principal means of protecting BART passengers as well as pedestrians and vehicles outside the BART right-of-way from the hazards of high speed trains and the electric third rail.  Security provided by the fence for at-grade sections is subject to the approval of the CPUC and to its authority to make changes and additions if, in its opinion, fencing is not adequate.  Right-of-way fencing shall conform to the requirements of CPUC General Order No. 95, Rule 79.4, except as herein amended.'),
(34, 'GW.110.04', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.3, Page 3', 1, 110, 1, 0, 'Maximum-Security Fencing. Fencing used to deny access to BART trackways and fencing used to maintain \nsecurity of BART System property which requires a high degree of security, shall be 8 feet high consisting of 7 feet of chain-link fabric topped by three strands of barbed \nwire, 12 inches high, or combinations of walls or barriers with chain-link fabric and barbed wire with a total height of 8 feet.  Chain link fabric shall be attached to posts, \ntension wires and rails on the side facing away from BART property.  Refer to Article 2.11 for requirements for greater fencing height at high voltage and other facilities.  \nRefer to Article 2.15 for minimum-security fencing requirements.  '),
(35, 'GW.110.05', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.4, Page 4', 1, 110, 1, 0, 'Fencing for Protection Against Vandalism. BART facilities requiring an increased level of security, due to extreme danger to the public or areas susceptible to vandalism shall be protected using maximum security fencing with the addition of razor ribbon coil wire or barbed tape spiral affixed to the top of the fence.  Razor wire coils shall be securely fastened to the tension wire or top rail and to the barbed wire strands and shall be secured so that they are not suspended lower than 7 feet above ground.  '),
(36, 'GW.110.06', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.5, Page 4', 1, 110, 1, 0, 'Fencing Along at Grade Sections. Maximum-security fencing as described in Article 2.3 shall be provided continuously along each side of all at-grade sections, including transitions to subway or aerial sections.'),
(37, 'GW.110.07', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.7, Page 5', 1, 110, 1, 0, 'Fencing Along Aerial Sections. All aerial structure sections, where the ground level is less than 10 feet below the underside of the structure, shall be enclosed with maximum-security fencing. '),
(38, 'GW.110.08', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.11, Page 6', 1, 110, 1, 0, 'Fencing of High Voltage and Other Facilities. Maximum-security fencing shall be provided to deny access to high voltage installations, such as substations, gap breaker stations, areas containing BART System property adjoining private and public property, and other areas where so required.  Fencing or enclosures for such areas shall be 9 feet high, consisting of 8 feet of chain-link fabric, secured at the top and bottom to galvanized pipe rail, topped by three strands of barbed wire, 12 inches high, unless these facilities are adequately protected by a minimum of 9-feet-high walls.  '),
(39, 'GW.110.09', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.14, Page 9', 1, 110, 1, 0, 'Gates. Gates shall be provided so that all fenced areas, no matter how small, are accessible from outside the fenced area.  Gates shall be have a minimum 4\'-0\" width and shall be provided for personnel/equipment access.  Where vehicular access is required, drive gates with 12-feet minimum width shall be provided. The swing of the gate shall be such that no part of the gate shall be closer than 8 feet 6 inches from the centerline of the nearest BART track.  '),
(40, 'GW.110.10', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.14.1.A, Page 9', 1, 110, 1, 0, 'Gates shall be located at approximately one-half mile intervals.  Gates shall be provided on both sides of the right-of-way at the same milepost. '),
(41, 'GW.110.11', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.14.1.B, Page 10', 1, 110, 1, 0, 'At gate locations in walls or concrete traffic barriers, where the concrete section of fencing exceeds a height of 3 feet above grade on the BART right-of-way side of the fence, the grade level shall be elevated or a step provided such that the step down distance does not exceed 3 feet.'),
(42, 'GW.110.12', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.14.1.C, Page 10', 1, 110, 1, 0, 'The District will coordinate the location of the personnel/equipment gates with the local fire service agency. For emergency access designated gates, information that clearly identifies the route and location of each gate shall be provided on the gates or adjacent thereto per NFPA 130.'),
(43, 'GW.110.13', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.16, Page 10', 1, 110, 1, 0, 'Grounding of Fencing. All permanent fencing shall be grounded as specified in the Standard Specifications and as shown on Civil Standard Drawing No. CS01.'),
(44, 'GW.110.14', 'Facility Design Criteria, 3.2.3\nCivil - \nMiscellaneous Standards', '2.17, Page 11', 1, 110, 1, 0, 'Signs. Fences along right-of-way lines shall be marked with signs as described in Facility Design, Criteria, ARCHITECTURE, Signage. '),
(45, 'GW.110.15', 'CPUC GO 95            Facility Design Criteria - Civil-Miscellaneous Standards', 'Rule 79.4.A                                    2.1', 1, 110, 1, 0, 'At Ground Level\r\n\r\nThird rail construction or reconstruction shall not be permitted at ground level unless the rights-of-way, easement or other property upon which the same is located is entirely fenced. Fence construction shall be designed, installed and maintained in such manner as to deny access over, under or through the fencing to all but authorized persons.\r\n\r\nFencing of at-grade right-of-way is the principal means of protecting BART passengers as well as pedestrians and vehicles outside the BART right-of-way from the hazards of high speed trains and the electric third rail.  Security provided by the fence for at-grade sections is subject to the approval of the CPUC and to its authority to make changes and additions if, in its opinion, fencing is not adequate.  Right-of-way fencing shall conform to the requirements'),
(46, 'GW.110.16', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.2.1. Page 3', 1, 110, 1, 0, 'Fabric.  Chain-link fabric shall be galvanized steel, coating weight class 2, with a maximum mesh opening of 1 inch.  Fabric edge finish at both top and bottom edges shall be barbed and twisted when barbed wire is specified, and shall be knuckled when no barbed wire is specified. .'),
(47, 'GW.110.17', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.2.2, Page 3', 1, 110, 1, 0, 'Fabric Support.  Fabric shall be supported by a tension wire at both top and bottom edges.  An exception shall be where fences may be subject to abuse, such as at playgrounds or adjacent to pedestrian areas.  In these cases, the fabric shall be supported by a pipe rail at both the top and bottom.  In order to hold the bottom tension wire in place, 1/4-inch-diameter eyebolts shall be embedded in the footing concrete at each post with the eye 1 inch above grade.  The bottom tension wire shall be run through each of these eyebolts when installed. '),
(48, 'GW.110.18', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.2.3, Page 3', 1, 110, 1, 0, 'Grading Requirements.  Security provided by at-grade fencing begins with attention to earthwork, grading, and drainage.  The fence specifications require that the bottom \ntension wire be within 1 inch of grade.  The grading specifications require that earthwork in the line of the fence be properly performed to hold the surface under the fence to this 1-inch tolerance and to assure that the earth is well compacted so that it will not settle after the fence is constructed.  Fence shall not be located on slopes of \ncut banks or trackway embankments except where absolutely required by right-ofway and earthwork restrictions.  Where the fence is near or parallel to the top or bottom of a slope, the earth shall be thoroughly compacted and, if necessary to prevent erosion of earth under fence, the shoulder shall be hard-surfaced with asphalt concrete or equivalent for a distance of 3 feet on each side of the fence. '),
(49, 'GW.110.19', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.2.4, Page 3', 1, 110, 1, 0, 'Alignment Changes.  Wherever changes in the horizontal and vertical alignment of the fence are 5 degrees or greater, corner posts shall be installed and braced as shown on the Standard Drawings. '),
(50, 'GW.110.20', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.2.A, Page 2', 1, 110, 1, 0, 'All District right-of-way adjoining private property shall be protected at the property line with a fence, a wall, or combination of a wall and a fence.  Fencing shall consist of chain-link fabric attached to steel pipe posts spaced at \nnot more than 10 feet on center. The posts shall be embedded into concrete footings or set into concrete retaining walls.  Refer to the Standard Drawings for details.   '),
(51, 'GW.110.21', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.2.B, Page 2', 1, 110, 1, 0, 'Fencing/Screen Wall:  Consideration shall be given to the visual appearance of the trackway right-of-way fencing as it transitions into a station or passes through an area of public attraction or vista.  A special fence or barrier design \nappropriate for the condition shall be considered subject to reviewed by the District.  '),
(52, 'GW.110.22', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.3.1, Page 3', 1, 110, 1, 0, 'Extension Arms on Maximum Security Fence.  The fence shall have barbed wire extension arms inclined away \nfrom the BART property.  Where it is absolutely impossible to incline the extension arms away from the BART property, they shall be installed vertically.  Extension arms, in addition to carrying the barbed wire, shall have adequate strength to support a 300-pound vertical load applied at their outer end.   '),
(53, 'GW.110.23', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.3.2, Page 4', 1, 110, 1, 0, 'Depressions Under the Fence.  Depressions of more than one inch under the fence shall be prevented by means described in Article 2.2.3 above or with the closure \ndetail shown on the fencing Standard Drawing. '),
(54, 'GW.110.24', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.3.3, Page 4', 1, 110, 1, 0, 'Landscaping.  Landscaping shall be carefully controlled at security fencing to assure  that no large trees or shrubs provide an easy method of access over the fence.  \nFencing and trees shall be kept apart a minimum of 5 feet.  Future growth of the landscaped materials shall be considered. '),
(55, 'GW.110.25', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.6.A, Page4', 1, 110, 1, 0, 'Where a wall of a retained fill or open cut section or a concrete traffic barrier adjacent to a BART trackway lies essentially on the right-of-way line, maximum security fencing shall be installed on top of the retaining wall or \ntraffic barrier.'),
(56, 'GW.110.26', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2..6.B, Page 4', 1, 110, 1, 0, 'Where a retaining wall adjacent to the BART trackway extends above the adjacent ground level, and the wall is located essentially on the right-of-way line, maximum-security fencing shall be installed on top of the wall or traffic barrier.  In such cases the combined height of the wall or traffic barrier and the fence above the adjacent ground outside the BART right-of-way shall be not \nless than 8 feet, including wall, chain-link fabric and 1 foot of barbed wire, in accordance with the respective Civil Standard Drawings'),
(57, 'GW.110.29', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.6.C, Page4', 1, 110, 1, 0, 'Where a retaining wall is well within the right-of-way line, security fencing shall be located in accordance with other requirements and shall not be placed on top of the wall.  See Article 2.18 for requirements for railing along top of \nwall.'),
(58, 'GW.110.30', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.6.D, Page 5', 1, 110, 1, 0, 'Fencing between at-grade and retained sections shall be continuous. '),
(59, 'GW.110.31', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.10.3, Page 6', 1, 110, 1, 0, 'Adjoining Public Property.  Where right-of-way of at-grade sections adjoins public property, fencing may be located further from the right-of-way line than indicated in \nArticle 2.10.1 herein provided that the following conditions are met: \n                                                                                                         A. A public authority requests that the fence be moved closer to the adjacent track and agrees to police and maintain the area between the fence and the right-ofway\nline. \n                                                                                                       B. A minimum distance of 13 feet is maintained between the post centerlines and the adjacent BART track centerline. \n                                                                                                          C. The fencing is installed as close to the track as practical (not on slope of trackway embankment), and only the area outside of the fence is landscaped.'),
(60, 'GW.110.32', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.10.1, Page 6', 1, 110, 1, 0, 'Distance to Right-of-Way Line.  The fence shall be placed inside BART property 12 inches from the right-of-way line with the barbed wire extension arms inclined away \nfrom the BART property.  Where the extension arms are vertical, the fence shall be placed 4-1/2 inches from the right-of-way line. '),
(61, 'GW.110.33', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.12, Page 6 -7', 1, 110, 1, 0, 'Maximum-security fences shall preferably be placed 3 feet away from the backside of the adjacent rigid or a semi-flexible traffic barrier and shall be 8 feet high.  Where \nmaximum-security fences are closer than 3 feet to the barrier, the fabric height shall be increased by an amount equal to the height of the traffic barrier for a distance not \nless than 10 feet beyond each end of the barrier, or when the barrier is curved, not less than 10 feet beyond the point where the fence is 3 feet from the barrier.  See Figure 1.  Where fence is on a rigid barrier, the combined height of the fence and barrier shall be not less than 8 feet. '),
(62, 'GW.110.34', 'Facility Design Criteria - 3.2.3 - Civil-Miscellaneous Standards', '2.13, Page 9', 1, 110, 1, 0, 'Debris racks shall be designed in accordance with the requirements of Facility Design, Criteria, CIVIL, Drainage.                         \r\n\r\nGenerally, the debris rack shall have bars spaced with six-inch maximum clearances and with all edges finished flush with sides and bottom of the concrete ditch lining and bottom of the fence.                                                                 The debris rack shall be inclined approximately 15 degrees from the vertical and extend from invert of ditch to six inches above top of culvert.  \r\n\r\nThe debris rack bars shall be of solid rectangular cross-section designed to withstand maximum impact from largest expected floating debris. '),
(63, 'GW.100.01', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies                  C700 Contract', '3.B, Page 3.LS-C200 to LS-C243 (Trackway P & P Drawings)             ', 1, 100, 1, 0, 'Unauthorized access to equipment, possible injury to unauthorized personnel, theft, and damage shall be limited by preventing access to BART facilities by means of fencing, walls and other types of barriers.  '),
(64, 'GW.100.02', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '3.C, Page 4', 1, 100, 1, 0, 'The entire BART system shall be in a dedicated right-of-way to protect passengers, pedestrians, and other modes of transportation sharing a common corridor with BART.'),
(65, 'GW.100.03', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies                  C700 Contract', '3.B, Page 3.LS-C200 to LS-C243 (Trackway P & P Drawings)             ', 1, 100, 1, 0, 'Unauthorized access to equipment, possible injury to unauthorized personnel, theft, and damage shall be limited by preventing access to BART facilities by means of fencing, walls and other types of barriers.  '),
(66, 'GW.100.04', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '3.C, Page 4', 1, 100, 1, 0, 'The entire BART system shall be in a dedicated right-of-way to protect passengers, pedestrians, and other modes of transportation sharing a common corridor with BART.'),
(67, 'GW.100.05', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '3.D, Page 4', 1, 100, 1, 0, 'The entire BART system shall be completely separated from other forms of transportation. At-grade public road crossings and at-grade track crossings with other rail systems shall not be used.'),
(68, 'GW.100.06', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '3.E, Page 4', 1, 100, 1, 0, 'The entire BART right-of-way shall be protected to avoid access by unauthorized vehicles or pedestrians, except at stations and associated parking facilities and at grade-separated structures.  Areas designated as non-public areas in stations and parking facilities shall also be protected from unauthorized access.'),
(69, 'GW.100.07', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '3.F, Page 4', 1, 100, 1, 0, 'BART trackway and other facilities shall be protected from intrusion of motor vehicles and derailment of an adjacent rail system where required.  Protection from motor vehicles on adjacent roadways shall be provided by means of traffic barriers. Protection of BART train operating envelope from derailment of an adjacent rail system shall be provided as described in this Section under Intrusion Barriers.'),
(70, 'GW.100.08', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.2.A, Page 4', 1, 100, 1, 0, 'Where the trackway is traversed by a motor vehicle overpass, the overpass shall be provided with barriers capable of preventing vehicular penetration.  These barriers shall be capable of performing at least as effectively as the barrier described herein for preventing vehicular penetration from parallel, adjacent highway traffic lane.'),
(71, 'GW.100.09', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.2.B,Page 4 - 5', 1, 100, 1, 0, 'A right-of-way barrier shall be constructed when an at-grade right-of-way runs parallel and is adjacent to a highway traffic lane, including those locations where the trackway shares a common corridor in a highway median. The barrier shall be designed to prevent vehicle intrusion into the right-of-way.\r\n\r\nThe barrier shall be constructed of concrete, or other suitable material, to a height of 3 feet above the highway grade level.  The remaining height of the barrier shall be fencing material, as required in General Order 95, Rule 79.4, Fencing.\r\n\r\nIf a highway lane is adjacent to the right-of-way, has a direction of automotive travel which turns to the right with the right-of-way fence having a radius of curvature of 3,500 feet or less, and the highway lane is on a 2 percent or greater negative grade (that is, highway traffic is traveling downhill), the concrete barrier shall be at least 4 feet 6 inches in height.\r\n\r\nIn both cases (3 feet and 4 feet 6 inch high barriers), the total hei'),
(72, 'GW.100.10', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.2.C, Page 5', 1, 100, 1, 0, 'At Curves on BART System Streets. A barrier shall be installed on BART System streets at the outside of any curve where safety considerations dictate a speed less than the posted maximum street speed.'),
(73, 'GW.100.11', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.2D, Page 5', 1, 100, 1, 0, 'At Dead-End Streets. A barrier shall be installed at the end of dead-end streets and T intersections that are so close to the tracks as to cause a hazard.  The barrier length shall be sufficient to intercept all possible vehicular paths from within the traveled way of the approaching street.'),
(74, 'GW.100.12', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.3, Page 5', 1, 100, 1, 0, 'Traffic Barrier Types   \n Barriers shall be either rigid or semi-flexible depending on the location as indicated in Articles 4.4 through 4.6, herein.  Refer to Standard Drawings for installation and \nconstruction details. '),
(75, 'GW.100.13', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.4.A, Page 5', 1, 100, 1, 0, 'Roadways Parallelling BART System Tracks:\n\nA rigid barrier shall be used where the distance from centerline of nearest track to roadway face of barrier is less than 17 feet.  The barrier shall be Type D as shown on the Standard Drawings on Sheet CS04.  Where the trackway and an adjoining roadway are separated by a retaining wall, the wall shall be extended above the roadway to serve as the barrier and the wall face next to the roadway shall be shaped to match the contour of the aforesaid concrete barrier.'),
(76, 'GW.100.14', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.4.B, Page 5', 1, 100, 1, 0, 'Roadways Parallelling BART System Tracks:\n\nA heavy-duty, semi-flexible barrier Type A as shown on the Standard drawings on Sheet CS03, shall be used where the distance from centerline of nearest track to roadway face of barrier is 17 feet or more.  The barrier shall consist of a blocked-out, continuous corrugated steel rail and a continuous steel channel supported by wooden posts spaced 6 feet 3 inches apart.  The top of the guard rail shall be 2 feet 8 inches above the roadway surface at the barrier.'),
(77, 'GW.100.15', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.5.A, Page 6', 1, 100, 1, 0, 'Dead-End Streets at BART System Tracks:\n\nA standard-duty, semi-flexible barrier Type B as shown on the Standard Drawings on Sheet CS03, shall be used where streets having relatively flat grades of less than 2 percent dead end at BART System tracks.  The barrier shall consist of a blocked-out, corrugated steel rail supported by wooden posts spaced 6 feet 3 inches apart.  The top of the guard rail shall be 2 feet 3 inches above the street surface at the barrier.'),
(78, 'GW.100.16', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '4.5.B, Page 6', 1, 100, 1, 0, 'Dead-End Streets at BART System Tracks:\n\nA rigid barrier, Type C as shown on the Standard drawings on Sheet CS04, shall be provided where steep grades and close proximity of the track require a substantial physical barrier against runaway vehicles.  The barrier shall consist of an 18-inch-thick reinforced concrete wall.  The top of the barrier shall be 5 feet above the street surface at the barrier.'),
(79, 'GW.100.17', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '5, Page 6', 1, 100, 1, 0, 'Intrusion Barriers\nWhere a District\'s trackway is either at-grade, aerial, or within an open cut and it shares a right-of-way common corridor with another rail system, intrusion protection shall be provided.\n'),
(80, 'GW.100.18', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '5.A, Page 6', 1, 100, 1, 0, 'If a physical (structural or earthwork) barrier is utilized for intrusion protection, such a barrier shall be placed as close as possible to the trackway of the adjacent rail system. Refer to Facility Design, Criteria, STRUCTURAL, Miscellaneous Structures, under Barrier Walls. (Guidelines for crash barriers are provided in the AREMA Manual for Railway Engineering.)'),
(81, 'GW.100.19', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '5.B, Page 6 - 7', 1, 100, 1, 0, 'At Grade:  Where a District\'s trackway shares an at-grade right-of-way common corridor with another rail system (where the track centerline of the rail system is within 65 feet of the District\'s track centerline), intrusion protection shall be provided.  The intrusion protection shall be such that a train derailment of the adjacent rail system will not intrude into the District\'s train operating envelope.  Intrusion protection can be achieved by the following means:\r\nProviding lateral separation greater than 65 feet (measured between the track centerlines of the adjacent rail system and the District\'s).\r\n\r\nProvide grade separation of 6 feet for track separations of less than 35 feet. The District trackway shall be higher.\r\n\r\nWhen lateral separation is between 65 feet and 35 feet, provide grade separation determined as follows. Height of grade separation shall be 0 feet at 65 feet and 6 feet at 35 feet. For lateral separation between 65 and 35 feet, height of grade separation  shall be '),
(82, 'GW.100.20', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '5.C, Page 7', 1, 100, 1, 0, 'Aerial Construction: Where the trackway centerline of an adjacent, at-grade rail system is within 60 feet of a District\'s aerial trainway support structure, the support structure shall be protected from impact by derailed vehicles of the rail system. Such protection can be achieved by the following means:\r\n\r\nProviding lateral separation greater than 60 feet (measured between the track centerline of the adjacent rail system and the District\'s aerial support structure).\r\n\r\nProviding a physical (structural or earthwork) barrier, or\r\n\r\nProviding an appropriate combination of lateral separation and physical barriers.\r\n'),
(83, 'GW.100.21', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '5.D, Page 7', 1, 100, 1, 0, 'Open Cut Construction:                                                     B1112Where a District\'s trackway shares a common corridor with an adjacent rail system, in which the District\'s trainway is in an open cut and the adjacent rail system\'s track centerline is within 60 feet of the open cut verge, intrusion protection shall be provided.  The intrusion protection shall be such that a vehicle derailment of the adjacent rail system will not intrude into the District\'s open cut trainway.  Intrusion protection can be achieved by the following means:  \n- Providing lateral separation greater than 60 feet (measured between the track centerline of the adjacent rail system and the verge of the District\'s open cut). \n - Providing a physical (structural or earthwork) barrier, or \n - Providing an appropriate combination of lateral separation and physical barriers.'),
(84, 'GW.100.22', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.A, Page 8', 1, 100, 1, 0, 'This Article defines only the major civil engineering design requirements for trackway access and egress.  The trackway access and egress features covered herein are walkway, crosswalks, emergency exits, and hi-rail vehicle access points.  Trackway access and egress shall conform to the requirements of  NFPA 130.'),
(85, 'GW.100.23', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.B, Page 8', 1, 100, 1, 0, 'Continuous walkways shall be provided throughout the entire BART System trackway as means for emergency evacuation for patrons from transit vehicles and stations along all the different types of trackway, including turnarounds, to a point of safety.  Safety walkways include ramps, stairs, cross-passages, passageways, crosswalks, emergency exits, and other paths of travel.'),
(86, 'GW.100.24', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.C, Page 8', 1, 100, 1, 0, 'Walkways shall also be designed to facilitate access to and egress from trains and trackway by BART operations and maintenance personnel.  Access to and egress from the trackway on foot for maintenance will be from stations, maintenance-of-way hi-rail access points, and emergency exit passageways.  Additional access and egress routes may be required beyond minimum safety requirements.'),
(87, 'GW.100.25', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.D, Page 9', 1, 100, 1, 0, 'Walkways shall be designed to follow good egress design principles.  \"Dead ends\" shall be avoided.  '),
(88, 'GW.100.26', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.E, Page 9', 1, 100, 1, 0, 'Locations, methods, and means of access to the BART trackway by emergency personnel and vehicles shall be based on the agreement between the local jurisdictions and the District.'),
(89, 'GW.100.27', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.F,  Page 9', 1, 100, 1, 0, 'Access to emergency access and egress locations shall be from public streets, BART parking lots, or access roads, having a minimum paved clear width of 20 feet. Access roads to emergency egress locations shall be continuous from a public street to a public street, or a 66-foot outside radius turnaround shall be provided.'),
(90, 'GW.100.28', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.G, Page 9', 1, 100, 1, 0, 'For at-grade trackway, per NFPA 130, Section 3-3.5.2, emergency access gates shall be a minimum of two exit units wide and shall be of the hinged or sliding type. Gates shall be placed as close as practical to portals to permit easy access to tunnels. Refer to Facility Design, Criteria, CIVIL, Miscellaneous, for related provsions for fences and gates.  '),
(91, 'GW.100.29', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.H, Page 9', 1, 100, 1, 0, 'Per NFPA 130, Section 3-3.5.3, information shall be provided on the gates or adjacent thereto that clearly identifies the route and location (track designation and milepost) of each gate. Refer to Facility Design, Criteria, ARCHITECTURE, Signage.  '),
(92, 'GW.100.30', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.I, Page 9', 1, 100, 1, 0, 'Walkway envelopes shall be provided with a clear unobstructed cross-section with a minimum width of 30 inches and minimum height of 78 inches, including construction tolerances. The entire cross-section shall be located outside the dynamic envelope of revenue vehicles shown in Introduction, COMMON REQUIREMENTS, Trackway Clearances. Except for walkway handrails described herein, there shall be no protrusion into the walkway envelope.'),
(93, 'GW.100.31', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.J, Page 9', 1, 100, 1, 0, 'Except within interlockings, walkways and contact rails shall be located on the opposite sides of the trackway from each other.  '),
(94, 'GW.100.32', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.K.1, Page 9', 1, 100, 1, 0, 'The static coefficient of friction of walkway surfaces shall not be less than 0.5 when tested in accordance with ASTM C 1028, 15.02. '),
(95, 'GW.100.33', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.K.2, Page 9', 1, 100, 1, 0, 'Open grating surfaces shall not be permitted except on aerial structures. Walkway gratings, where used, shall have slip-resistant design and shall have 1/4- inch maximum clear space between bars.'),
(96, 'GW.100.34', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.L, Page 9', 1, 100, 1, 0, 'Walkways shall have a cross slope toward the trackway. The cross slope shall not to exceed 0.5 percent.'),
(97, 'GW.100.35', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.M, Page 10', 1, 100, 1, 0, 'Walkways grades shall not exceed 8.3 percent.  Where slopes exceed 4 percent, a continuous handrail shall be provided. Where grades would exceed 8.3 percent, stairs shall be used.  '),
(98, 'GW.100.36', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.N, Page 10', 1, 100, 1, 0, 'Stairs shall have a minimum of two risers, equal in height and be between 4 and 7 inches each, and 11-inch treads.  Stairs shall have a continuous handrail.'),
(99, 'GW.100.37', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.O, Page 10', 1, 100, 1, 0, 'Where walkways are adjacent to any type of wall exceeding 5 feet in height above the top of adjacent rail and more than 100 feet in length, the walkway shall be raised to a height of two feet above top of the adjacent rail.'),
(100, 'GW.100.38', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.P, Page 10', 1, 100, 1, 0, 'Walkway shall be designed for a point bearing load of 1000 pounds minimum at any location on the walking surface.  '),
(101, 'GW.100.39', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.Q, Page 10', 1, 100, 1, 0, 'Where handrails are required along walkways and cross-passages, they shall be continuous 1-1/4-inch standard galvanized pipe mounted 3 feet 0 inches above the walkway or nosings on steps.  Handrails shall not protrude into the walkway more than 3-1/2 inches, nor less than 2-3/4 inches from the mounting wall or surface.  Handrails shall turn in towards the wall at exit doorways and cross-passages and continue across non-exit passageways. At non-exit passageways, the adjacent handrail section shall be readily removable, or otherwise operable to provide access to maintenance personnel.'),
(102, 'GW.100.40', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.R.1, Page 10', 1, 100, 1, 0, 'Crosswalks shall be provided at track level to assure walkway continuity where safety walkways are discontinued on one side of the trackway and continued on the opposite side and where access is required from safety walkways and track walkways to egress points, i.e. exit stairs, cross-passages, or maintenance stairs.'),
(103, 'GW.100.41', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.R.2, Page 10', 1, 100, 1, 0, 'Crosswalks shall have a minimum width of 5 feet and a walking surface at top of rail elevation.'),
(104, 'GW.100.42', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.R.3, Page 10', 1, 100, 1, 0, 'Where the crosswalk is to extend to the side of the trackway with the traction power contact rail, the contact rail shall be discontinued not less than 5 feet from each side of the crosswalk.'),
(105, 'GW.100.43', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.R.4, Page 10', 1, 100, 1, 0, 'Elevated safety walkway shall be brought down to the top of rail level by using ramps or stairs at crosswalks.  The length of the lower walkway shall be the width of the crosswalk.'),
(106, 'GW.100.44', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.R.5, Page 10', 1, 100, 1, 0, 'Crosswalks shall not be located where the track is superelevated in excess of 5 1/2 inches to ensure the maximum slope does not exceed 8.3 percent.');
INSERT INTO `SafetyCert` (`CertID`, `Item`, `DesignCode`, `DesignSpec`, `ContractNo`, `ControlNo`, `ElementGroup`, `CertElement`, `Requirement`) VALUES
(107, 'GW.100.45', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.R.6, Page 11', 1, 100, 1, 0, 'Crosswalks shall not be located between, on, or within special trackwork.'),
(108, 'GW.100.46', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.R.7, Page 11', 1, 100, 1, 0, 'Handrails are not required at crosswalks.'),
(109, 'GW.100.47', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.R.8, Page 11', 1, 100, 1, 0, 'Where a parked train can block a crosswalk, an alternative exit path shall be provided. There shall not be dead-end walkways.'),
(110, 'GW.100.48', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.S.1-6, Page 11', 1, 100, 1, 0, 'Points of safety are defined as follows:\n 1. A public way as defined in the CBC, Section 1002. \n 2.   An at-grade area, beyond any structure, leading to a public way.\n 3.  A fire exit that is enclosed for its full length to a public or an at-grade area beyond any structure. \n 4.  Opposite trainway when in separated tunnels and where emergency ventilation is provided.\n 5.  In at-grade and elevated station structures so designed that the station platform is open to the elements and, when the concourse is below or protected from the platform by distance or materials, as determined by an appropriate analysis, that concourse may be defined as a point of safety.                                                                           6.  In Highway median strips, a point of safety can be provided by a fenced holding area.'),
(111, 'GW.100.49', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.T.1, Page 11', 1, 100, 1, 0, 'Emergency exit passageways shall have a minimum clear width of 44 inches. Stairways shall have handrails on each side, landings of length equal to the stair width at the bottom and at not greater than 12-foot vertical intervals, minimum 7-foot headroom.  '),
(112, 'GW.100.50', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.T.2, Page 11', 1, 100, 1, 0, 'Emergency exit discharge shall be to a point of safety as defined herein, through an opening with a minimum width of 44 inches and a minimum height of 80 inches. The exit shall be a vertical exit door in a surface kiosk or an adjacent building. Such a door shall be equipped with panic hardware on the emergency exit side and shall have a minimum fire rating of 1-1/2 hours, as defined in NFPA 80. The door shall be arranged to open in the direction of egress and equipped with a door closer. Entrance from the outside shall be provided by key, and be designed to prevent public access, while still allowing unobstructed emergency exit.  '),
(113, 'GW.100.51', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.T.3, Page 11', 1, 100, 1, 0, 'Emergency exit doors shall be equiped alarms which will notify Central Control when door is opened.B1005'),
(114, 'GW.100.52', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.T.4, Page 12', 1, 100, 1, 0, 'Emergency lighting and exit signs shall meet the applicable requirements of Criteria/ELECTRICAL/Stations and Wayside Systems Structures'),
(115, 'GW.100.53', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.T.5, Page 12', 1, 100, 1, 0, 'Communications systems shall meet the applicable requirements of Criteria/ELECTRONICS/Telephone Systems.'),
(116, 'GW.100.54', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.T.6, Page 12', 1, 100, 1, 0, 'Access security shall meet the applicable requirements of Criteria/ARCHITECTURE/Facilities Security'),
(117, 'GW.100.55', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.1.U, Page 12', 1, 100, 1, 0, 'Wherever walkways or access roads run along storage or transfer tracks where the third rail is located on the opposite of the track, personnel shall be protected from exposed third rail collector shoes by a coverboard and bracket without a third rail (known as a dummy coverboard) or other separating barrier along the side of track adjacent to the walkway, cartway, or access road.'),
(118, 'GW.100.56', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.2.A, Page 12', 1, 100, 1, 0, 'Aerial Structure. Except at turnouts, walkways on aerial structures shall be level with top of adjacent rail.'),
(119, 'GW.100.57', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.2.B, Page 12', 1, 100, 1, 0, 'At locations of superelevated trackway and where the walkways are situated between two trackways, walkways shall be level with the top of the higher of the running rails which are nearest to the walkway.'),
(120, 'GW.100.58', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.2.C.1-3', 1, 100, 1, 0, 'Walkways along the outer edge of the aerial structure shall be protected by a continuous pipe railing or barrier a minimum of 4 feet high measured from top of walkway.  Railing or barrier shall be located along the side of the walkway furthest from track.\n- A continuous kick plate, a minimum of 4 inch tall, measured from the top of the walkway surface, located on the same side of the pipe railing or barrier.\n-  If continuous pipe railing is used, an intermediate railing shall be provided at 2 foot intervals measured from the top of the walkway surface.  \n-  If continuous barrier is used, a handrail shall be provided. \n'),
(121, 'GW.100.59', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.2.D, Page 12', 1, 100, 1, 0, 'Emergency Access to Aerial Trackways: In accordance with NFPA 130, Section 3-4.5, access to the train way shall be from stations or by mobile ladder equipment from roadways. If no adjacent or crossing roadways exist, access roads at maximum 2,500-foot intervals shall be provided. '),
(122, 'GW.100.60', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.3.A, Page 13', 1, 100, 1, 0, 'Retained Fill and At-Grade. Continuous safety walkway(s) shall be provided along one side of each single trackway within a retained fill or at-grade section.'),
(123, 'GW.100.61', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.3.B, Page 13', 1, 100, 1, 0, 'Walkways shall be level with the top of ballast, top of tie, or at the toe of ballast slope, on the track bed surface.'),
(124, 'GW.100.62', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.3.C, Page 13', 1, 100, 1, 0, 'Single walkways may be located between trackways in a two-track section and serve both trackways.'),
(125, 'GW.100.63', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.3.D, Page 13', 1, 100, 1, 0, 'Walkways shall not be paved unless they also serve as train operator walkways.'),
(126, 'GW.100.64', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.4.A.1-3, Page 13', 1, 100, 1, 0, 'Retained Cut. Retained cut trainways are defined as trainways having at least one of its vertical walls exceeding 5 feet in height measured from the top of rail. Safety walkways and continuous handrails as defined in \"Underground Trackways\" herein shall be provided.  At Retained Cuts, emergency exits shall be provided as follows:\r\n1. If the cut exceeds 2,000 feet in length, emergency exit shall be provided at intervals not to exceed 1,000 feet.\r\n2.  If the length of the cut is between 1,000 feet to 2,000 feet, emergency exit shall be provided approximately mid-way along the length of the cut.\r\n3. If the cut is less than 1,000 feet in length an emergency exit is not required.\r\n'),
(127, 'GW.100.65', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.6.A, Page 15', 1, 100, 1, 0, 'Yards and End-of-Line Storage Tracks. Yard and at-grade end-of-line storage tracks shall have a non-public service and emergency access road.  The road shall comply with requirements for access roads in accordance with Article entitled \"Access to BART Facilities\", herein.  Access roads shall connect to public roadways.'),
(128, 'GW.100.66', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.6.B, Page 15', 1, 100, 1, 0, 'Aerial and subway end-of-line storage tracks shall have a non-public access road or cartway that allows access and egress of carts to and from adjacent public roadways or other BART facilities. \n'),
(129, 'GW.100.67', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.6.D, Page 16', 1, 100, 1, 0, 'End-of-Line Walkway:  Wherever it is determined by the District that cartways are not required along end-of-line storage tracks, a 2 feet six inches wide lighted and paved walkway, level with the top of tie, shall be provided for accessibility to each end-of-line storage track.  A single walkway between tracks is preferred.'),
(130, 'GW.100.68', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.7.B.1-3, Page 17', 1, 100, 1, 0, 'Stations. Walkways at End of Station Platform: \n1. Walkways shall be brought to the bottom of rail elevation at each end of a station platform. \n2. The walkways shall provide access to the underside of vehicles and the refuge space below the platform, with a 10-car revenue track berthed at the platform.\n3. The length of the lower walkway , not including ramps or stairs , shall be 70 feet. '),
(131, 'GW.100.69', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.8.A, Page 17', 1, 100, 1, 0, 'Interlockings and Special Trackwork. Walkway continuity shall be maintained at and through interlockings and special trackwork sections and shall be located opposite the track from switch machines. Maintenance access walkways at and through interlockings and special trackwork sections may be the same walkway as provided for emergency egress as long as maintenance access walkway complies with the requirements of NFPA 130.  (For information on Interlockings refer to Facility Design, Criteria, ELECTRONICS, Automatic Train Control System.)   '),
(132, 'GW.100.70', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.9.A, Page 19', 1, 100, 1, 0, 'Hi-Rail Vehicle Access Points. Hi-rail vehicle access points shall be at least 60 feet in length.'),
(133, 'GW.100.71', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.9.B, Page 19', 1, 100, 1, 0, 'Hi-rail vehicle access points shall meet all of the requirements for crosswalks.'),
(134, 'GW.100.72', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.9.C, Page 19', 1, 100, 1, 0, 'A paved roadway, level with the top of rail, extending the entire length of the access point, shall be provided between all tracks at hi-rail vehicle access locations.'),
(135, 'GW.100.73', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '6.9.G.1, Page 19', 1, 100, 1, 0, 'Access Roads. Access to and from at-grade hi-rail vehicle access points shall be from public streets, BART parking lots, Yards, or access roads'),
(136, 'GW.100.74', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '7.C, Page 23', 1, 100, 1, 0, 'ACCESS TO BART FACILITIES. Access roads shall have a minimum width of 20 feet, and curves shall have a minimum outside radius of 60 feet.  \n'),
(137, 'GW.100.75', 'C-700 Civil Design Criteira', '7.E, Page 3', 1, 100, 1, 0, 'Pump Station areas adjacent to non-VTA rght-of-way (ROW) shall be prptected y BFS maximum security fencing and shall comply with the requirements stated herein.  Personnel/equipment access gates shall be located to provide egress from the top of the stairs at the pump station to the public ROW.  Personnel/equipment acccess gates shall be equipped with panic hardware and shall be tamper proof such that the door may not be opened from the outside.'),
(138, 'GW.100.76', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '8.A, Page 23', 1, 100, 1, 0, 'UNDERGROUND TRAINWAY PROTECTION AGAINST HAZARDOUS SUBSTANCE INTRUSION. Underground trainway protection against intrusion of Class I flammable or Class II and Class III combustible liquids shall be in accordance with NFPA 130, Section 3?2.8.  '),
(139, 'GW.100.77', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '8.B, Page 23', 1, 100, 1, 0, 'Existing underground hazardous substance storage tanks located in or under buildings which are directly above a subsurface transit structure, or within 25 feet (measured horizontally) from the outside wall of the subsurface transit structure, shall be removed or abandoned in accordance with the requirements of CCR, Title 23, Chapter 3, Subchapter 16.'),
(140, 'GW.100.78', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '9, Page 23', 1, 100, 1, 0, 'FLOOD CONTROL AND EVACUATION UNDER FLOOD CONDITIONS. Underground trainways shall be protected from flooding.  Where natural gravity drainage is inadequate, sump pumps shall be used.  The holding capacity of the sump pits and sump pump flow rate shall be sufficient to permit adequate evacuation time from credible, worst case water incursion rates.  '),
(141, 'GW.100.79', 'Facility Design Criteria, 3.2\nCivil - \nBasic Design Policies', '9.B, Page 24', 1, 100, 1, 0, 'Suitable berms or other positive flow control means shall be provided to protect subway portal inclines from flooding by flow from adjacent surrounding surface areas.  Historic records of flooding and predictions of flood occurrence shall be consulted.  ');

-- --------------------------------------------------------

--
-- Table structure for table `secQ`
--

CREATE TABLE `secQ` (
  `SecQID` int(11) NOT NULL,
  `secQ` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secQ`
--

INSERT INTO `secQ` (`SecQID`, `secQ`) VALUES
(1, 'What is your mother\'s maiden name?'),
(2, 'What city were you born in?'),
(3, 'What is your favorite color?'),
(4, 'Which year did you graduate from High School?'),
(5, 'What was the name of your first boyfriend/girlfriend?'),
(6, 'What was your first make of car?');

-- --------------------------------------------------------

--
-- Table structure for table `Severity`
--

CREATE TABLE `Severity` (
  `SeverityID` int(11) NOT NULL,
  `SeverityName` varchar(12) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  `Prority` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Severity`
--

INSERT INTO `Severity` (`SeverityID`, `SeverityName`, `Description`, `Update_TS`, `Updated_by`, `Prority`) VALUES
(1, 'Critical', 'A deficiency that allows an unsafe situation to remain, or that prohibits the progress of 2 or more other systems, or that has a significant effect on cost and/or schedule.', '2018-03-06 16:44:34', 'rburns', 0),
(2, 'Major', 'A deficiency that prohibits the system or equipment from functionally operating as designed or intended.', '2018-03-05 18:40:27', 'rburns', 0),
(3, 'Minor', 'A deficiency that does not affect the designed or intended operation of a piece of equipment.  Normally used for cosmetic damage, or some labeling issues where there is no safety issue.', '2018-03-06 03:28:45', 'rburns', 0),
(4, 'Blocker', 'The project cannot move forward while this deficiency is unresolved.', '2018-03-06 17:06:12', 'rburns', 0);

-- --------------------------------------------------------

--
-- Table structure for table `Specs`
--

CREATE TABLE `Specs` (
  `SpecID` int(11) NOT NULL,
  `SpecCode` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Status`
--

CREATE TABLE `Status` (
  `StatusID` int(11) NOT NULL,
  `Status` varchar(10) DEFAULT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Status`
--

INSERT INTO `Status` (`StatusID`, `Status`, `Update_TS`, `Updated_by`) VALUES
(1, 'Open', '2018-03-05 03:57:05', 'rburns'),
(2, 'Closed', '2018-03-05 04:43:55', 'rburns'),
(3, 'Deleted', '2018-03-06 20:55:41', 'rburns');

-- --------------------------------------------------------

--
-- Table structure for table `System`
--

CREATE TABLE `System` (
  `SystemID` int(11) NOT NULL,
  `System` varchar(55) NOT NULL,
  `Update_TS` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  `Lead` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `System`
--

INSERT INTO `System` (`SystemID`, `System`, `Update_TS`, `Updated_by`, `Lead`) VALUES
(1, 'Electrical', '2018-03-06 01:33:08', 'rburns', 0),
(2, 'Mechanical', '2018-03-06 01:33:12', 'rburns', 0),
(3, 'SCADA', '2018-03-06 01:33:16', 'rburns', 0),
(4, 'Fire Protection', '2018-03-06 01:33:10', 'rburns', 0),
(5, 'Architectural', '2018-03-06 01:33:01', 'rburns', 0),
(6, 'Civil', '2018-03-06 01:33:04', 'rburns', 0),
(7, 'Structural', '2018-03-06 01:33:18', 'rburns', 0),
(8, 'Communications', '2018-03-06 01:33:06', 'rburns', 0),
(9, 'Public Address', '2018-03-06 01:33:14', 'rburns', 0),
(10, 'Conveying', '2018-03-06 16:55:30', 'rburns', 0),
(11, 'Construction', '2018-03-06 16:57:24', 'rburns', 0),
(12, 'Fans', '2018-03-22 20:40:32', 'rburns', 0),
(13, 'Plumbing', '2018-03-06 16:59:14', 'rburns', 0),
(14, 'Traction Power', '2018-03-13 16:05:26', 'rburns', 0),
(15, 'Train Control', '2018-03-13 16:05:41', 'rburns', 0),
(16, 'Automatic Train Control', '2018-03-22 20:40:58', 'rburns', 0),
(17, 'Design', '2018-03-14 23:04:13', 'rburns', 0),
(18, 'CCTV', '2018-03-21 20:49:20', 'rburns', 0),
(19, 'Access Control System', '2018-03-22 22:31:30', 'rburns', 0),
(20, 'VMS', '2018-03-21 20:49:38', 'rburns', 0),
(21, 'Digital Signage', '2018-03-22 22:32:06', 'rburns', 0),
(22, 'Management', '2018-03-21 21:02:56', 'rburns', 0),
(23, 'Telephones', '2018-03-22 20:35:39', 'rburns', 0),
(24, 'Pumps', '2018-03-22 20:35:53', 'rburns', 0),
(25, 'Automated Fare Collection', '2018-03-22 20:36:28', 'rburns', 0),
(26, 'Rail Intrusion Detection System (RIDS)', '2018-03-22 22:33:16', 'rburns', 0),
(27, 'Networks', '2018-03-22 20:38:15', 'rburns', 0),
(28, 'Radio', '2018-03-22 20:41:23', 'rburns', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_enc`
--

CREATE TABLE `users_enc` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(25) NOT NULL,
  `Role` varchar(10) NOT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `firstname` varchar(25) DEFAULT NULL,
  `lastname` varchar(25) DEFAULT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `Updated_by` varchar(25) DEFAULT NULL,
  `DateAdded` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Created_by` varchar(25) DEFAULT NULL,
  `Email` varchar(55) DEFAULT NULL,
  `secQ` tinyint(4) NOT NULL DEFAULT '0',
  `secA` varchar(32) NOT NULL,
  `LastLogin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `Company` varchar(255) NOT NULL,
  `viewIDR` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_enc`
--

INSERT INTO `users_enc` (`UserID`, `Username`, `Role`, `Password`, `firstname`, `lastname`, `LastUpdated`, `Updated_by`, `DateAdded`, `Created_by`, `Email`, `secQ`, `secA`, `LastLogin`, `Company`, `viewIDR`) VALUES
(1, 'rburns', 'S', '$2y$10$ZWVlMGM3NWUyZmUxZWVmZOLNRoZkKU4h4P3aoRuWWcgOVr7.a5EPq', 'Robert', 'Burns', '2018-04-30 15:54:21', 'rburns', '2018-03-09 19:48:51', 'rburns1', 'robert.burns@vta.org', 6, 'metro', '2018-04-30 15:54:21', 'Bechtel', b'1'),
(19, 'JBayat', 'V', '$2y$10$nmf5cAbKaXphXekRsNdxReNxpVyJuujxQJ9Xe6tMpwyoAxpnOL5aO', 'Joe', 'Bayat', '2018-03-14 22:36:37', NULL, '2018-03-14 22:36:37', 'rburns', 'joseph.bayat@vta.org', 0, '', '0000-00-00 00:00:00', 'MottMacDonald', b'0'),
(20, 'jengstrom', 'V', '$2y$10$ceRVBKJYV13yXKpPnR7l6ObIyNpYwmKLg8IL64mVaK07vVnBuywAm', 'John', 'Engstrom', '2018-04-30 14:49:06', 'jengstrom', '2018-03-14 22:40:10', 'rburns', 'john.engstrom@vta.org', 2, 'Chehalis', '2018-04-30 14:48:46', 'Bechtel', b'0'),
(22, 'rjacobs', 'V', '$2y$10$27OHQrqkqcUoBTAkyWnwauogrRLRpw9iVry7oNZp389HgfUZZS/Za', 'Robert', 'Jacobs', '2018-03-16 12:42:43', NULL, '2018-03-16 12:42:43', 'rburns', 'robert.jacobs@vta.org', 0, '', '0000-00-00 00:00:00', 'Bechtel', b'0'),
(23, 'fmarten', 'U', '$2y$10$su6XVgQfvrtIT/i.afTKF.DUYYE3MfS.SD4B8Ewn7T5Fsiv6Ssnvi', 'Felix', 'Marten', '2018-03-16 12:50:11', 'rburns', '2018-03-16 12:45:33', 'rburns', 'felix.marten@vta.org', 0, '', '0000-00-00 00:00:00', 'VTA', b'0'),
(24, 'afauria', 'U', '$2y$10$eleWI8HBDv3Svh5BxZetmudymk19j0WpXQ4RipK31XqjEZDB8VcLe', 'Amy', 'Fauria', '2018-04-27 21:02:30', 'afauria', '2018-03-16 12:53:20', 'rburns', 'amy.fauria@vta.org', 6, 'Datsun', '2018-04-27 21:02:02', 'VTA', b'0'),
(25, 'mrobertson', 'U', '$2y$10$Mcxduux2QVY3CdzIpF8Zp.PgaN19fX/ek90J0UYmuZzqLmuZjv1Ha', 'Michael', 'Robertson', '2018-04-02 23:08:09', 'mrobertson', '2018-03-16 12:55:59', 'rburns', 'michael.robertson@vta.org', 4, '1967', '2018-04-02 23:08:09', 'VTA', b'0'),
(26, 'kaboud', 'U', '$2y$10$PG5sWTwn6jsu/jpACZz1YezW7ZxyvXzqdvVcb7fKT/wwA6Z.qa1y2', 'Karim', 'Aboud', '2018-04-24 21:45:40', 'kaboud', '2018-03-16 12:57:11', 'rburns', 'karim.aboud@vta.org', 3, 'orange', '2018-04-24 21:45:40', 'VTA', b'0'),
(27, 'jvukasin', 'V', '$2y$10$VM6vaHqrpfn90uVhZv36ZOzhctREgH7UPhyIDbJ/Er0LkxuZQ57EC', 'John', 'Vukasin', '2018-04-27 21:58:58', 'jvukasin', '2018-03-16 12:58:54', 'rburns', 'john.vukasin@vta.org', 6, 'Cuda', '2018-04-27 21:58:58', 'Bechtel', b'0'),
(28, 'npappas', 'U', '$2y$10$q7u81qAPefSOhuzQD3SY2e5RWVZ/D2iyVM3Snt9lvU0C5gSs4/opq', 'Nicholas', 'Pappas', '2018-03-16 13:01:45', 'rburns', '2018-03-16 13:00:34', 'rburns', 'nicholas.pappas@vta.org', 0, '', '0000-00-00 00:00:00', 'VTA', b'0'),
(29, 'bryanlamoreaux', 'U', '$2y$10$3O/yERUtwWEpCJvfDSQbh.bKGcY4ar1lE76DdNswx6pQd4u18aHUu', 'Bryan', 'Lamoreaux', '2018-04-05 20:19:04', 'bryanlamoreaux', '2018-03-16 13:04:23', 'rburns', 'bryan.lamoreaux@vta.org', 1, 'stults', '2018-04-05 20:19:04', 'Lamoreaux', b'0'),
(30, 'lmahroom', 'V', '$2y$10$I53ve8EUgqXHsxiHTj4fyeN1d5ONWfrFCP6HhTI6h0j8niG9ENmL2', 'Laila', 'Mahroom', '2018-03-16 13:07:33', NULL, '2018-03-16 13:07:33', 'rburns', 'laila.mahroom@vta.org', 0, '', '0000-00-00 00:00:00', 'BART', b'0'),
(31, 'mtagoeguzman', 'V', '$2y$10$R5nBnSqKssEfvScgp6dzte8APzp/iiCW3KPQ9D2mAtf2kpGXpbLwu', 'M\'balia', 'Tagoe-Guzman', '2018-03-16 13:18:39', NULL, '2018-03-16 13:15:22', 'rburns', 'M\'balia.Tagoe-Guzman@vta.org', 0, '', '0000-00-00 00:00:00', 'Bechtel', b'0'),
(32, 'demo', 'V', '$2y$10$LH.FYR6tg6.at8yzUVaOu.PzfmkAWYZL.PtVmsvLj5K3mev2llEjS', 'Demo', 'Demo', '2018-04-23 19:49:11', 'rburns', '2018-03-16 17:59:51', 'rburns', 'Demo@demo.com', 2, 'plymouth', '2018-04-23 19:49:11', 'Demonstration', b'0'),
(33, 'thimraj', 'V', '$2y$10$ceseUH.QMHADZqV8EF3dnOlclv1.RKdsffx1vxUmow.J/3oB2DtFm', 'Tony', 'Himraj', '2018-04-05 21:03:41', 'thimraj', '2018-03-19 13:34:42', 'rburns', 'tony.himraj@vta.org', 1, 'Seereeram', '2018-04-05 21:02:05', 'Bechtel', b'0'),
(34, 'aflores', 'U', '$2y$10$x5EwpLu1jVO1lrc/UzJNh.T2tcpQna8iozjNn1Olkvk1Upq8YSxCu', 'Adrian', 'Flores', '2018-04-02 22:57:35', 'aflores', '2018-03-22 17:10:50', 'rburns', 'adrian.flores@vta.org', 1, 'Sanchez', '2018-04-02 22:57:14', 'VTA', b'0'),
(35, 'ttran', 'U', '$2y$10$xNR/XZWnqjfpHuWfLEFESeTKGnIoA4OgeGPee2MDiYZn3JWBEUCie', 'Tommy', 'Tran', '2018-03-22 20:28:39', 'rburns', '2018-03-22 20:25:15', 'rburns', 'thomas.tran@vta.org', 0, '', '0000-00-00 00:00:00', 'VTA', b'0'),
(36, 'msanchez', 'U', '$2y$10$BWPgJLo3rL/Z2e9YolPj0.67W4OTULSTKLam8LK.yT2ZoInAgZN8S', 'Miguel', 'Sanchez', '2018-03-22 20:28:47', 'rburns', '2018-03-22 20:28:16', 'rburns', 'miguel.sanchez@vta.org', 0, '', '0000-00-00 00:00:00', 'VTA', b'0'),
(37, 'wblake', 'U', '$2y$10$fIPCMRD5suo8Gm2rIH1s6OrQRR8AKrwfWUx7.ppcIW2NCtamTHbWu', 'Wayne', 'Blake', '2018-04-26 18:23:05', 'wblake', '2018-03-22 20:29:40', 'rburns', 'wayne.blake@vta.org', 2, 'Lansing', '2018-04-26 18:23:05', 'VTA', b'0'),
(38, 'mevans', 'U', '$2y$10$J.JFV9CmRoSHRXINLRvuOeNCWk3iX30W6snVzZWGyoOoCencynVGm', 'Mark', 'Evans', '2018-03-22 20:31:33', 'rburns', '2018-03-22 20:31:17', 'rburns', 'mark.evans@vta.org', 0, '', '0000-00-00 00:00:00', 'VTA', b'0'),
(39, 'svandevanter', 'U', '$2y$10$koGX9ucmSZgtFS3vFmWiOeAxee0u.Qxucdh/2r04GDnN8jcoIQeyu', 'Saxon', 'VanDeVanter', '2018-04-27 17:24:13', 'svandevanter', '2018-03-22 20:33:30', 'rburns', 'saxon.vandevanter@vta.org', 2, 'Milford', '2018-04-27 17:24:13', 'VTA', b'1'),
(40, 'kleavitt', 'U', '$2y$10$WDoK4nEgZKBF01nn1PqNgeDIH7/MheDAPJ1j/Ve2OJJpLwLO9JprG', 'Kaden', 'Leavitt', '2018-03-22 23:57:53', 'kleavitt', '2018-03-22 22:37:05', 'rburns', 'kaden.leavitt@vta.org', 4, '2005', '2018-03-22 23:57:37', 'VTA', b'0'),
(41, 'rmurphy', 'U', '$2y$10$cyRicPGx6fIVH2HZ2dc2Veo3BezZBw.2ILSJzw2yZBboh2k/5DkLS', 'Robert', 'Murphy', '2018-03-22 23:44:54', 'rburns', '2018-03-22 22:49:29', 'rburns', 'robert.murphy@vta.org', 0, '', '0000-00-00 00:00:00', 'VTA', b'0'),
(42, 'ckingbailey', 'S', '$2y$10$i/Zear7QMa9ELSVo3KNgl.2BRN9PMhRCD11YLdhF.HfbOHHhvoIeK', 'Colin', 'King-Bailey', '2018-05-01 17:43:19', 'ckingbailey', '2018-03-26 16:35:13', 'rburns', 'colin.king-bailey@vta.org', 1, 'King', '2018-05-01 17:43:19', 'VTA', b'1'),
(43, 'sgonzales', 'U', '$2y$10$C6v8UNrVslKjbiEmjxbz9OHfoj5ZQ9HgpCgZu.WYC5K/eJm6/Vydi', 'Shannon', 'Gonzales', '2018-03-27 18:55:50', 'rburns', '2018-03-27 18:54:40', 'rburns', 'Shannon.Gonzales@vta.org', 0, '', '0000-00-00 00:00:00', 'VTA', b'0'),
(44, 'jgeyer', 'V', '$2y$10$T2kwGM69DUpfo8wu/pyYQ.WjTvnrNy/SZLpqJm6OMV0SXTea9R3Hy', 'Jacob', 'Geyer', '2018-04-30 16:19:28', 'jgeyer', '2018-03-28 15:10:29', 'rburns', 'jacob.geyer@vta.org', 1, 'Hurni', '2018-04-30 16:19:28', 'VTA', b'0'),
(45, 'bdixon', 'V', '$2y$10$vUiynS0BEvDS3YucOcuFHOmd.s5TBtsZTw8pqpBTqVAdk8fq1SGY6', 'Brigid', 'Dixon', '2018-04-24 21:42:43', 'bdixon', '2018-03-28 15:11:20', 'rburns', 'brigid.dixon@vta.org', 1, 'vail', '2018-04-24 21:42:43', 'VTA', b'0'),
(46, 'cpotts', 'V', '$2y$10$KQ6YxJVZevfls8KNhWRebedPq5CoCsxEqn6E/JLhLZEU.4Lvs2ut.', 'Carlyle', 'Potts', '2018-03-30 17:54:31', 'cpotts', '2018-03-29 23:36:52', 'rburns', 'cpotts@bart.gov', 4, '1977', '2018-03-30 17:54:31', 'BART', b'0'),
(47, 'fantar', 'U', '$2y$10$bwyXPnJ8RdfMfMEgt/U.UuIpRS7VM.O4gDlTrg.m0zhxfDFE.5wV6', 'Faissal', 'Antar', '2018-04-06 19:16:51', 'fantar', '2018-04-02 23:40:45', 'ckingbailey', 'faissal.antar@vta.org', 2, 'Freetown', '2018-04-06 19:16:51', 'VTA', b'0'),
(48, 'rlopez', 'A', '$2y$10$2Uurc8mWm6JE/AoqentW..lpUuck7LxTk4wkiDiTc2Gt4UUklHTgK', 'Rosalinda', 'Lopez', '2018-04-26 17:55:01', 'rlopez', '2018-04-26 17:40:58', 'ckingbailey', 'rosalinda.lopez@vta.org', 1, 'dagnino', '2018-04-26 17:52:29', 'Lamoreaux', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `YesNo`
--

CREATE TABLE `YesNo` (
  `YesNoID` int(11) NOT NULL,
  `YesNo` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `YesNo`
--

INSERT INTO `YesNo` (`YesNoID`, `YesNo`) VALUES
(1, 'Yes'),
(2, 'No');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activityID`);

--
-- Indexes for table `Build`
--
ALTER TABLE `Build`
  ADD PRIMARY KEY (`BuildID`);

--
-- Indexes for table `CDL`
--
ALTER TABLE `CDL`
  ADD PRIMARY KEY (`DefID`);

--
-- Indexes for table `CertifiableElement`
--
ALTER TABLE `CertifiableElement`
  ADD PRIMARY KEY (`CE_ID`),
  ADD UNIQUE KEY `CertifiableElement` (`CertifiableElement`);

--
-- Indexes for table `Contract`
--
ALTER TABLE `Contract`
  ADD PRIMARY KEY (`ContractID`),
  ADD UNIQUE KEY `Contract` (`Contract`);

--
-- Indexes for table `ElementGroup`
--
ALTER TABLE `ElementGroup`
  ADD PRIMARY KEY (`EG_ID`),
  ADD UNIQUE KEY `ElementGroup` (`ElementGroup`);

--
-- Indexes for table `equipAct_link`
--
ALTER TABLE `equipAct_link`
  ADD PRIMARY KEY (`equipActID`);

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipID`);

--
-- Indexes for table `EvidenceType`
--
ALTER TABLE `EvidenceType`
  ADD PRIMARY KEY (`EviTypeID`);

--
-- Indexes for table `IDR`
--
ALTER TABLE `IDR`
  ADD PRIMARY KEY (`idrID`);

--
-- Indexes for table `idrComments`
--
ALTER TABLE `idrComments`
  ADD PRIMARY KEY (`idrCommentID`);

--
-- Indexes for table `labor`
--
ALTER TABLE `labor`
  ADD PRIMARY KEY (`laborID`);

--
-- Indexes for table `laborAct_link`
--
ALTER TABLE `laborAct_link`
  ADD PRIMARY KEY (`laborActID`);

--
-- Indexes for table `Location`
--
ALTER TABLE `Location`
  ADD PRIMARY KEY (`LocationID`);

--
-- Indexes for table `Pictures`
--
ALTER TABLE `Pictures`
  ADD PRIMARY KEY (`PicID`),
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Indexes for table `recoveryemails_enc`
--
ALTER TABLE `recoveryemails_enc`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Repo`
--
ALTER TABLE `Repo`
  ADD PRIMARY KEY (`RepoID`);

--
-- Indexes for table `RequiredBy`
--
ALTER TABLE `RequiredBy`
  ADD PRIMARY KEY (`ReqByID`);

--
-- Indexes for table `SafetyCert`
--
ALTER TABLE `SafetyCert`
  ADD PRIMARY KEY (`CertID`),
  ADD UNIQUE KEY `Item` (`Item`);

--
-- Indexes for table `secQ`
--
ALTER TABLE `secQ`
  ADD PRIMARY KEY (`SecQID`);

--
-- Indexes for table `Severity`
--
ALTER TABLE `Severity`
  ADD PRIMARY KEY (`SeverityID`);

--
-- Indexes for table `Specs`
--
ALTER TABLE `Specs`
  ADD PRIMARY KEY (`SpecID`);

--
-- Indexes for table `Status`
--
ALTER TABLE `Status`
  ADD PRIMARY KEY (`StatusID`);

--
-- Indexes for table `System`
--
ALTER TABLE `System`
  ADD PRIMARY KEY (`SystemID`);

--
-- Indexes for table `users_enc`
--
ALTER TABLE `users_enc`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `YesNo`
--
ALTER TABLE `YesNo`
  ADD PRIMARY KEY (`YesNoID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activityID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `Build`
--
ALTER TABLE `Build`
  MODIFY `BuildID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `CDL`
--
ALTER TABLE `CDL`
  MODIFY `DefID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=658;

--
-- AUTO_INCREMENT for table `CertifiableElement`
--
ALTER TABLE `CertifiableElement`
  MODIFY `CE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Contract`
--
ALTER TABLE `Contract`
  MODIFY `ContractID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ElementGroup`
--
ALTER TABLE `ElementGroup`
  MODIFY `EG_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipAct_link`
--
ALTER TABLE `equipAct_link`
  MODIFY `equipActID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `EvidenceType`
--
ALTER TABLE `EvidenceType`
  MODIFY `EviTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `IDR`
--
ALTER TABLE `IDR`
  MODIFY `idrID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `idrComments`
--
ALTER TABLE `idrComments`
  MODIFY `idrCommentID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `labor`
--
ALTER TABLE `labor`
  MODIFY `laborID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `laborAct_link`
--
ALTER TABLE `laborAct_link`
  MODIFY `laborActID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Location`
--
ALTER TABLE `Location`
  MODIFY `LocationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `Pictures`
--
ALTER TABLE `Pictures`
  MODIFY `PicID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recoveryemails_enc`
--
ALTER TABLE `recoveryemails_enc`
  MODIFY `ID` bigint(20) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `Repo`
--
ALTER TABLE `Repo`
  MODIFY `RepoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `RequiredBy`
--
ALTER TABLE `RequiredBy`
  MODIFY `ReqByID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `SafetyCert`
--
ALTER TABLE `SafetyCert`
  MODIFY `CertID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT for table `secQ`
--
ALTER TABLE `secQ`
  MODIFY `SecQID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `Severity`
--
ALTER TABLE `Severity`
  MODIFY `SeverityID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Specs`
--
ALTER TABLE `Specs`
  MODIFY `SpecID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Status`
--
ALTER TABLE `Status`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `System`
--
ALTER TABLE `System`
  MODIFY `SystemID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users_enc`
--
ALTER TABLE `users_enc`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `YesNo`
--
ALTER TABLE `YesNo`
  MODIFY `YesNoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
