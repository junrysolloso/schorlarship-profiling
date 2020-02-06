DROP TABLE applied_info;

CREATE TABLE `applied_info` (
  `ApId` int(11) NOT NULL AUTO_INCREMENT,
  `DateApplied` date NOT NULL,
  PRIMARY KEY (`ApId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE course_info;

CREATE TABLE `course_info` (
  `CoId` int(11) NOT NULL AUTO_INCREMENT,
  `Course` varchar(20) NOT NULL,
  `Description` varchar(128) NOT NULL,
  PRIMARY KEY (`CoId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO course_info VALUES("1","BSIT","Bachelor of Science in Information Technology");
INSERT INTO course_info VALUES("2","BSCRIM","Bachelor of Science in Criminology");
INSERT INTO course_info VALUES("3","BSBA","Bachelor of Science in Business Administration");
INSERT INTO course_info VALUES("4","BSED","Bachelor of Science in Secondary Education");
INSERT INTO course_info VALUES("5","BEED","Bachelor of Science in Elementary Education");
INSERT INTO course_info VALUES("6","AB","Bachelor of Arts");
INSERT INTO course_info VALUES("7","BSTM","Bachelor of Science in Tourism Management");
INSERT INTO course_info VALUES("8","BSHRM","Bachelor of Science in Hotel and Restaurant Management");



DROP TABLE educ_info;

CREATE TABLE `educ_info` (
  `EdId` int(11) NOT NULL AUTO_INCREMENT,
  `ElemComp` varchar(255) NOT NULL,
  `HighComp` varchar(255) NOT NULL,
  `ElemGrad` varchar(20) NOT NULL,
  `HighGrad` varchar(20) NOT NULL,
  PRIMARY KEY (`EdId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE enroll_info;

CREATE TABLE `enroll_info` (
  `EnId` int(11) NOT NULL AUTO_INCREMENT,
  `Course` varchar(20) NOT NULL,
  `YearLevel` varchar(20) NOT NULL,
  `AcademicYear` varchar(20) NOT NULL,
  `DropStatus` varchar(10) NOT NULL,
  `DropDate` varchar(20) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  PRIMARY KEY (`EnId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE parent_info;

CREATE TABLE `parent_info` (
  `PaId` int(11) NOT NULL AUTO_INCREMENT,
  `ParentName` varchar(128) NOT NULL,
  `ParentPhone` int(11) NOT NULL,
  `Municipality` varchar(50) NOT NULL,
  PRIMARY KEY (`PaId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE student_info;

CREATE TABLE `student_info` (
  `StId` int(11) NOT NULL AUTO_INCREMENT,
  `IdNumber` varchar(50) NOT NULL,
  `Fname` varchar(50) NOT NULL,
  `Lname` varchar(50) NOT NULL,
  `Mname` varchar(50) NOT NULL,
  `DateBirth` date NOT NULL,
  `Gender` varchar(20) NOT NULL,
  `CivilStatus` varchar(20) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `EmailAdd` varchar(20) NOT NULL,
  `PhoneNo` int(15) NOT NULL,
  `ProfilePic` varchar(128) NOT NULL,
  PRIMARY KEY (`StId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE user_info;

CREATE TABLE `user_info` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `UserPass` varchar(255) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO user_info VALUES("1","syrnuj","a41acc7effe601de1dc2099a4e2fdd7c");
INSERT INTO user_info VALUES("2","user","ab86a1e1ef70dff97959067b723c5c24");



