<?php
/**
 * RockMongo startup
 *
 * In here we define some default settings and start the configuration files
 * @package rockmongo
 */

/**
* Defining version number and enabling error reporting
*/
define("ROCK_MONGO_VERSION", "1.1.1");

error_reporting(E_ALL);

/**
* Environment detection
*/
if (!version_compare(PHP_VERSION, "5.0")) {
	exit("To make things right, you must install PHP5");
}
if (!class_exists("Mongo")) {
	exit("To make things right, you must install php_mongo module. <a href=\"http://www.php.net/manual/en/mongo.installation.php\" target=\"_blank\">Here for installation documents on PHP.net.</a>");
}

/**
* Initializing configuration files and RockMongo
*/
require "config.php";
require "rock.php";
rock_check_version();
rock_init_lang();
rock_init_plugins();
Rock::start();

?>