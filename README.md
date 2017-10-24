Stack Underflow
==================================

[![Build Status](https://travis-ci.org/oenstrom/ramverk1-kmom10.svg?branch=master)](https://travis-ci.org/oenstrom/ramverk1-kmom10)
[![Build Status](https://scrutinizer-ci.com/g/oenstrom/ramverk1-kmom10/badges/build.png?b=master)](https://scrutinizer-ci.com/g/oenstrom/ramverk1-kmom10/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/oenstrom/ramverk1-kmom10/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/oenstrom/ramverk1-kmom10/?branch=master)

A Stack Overflow copy. (Assignment kmom10 in the course "[ramverk1](https://dbwebb.se/kurser/ramverk1/kmom10)" at BTH)


Install
------------------

### Clone the repo

First clone the repo.

```
git clone https://github.com/oenstrom/ramverk1-kmom10.git
```


### Install with Composer

Second install dependencies with composer.
```
composer install
```


### Setup database
THIS IS NOT CORRECT. UPDATE COMING!
Execute the SQL-file `sql/setup.sql` to create a new database called `anaxuser` and a new table with two users:
`admin:admin` and `doe:doe`
If you already have a database, just edit the SQL-file or use the SQL code below.
```
CREATE TABLE User (
    `id`        INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `role`      VARCHAR(20) NOT NULL DEFAULT 'user',
    `username`  VARCHAR(80) UNIQUE NOT NULL,
    `email`     VARCHAR(255) UNIQUE NOT NULL,
    `password`  VARCHAR(255) NOT NULL,
    `created`   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `deleted`   DATETIME
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;

INSERT INTO User(role, username, email, password) VALUES
('admin', 'admin', 'admin@admin.com', '$2y$10$Njbsb6l8TCLdvHUcS/65IOcEVARQGICBYqDqx8843aPgpVdlYedrC'),
('user', 'doe', 'user@user.com', '$2y$10$26KgRWjs3F654.yHpsYYDO4sd86ksNN1E8zpQ2yHMA/yx33tV/ACq');
```
Now update the file `config/database.php` with settings and credentials for your SQL server.



License
------------------
This software carries a MIT license.


```

  Copyright (c) 2017 Olof Enström (olof.enstrom@gmail.com)

```
