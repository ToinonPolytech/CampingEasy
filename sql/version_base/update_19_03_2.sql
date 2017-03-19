ALTER TABLE `restaurant` CHANGE `heureOuverture` `heureOuverture` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `restaurant` CHANGE `heureFermeture` `heureFermeture` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
ALTER TABLE `lieu_commun` CHANGE `debutReservation` `debutReservation` VARCHAR(255) NOT NULL;
ALTER TABLE `lieu_commun` CHANGE `finReservation` `finReservation` VARCHAR(255) NOT NULL;