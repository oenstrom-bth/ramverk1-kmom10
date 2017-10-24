Stack Underflow
==================================

[![Build Status](https://travis-ci.org/oenstrom/ramverk1-kmom10.svg?branch=master)](https://travis-ci.org/oenstrom/ramverk1-kmom10)
[![Build Status](https://scrutinizer-ci.com/g/oenstrom/ramverk1-kmom10/badges/build.png?b=master)](https://scrutinizer-ci.com/g/oenstrom/ramverk1-kmom10/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/oenstrom/ramverk1-kmom10/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/oenstrom/ramverk1-kmom10/?branch=master)

A Stack Overflow copy. (Assignment kmom10 in the course "[ramverk1](https://dbwebb.se/kurser/ramverk1/kmom10)" at BTH)


Install
------------------

### Clone the repo

Clone the repo.

```
git clone https://github.com/oenstrom/ramverk1-kmom10.git
```


### Install with Composer

Install all dependencies with composer.
```
composer install
```


### Writeable Cache dir

Make sure the web server can write to the directory "cache/cimage". Otherwise the images won't work.


### Setup database

Execute the SQL-file `sql/setup.sql` to create all tables and content. Make sure to do it on the correct database.

Now rename the file `database_mysql.php` to `database.php`, which is located in the config directory. After that, update it with settings and credentials for your MySQL server.



License
------------------
This software carries a MIT license.


```

  Copyright (c) 2017 Olof Enström (olof.enstrom@gmail.com)

```
