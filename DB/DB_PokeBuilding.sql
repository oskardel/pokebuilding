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
    `userLevel` INT,
    `token` VARCHAR(9)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `teams` (
    `id` INT NOT NULL,
    `teamName` VARCHAR(30),
    `pokemon1` VARCHAR(25),
    `pokemon2` VARCHAR(25),
    `pokemon3` VARCHAR(25),
    `pokemon4` VARCHAR(25),
    `pokemon5` VARCHAR(25),
    `pokemon6` VARCHAR(25),
    `votes` INT NOT NULL,
    `votedBy` VARCHAR(20),
    `userId` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users`(`id`, `username`, `cryptPassword`, `mail`, `teams`, `userLevel`) VALUES (1, 'root', '$2a$07$usesomesillystringforehg0dedj7L/iujhXGa/PYA4EZKm/yiEW', 'root@gmail.com', '0', '2');

/*Adding primary keys to the tables*/
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
    MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

ALTER TABLE `teams`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `teams`
    MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;