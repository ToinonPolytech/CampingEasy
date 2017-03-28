ALTER TABLE `lieu_commun` DROP ` finReservation `;
ALTER TABLE `lieu_commun` CHANGE `debutReservation` `estReservable` BOOLEAN NOT NULL;
ALTER TABLE `lieu_commun` ADD `timeReservation` TEXT NOT NULL AFTER `is_reservable`;