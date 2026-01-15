CREATE Database if not exists `Morningstar`
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;
USE `Morningstar`;

CREATE TABLE `Teacher` (
    `TeacherID` INT AUTO_INCREMENT,
    `Name` VARCHAR(255) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `Phone` VARCHAR(255) NOT NULL,
    `Subject` VARCHAR(255) NOT NULL,
    CONSTRAINT PK_teacher_id PRIMARY KEY(`TeacherID`)
);

CREATE TABLE `Student` (
    `StudentID` INT AUTO_INCREMENT,
    `Name` VARCHAR(255) NOT NULL,
    `Class` VARCHAR(255) NOT NULL,
    CONSTRAINT PK_student_id PRIMARY KEY(`StudentID`)
);

CREATE TABLE `Attendance` (
    `AttendanceID` INT AUTO_INCREMENT,
    `TeacherID` INT NOT NULL,
    `StudentID` INT NOT NULL,
    `Date` Date NOT NULL,
    `Status` VARCHAR(255) NOT NULL,
    CONSTRAINT PK_attendance_id PRIMARY KEY(`AttendanceID`),
    CONSTRAINT FK_teacher_id FOREIGN KEY(`TeacherID`) REFERENCES `Teacher`(`TeacherID`)       
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT FK_student_id FOREIGN KEY(`StudentID`)  REFERENCES `Student`(`StudentID`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE table `Progress` (
    `ProgressID` INT AUTO_INCREMENT,
    `StudentID` INT NOT NULL,
    `TeacherID` INT NOT NULL,
    `Date` Date NOT NULL,
    `Notes` Text NOT NULL,
    CONSTRAINT PK_progress_id PRIMARY KEY(`ProgressID`),
    CONSTRAINT FK_teacher_id_progress FOREIGN KEY(`TeacherID`) REFERENCES `Teacher`(`TeacherID`)       
        ON UPDATE CASCADE
        ON DELETE CASCADE,
    CONSTRAINT FK_student_id_progress FOREIGN KEY(`StudentID`)  REFERENCES `Student`(`StudentID`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE table `Admin` (
    `AdminID` INT AUTO_INCREMENT,
    `Name` VARCHAR(255) NOT NULL,
    `Email` VARCHAR(255) NOT NULL,
    `Role`  VARCHAR(255) NOT NULL,
    CONSTRAINT PK_admin_id PRIMARY KEY(`AdminID`)
);

CREATE table `Announcement` (
    `AnnouncementID` INT AUTO_INCREMENT,
    `AdminID` INT NOT NULL,
    `Title` VARCHAR(255) NOT NULL,
    `Content` Text NOT NULL,
    `PublishingDate`  DATETIME NOT NULL,
    CONSTRAINT PK_announcement_id PRIMARY KEY(`AnnouncementID`),
    CONSTRAINT FK_Admin_id FOREIGN KEY(`AdminID`) REFERENCES `Admin`(`AdminID`)
        ON UPDATE CASCADE
        ON DELETE CASCADE
);

CREATE TABLE `employee` (
    `employeeID` INT AUTO_INCREMENT,
    `firstName` VARCHAR(255) NOT NULL,
    `lastName` VARCHAR(255) NOT NULL,
    `username` VARCHAR(255) NOT NULL,
    `passwordd` VARCHAR(255) NOT NULL,
    CONSTRAINT PK_employee_id PRIMARY KEY(`employeeID`)
);





