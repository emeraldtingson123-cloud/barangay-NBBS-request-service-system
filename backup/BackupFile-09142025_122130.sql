CREATE DATABASE IF NOT EXISTS `barangay`;

USE `barangay`;

SET foreign_key_checks = 0;

DROP TABLE IF EXISTS `activity_log`;

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message` varchar(255) NOT NULL DEFAULT 'none',
  `date` varchar(255) NOT NULL DEFAULT 'none',
  `status` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1352 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `activity_log` VALUES (1250,"ADMIN: UPDATED OFFICIAL POSITION -  0401202511295839347 |  FROM CHAIRMANS TO CHAIRMAN","1-4-2025 1:05 PM","update"),
(1251,"ADMIN: DELETED POSITION -  77311317124789201092022180612765 | chairmans","1-4-2025 7:05 AM","delete"),
(1252,"ADMIN: ADDED RESIDENT - 23388956417195 |  Alexandra Kane Non commodi saepe se","1-4-2025 1:06 PM","create"),
(1253,"ADMIN: ADDED RESIDENT - 3188696235402 |  Alexandra Mooney In rem voluptatem E","1-4-2025 1:06 PM","create"),
(1254,"ADMIN: Admin Admin | LOGOUT","1-4-2025 7:07 AM","logout"),
(1255,"ADMIN: Admin Admin | LOGIN","1-4-2025 1:09 PM","login"),
(1256,"ADMIN: ADDED BLOTTER RECORD  -  3647560271426891 | Complainant - Alexandra Kane | Incident - Incident | Date Incident 2025-04-19T13:10 | Location Incident Location of Incident | Complainant Statement - Complainant Statement | Respondent - Respondent","1-4-2025 1:10 PM","delete"),
(1257,"ADMIN: ADDED BLOTTER RECORD  -  3647560271426891 | Person Involved - Alexandra Kane | Incident - Incident | Date Incident 2025-04-19T13:10 | Location Incident Location of Incident | Complainant Statement - Complainant Statement | Respondent - Respondent","1-4-2025 1:10 PM","delete"),
(1258,"ADMIN: ADDED BLOTTER RECORD  -  3647560271426891 | Person Not Resident - wq | Incident - Incident | Date Incident 2025-04-19T13:10 | Location Incident Location of Incident | Complainant Statement - ewqewq | Respondent - Respondent","1-4-2025 1:10 PM","delete"),
(1259,"ADMIN: ADDED BLOTTER RECORD  -  3647560271426891 | Complainant Not Resident - Complainant Not Resident | Incident - Incident | Date Incident 2025-04-19T13:10 | Location Incident Location of Incident | Complainant Statement - Complainant Statement | Respon","1-4-2025 1:10 PM","delete"),
(1260,"ADMIN: ADDED RESIDENT - 37404238492438 |  Miriam Frost Harum sit ut provide","1-4-2025 1:10 PM","create"),
(1261,"ADMIN: ADDED RESIDENT - 1086692484891 |  Jelani Ellison Dolorum qui qui id v","1-4-2025 1:11 PM","create"),
(1262,"ADMIN: ADDED RESIDENT - 12435095932673 |  Darrel Kline Quas perferendis aut","1-4-2025 1:11 PM","create"),
(1263,"ADMIN: ADDED RESIDENT - 34151365970057 |  Moana Burt Dolorum fugiat nisi","1-4-2025 1:11 PM","create"),
(1264,"ADMIN: ADDED OFFICIAL - 0401202513120186625 | KAGAWAD Branden Whitney Minim dolores velit | START 2021-12-17 END 1971-04-06","1-4-2025 1:12 PM","create"),
(1265,"ADMIN: Admin Admin | LOGOUT","1-4-2025 7:12 AM","logout"),
(1266,"ADMIN: Admin Admin | LOGIN","1-4-2025 1:15 PM","login"),
(1267,"ADMIN: Admin Admin | LOGIN","8-9-2025 5:30 PM","login"),
(1268,"ADMIN: Admin Admin | LOGOUT","8-9-2025 11:31 AM","logout"),
(1269,"ADMIN: Admin Admin | LOGIN","8-9-2025 5:34 PM","login"),
(1270,"ADMIN: ADDED OFFICIAL - 090820251735387780 | KAGAWAD Joshua awdkawdkl dankndaw | START 2025-09-03 END 2025-09-23","8-9-2025 5:35 PM","create"),
(1271,"ADMIN: Admin Admin | LOGOUT","8-9-2025 11:37 AM","logout"),
(1272,"OFFICIAL: Secretary Secretary | LOGIN","8-9-2025 5:37 PM","login"),
(1273,"OFFICAL: Secretary Secretary - 174668789044820710152022021619941 | ADDED RESIDENT - 49786338683746 |  awdjhwaj wajdawdwaj jwahkhaw","8-9-2025 5:38 PM","create"),
(1274,"OFFICIAL: Secretary Secretary | LOGOUT","8-9-2025 11:39 AM","logout"),
(1275,"RESIDENT: REGISTER RESIDENT - 48223779709266 |  dwakjdwa awdjlawdjlwak dwakwald","8-9-2025 5:40 PM","create"),
(1276,"RESIDENT: dwakjdwa awdjlawdjlwak | LOGIN","8-9-2025 5:40 PM","login"),
(1277,"RESIDENT - 48223779709266: dwakjdwa awdjlawdjlwak | REQUEST CERTIFICATE - INDIGENCY","8-9-2025 5:41 PM","create"),
(1278,"RESIDENT: dwakjdwa awdjlawdjlwak | LOGOUT","8-9-2025 11:41 AM","logout"),
(1279,"ADMIN: Admin Admin | LOGIN","8-9-2025 5:41 PM","login"),
(1280,"ADMIN: RESIDENT REQUEST CERTIFICATE ACCEPTED - 48223779709266 | PURPOSE INDIGENCY | MESSAGE none | DATE ISSUED 2025-09-09 | DATE EXPIRED 2025-09-26","8-9-2025 11:41 AM","updated"),
(1281,"ADMIN: Admin Admin | LOGOUT","8-9-2025 11:42 AM","logout"),
(1282,"RESIDENT: dwakjdwa awdjlawdjlwak | LOGIN","8-9-2025 5:42 PM","login"),
(1283,"RESIDENT: dwakjdwa awdjlawdjlwak | LOGOUT","8-9-2025 11:44 AM","logout"),
(1284,"ADMIN: Admin Admin | LOGIN","8-9-2025 5:44 PM","login"),
(1285,"ADMIN: Admin Admin | LOGOUT","8-9-2025 11:52 AM","logout"),
(1286,"ADMIN: Admin Admin | LOGIN","8-9-2025 5:53 PM","login"),
(1287,"ADMIN: Admin Admin | LOGIN","10-9-2025 12:53 AM","login"),
(1288,"ADMIN: Admin Admin | LOGIN","10-9-2025 2:41 PM","login"),
(1289,"ADMIN: Admin Admin | LOGOUT","10-9-2025 8:42 AM","logout"),
(1290,"ADMIN: Admin Admin | LOGIN","10-9-2025 2:43 PM","login"),
(1291,"ADMIN: Admin Admin | LOGIN","10-9-2025 7:26 PM","login"),
(1292,"ADMIN: Admin Admin | LOGOUT","10-9-2025 1:33 PM","logout"),
(1293,"RESIDENT: REGISTER RESIDENT - 63572011649247 |  tingson nana ","10-9-2025 7:35 PM","create"),
(1294,"ADMIN: Admin Admin | LOGIN","10-9-2025 7:36 PM","login"),
(1295,"ADMIN: Admin Admin | LOGOUT","10-9-2025 1:37 PM","logout"),
(1296,"RESIDENT: REGISTER RESIDENT - 62220181424620 |    ","10-9-2025 7:40 PM","create"),
(1297,"ADMIN: Admin Admin | LOGIN","11-9-2025 4:24 PM","login"),
(1298,"ADMIN: Admin Admin | LOGOUT","11-9-2025 10:31 AM","logout"),
(1299,"ADMIN: Admin Admin | LOGIN","12-9-2025 3:17 PM","login"),
(1300,"ADMIN: Admin Admin | LOGOUT","12-9-2025 9:25 AM","logout"),
(1301,"ADMIN: Admin Admin | LOGIN","12-9-2025 3:25 PM","login"),
(1302,"ADMIN: Admin Admin | LOGOUT","12-9-2025 9:26 AM","logout"),
(1303,"ADMIN: Admin Admin | LOGIN","12-9-2025 3:26 PM","login"),
(1304,"ADMIN: Admin Admin | LOGOUT","12-9-2025 9:31 AM","logout"),
(1305,"ADMIN: Admin Admin | LOGIN","12-9-2025 3:31 PM","login"),
(1306,"ADMIN: Admin Admin | LOGOUT","12-9-2025 9:31 AM","logout"),
(1307,"ADMIN: Admin Admin | LOGIN","12-9-2025 3:33 PM","login"),
(1308,"ADMIN: Admin Admin | LOGOUT","12-9-2025 9:33 AM","logout"),
(1309,"ADMIN: Admin Admin | LOGIN","12-9-2025 3:44 PM","login"),
(1310,"ADMIN: Admin Admin | LOGIN","13-9-2025 12:42 PM","login"),
(1311,"ADMIN: Admin Admin | LOGOUT","13-9-2025 6:46 AM","logout"),
(1312,"ADMIN: Admin Admin | LOGIN","13-9-2025 1:14 PM","login"),
(1313,"ADMIN: Admin Admin | LOGOUT","13-9-2025 7:22 AM","logout"),
(1314,"ADMIN: Admin Admin | LOGIN","13-9-2025 1:22 PM","login"),
(1315,"ADMIN: Admin Admin | LOGOUT","13-9-2025 7:26 AM","logout"),
(1316,"OFFICIAL: Secretary Secretary | LOGIN","13-9-2025 1:27 PM","login"),
(1317,"OFFICIAL: Secretary Secretary | LOGOUT","13-9-2025 9:49 AM","logout"),
(1318,"ADMIN: Admin Admin | LOGIN","13-9-2025 3:49 PM","login"),
(1319,"RESIDENT: REGISTER RESIDENT - 2855307104181 |  eula tingson ","14-9-2025 5:29 PM","create"),
(1320,"RESIDENT: eula tingson | LOGIN","14-9-2025 5:29 PM","login"),
(1321,"RESIDENT: eula tingson - 2855307104181 | UPDATED RESIDENT ADDRESS - 2855307104181 |  FROM  TO 123 bisig","14-9-2025 11:30 AM","update"),
(1322,"RESIDENT: eula tingson - 2855307104181 | UPDATED RESIDENT CONTACT NUMBER - 2855307104181 |  FROM  TO 09090909090","14-9-2025 11:30 AM","update"),
(1323,"RESIDENT - 2855307104181: eula tingson | REQUEST CERTIFICATE - RESIDENT CLEARANCE","14-9-2025 5:31 PM","create"),
(1324,"RESIDENT: eula tingson | LOGOUT","14-9-2025 11:32 AM","logout"),
(1325,"ADMIN: Admin Admin | LOGIN","14-9-2025 5:32 PM","login"),
(1326,"ADMIN: RESIDENT REQUEST CERTIFICATE ACCEPTED - 2855307104181 | PURPOSE RESIDENT CLEARANCE | MESSAGE none | DATE ISSUED 2025-09-10 | DATE EXPIRED 2025-09-17","14-9-2025 11:33 AM","updated"),
(1327,"ADMIN: Admin Admin | LOGOUT","14-9-2025 11:33 AM","logout"),
(1328,"RESIDENT: eula tingson | LOGIN","14-9-2025 5:33 PM","login"),
(1329,"RESIDENT: eula tingson | LOGOUT","14-9-2025 11:34 AM","logout"),
(1330,"ADMIN: Admin Admin | LOGIN","14-9-2025 5:34 PM","login"),
(1331,"ADMIN: ADDED BLOTTER RECORD  -  6609262989299823 | Complainant - eula tingson | Incident - fighting | Date Incident 2025-09-02T02:42 | Location Incident dyAN LANG | Complainant Statement - fighting | Respondent - kagawad","14-9-2025 5:43 PM","delete"),
(1332,"ADMIN: ADDED BLOTTER RECORD  -  6609262989299823 | Person Involved - eula tingson | Incident - fighting | Date Incident 2025-09-02T02:42 | Location Incident dyAN LANG | Complainant Statement - fighting | Respondent - kagawad","14-9-2025 5:43 PM","delete"),
(1333,"ADMIN: ADDED BLOTTER RECORD  -  6609262989299823 | Person Not Resident -  | Incident - fighting | Date Incident 2025-09-02T02:42 | Location Incident dyAN LANG | Complainant Statement - fighting | Respondent - kagawad","14-9-2025 5:43 PM","delete"),
(1334,"ADMIN: ADDED BLOTTER RECORD  -  6609262989299823 | Complainant Not Resident -  | Incident - fighting | Date Incident 2025-09-02T02:42 | Location Incident dyAN LANG | Complainant Statement - fighting | Respondent - kagawad","14-9-2025 5:43 PM","delete"),
(1335,"ADMIN: ADDED ADMINISTRATOR  -  184323227961722209142025174804253 | angelica espinosa","14-9-2025 5:48 PM","delete"),
(1336,"ADMIN: Admin Admin | LOGOUT","14-9-2025 11:48 AM","logout"),
(1337,"RESIDENT: REGISTER RESIDENT - 46337153140937 |  kim pore ","14-9-2025 5:50 PM","create"),
(1338,"RESIDENT: kim pore | LOGIN","14-9-2025 5:50 PM","login"),
(1339,"RESIDENT: kim pore | LOGOUT","14-9-2025 11:51 AM","logout"),
(1340,"RESIDENT: REGISTER RESIDENT - 20555304446479 |  eula tingson ","14-9-2025 5:53 PM","create"),
(1341,"ADMIN: Admin Admin | LOGIN","14-9-2025 5:56 PM","login"),
(1342,"ADMIN: Admin Admin | LOGOUT","14-9-2025 12:04 PM","logout"),
(1343,"OFFICIAL: Secretary Secretary | LOGIN","14-9-2025 6:04 PM","login"),
(1344,"OFFICIAL: Secretary Secretary | LOGOUT","14-9-2025 12:09 PM","logout"),
(1345,"ADMIN: Admin Admin | LOGIN","14-9-2025 6:09 PM","login"),
(1346,"ADMIN: DELETED RESIDENT -  62220181424620 |  -  ","14-9-2025 12:10 PM","delete"),
(1347,"ADMIN: UNDELETED RESIDENT -  62220181424620 |  -  ","14-9-2025 12:11 PM","delete"),
(1348,"ADMIN: DELETED RESIDENT -  62220181424620 |  -  ","14-9-2025 12:11 PM","delete"),
(1349,"ADMIN: UNDELETED RESIDENT -  62220181424620 |  -  ","14-9-2025 12:12 PM","delete"),
(1350,"ADMIN: DELETED RESIDENT -  62220181424620 |  -  ","14-9-2025 12:14 PM","delete"),
(1351,"ADMIN: DELETED RESIDENT -  63572011649247 |  - tingson nana","14-9-2025 12:14 PM","delete");


DROP TABLE IF EXISTS `backup`;

CREATE TABLE `backup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=172 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `backup` VALUES (171,"BackupFile-09142025_122130.sql");


