-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2023 at 05:40 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nurse_edo`
--

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `p_id` int(11) NOT NULL,
  `p_no` int(11) NOT NULL,
  `p_tex` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `p_name_TH` text COLLATE utf8_unicode_ci NOT NULL,
  `p_slogan_TH` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สโลแกน',
  `p_description_TH` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'คำอธิบาย',
  `p_objective_TH` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'วัตถุประสงค์',
  `p_name_EN` text COLLATE utf8_unicode_ci NOT NULL,
  `p_slogan_EN` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'สโลแกน',
  `p_description_EN` mediumtext COLLATE utf8_unicode_ci NOT NULL COMMENT 'คำอธิบาย',
  `p_objective_EN` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'วัตถุประสงค์'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`p_id`, `p_no`, `p_tex`, `p_name_TH`, `p_slogan_TH`, `p_description_TH`, `p_objective_TH`, `p_name_EN`, `p_slogan_EN`, `p_description_EN`, `p_objective_EN`) VALUES
(1, 5, 'ลดหย่อนภาษี 2 เท่า  ', 'โครงการทุนการศึกษาเพื่อนักศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ ', 'สร้างโอกาสการศึกษา สร้างพยาบาลในอนาคต', 'คณะพยาบาลศาสตร์ มช. เป็นสถาบันการศึกษาพยาบาลที่ผลิตบัณฑิตพยาบาล ที่เป็นกำลังสำคัญในระบบสาธารณสุขของประเทศ แต่ละปีมีนักศึกษาที่อยู่ระหว่างการศึกษาทุกระดับมากกว่า 1,500 คน คณะฯ ตระหนักถึงความสำคัญของการให้โอกาสทางการศึกษา และมุ่งหวังที่จะสนับสนุนและส่งเสริมให้นักศึกษาได้มีโอกาสเรียนรู้จนสำเร็จการศึกษาภายในระยะเวลาที่กำหนดไว้ในหลักสูตร โครงการนี้จัดตั้งขึ้นเพื่อมอบทุนการศึกษาแก่นักศึกษาพยาบาลทุกระดับที่ขาดแคลน\r\nทุนทรัพย์ ให้สามารถจ่ายค่าธรรมเนียมการศึกษา ค่าที่พักอาศัย และค่าใช้จ่ายในการดำรงชีพ ซึ่งจะช่วยให้นักศึกษาได้ใช้เวลาในการศึกษาเล่าเรียนอย่างเต็มศักยภาพ รวมทั้งเป็นรางวัลสำหรับนักศึกษาผู้ที่มีผลการเรียนและผลการฝึกปฏิบัติยอดเยี่ยม  ดังนั้นเมื่อสำเร็จการศึกษา นักศึกษาจะได้นำความรู้และทักษะทางการพยาบาลมาช่วยเหลือดูแลผู้ป่วย ครอบครัว และสังคมต่อไป\r\n', 'เพื่อมอบเป็นทุนการศึกษาสำหรับนักศึกษาพยาบาล มช. ที่ขาดแคลนทุนทรัพย์,\r\nเพื่อมอบเป็นรางวัลสำหรับนักศึกษาพยาบาล มช. มีผลการเรียนดีเยี่ยมและมีความประพฤติดี\r\n', 'Financial Aid & Scholarships for Nursing Students', 'Creating Equal Opportunities and Empowering Future Nurses ', 'NurseCMU was built on the foundation of producing nurses who comprise the largest segment of Thailand’s health workforce and contribute to the overall improvement of the Thai health system. We offer degree programs in both Thai and English at the bachelors, master’s, and doctoral levels and have an average of 1,500 students in all programs. NurseCMU recognizes the importance of providing equal educational opportunities, and scholarships, grants, and loans are available to students to help finance their education at NurseCMU. All of our institutional aid is awarded to students with financial need.  This financial support allows students to fully focus on their studies and so they can excel in all areas of their academic life. ', 'To provide financial assistance through grants and scholarships to NurseCMU students with financial need.,\r\nTo reward NurseCMU students for excellent academic achievement and exemplary performance.\r\n'),
(2, 6, 'ลดหย่อนภาษี 2 เท่า  ', 'เพื่อจัดสร้างอาคารและปรับปรุงอาคารเรียน คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'ร่วมกันพัฒนาอาคารเรียน ปรับเปลี่ยนพื้นที่สู่อนาคต', 'คณะพยาบาลศาสตร์ มช. เปิดดำเนินการจัดการเรียนการสอนและได้ผลิตบัณฑิตคณะพยาบาลศาสตร์ ออกไปรับใช้สังคมทั้งไทยและต่างประเทศมามากกว่า 60 ปี ปัจจุบันคณะพยาบาลศาสตร์ มีอาคารเรียนทั้งหมด 4 อาคาร ในการดำเนินการตามพันธกิจของคณะฯ จำเป็นต้องมีการพัฒนาปรับปรุงห้องเรียน อาคารเรียน อาคารสถานที่ และสภาพแวดล้อมภูมิทัศน์อย่างต่อเนื่อง เพื่อให้อาคารสถานที่และสิ่งแวดล้อม สะอาด ร่มรื่น สวยงาม ปลอดภัย และมีบรรยากาศเอื้ออำนวยต่อการเรียนการสอนของอาจารย์ นักศึกษา บุคลากร และผู้รับบริการทุกกลุ่มมีความพึงพอใจ ', 'เพื่อจัดสร้าง ปรับปรุง พัฒนา อาคารเรียนและสิ่งแวดล้อมคณะพยาบาลศาสตร์ มช.', 'NurseCMU Facility Improvement and Renovation Initiatives', 'Creating and Modernizing Learning Spaces', 'NurseCMU was established more than 60 years ago and has 4 buildings with dedicated classroom space to help students and scholars serve society through the pursuit of truth and knowledge and the creative use of interdisciplinary approaches and technology. Continuous improvement of classrooms, buildings, and facilities is needed to maintain a clean, beautiful, and safe environment conducive to teaching and learning.', 'To build, improve, and renovate NurseCMU buildings and grounds'),
(3, 6, 'ลดหย่อนภาษี 2 เท่า  ', 'เพื่อจัดหาวัสดุอุปกรณ์การศึกษา คณะพยาบาลศาสตร์ \r\n มหาวิทยาลัยเชียงใหม่', 'มอบอุปกรณ์ทางการศึกษา เพิ่มคุณค่าแห่งการเรียนรู้ ', 'คณะพยาบาลศาสตร์ มช. มียุทธศาสตร์ด้านการศึกษาที่มุ่งมั่นหลอมรวมความเป็นเลิศทางการพยาบาลเข้ากับเทคโนโลยีด้านการศึกษา เพื่อเป็นต้นแบบในการสร้างพยาบาลวิชาชีพที่มีทักษะแห่งศตวรรษที่ 21 ซึ่งพยาบาลเหล่านี้จะกลายเป็นศูนย์กลางการบริการด้านสุขภาพที่ยังคงเชื่อมต่อกับผู้ป่วยและผู้ที่ต้องการความช่วยเหลือด้านสุขภาพกับผู้เชี่ยวชาญด้านการแพทย์สาขาอื่น รวมทั้งเทคโนโลยีทางการแพทย์สมัยใหม่ ดังนั้นคณะฯ จำเป็นต้องจัดหาเทคโนโลยีและอุปกรณ์ทางการศึกษา รวมทั้งครุภัณฑ์เพื่อใช้ในกิจกรรมการเรียนการสอนและการฝึกปฏิบัติของนักศึกษา จัดหาทดแทนวัสดุอุปกรณ์ที่เสื่อมสภาพ หมดอายุ รวมทั้งจัดหาเทคโนโลยีทางการพยาบาลสมัยใหม่ เพื่อสนับสนุนกิจกรรมพัฒนาทักษะทางการพยาบาลแห่งศตวรรษที่ 21 เช่น เครื่องมืออุปกรณ์ในการฝึกทักษะทางการพยาบาลในห้องปฏิบัติการ รวมทั้งสื่อการศึกษา ตำรา สารสนเทศเพื่อสนับสนุนนักศึกษาให้สามารถนำไปใช้ในกิจกรรมการเรียนการสอน และพัฒนาทักษะทางการพยาบาลได้อย่างมีประสิทธิภาพ ', 'เพื่อจัดหาวัสดุอุปกรณ์และครุภัณฑ์สำหรับใช้ในการเรียนการสอนและการฝึกปฏิบัติ,\r\nเพื่อพัฒนาสื่อการเรียนการสอนสำหรับนักศึกษาพยาบาล มช.\r\n', 'Equipment and Materials ', 'Supplying Educational Equipment: Enhancing Learning', 'NurseCMU strives to combine nursing excellence with advanced educational technology and to serve as a model for building 21st-century skilled nurses. Hence, NurseCMU needs to procure and modernize existing equipment used for teaching/learning activities to support the advancement and nurturing of 21st-century nursing skills in students. Equipment includes tools and equipment for practicing nursing skills in the laboratory, educational materials, textbooks, and information to allow students to develop advanced technological nursing skills.', 'To procure learning materials and modernize equipment to improve teaching and learning,\r\nTo develop teaching materials for NurseCMU students\r\n'),
(4, 7, 'ลดหย่อนภาษี 1 เท่า ', 'บริจาคเพื่อผู้ยากไร้และผู้ด้อยโอกาสในสังคม', 'อันความกรุณาปราณี จะมีใครบังคับก็หาไม่ ', 'คณะพยาบาลศาสตร์ มช. เป็นสถาบันการศึกษาพยาบาลที่ผลิตบัณฑิตพยาบาล ที่เป็นกำลังสำคัญในระบบสาธารณสุขของประเทศ ที่ไม่ได้มุ่งหวังแค่การรักษาพยาบาลประชาชนเมื่อเจ็บป่วยเท่านั้น แต่มุ่งหวังให้ประชาชนมีสุขภาวะกายและจิตที่ดี ผ่านกระบวนการสร้างเสริมสุขภาพ ป้องกันโรค รักษาโรค และฟื้นฟูสภาพ คณะฯ ตระหนักถึงความยากลำบาก และความไม่เท่าเทียมกันของประชาชนในกลุ่มและพื้นที่ต่างๆ ที่ยังมีช่องว่างในการเข้าถึงบริการสาธารณสุขขั้นพื้นฐานที่มีคุณภาพ ดังนั้นคณะฯมีความมุ่งมั่นตั้งใจที่จะช่วยเหลือผู้ยากไร้ ผู้ด้อยโอกาสในสังคม ผู้ที่ขาดโอกาสในการเข้าถึงบริการสาธารณสุข ตลอดจนผู้ที่ขาดโอกาสด้านการศึกษาในสังคม โดยการรวบรวมเงินบริจาคเพื่อแบ่งปันเอื้ออาทร ช่วยเหลือซึ่งกันและกัน', 'เพื่อช่วยเหลือผู้ยากไร้ ผู้ด้อยโอกาสในสังคม ผู้ที่ขาดโอกาสในการเข้าถึงบริการสาธารณสุข และผู้ที่ขาดโอกาสด้านการศึกษา,\r\nเพื่อสมทบทุน และสนับสนุนโครงการของหน่วยงาน และองค์กรอื่นๆ ที่ช่วยเหลือผู้ยากไร้และผู้ด้อยโอกาสในสังคม\r\n', 'Reducing Health Inequality', 'Giving Back to Society, Societal Stewardship ', 'NurseCMU believes in giving back to the community and in being a good community partner by providing necessary help and support for those experiencing difficulties in receiving basic health care services and education. Donations are distributed to groups experiencing financial instability and with limited access to health care.', 'To provide financial support for communities with limited access to basic health services and educational opportunities.,\r\nTo provide financial contributions to organizations focused serving and uplifting groups experiencing financial instability.\r\n'),
(5, 7, 'ลดหย่อนภาษี 1 เท่า ', 'บริจาคเพื่อเพื่อนร่วมวิชาชีพพยาบาลที่ประสบภัยจากการปฏิบัติงานในหน้าที่ ', 'เพื่อนไม่ทิ้งกัน ยามเพื่อนมีภัย', 'วิชาชีพพยาบาล มีหน้าที่ให้บริการสังคมในการดูแลสุขภาพและการเจ็บป่วยของประชาชน พยาบาลวิชาชีพในประเทศไทยกว่าหนึ่งแสนสองหมื่นคนทั่วประเทศ มีความเสี่ยงจากการทำงานที่ต้องเผชิญในระหว่างการปฏิบัติงานในหน้าที่ในแต่ละวัน ไม่ว่าจะปฏิบัติงานในหน้าที่อยู่ในสถานบริการสุขภาพ/โรงพยาบาล และระหว่างส่งต่อผู้ป่วย คณะพยาบาลศาสตร์ มช. มีความห่วงใยในสวัสดิภาพและความปลอดภัยของผู้ประกอบวิชาชีพพยาบาลทุกท่าน และประสงค์ร่วมกับสภาการพยาบาลในการสมทบกองทุนช่วยเหลือเบื้องต้นแก่สมาชิกสภาการพยาบาลที่ประสบภัยจากการปฏิบัติงานในหน้าที่', 'เพื่อช่วยเหลือพยาบาลไทยทุกระดับ ที่ประสบภัยจากการปฏิบัติงานในหน้าที่,\r\nเพื่อสมทบทุนกองทุนช่วยเหลือเบื้องต้นแก่สมาชิกสภาการพยาบาลที่ประสบภัยจากการปฏิบัติงานในหน้าที่ ของสภาการพยาบาลแห่งประเทศไทย\r\n', 'Financial Support for Nurses Experiencing Occupational Hazards ', 'Protecting Nurses and the Nursing Profession ', 'NurseCMU has a duty to serve fellow nurses and professionals in health care. There are more than one hundred and twenty thousand registered nurses in Thailand who face work-related risks on a daily basis. NurseCMU feels the welfare and safety of our nursing workforce is of highest importance and would like to make contributions Thailand Nursing and Midwifery Council’s Fund for nurses with workplace injuries.', 'To help Thai nurses with workplace injuries.,\r\nTo contribute to the Thailand Nursing and Midwifery Council Fund to support nurses workplace injuries. \r\n'),
(6, 7, 'ลดหย่อนภาษี 1 เท่า ', 'บริจาคเพื่อสนับสนุนโครงการนักศึกษาพยาบาล มช. ส่งต่อความดีเพื่อสังคม', 'สร้างสะพานบุญ เชื่อมต่อความดี ', 'คณะพยาบาลศาสตร์ มช. มุ่งเน้นให้นักศึกษามีคุณสมบัติในการเป็น CMU smart students ตามแนวทางของมหาวิทยาลัย ทั้ง 6 ด้าน ได้แก่ 1) Smart Heart  2) Smart Health 3) Smart Character 4) Smart English 5) Smart IT และ 6) Smart Brain คณะฯ ตระหนักถึงความสำคัญในการส่งเสริมให้นักศึกษามีคุณลักษณะดังกล่าว ได้มีการดำเนินการผ่านการจัดการเรียนการสอน และกิจกรรมเสริมหลักสูตร เพื่อให้นักศึกษาได้เรียนรู้ ได้ลงมือทำ ให้เกิดประสบการณ์ตรงในการทำงานร่วมกับผู้อื่น รวมทั้งเป็นการฝึกฝนให้นักศึกษามุ่งสร้างความดีเพื่อสังคม มีจิตอาสา รู้จักเสียสละแบ่งปัน นำความรู้ทางวิชาการของตนเองเพื่อก่อประโยชน์แก่สังคมและประเทศชาติ', 'เพื่อมอบเป็นทุนสนับสนุนให้นักศึกษาจัดกิจกรรมสร้างความดีที่ก่อให้เกิดประโยชน์แก่สังคม', 'NurseCMU Student Leadership, Involvement, and Social Outreach', 'Building Merit, Connecting Communities, Fostering Good Citizens', 'NurseCMU focuses on providing students with the foundation to excel in Chiang Mai University’s six target areas:  1) Smart Heart, 2) Smart Health, \r\n3) Smart Character, 4) Smart English, 5) Smart IT, and 6) Smart Brain. \r\nNurseCMU recognizes the importance of these qualities emphasized in the “CMU Smart Students vision,” and have integrated development of these areas into our teaching and learning management, and extracurricular activities.  Students participate in programs to give back to the community and receive training on creating good for society, volunteerism, altruism, and sharing.\r\n', 'To provide financial support to students and organize activities that are beneficial to society'),
(7, 7, 'ลดหย่อนภาษี 1 เท่า ', 'บริจาคเพื่อครอบครัวคณะพยาบาลศาสตร์ มช. ที่ประสบความเดือดร้อน', 'แบ่งปันน้ำใจให้กัน  ความผูกพันดุจครอบครัว', 'คณะพยาบาลศาสตร์ มช. มีความห่วงใยสมาชิกครอบครัวชาวคณะพยาบาลศาสตร์ มช. ได้แก่ นักศึกษา ศิษย์เก่า อาจารย์ และบุคลากรทั้งในอดีตและปัจจุบัน ที่ประสบปัญหาความเดือดร้อนและภาวะยากลำบากในการดำรงชีวิต การบริจาคในโครงการนี้จะทำให้คณะฯ สามารถนำเงินที่ได้จากน้ำใจของผู้บริจาคไปช่วยเหลือแบ่งเบาความเดือดร้อนของครอบครัวชาวคณะพยาบาลศาสตร์ มช. ที่อยู่ในสถานการณ์อันยากลำบาก', 'เพื่อช่วยเหลือนักศึกษา ศิษย์เก่า อาจารย์ และบุคลากรทั้งในอดีตและปัจจุบัน ที่ประสบปัญหาความเดือดร้อนและภาวะยากลำบาก', 'Hardship Support and NurseCMU Community Assistance ', 'Spreading Kindness to the NurseCMU Community', 'NurseCMU aims to support students, alumni, faculty members, and staff experiencing financial hardship. Donations to this fund will be distributed to members of the NurseCMU family experiencing financial difficulties.', 'To support faculty members, students, and staff (present and past) who are in need of financial support.');

-- --------------------------------------------------------

--
-- Table structure for table `pro_edo`
--

CREATE TABLE `pro_edo` (
  `edo_id` int(11) NOT NULL,
  `edo_pro_id` varchar(55) DEFAULT NULL,
  `edo_tex` varchar(255) NOT NULL,
  `edo_name` text NOT NULL,
  `edo_name1` text NOT NULL,
  `edo_slogan1` text NOT NULL,
  `edo_description1` text NOT NULL,
  `edo_name2` text NOT NULL,
  `edo_slogan2` text NOT NULL,
  `edo_description2` text NOT NULL,
  `edo_name3` text NOT NULL,
  `edo_slogan3` text NOT NULL,
  `edo_description3` text NOT NULL,
  `edo_name4` text NOT NULL,
  `edo_slogan4` text NOT NULL,
  `edo_description4` text NOT NULL,
  `edo_objective1` varchar(255) NOT NULL,
  `edo_objective2` varchar(255) NOT NULL,
  `edo_objective3` varchar(255) NOT NULL,
  `edo_objective4` varchar(255) NOT NULL,
  `edo_description` varchar(255) NOT NULL,
  `edo_objective` varchar(255) NOT NULL,
  `img_file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro_edo`
--

INSERT INTO `pro_edo` (`edo_id`, `edo_pro_id`, `edo_tex`, `edo_name`, `edo_name1`, `edo_slogan1`, `edo_description1`, `edo_name2`, `edo_slogan2`, `edo_description2`, `edo_name3`, `edo_slogan3`, `edo_description3`, `edo_name4`, `edo_slogan4`, `edo_description4`, `edo_objective1`, `edo_objective2`, `edo_objective3`, `edo_objective4`, `edo_description`, `edo_objective`, `img_file`) VALUES
(1, '121205', 'บริจาคเพื่อลดหย่อนภาษี 2 เท่า', 'บริจาคเพื่อทุนการศึกษาเพื่อนักศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'โครงการทุนการศึกษาเพื่อนักศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่ ', 'สร้างโอกาสการศึกษา สร้างพยาบาลในอนาคต', 'คณะพยาบาลศาสตร์ มช. เป็นสถาบันการศึกษาพยาบาลที่ผลิตบัณฑิตพยาบาล ที่เป็นกำลังสำคัญในระบบสาธารณสุขของประเทศ แต่ละปีมีนักศึกษาที่อยู่ระหว่างการศึกษาทุกระดับมากกว่า 1,500 คน คณะฯ ตระหนักถึงความสำคัญของการให้โอกาสทางการศึกษา และมุ่งหวังที่จะสนับสนุนและส่งเสริมให้นักศึกษาได้มีโอกาสเรียนรู้จนสำเร็จการศึกษาภายในระยะเวลาที่กำหนดไว้ในหลักสูตร โครงการนี้จัดตั้งขึ้นเพื่อมอบทุนการศึกษาแก่นักศึกษาพยาบาลทุกระดับที่ขาดแคลน\r\nทุนทรัพย์ ให้สามารถจ่ายค่าธรรมเนียมการศึกษา ค่าที่พักอาศัย และค่าใช้จ่ายในการดำรงชีพ ซึ่งจะช่วยให้นักศึกษาได้ใช้เวลาในการศึกษาเล่าเรียนอย่างเต็มศักยภาพ รวมทั้งเป็นรางวัลสำหรับนักศึกษาผู้ที่มีผลการเรียนและผลการฝึกปฏิบัติยอดเยี่ยม  ดังนั้นเมื่อสำเร็จการศึกษา นักศึกษาจะได้นำความรู้และทักษะทางการพยาบาลมาช่วยเหลือดูแลผู้ป่วย ครอบครัว และสังคมต่อไป\r\n', 'เพื่อมอบเป็นทุนการศึกษาสำหรับนักศึกษาพยาบาล มช. ที่ขาดแคลนทุนทรัพย์', '', '', 'เพื่อมอบเป็นรางวัลสำหรับนักศึกษาพยาบาล มช. มีผลการเรียนดีเยี่ยมและมีความประพฤติดี', '', '', '', '', '', '', '', '', '', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'DSC_2926.jpg'),
(2, '121206', 'บริจาคเพื่อลดหย่อนภาษี 2 เท่า  ', 'บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'เพื่อจัดสร้างอาคารและปรับปรุงอาคารเรียน คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'ร่วมกันพัฒนาอาคารเรียน ปรับเปลี่ยนพื้นที่สู่อนาคต', 'คณะพยาบาลศาสตร์ มช. เปิดดำเนินการจัดการเรียนการสอนและได้ผลิตบัณฑิตคณะพยาบาลศาสตร์ ออกไปรับใช้สังคมทั้งไทยและต่างประเทศมามากกว่า 60 ปี ปัจจุบันคณะพยาบาลศาสตร์ มีอาคารเรียนทั้งหมด 4 อาคาร ในการดำเนินการตามพันธกิจของคณะฯ จำเป็นต้องมีการพัฒนาปรับปรุงห้องเรียน อาคารเรียน อาคารสถานที่ และสภาพแวดล้อมภูมิทัศน์อย่างต่อเนื่อง เพื่อให้อาคารสถานที่และสิ่งแวดล้อม สะอาด ร่มรื่น สวยงาม ปลอดภัย และมีบรรยากาศเอื้ออำนวยต่อการเรียนการสอนของอาจารย์ นักศึกษา บุคลากร และผู้รับบริการทุกกลุ่มมีความพึงพอใจ ', 'เพื่อจัดหาวัสดุอุปกรณ์การศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'มอบอุปกรณ์ทางการศึกษา เพิ่มคุณค่าแห่งการเรียนรู้ ', 'คณะพยาบาลศาสตร์ มช. มียุทธศาสตร์ด้านการศึกษาที่มุ่งมั่นหลอมรวมความเป็นเลิศทางการพยาบาลเข้ากับเทคโนโลยีด้านการศึกษา เพื่อเป็นต้นแบบในการสร้างพยาบาลวิชาชีพที่มีทักษะแห่งศตวรรษที่ 21 ซึ่งพยาบาลเหล่านี้จะกลายเป็นศูนย์กลางการบริการด้านสุขภาพที่ยังคงเชื่อมต่อกับผู้ป่วยและผู้ที่ต้องการความช่วยเหลือด้านสุขภาพกับผู้เชี่ยวชาญด้านการแพทย์สาขาอื่น รวมทั้งเทคโนโลยีทางการแพทย์สมัยใหม่ ดังนั้นคณะฯ จำเป็นต้องจัดหาเทคโนโลยีและอุปกรณ์ทางการศึกษา รวมทั้งครุภัณฑ์เพื่อใช้ในกิจกรรมการเรียนการสอนและการฝึกปฏิบัติของนักศึกษา จัดหาทดแทนวัสดุอุปกรณ์ที่เสื่อมสภาพ หมดอายุ รวมทั้งจัดหาเทคโนโลยีทางการพยาบาลสมัยใหม่ เพื่อสนับสนุนกิจกรรมพัฒนาทักษะทางการพยาบาลแห่งศตวรรษที่ 21 เช่น เครื่องมืออุปกรณ์ในการฝึกทักษะทางการพยาบาลในห้องปฏิบัติการ รวมทั้งสื่อการศึกษา ตำรา สารสนเทศเพื่อสนับสนุนนักศึกษาให้สามารถนำไปใช้ในกิจกรรมการเรียนการสอน และพัฒนาทักษะทางการพยาบาลได้อย่างมีประสิทธิภาพ ', 'เพื่อจัดสร้างอาคารและปรับปรุงอาคารเรียน คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'ร่วมกันพัฒนาอาคารเรียน ปรับเปลี่ยนพื้นที่สู่อนาคต', 'คณะพยาบาลศาสตร์ มช. เปิดดำเนินการจัดการเรียนการสอนและได้ผลิตบัณฑิตคณะพยาบาลศาสตร์ ออกไปรับใช้สังคมทั้งไทยและต่างประเทศมามากกว่า 60 ปี ปัจจุบันคณะพยาบาลศาสตร์ มีอาคารเรียนทั้งหมด 4 อาคาร ในการดำเนินการตามพันธกิจของคณะฯ จำเป็นต้องมีการพัฒนาปรับปรุงห้องเรียน อาคารเรียน อาคารสถานที่ และสภาพแวดล้อมภูมิทัศน์อย่างต่อเนื่อง เพื่อให้อาคารสถานที่และสิ่งแวดล้อม สะอาด ร่มรื่น สวยงาม ปลอดภัย และมีบรรยากาศเอื้ออำนวยต่อการเรียนการสอนของอาจารย์ นักศึกษา บุคลากร และผู้รับบริการทุกกลุ่มมีความพึงพอใจ ', '', '', '', '1. เพื่อจัดสร้างอาคารและปรับปรุงอาคารเรียน คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่\r\n', ' 2. เพื่อจัดหาวัสดุอุปกรณ์การศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่\r\n', '', '', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'DSC_2928.jpg'),
(3, '121207', 'บริจาคเพื่อลดหย่อนภาษี 1 เท่า  ', 'บริจาคเพื่อสาธารณประโยชน์และการกุศลอื่น ๆ\r\nคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อผู้ยากไร้และผู้ด้อยโอกาสในสังคม', 'อันความกรุณาปราณี จะมีใครบังคับก็หาไม่', 'คณะพยาบาลศาสตร์ มช. เป็นสถาบันการศึกษาพยาบาลที่ผลิตบัณฑิตพยาบาล ที่เป็นกำลังสำคัญในระบบสาธารณสุขของประเทศ ที่ไม่ได้มุ่งหวังแค่การรักษาพยาบาลประชาชนเมื่อเจ็บป่วยเท่านั้น แต่มุ่งหวังให้ประชาชนมีสุขภาวะกายและจิตที่ดี ผ่านกระบวนการสร้างเสริมสุขภาพ ป้องกันโรค รักษาโรค และฟื้นฟูสภาพ คณะฯ ตระหนักถึงความยากลำบาก และความไม่เท่าเทียมกันของประชาชนในกลุ่มและพื้นที่ต่างๆ ที่ยังมีช่องว่างในการเข้าถึงบริการสาธารณสุขขั้นพื้นฐานที่มีคุณภาพ ดังนั้นคณะฯมีความมุ่งมั่นตั้งใจที่จะช่วยเหลือผู้ยากไร้ ผู้ด้อยโอกาสในสังคม ผู้ที่ขาดโอกาสในการเข้าถึงบริการสาธารณสุข ตลอดจนผู้ที่ขาดโอกาสด้านการศึกษาในสังคม โดยการรวบรวมเงินบริจาคเพื่อแบ่งปันเอื้ออาทร ช่วยเหลือซึ่งกันและกัน', 'บริจาคเพื่อเพื่อนร่วมวิชาชีพพยาบาลที่ประสบภัยจากการปฏิบัติงานในหน้าที่', 'เพื่อนไม่ทิ้งกัน ยามเพื่อนมีภัย', 'วิชาชีพพยาบาล มีหน้าที่ให้บริการสังคมในการดูแลสุขภาพและการเจ็บป่วยของประชาชน พยาบาลวิชาชีพในประเทศไทยกว่าหนึ่งแสนสองหมื่นคนทั่วประเทศ มีความเสี่ยงจากการทำงานที่ต้องเผชิญในระหว่างการปฏิบัติงานในหน้าที่ในแต่ละวัน ไม่ว่าจะปฏิบัติงานในหน้าที่อยู่ในสถานบริการสุขภาพ/โรงพยาบาล และระหว่างส่งต่อผู้ป่วย คณะพยาบาลศาสตร์ มช. มีความห่วงใยในสวัสดิภาพและความปลอดภัยของผู้ประกอบวิชาชีพพยาบาลทุกท่าน และประสงค์ร่วมกับสภาการพยาบาลในการสมทบกองทุนช่วยเหลือเบื้องต้นแก่สมาชิกสภาการพยาบาลที่ประสบภัยจากการปฏิบัติงานในหน้าที่', 'บริจาคเพื่อสนับสนุนโครงการนักศึกษาพยาบาล มช. ส่งต่อความดีเพื่อสังคม', 'สร้างสะพานบุญ เชื่อมต่อความดี', 'คณะพยาบาลศาสตร์ มช. มุ่งเน้นให้นักศึกษามีคุณสมบัติในการเป็น CMU smart students ตามแนวทางของมหาวิทยาลัย ทั้ง 6 ด้าน ได้แก่ 1) Smart Heart  2) Smart Health 3) Smart Character 4) Smart English 5) Smart IT และ 6) Smart Brain คณะฯ ตระหนักถึงความสำคัญในการส่งเสริมให้นักศึกษามีคุณลักษณะดังกล่าว ได้มีการดำเนินการผ่านการจัดการเรียนการสอน และกิจกรรมเสริมหลักสูตร เพื่อให้นักศึกษาได้เรียนรู้ ได้ลงมือทำ ให้เกิดประสบการณ์ตรงในการทำงานร่วมกับผู้อื่น รวมทั้งเป็นการฝึกฝนให้นักศึกษามุ่งสร้างความดีเพื่อสังคม มีจิตอาสา รู้จักเสียสละแบ่งปัน นำความรู้ทางวิชาการของตนเองเพื่อก่อประโยชน์แก่สังคมและประเทศชาติ', 'บริจาคเพื่อครอบครัวคณะพยาบาลศาสตร์ มช. ที่ประสบความเดือดร้อนโครงการ', 'แบ่งปันน้ำใจให้กัน  ความผูกพันดุจครอบครัว', 'คณะพยาบาลศาสตร์ มช. มีความห่วงใยสมาชิกครอบครัวชาวคณะพยาบาลศาสตร์ มช. ได้แก่ นักศึกษา ศิษย์เก่า อาจารย์ และบุคลากรทั้งในอดีตและปัจจุบัน ที่ประสบปัญหาความเดือดร้อนและภาวะยากลำบากในการดำรงชีวิต การบริจาคในโครงการนี้จะทำให้คณะฯ สามารถนำเงินที่ได้จากน้ำใจของผู้บริจาคไปช่วยเหลือแบ่งเบาความเดือดร้อนของครอบครัวชาวคณะพยาบาลศาสตร์ มช. ที่อยู่ในสถานการณ์อันยากลำบาก', '1. บริจาคเพื่อผู้ยากไร้และผู้ด้อยโอกาสในสังคม ', '2.  บริจาคเพื่อเพื่อนร่วมวิชาชีพพยาบาลที่ประสบภัยจากการปฏิบัติงานในหน้าที่ ', '3.  บริจาคเพื่อสนับสนุนโครงการนักศึกษาพยาบาล มช. ส่งต่อความดีเพื่อสังคม', '4.  บริจาคเพื่อครอบครัวคณะพยาบาลศาสตร์ มช. ที่ประสบความเดือดร้อนโครงการ', 'บริจาคเพื่อสาธารณประโยชน์และการกุศลอื่นๆ', 'บริจาคเพื่อสาธารณประโยชน์และการกุศลอื่นๆ', 'DSC_8522.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pro_offline`
--

