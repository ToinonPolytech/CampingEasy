ALTER TABLE `activities` CHANGE `type` `type` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL;
ALTER TABLE activities DROP ageMin, DROP ageMax;