DROP TABLE IF EXISTS `barangay_information`;

CREATE TABLE `barangay_information` (
  `id` varchar(255) NOT NULL,
  `barangay` varchar(255) NOT NULL DEFAULT 'none',
  `zone` varchar(255) NOT NULL DEFAULT 'none',
  `district` varchar(255) NOT NULL DEFAULT 'none',
  `address` varchar(69) NOT NULL DEFAULT 'none',
  `postal_address` varchar(255) NOT NULL DEFAULT 'none',
  `image` varchar(255) NOT NULL DEFAULT 'none',
  `image_path` varchar(255) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `barangay_information` VALUES (32432432432432432,"NBBS PROPER","Zone","BLOCK 1","NAVOTAS","Postal Address","128856464268c4ffcc70fb4.png","../assets/dist/img/128856464268c4ffcc70fb4.png");


DROP TABLE IF EXISTS `blotter_complainant`;

CREATE TABLE `blotter_complainant` (
  `id` varchar(255) NOT NULL,
  `blotter_main` varchar(255) NOT NULL,
  `complainant_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `blotter_complainant` VALUES (433075133122630,6609262989299823,2855307104181);


DROP TABLE IF EXISTS `blotter_info`;

CREATE TABLE `blotter_info` (
  `id` varchar(255) NOT NULL,
  `blotter_main_id` varchar(255) NOT NULL,
  `blotter_person_id` varchar(255) NOT NULL,
  `blotter_complainant_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `blotter_record`;

CREATE TABLE `blotter_record` (
  `blotter_id` varchar(255) NOT NULL,
  `complainant_not_residence` varchar(255) NOT NULL DEFAULT 'none',
  `statement` varchar(255) NOT NULL DEFAULT 'none',
  `respodent` varchar(255) NOT NULL DEFAULT 'none',
  `involved_not_resident` varchar(255) NOT NULL DEFAULT 'none',
  `statement_person` varchar(255) NOT NULL DEFAULT 'none',
  `date_incident` varchar(255) NOT NULL DEFAULT 'none',
  `date_reported` varchar(255) NOT NULL DEFAULT 'none',
  `type_of_incident` varchar(255) NOT NULL DEFAULT 'none',
  `location_incident` varchar(255) NOT NULL DEFAULT 'none',
  `status` varchar(69) NOT NULL DEFAULT 'none',
  `remarks` varchar(69) NOT NULL DEFAULT 'none',
  `date_added` varchar(255) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`blotter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `blotter_record` VALUES (6609262989299823,"","fighting","kagawad","","fighting","2025-09-02T02:42","2025-09-10T02:42","fighting","dyAN LANG","NEW","CLOSED",2025);


DROP TABLE IF EXISTS `blotter_status`;

CREATE TABLE `blotter_status` (
  `blotter_id` varchar(255) NOT NULL,
  `blotter_main` varchar(255) NOT NULL,
  `person_id` varchar(255) NOT NULL,
  PRIMARY KEY (`blotter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `blotter_status` VALUES (439506272155289,6609262989299823,48223779709266);


DROP TABLE IF EXISTS `carousel`;

CREATE TABLE `carousel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_title` varchar(255) NOT NULL,
  `banner_image` varchar(255) NOT NULL,
  `banner_image_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `certificate`;

CREATE TABLE `certificate` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `certificate_id` varchar(255) NOT NULL,
  `residence_id` varchar(255) NOT NULL,
  `certificate` varchar(255) NOT NULL,
  `ctc` varchar(255) NOT NULL,
  `issued_at` varchar(255) NOT NULL,
  `or_no` varchar(255) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `control_no` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `expired_at` varchar(255) NOT NULL,
  PRIMARY KEY (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `certificate_request`;

CREATE TABLE `certificate_request` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(255) NOT NULL,
  `residence_id` varchar(255) NOT NULL,
  `certificate_type` varchar(255) NOT NULL DEFAULT 'none',
  `purpose` varchar(255) NOT NULL DEFAULT 'none',
  `message` varchar(255) NOT NULL DEFAULT 'none',
  `date_issued` varchar(255) NOT NULL DEFAULT 'none',
  `date_request` varchar(255) NOT NULL DEFAULT 'none',
  `date_expired` varchar(255) NOT NULL DEFAULT 'none',
  `status` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `a_i` (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `certificate_request` VALUES (64,"3891350209082025174113983143303253868bea4b9f038c",48223779709266,"none","INDIGENCY","none","2025-09-09","09/08/2025","2025-09-26","ACCEPTED"),
(65,"4507313360914202517315609424456429768c68b8c171e6",2855307104181,"none","RESIDENT CLEARANCE","none","2025-09-10","09/14/2025","2025-09-17","ACCEPTED");


DROP TABLE IF EXISTS `house_holds`;

CREATE TABLE `house_holds` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `house_hold_id` varchar(255) NOT NULL DEFAULT 'none',
  `hold_unique` varchar(255) NOT NULL,
  `purok_id` varchar(255) NOT NULL,
  `residence_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `birth_date` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `educ_attainment` varchar(255) NOT NULL,
  `occupation` varchar(255) NOT NULL,
  `nawasa` varchar(255) NOT NULL,
  `water_pump` varchar(255) NOT NULL,
  `water_sealed` varchar(255) NOT NULL,
  `flush` varchar(255) NOT NULL,
  `religion` varchar(255) NOT NULL,
  `ethnicity` varchar(255) NOT NULL,
  `sangkap_seal` varchar(255) NOT NULL,
  `is_approved` varchar(255) NOT NULL,
  `is_resident` varchar(255) NOT NULL,
  PRIMARY KEY (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `house_holds` VALUES (119,765720104206,90635228440419,916259339179300507242022155033612,16455182440138," First name","Middle name","Last name","2022-10-08","Female","educ","Occupation","YES","YES","YES","YES","Religion","Ethnicity","YES","APPROVED","NO"),
(120,377220153950,90635228440419,916259339179300507242022155033612,16455182440138,"qe","qwe","qweqwe","2022-10-12","Male","qweqw","wqe","YES","YES","YES","YES","qwe","eqwe","YES","APPROVED","NO"),
(121,377220153950,90635228440419,916259339179300507242022155033612,16455182440138,"First Name","Middle Name","Last Name","2022-10-27","Male","qwewqe","Occupation","YES","YES","YES","NO","Religion","qwe","YES","APPROVED","YES"),
(122,530011579769,70838125253292,916259339179300507242022155033612,54278971251733," First name","Middle name","Last name","2022-10-08","Male","Educational Attainment","Occupation","YES","YES","YES","YES","Religion","Ethnicity","YES","PENDING","NO"),
(123,85351248693,70838125253292,916259339179300507242022155033612,54278971251733,"qwe","wqe","wqewqe","2022-10-15","Female","wqe","wqe","YES","YES","YES","YES","qwe","qwe","YES","PENDING","NO"),
(124,85351248693,70838125253292,916259339179300507242022155033612,54278971251733,"Eugine","Palce","ROsillon","1997-09-06","Male","Educational Attainment","Wala","YES","YES","YES","YES","Catholic","Ethnicity","YES","PENDING","YES");


DROP TABLE IF EXISTS `official_end_information`;

CREATE TABLE `official_end_information` (
  `official_id` varchar(255) NOT NULL,
  `first_name` varchar(69) NOT NULL DEFAULT 'none',
  `middle_name` varchar(69) NOT NULL DEFAULT 'none',
  `last_name` varchar(69) NOT NULL DEFAULT 'none',
  `suffix` varchar(69) NOT NULL DEFAULT 'none',
  `birth_date` varchar(69) NOT NULL DEFAULT 'none',
  `birth_place` varchar(69) NOT NULL DEFAULT 'none',
  `gender` varchar(69) NOT NULL DEFAULT 'none',
  `age` varchar(69) NOT NULL DEFAULT 'none',
  `civil_status` varchar(69) NOT NULL DEFAULT 'none',
  `religion` varchar(69) NOT NULL DEFAULT 'none',
  `nationality` varchar(69) NOT NULL DEFAULT 'none',
  `municipality` varchar(69) NOT NULL DEFAULT 'none',
  `zip` varchar(69) NOT NULL DEFAULT 'none',
  `barangay` varchar(69) NOT NULL DEFAULT 'none',
  `house_number` varchar(69) NOT NULL DEFAULT 'none',
  `street` varchar(69) NOT NULL DEFAULT 'none',
  `address` varchar(69) NOT NULL DEFAULT 'none',
  `email_address` varchar(69) NOT NULL DEFAULT 'none',
  `contact_number` varchar(69) NOT NULL DEFAULT 'none',
  `fathers_name` varchar(69) NOT NULL DEFAULT 'none',
  `mothers_name` varchar(69) NOT NULL DEFAULT 'none',
  `guardian` varchar(69) NOT NULL DEFAULT 'none',
  `guardian_contact` varchar(69) NOT NULL DEFAULT 'none',
  `image` varchar(255) NOT NULL DEFAULT 'none',
  `image_path` varchar(255) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`official_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `official_end_status`;

CREATE TABLE `official_end_status` (
  `official_id` varchar(255) NOT NULL,
  `position` varchar(69) NOT NULL DEFAULT 'none',
  `purok_id` varchar(255) NOT NULL,
  `senior` varchar(69) NOT NULL DEFAULT 'none',
  `term_from` varchar(69) NOT NULL DEFAULT 'none',
  `term_to` varchar(69) NOT NULL DEFAULT 'none',
  `pwd` varchar(69) NOT NULL DEFAULT 'none',
  `pwd_info` varchar(255) NOT NULL DEFAULT 'none',
  `single_parent` varchar(69) NOT NULL DEFAULT 'none',
  `status` varchar(69) NOT NULL DEFAULT 'none',
  `voters` varchar(69) NOT NULL DEFAULT 'none',
  `date_deleted` varchar(69) NOT NULL DEFAULT 'none',
  PRIMARY KEY (`official_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



DROP TABLE IF EXISTS `official_information`;

CREATE TABLE `official_information` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `official_id` varchar(255) NOT NULL,
  `first_name` varchar(69) NOT NULL DEFAULT 'none',
  `middle_name` varchar(69) NOT NULL DEFAULT 'none',
  `last_name` varchar(69) NOT NULL DEFAULT 'none',
  `suffix` varchar(69) NOT NULL DEFAULT 'none',
  `birth_date` varchar(69) NOT NULL DEFAULT 'none',
  `birth_place` varchar(69) NOT NULL DEFAULT 'none',
  `gender` varchar(69) NOT NULL DEFAULT 'none',
  `age` varchar(69) NOT NULL DEFAULT 'none',
  `civil_status` varchar(69) NOT NULL DEFAULT 'none',
  `religion` varchar(69) NOT NULL DEFAULT 'none',
  `nationality` varchar(69) NOT NULL DEFAULT 'none',
  `municipality` varchar(69) NOT NULL DEFAULT 'none',
  `zip` varchar(69) NOT NULL DEFAULT 'none',
  `barangay` varchar(69) NOT NULL DEFAULT 'none',
  `house_number` varchar(69) NOT NULL DEFAULT 'none',
  `street` varchar(69) NOT NULL DEFAULT 'none',
  `address` varchar(69) NOT NULL DEFAULT 'none',
  `email_address` varchar(69) NOT NULL DEFAULT 'none',
  `contact_number` varchar(69) NOT NULL DEFAULT 'none',
  `fathers_name` varchar(69) NOT NULL DEFAULT 'none',
  `mothers_name` varchar(69) NOT NULL DEFAULT 'none',
  `guardian` varchar(69) NOT NULL DEFAULT 'none',
  `guardian_contact` varchar(69) NOT NULL DEFAULT 'none',
  `image` varchar(255) NOT NULL DEFAULT 'none',
  `image_path` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `a_i` (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `official_information` VALUES (65,090820251735387780,"Joshua","awdnkawndklwa","awdkawdkl","dankndaw","2025-09-25","dwadjawdwaj","Male",0,"Single","wadakw","awdjnaw","dwkal",1231,"qdnawnawk",12312,12312,"wekaekaw","wajekwajklaw@gmail.com",09380912839,"","","","","","");


DROP TABLE IF EXISTS `official_status`;

CREATE TABLE `official_status` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `official_id` varchar(255) NOT NULL,
  `position` varchar(69) NOT NULL DEFAULT 'none',
  `purok_id` varchar(255) NOT NULL,
  `senior` varchar(69) NOT NULL DEFAULT 'none',
  `term_from` varchar(69) NOT NULL DEFAULT 'none',
  `term_to` varchar(69) NOT NULL DEFAULT 'none',
  `pwd` varchar(69) NOT NULL DEFAULT 'none',
  `pwd_info` varchar(255) NOT NULL DEFAULT 'none',
  `status` varchar(69) NOT NULL DEFAULT 'none',
  `voters` varchar(69) NOT NULL DEFAULT 'none',
  `single_parent` varchar(255) NOT NULL DEFAULT 'none',
  `date_added` varchar(69) NOT NULL DEFAULT 'none',
  `date_undeleted` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `a_i` (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `official_status` VALUES (59,090820251735387780,268778674891281501142022025704271,"","NO","2025-09-03","2025-09-23","NO","","ACTIVE","YES","NO","09/08/2025 05:35 PM","none");


DROP TABLE IF EXISTS `position`;

CREATE TABLE `position` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `position_id` varchar(255) NOT NULL,
  `position` varchar(69) NOT NULL DEFAULT 'none',
  `position_limit` varchar(69) NOT NULL DEFAULT 'none',
  `position_description` varchar(255) NOT NULL DEFAULT 'none',
  `color` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `a_i` (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `position` VALUES (20,268778674891281501142022025704271,"kagawad",7,"","#50d425"),
(21,811981911875128801142022163118246,"sk kagawad",7,"","#3bc173"),
(22,619131249471207208162022141229307,"chairman",1,"","#4fb42e");


DROP TABLE IF EXISTS `precint`;

CREATE TABLE `precint` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `precint_id` varchar(255) NOT NULL,
  `precint` varchar(255) NOT NULL,
  PRIMARY KEY (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `precint` VALUES (1,112430277815139107242022164651634,12313200),
(5,834679331034411909122022012433363,"Test 123");


DROP TABLE IF EXISTS `purok`;

CREATE TABLE `purok` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `purok_id` varchar(255) NOT NULL,
  `purok` varchar(255) NOT NULL,
  `leader` varchar(255) NOT NULL,
  PRIMARY KEY (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `purok` VALUES (2,916259339179300507242022155033612,"puirok","qweqwe"),
(5,74710938236700907272022172121040,"ewqe","wqewqeq");


DROP TABLE IF EXISTS `residence_information`;

CREATE TABLE `residence_information` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `residence_id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT 'none',
  `middle_name` varchar(255) NOT NULL DEFAULT 'none',
  `last_name` varchar(255) NOT NULL DEFAULT 'none',
  `age` varchar(11) NOT NULL,
  `suffix` varchar(255) NOT NULL DEFAULT 'none',
  `alias` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL DEFAULT 'none',
  `civil_status` varchar(36) NOT NULL DEFAULT 'none',
  `religion` varchar(36) NOT NULL DEFAULT 'none',
  `nationality` varchar(255) NOT NULL DEFAULT 'none',
  `contact_number` varchar(69) NOT NULL DEFAULT 'none',
  `email_address` varchar(255) NOT NULL DEFAULT 'none',
  `address` varchar(255) NOT NULL DEFAULT 'none',
  `birth_date` varchar(255) NOT NULL DEFAULT 'none',
  `birth_place` varchar(255) NOT NULL DEFAULT 'none',
  `municipality` varchar(69) NOT NULL DEFAULT 'none',
  `zip` varchar(69) NOT NULL DEFAULT 'none',
  `barangay` varchar(69) NOT NULL DEFAULT 'none',
  `house_number` varchar(69) NOT NULL DEFAULT 'none',
  `street` varchar(69) NOT NULL DEFAULT 'none',
  `fathers_name` varchar(255) NOT NULL DEFAULT 'none',
  `mothers_name` varchar(255) NOT NULL DEFAULT 'none',
  `guardian` varchar(69) NOT NULL DEFAULT 'none',
  `guardian_contact` varchar(69) NOT NULL DEFAULT 'none',
  `occupation` varchar(255) NOT NULL,
  `employer_name` varchar(255) NOT NULL,
  `family_relation` varchar(255) NOT NULL,
  `national_number` varchar(255) NOT NULL,
  `sss_number` varchar(255) NOT NULL,
  `tin_number` varchar(255) NOT NULL,
  `gsis_number` varchar(255) NOT NULL,
  `pagibig_number` varchar(255) NOT NULL,
  `philhealth_number` varchar(255) NOT NULL,
  `bloodtype` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL DEFAULT 'none',
  `image_path` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `a_` (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `residence_information` VALUES (182,49786338683746,"awdjhwaj","wajdhawhdjk","wajdawdwaj","","jwahkhaw","","Male","Single","awjdkla","nwajkdnwa",12389210831,"WHahw@gmail.com","wadjlkawl","2025-09-10","jdkawwakj","jdwlakdjalk",121312,"dajkjawjd","wadjklawj","wkaljwdalk","","","","","","","","","","","","","","","",""),
(183,48223779709266,"dwakjdwa","wakldjlawdk","awdjlawdjlwak","","dwakwald","","Male","Married","dwajdawlj","dwanklawnkwa","","","","2025-09-03","dwakljdwa","","","","","","","","","","","","","","","","","","","","",""),
(184,63572011649247,"tingson","emerald","nana","","","","Male","Single","catholic","filipino","","","","2025-09-11","","","","","","","","","","","","","","","","","","","","","",""),
(185,62220181424620,"","","","","","","Male","Single","","","","","","2025-09-23","","","","","","","","","","","","","","","","","","","","","",""),
(186,2855307104181,"eula","","tingson",0,"","","Male","Single","","",09090909090,"","123 bisig","2025-09-02"," manila","","","","","","","","","","","","","","","","","","","","",""),
(187,46337153140937,"kim","","pore","","","","Male","Single","","","","","","2025-09-08","","","","","","","","","","","","","","","","","","","","","",""),
(188,20555304446479,"eula","","tingson","","","","Male","Single","","","","","","2025-09-04","manila","","","","","","","","","","","","","","","","","","","","","");


DROP TABLE IF EXISTS `residence_status`;

CREATE TABLE `residence_status` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `residence_id` varchar(255) NOT NULL,
  `status` varchar(69) NOT NULL DEFAULT 'none',
  `is_approved` varchar(255) NOT NULL,
  `voters` varchar(69) NOT NULL DEFAULT 'none',
  `pwd` varchar(69) NOT NULL DEFAULT 'none',
  `pwd_info` varchar(255) NOT NULL DEFAULT 'none',
  `senior` varchar(69) NOT NULL DEFAULT 'none',
  `single_parent` varchar(69) NOT NULL DEFAULT 'none',
  `wra` varchar(255) NOT NULL,
  `4ps` varchar(255) NOT NULL,
  `purok_id` varchar(255) NOT NULL,
  `precint_id` varchar(255) NOT NULL,
  `archive` varchar(69) NOT NULL DEFAULT 'none',
  `date_added` varchar(69) NOT NULL DEFAULT 'none',
  `date_archive` varchar(69) NOT NULL DEFAULT 'none',
  `date_unarchive` varchar(69) NOT NULL DEFAULT 'none',
  UNIQUE KEY `a_i` (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=189 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `residence_status` VALUES (182,49786338683746,"ACTIVE","","YES","NO","","NO","YES","","","","","NO","09/08/2025 05:38 PM","none","none"),
(183,48223779709266,"ACTIVE","","YES","NO","","NO","NO","","","","","NO","09/08/2025 05:40 PM","none","none"),
(184,63572011649247,"INACTIVE","","YES","NO","","NO","NO","","","","","YES","09/10/2025 07:35 PM","09/14/2025 12:14 PM","none"),
(185,62220181424620,"INACTIVE","","YES","YES","","NO","NO","","","","","YES","09/10/2025 07:40 PM","09/14/2025 12:14 PM","09/14/2025 12:12 PM"),
(186,2855307104181,"ACTIVE","","YES","NO","","NO","YES","","","","","NO","09/14/2025 05:29 PM","none","none"),
(187,46337153140937,"ACTIVE","","YES","YES","blind","NO","YES","","","","","NO","09/14/2025 05:50 PM","none","none"),
(188,20555304446479,"ACTIVE","","NO","NO","","NO","NO","","","","","NO","09/14/2025 05:53 PM","none","none");


DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `id` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL DEFAULT 'none',
  `middle_name` varchar(255) NOT NULL DEFAULT 'none',
  `last_name` varchar(255) NOT NULL DEFAULT 'none',
  `username` varchar(255) NOT NULL DEFAULT 'none',
  `password` varchar(255) NOT NULL DEFAULT 'none',
  `user_type` varchar(255) NOT NULL DEFAULT 'none',
  `contact_number` varchar(255) NOT NULL DEFAULT 'none',
  `image` varchar(255) NOT NULL DEFAULT 'none',
  `image_path` varchar(255) NOT NULL DEFAULT 'none',
  UNIQUE KEY `a_i` (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` VALUES (52,1506135735699,"Admin","Admin","Admin","admin123","admin123","admin",11111111111,"182708071361a0f053c94fb.png","../assets/dist/img/182708071361a0f053c94fb.png"),
(195,174668789044820710152022021619941,"Secretary","Secretary","Secretary","secretary123","secretary123","secretary",99999999999,"",""),
(205,49786338683746,"awdjhwaj","wajdhawhdjk","wajdawdwaj",49786338683746,09082025173840235,"resident",12389210831,"",""),
(206,48223779709266,"dwakjdwa","wakldjlawdk","awdjlawdjlwak","emerald2025",12345678919,"resident","","",""),
(207,63572011649247,"tingson","emerald","nana","","","resident","","",""),
(209,2855307104181,"eula","","tingson","tingson123","emeraldmaja","resident",09090909090,"",""),
(210,184323227961722209142025174804253,"angelica","","espinosa","espinosa",123456,"secretary",98988984445,"",""),
(211,46337153140937,"kim","","pore","kimpore@#123","kimpore!@#$%","resident","","",""),
(212,20555304446479,"eula","","tingson","kimpore@#","kimpore!@#$","resident","","","");


DROP TABLE IF EXISTS `vaccine`;

CREATE TABLE `vaccine` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `vaccine_id` varchar(255) NOT NULL,
  `residence_id` varchar(255) NOT NULL,
  `vaccine` varchar(255) NOT NULL,
  `second_vaccine` varchar(255) NOT NULL,
  `first_dose_date` varchar(255) NOT NULL,
  `second_dose_date` varchar(255) NOT NULL,
  `booster` varchar(255) NOT NULL,
  `booster_date` varchar(255) NOT NULL,
  `second_booster` varchar(255) NOT NULL,
  `second_booster_date` varchar(255) NOT NULL,
  PRIMARY KEY (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `vaccine` VALUES (35,3267818051106726,16455182440138,"first","second","2022-10-01","2022-10-02","first b","2022-10-03","second b","2022-10-04"),
(36,9517807083807772,54278971251733,"first","second","2022-10-01","2022-10-02","first b","2022-10-03","second b","2022-10-04");


DROP TABLE IF EXISTS `wra`;

CREATE TABLE `wra` (
  `a_i` int(11) NOT NULL AUTO_INCREMENT,
  `resident_id` varchar(255) NOT NULL,
  `nhts` varchar(255) NOT NULL,
  `pregnant` varchar(255) NOT NULL,
  `menopause` varchar(255) NOT NULL,
  `achieving` varchar(255) NOT NULL,
  `ofw` varchar(255) NOT NULL,
  `fp_method` varchar(255) NOT NULL,
  `desire_limit` varchar(255) NOT NULL,
  `desire_space` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  PRIMARY KEY (`a_i`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `wra` VALUES (62,16455182440138,"NTHS","YES","YES","YES","YES","FP Method","YES","YES",""),
(63,54278971251733,"NTHS","YES","YES","YES","YES","FP Method","YES","YES","");


SET foreign_key_checks = 1;
