[![Scrutinizer Quality Score](https://scrutinizer-ci.com/g/EVE-KILL/projectRena/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/EVE-KILL/projectRena/)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/75374b67-bb51-4b3f-b00a-b14ea811058f/big.png)](https://insight.sensiolabs.com/projects/75374b67-bb51-4b3f-b00a-b14ea811058f)

# Documentation
_http://eve-kill.github.io/projectRena/api/_

# Project Rena
ProjectRena is a complete from the ground up rewrite of the backend for EVSCO/EVE-KILL

# WARNING
Project Rena is in development and shouldn't be used by anyone!
If you do use it, then good luck to you! ;)

# Contact
`#esc-dev` on `irc.coldfront.net`
_http://chat.mibbit.com/?channel=%23esc-dev&server=irc.coldfront.net_

# LICENSE
MIT, check LICENSE for more information

# Requirements
- PHP 5.6 / HHVM 3.*
- Nginx
- Linux
- MariaDB 10+ with TokuDB
- Composer
- cURL and PHP5-cURL
- Redis and PHP5-Redis

# Installation
1. Clone to a directory of your choice
2. Setup Nginx to point at the public/ dir
3. Install vendor files with composer
4. Copy config_new.php to config.php under config/
5. Edit config.php with database information and so forth
6. Run update with: php Rena update
7. Setup migrations: php Rena init
8. Edit phinx.yml with database information
9. Run database migration: php Rena migrate
10. Setup supervisor with scripts from external
11. Install Stomp (extract pecl.tar ```run phpize && ./configure && make && make install``` then create ```/etc/php5/cli/conf.d/20-stomp.ini``` with ```extension=stomp.so``` inside) 
12. Enjoy