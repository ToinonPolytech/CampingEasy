ALTER TABLE `activities` DROP `type`;
ALTER TABLE `activities`  ADD `type` ENUM('SPORTIF','INTELLECTUELLE') NOT NULL  AFTER `description`;
ALTER TABLE `activities`  ADD `mustBeReserved` tinyint(1) NOT NULL  AFTER `prix`;