CREATE TABLE `pro_offline` (
  `id` int(11) NOT NULL,
  `edo_pro_id` varchar(10) NOT NULL,
  `edo_name` varchar(255) NOT NULL,
  `edo_description` varchar(255) NOT NULL,
  `edo_objective` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pro_offline`
--

INSERT INTO `pro_offline` (`id`, `edo_pro_id`, `edo_name`, `edo_description`, `edo_objective`) VALUES
(1, '121205', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่'),
(2, '121206', 'บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่'),
(3, '121207', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่นๆ', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่นๆ');

-- --------------------------------------------------------

--
-- Table structure for table `receipt_offline`
--

CREATE TABLE `receipt_offline` (
  `id` int(11) NOT NULL,
  `name_title` varchar(20) NOT NULL COMMENT 'คำนำหน้าชื่อ',
  `rec_name` varchar(255) NOT NULL COMMENT 'ชื่อ',
  `rec_surname` varchar(255) NOT NULL COMMENT 'สกุล',
  `rec_idname` varchar(255) NOT NULL COMMENT 'เลขบัตรประชาชน',
  `rec_tel` varchar(255) NOT NULL COMMENT 'เบอร์โทรศัพท์',
  `rec_email` varchar(255) NOT NULL COMMENT 'อีเมล์',
  `address` varchar(255) NOT NULL COMMENT 'ที่อยู่',
  `road` varchar(255) NOT NULL COMMENT 'ถนน',
  `provinces` varchar(255) NOT NULL COMMENT 'จังหวัด',
  `amphures` varchar(255) NOT NULL COMMENT 'อำเภอ',
  `districts` varchar(255) NOT NULL COMMENT 'ตำบล',
  `zip_code` varchar(255) NOT NULL COMMENT 'รหัสไปรษณีย์',
  `rec_date_s` varchar(255) NOT NULL COMMENT 'วันรับเงิน',
  `rec_date_out` varchar(255) NOT NULL COMMENT 'วันออกใบเสร็จ',
  `amount` varchar(255) NOT NULL COMMENT 'ยอดเงิน',
  `payby` varchar(255) NOT NULL COMMENT 'ชำระโดย',
  `edo_pro_id` varchar(255) NOT NULL COMMENT 'รหัสโครงการ',
  `edo_name` varchar(255) NOT NULL COMMENT 'ชื่อโครงการ',
  `edo_description` varchar(255) NOT NULL COMMENT 'รายละเอียดโครงการ(แสดงหน้าใบเสร็จ)',
  `edo_objective` varchar(255) NOT NULL COMMENT 'รายละเอียดโครงการ(แสดงหน้าใบอนุโมทนาบัตร)	',
  `comment` varchar(255) NOT NULL COMMENT 'หมายเหตุ',
  `status_donat` varchar(255) NOT NULL COMMENT 'สถานะการบริจาค',
  `status_user` varchar(55) NOT NULL COMMENT 'สถานะผู้บริจาค',
  `rec_time` time DEFAULT curtime(),
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `receipt_offline`
--

INSERT INTO `receipt_offline` (`id`, `name_title`, `rec_name`, `rec_surname`, `rec_idname`, `rec_tel`, `rec_email`, `address`, `road`, `provinces`, `amphures`, `districts`, `zip_code`, `rec_date_s`, `rec_date_out`, `amount`, `payby`, `edo_pro_id`, `edo_name`, `edo_description`, `edo_objective`, `comment`, `status_donat`, `status_user`, `rec_time`, `dateCreate`) VALUES
(144, 'นาย', 'พัชรพล', 'ปิงยศ', '0123456789987', '0987654321', 'edonation@gmail.com', '17/1', '-', 'พะเยา', 'ดอกคำใต้ ', 'คือเวียง', '56120', '', '2023-06-28', '199', '', '121206', 'บริจาคเพื่อระดมพลัง เร่งรัดปรับปรุงคุณภาพ คณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อสนับสนุนการศึกษาคณะพยาบาลศาสตร์ มหาวิทยาลัยเชียงใหม่', '', 'online', 'person', '11:04:19', '2023-06-28 04:04:19'),
(161, 'นาย', 'พัชรพล', 'ปิงยศ', '1-5007-01252-3-95', '0987654321', 'edonation@gmail.com', '17/1', '-', 'พะเยา', 'ดอกคำใต้ ', 'คือเวียง', '56120', '2023-07-03', '2023-07-03', '20300', 'โอน / Prompt Pay', '121205', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', '', 'offline', 'person', '15:46:17', '2023-07-03 08:46:17'),
(162, '', 'บริษัท เดอะดอว์น เชียงใหม่ รีแฮบแอนด์ เวลเนสเซ็นเตอร์ จำกัด   ', '', '0123456789987', '0987654321', '', '127', 'พหลโยธิน', 'ลำปาง ', 'เมืองลำปาว', 'ทาปลาดุก', '26130', '2023-07-03', '2023-07-03', '45000', 'เช็ค / Cheque', '121207', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่น ๆ', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่นๆ', 'บริจาคเพื่อสาธารณะประโยชน์และการกุศลอื่นๆ', '', 'offline', 'corporation', '15:46:58', '2023-07-03 08:46:58'),
(163, '', 'พัชรพล', '', '0123456789987', '0987654321', '', '17/1', 'พหลโยธิน', 'พะเยา', 'ดอกคำใต้ ', 'คือเวียง', '56120', '2023-07-03', '2023-07-03', '20000.50', 'เช็ค / Cheque', '121205', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', 'บริจาคเพื่อการศึกษา เพื่อเป็นทุนการศึกษานักศึกษาพยาบาลศาสตร์  มหาวิทยาลัยเชียงใหม่', '', 'offline', 'corporation', '16:06:23', '2023-07-03 09:06:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `pro_edo`
--
ALTER TABLE `pro_edo`
  ADD PRIMARY KEY (`edo_id`);

--
-- Indexes for table `pro_offline`
--
ALTER TABLE `pro_offline`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receipt_offline`
--
ALTER TABLE `receipt_offline`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `pro_edo`
--
ALTER TABLE `pro_edo`
  MODIFY `edo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pro_offline`
--
ALTER TABLE `pro_offline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `receipt_offline`
--
ALTER TABLE `receipt_offline`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
