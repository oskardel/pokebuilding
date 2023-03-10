SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `DB_PokeBuilding` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `DB_PokeBuilding`;

CREATE TABLE `users` (
    `id` INT(10) NOT NULL,
    `username` VARCHAR(25) NOT NULL,
    `cryptPassword` VARCHAR(72) NOT NULL,
    `mail` VARCHAR(50) NOT NULL,
    `teams` INT,
    `level` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `teams` (
    `teamId` INT NOT NULL,
    `pokemon1` VARCHAR(15),
    `pokemon2` VARCHAR(15),
    `pokemon3` VARCHAR(15),
    `pokemon4` VARCHAR(15),
    `pokemon5` VARCHAR(15),
    `pokemon6` VARCHAR(15),
    `userId` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users`(`id`, `username`, `cryptPassword`, `mail`, `teams`, `level`) VALUES (`1`, `root`, `$2a$07$usesomesillystringforehg0dedj7L/iujhXGa/PYA4EZKm/yiEW`, `root@gmail.com`, `0`, `2`);


/*Adding primary keys to the tables*/
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
    MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

ALTER TABLE `teams`
    ADD PRIMARY KEY (`teamId`);