--
-- Creating a User table and inserting example users.
-- Create a database and a user having access to this database,
-- this must be done by hand, se commented rows on how to do it.
--



--
-- Create a database for test
--
-- DROP DATABASE anaxdb;
-- CREATE DATABASE IF NOT EXISTS anaxdb;
USE olen16;



--
-- Create a database user for the test database
--
-- GRANT ALL ON anaxdb.* TO anax@localhost IDENTIFIED BY 'anax';



-- Ensure UTF8 on the database connection
SET NAMES utf8;

DROP TABLE IF EXISTS Comment;
DROP TABLE IF EXISTS User;

--
-- Table User
--
CREATE TABLE User (
    `id` 		INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `role`		VARCHAR(20) NOT NULL DEFAULT 'user',
    `username`	VARCHAR(80) UNIQUE NOT NULL,
    `email`		VARCHAR(255) UNIQUE NOT NULL,
    `password`	VARCHAR(255) NOT NULL,
    `created`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted`	DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;


CREATE TABLE Comment (
    `id` 		INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `userId`	INTEGER NOT NULL,
    `content`	TEXT NOT NULL,
    `created`	TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (`userId`) REFERENCES User(`id`) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;


INSERT INTO User(role, username, email, password) VALUES
('admin', 'admin', 'admin@admin.com', '$2y$10$Njbsb6l8TCLdvHUcS/65IOcEVARQGICBYqDqx8843aPgpVdlYedrC'),
('user', 'doe', 'user@user.com', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq');

INSERT INTO Comment(userId, content) VALUES(1, '#Första kommentaren\n##Markdown ska fungera i kommentarerna.');
INSERT INTO Comment(userId, content) VALUES(2, '#Andra kommentaren\n##Markdown ska fungera i kommentarerna.\n\n och länkar: https://google.com');

SELECT * FROM User;
SELECT * FROM Comment;
