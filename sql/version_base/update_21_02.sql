ALTER TABLE `users` DROP ` access_level `;
ALTER TABLE `users` ADD `access_level` ENUM('CLIENT','ANIMATEUR','TECHNICIEN','PATRON','PARTENAIRE') NOT NULL DEFAULT 'CLIENT' AFTER `infoId`;
ALTER TABLE `activities` ADD `debutReservation` INT(255) NOT NULL AFTER `capaciteMax`, ADD `finReservation` INT(255) NOT NULL AFTER `debutReservation`, ADD `photos` TEXT NOT NULL AFTER `finReservation`;
ALTER TABLE `problemes_technique` ADD `photos` TEXT NOT NULL AFTER `isBungalow`;
ALTER TABLE `partenaire` ADD `photos` TEXT NOT NULL AFTER `telephone`;
ALTER TABLE `lieu_commun` ADD `photos` TEXT NOT NULL AFTER `description`;
ALTER TABLE `activities` DROP index idDirigeant;
ALTER TABLE `activities` ADD index `idDirigeant` (`idDirigeant`);