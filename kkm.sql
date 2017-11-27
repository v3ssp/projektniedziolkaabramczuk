CREATE TABLE `uzytkownicy` (
	`id` int NOT NULL AUTO_INCREMENT,
	`imie` tinytext NOT NULL,
	`nazwisko` tinytext NOT NULL,
	`login` tinytext NOT NULL,
	`haslo` tinytext NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `wiadomosci` (
	`id` int NOT NULL AUTO_INCREMENT,
	`idNadawcy` int NOT NULL,
	`idOdbiorcy` int NOT NULL,
	`tresc` TEXT NOT NULL,
	`data` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `aukcje` (
	`id` int NOT NULL AUTO_INCREMENT,
	`idRodzaju` int NOT NULL,
	`idUzytkownika` int NOT NULL,
	`idWygrywajacego` int NOT NULL,
	`nazwa` tinytext NOT NULL,
	`opis` tinytext NOT NULL,
	`cena` FLOAT NOT NULL,
	`minimalnaCena` FLOAT,
	`zmianaCeny` FLOAT,
	`aktywne` bool NOT NULL,
	`doKiedy` DATE NOT NULL,
	`zdjecie` tinytext NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `rodzaje` (
	`id` int NOT NULL AUTO_INCREMENT,
	`nazwa` tinytext NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `wiadomosci` ADD CONSTRAINT `wiadomosci_fk0` FOREIGN KEY (`idNadawcy`) REFERENCES `uzytkownicy`(`id`);

ALTER TABLE `wiadomosci` ADD CONSTRAINT `wiadomosci_fk1` FOREIGN KEY (`idOdbiorcy`) REFERENCES `uzytkownicy`(`id`);

ALTER TABLE `aukcje` ADD CONSTRAINT `aukcje_fk0` FOREIGN KEY (`idRodzaju`) REFERENCES `rodzaje`(`id`);

ALTER TABLE `aukcje` ADD CONSTRAINT `aukcje_fk1` FOREIGN KEY (`idUzytkownika`) REFERENCES `uzytkownicy`(`id`);

ALTER TABLE `aukcje` ADD CONSTRAINT `aukcje_fk2` FOREIGN KEY (`idWygrywajacego`) REFERENCES `uzytkownicy`(`id`);
