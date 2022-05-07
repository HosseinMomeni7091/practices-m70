<?php

// Table creation
// -----------------------------------------------------------------------
CREAT DATABASE `HW12INDEX1`;
USE `HW12INDEX1`;
CREATE TABLE `Branches` (
    `Branch_ID` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(255) NOT NULL,
    `City` VARCHAR(255) NOT NULL,
    `Date of Foundation` DATE,
    PRIMARY KEY (`Branch_ID`)
  );
  
  CREATE TABLE `Departments` (
    `Department_ID` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(255) NOT NULL,
    `Brief` VARCHAR(255) NOT NULL,
    `Branch_ID` INT,
    PRIMARY KEY (`Department_ID`),
    FOREIGN KEY (`Branch_ID`) REFERENCES `Branches`(`Branch_ID`)
  );
  
  CREATE TABLE `Staffs` (
    `Personal_ID` INT NOT NULL AUTO_INCREMENT,
    `Name` VARCHAR(255) NOT NULL,
    `Age` INT NOT NULL,
    `Salary` INT NOT NULL,
    `Dep_ID` INT,
    PRIMARY KEY (`Personal_ID`),
    FOREIGN KEY (`Dep_ID`) REFERENCES `Departments`(`Department_ID`)
  );
  


// Requested Queries
// -----------------------------------------------------------------------
// 1--------------------------------------
SELECT `NAME` 
FROM `STAFFS` 
WHERE `SALARY`<1000;

// 2------`--------------------------------
SELECT 
`STAFFS`.`NAME`,
`DEPARTMENTS`.`NAME` 

FROM `STAFFS` 
JOIN `DEPARTMENTS` 
ON `STAFFS`.`DEP_ID`=`DEPARTMENTS`.`DEPARTMENT_ID`;

// 3------`--------------------------------
SELECT 
`DEPARTMENTS`.`DEPARTMENT_ID`,
`DEPARTMENTS`.`NAME`,
AVG(`STAFFS`.`SALARY`) 

FROM `STAFFS` 
JOIN `DEPARTMENTS` 
ON `STAFFS`.`DEP_ID`=`DEPARTMENTS`.`DEPARTMENT_ID` 
GROUP BY `DEPARTMENTS`.`DEPARTMENT_ID`;

// 4------`--------------------------------
SELECT 
`DEPARTMENTS`.`NAME`
FROM `BRANCHES`
JOIN `DEPARTMENTS`
ON `BRANCHES`.`BRANCH_ID`=`DEPARTMENTS`.`BRANCH_ID` 
WHERE `BRANCHES`.`NAME`="ESFAHAN";

// 5------`--------------------------------
SELECT 
`BRANCHES`.`NAME`,
COUNT(`DEPARTMENTS`.`DEPARTMENT_ID`) 
FROM `BRANCHES` 
JOIN `DEPARTMENTS` 
ON `BRANCHES`.`BRANCH_ID`=`DEPARTMENTS`.`BRANCH_ID` 
GROUP BY `BRANCHES`.`BRANCH_ID`;

// 6------`--------------------------------
SELECT 
`STAFFS`.`NAME`,
`BRANCHES`.`NAME` 
FROM 
((`STAFFS` JOIN `DEPARTMENTS` ON `STAFFS`.`DEP_ID`=`DEPARTMENTS`.`DEPARTMENT_ID`) JOIN 
`BRANCHES` 
ON `BRANCHES`.`BRANCH_ID`=`DEPARTMENTS`.`BRANCH_ID`);



// 7------`--------------------------------
SELECT 
`BRANCHES`.`CITY`,
AVG(`STAFFS`.`SALARY`) 
FROM 
((`STAFFS` JOIN `DEPARTMENTS` ON `STAFFS`.`DEP_ID`=`DEPARTMENTS`.`DEPARTMENT_ID`) JOIN 
`BRANCHES` 
ON `BRANCHES`.`BRANCH_ID`=`DEPARTMENTS`.`BRANCH_ID`) 
GROUP BY `BRANCHES`.`CITY`
HAVING `BRANCHES`.`CITY`="ESFAHAN";

// 8------`--------------------------------
SELECT 
`BRANCHES`.`NAME`,
COUNT(`STAFFS`.`PERSONAL_ID`) 
FROM 
((`STAFFS` JOIN `DEPARTMENTS` ON `STAFFS`.`DEP_ID`=`DEPARTMENTS`.`DEPARTMENT_ID`) JOIN 
`BRANCHES` 
ON `BRANCHES`.`BRANCH_ID`=`DEPARTMENTS`.`BRANCH_ID`) 
GROUP BY `BRANCHES`.`NAME`;

// 9------`--------------------------------
SELECT 
`BRANCHES`.`NAME`,
`DEPARTMENTS`.`NAME`,
COUNT(`STAFFS`.`PERSONAL_ID`) 
FROM 
((`DEPARTMENTS` LEFT JOIN `STAFFS`  ON `STAFFS`.`DEP_ID`=`DEPARTMENTS`.`DEPARTMENT_ID`) 
JOIN 
`BRANCHES` 
ON `BRANCHES`.`BRANCH_ID`=`DEPARTMENTS`.`BRANCH_ID`) 
GROUP BY `DEPARTMENTS`.`DEPARTMENT_ID`
HAVING `BRANCHES`.`NAME`="ESFAHAN1";




// 10------`--------------------------------
SELECT 
`BRANCHES`.`NAME`,
COUNT(`STAFFS`.`PERSONAL_ID`) AS `TOTAL_PERSONAL`
FROM 
((`DEPARTMENTS` LEFT JOIN `STAFFS`  ON `STAFFS`.`DEP_ID`=`DEPARTMENTS`.`DEPARTMENT_ID`) 
RIGHT JOIN 
`BRANCHES` 
ON `BRANCHES`.`BRANCH_ID`=`DEPARTMENTS`.`BRANCH_ID`) 
GROUP BY `BRANCHES`.`BRANCH_ID`
HAVING `TOTAL_PERSONAL`<10;






