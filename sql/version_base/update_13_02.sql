ALTER TABLE `activities` DROP `type`;
ALTER TABLE `activities`  ADD `type` ENUM('SPORTIF','INTELLECTUELLE') NOT NULL  AFTER `description`;
ALTER TABLE `activities`  ADD `mustBeReserved` tinyint(1) NOT NULL  AFTER `prix`;
ALTER TABLE `users` CHANGE `code` `code` VARCHAR(4) NULL; -- En effet imaginons le code 0023, en int cela ferait 23... 