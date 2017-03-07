ALTER TABLE `reservation` CHANGE `idActivite` `id` INT(255) NOT NULL;
ALTER TABLE `reservation` ADD `type` ENUM('ACTIVITE','RESTAURANT','ETAT_LIEUX','LIEU_COMMUN','') NOT NULL DEFAULT 'ACTIVITE' AFTER `id`;
ALTER TABLE reservation DROP FOREIGN KEY reservation_ibfk_1;
ALTER TABLE `campingeasy`.`reservation` DROP PRIMARY KEY, ADD PRIMARY KEY (`id`, `idUser`, `type`) USING BTREE;
ALTER TABLE `reservation` ADD `time` INT(255) NOT NULL DEFAULT '0' AFTER `idUser`;