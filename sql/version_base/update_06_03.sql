ALTER TABLE `equipe_membres` DROP FOREIGN KEY `equipe_membres_ibfk_1`; ALTER TABLE `equipe_membres` ADD CONSTRAINT `equipe_membres_ibfk_1` FOREIGN KEY (`idEquipe`) REFERENCES `equipe`(`id`) ON DELETE CASCADE ON UPDATE RESTRICT;
ALTER TABLE `reservation` CHANGE `idEquipe` `idEquipe` INT(255) NULL DEFAULT '0';
ALTER TABLE `partenaire` ADD `idUser` INT(255) NOT NULL AFTER `id`, ADD INDEX (`idUser`);
ALTER TABLE `partenaire` ADD FOREIGN KEY (`idUser`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
ALTER TABLE `lieu_commun` ADD `debutReservation` INT(255) NOT NULL DEFAULT '0';
ALTER TABLE `lieu_commun` ADD `finReservation` INT(255) NOT NULL DEFAULT '0';