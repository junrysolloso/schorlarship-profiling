DROP TABLE applied_info;

CREATE TABLE `applied_info` (
  `ApId` int(11) NOT NULL AUTO_INCREMENT,
  `DateApplied` date NOT NULL,
  PRIMARY KEY (`ApId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO applied_info VALUES("1","2017-02-03");
INSERT INTO applied_info VALUES("2","2018-02-05");
INSERT INTO applied_info VALUES("3","2018-04-23");
INSERT INTO applied_info VALUES("4","2015-03-04");
INSERT INTO applied_info VALUES("5","2018-02-03");



DROP TABLE course_info;

CREATE TABLE `course_info` (
  `CoId` int(11) NOT NULL AUTO_INCREMENT,
  `Course` varchar(20) NOT NULL,
  `Description` varchar(128) NOT NULL,
  PRIMARY KEY (`CoId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO educ_info VALUES("1","San Roque Elementary School","Del Pilar National High School","2008-2009","2013-2014");
INSERT INTO educ_info VALUES("2","Aurelio Elmentary School","Aurelion National High School","2007-2008","2011-2012");
INSERT INTO educ_info VALUES("3","Del Pilar Elementary School","Del Pilar National High School","2007-2008","2011-2012");
INSERT INTO educ_info VALUES("4","Del Pilar National High School","Del Pilar National High School","2008-2009","2011-2012");
INSERT INTO educ_info VALUES("5","Del Pilar Elementary School","Del Pilar National High School","2008-2009","2011-2012");



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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO enroll_info VALUES("1","BSIT","4th Year","2018-2019","NO","","");
INSERT INTO enroll_info VALUES("2","BSIT","1st Year","2018-2019","YES","2018-22-12","Just example. ");
INSERT INTO enroll_info VALUES("3","BSIT","2nd Year","2018-2019","YES","2018-22-12","Just example");
INSERT INTO enroll_info VALUES("4","BSIT","2nd Year","2018-2019","NO","","");
INSERT INTO enroll_info VALUES("5","Select Program","1st Year","2018-2019","NO","","");



DROP TABLE parent_info;

CREATE TABLE `parent_info` (
  `PaId` int(11) NOT NULL AUTO_INCREMENT,
  `ParentName` varchar(128) NOT NULL,
  `ParentPhone` int(11) NOT NULL,
  `Municipality` varchar(50) NOT NULL,
  PRIMARY KEY (`PaId`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO parent_info VALUES("1","Josephine Solloso","909090","Cagdianao");
INSERT INTO parent_info VALUES("2","Josephine Solloso","909090","Select Municipality");
INSERT INTO parent_info VALUES("3","Josephine Solloso","909090","San Jose");
INSERT INTO parent_info VALUES("4","Josephine Solloso","909090","San Jose");
INSERT INTO parent_info VALUES("5","Josephine Solloso","909090","Cagdianao");



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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO student_info VALUES("1","c-2020-2019","Junry","Solloso","S","1994-06-20","Male","Single","Aurelio, San Jose, Dinagat Islands","sollosoj@gmail.com","909090909","2x2.jpg");
INSERT INTO student_info VALUES("2","c-2020-2013","Ellen Gayl","Sabubo","S","1993-02-01","Female","Single","Aurelio, San Jose, Dinagat Islands","sollosoj@gmail.com","909090909","images (5).jpg");
INSERT INTO student_info VALUES("3","c-2020-20143","Erick","Solloso","S","1994-02-06","Male","Single","Aurelio, San Jose, Dinagat Islands","sollosoj@gmail.com","909090909","images (7).jpg");
INSERT INTO student_info VALUES("4","c-2020-2078","Jhon","Solloso","S","1994-06-20","Male","Single","Aurelio, San Jose, Dinagat Islands","sollosoj@gmail.com","909090909","images (15).jpg");
INSERT INTO student_info VALUES("5","c-2020-2062","Jerick","Solloso","S","1994-02-06","Male","Single","Del Pilar Cagdiano, Dinagat Islands ","sollosoj@gmail.com","909090909","images (7).jpg");



DROP TABLE user_info;

CREATE TABLE `user_info` (
  `UserId` int(11) NOT NULL AUTO_INCREMENT,
  `UserName` varchar(50) NOT NULL,
  `UserPass` varchar(255) NOT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO user_info VALUES("1","syrnuj","21232f297a57a5a743894a0e4a801fc3");
INSERT INTO user_info VALUES("2","user","ee11cbb19052e40b07aac0ca060c23ee");



