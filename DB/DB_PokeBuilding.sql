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
    `userLevel` INT
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `teams` (
    `id` INT NOT NULL,
    `pokemon1` INT,
    `pokemon2` INT,
    `pokemon3` INT,
    `pokemon4` INT,
    `pokemon5` INT,
    `pokemon6` INT,
    `userId` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pokemon` (
    `id` INT NOT NULL,
    `name` VARCHAR(15) NOT NULL,
    `type1` VARCHAR(8) NOT NULL,
    `type2` VARCHAR(8),
    `hp` INT NOT NULL,
    `speed` INT NOT NULL,
    `attack` INT NOT NULL,
    `defense` INT NOT NULL,
    `spAttack` INT NOT NULL,
    `spDefense` INT NOT NULL,
    `move1` INT NOT NULL,
    `move2` INT NOT NULL,
    `move3` INT NOT NULL,
    `move4` INT NOT NULL,
    `teamId` INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `moves` (
    `id` INT NOT NULL,
    `name` VARCHAR(35) NOT NULL,
    `type` VARCHAR(8) NOT NULL,
    `damage_class` VARCHAR(8) NOT NULL,
    `accurancy` INT NOT NULL,
    `power` INT NOT NULL,
    `pokemonId` INT NOT NULL 
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `users`(`id`, `username`, `cryptPassword`, `mail`, `teams`, `userLevel`) VALUES (1, 'root', '$2a$07$usesomesillystringforehg0dedj7L/iujhXGa/PYA4EZKm/yiEW', 'root@gmail.com', '0', '2');

/*Adding primary keys to the tables*/
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
    MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

ALTER TABLE `teams`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `pokemon`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `moves`
    ADD PRIMARY KEY (`id`);