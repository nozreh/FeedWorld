<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

switch (ENVIRONMENT)
	{
		case DEVELOPMENT:
			error_reporting(E_ALL);
			ini_set('display_errors', 1);
			$active_group = 'default';
			$db['default']['hostname'] = 'localhost';
			$db['default']['username'] = "admin";
			$db['default']['password'] = "password";
			$db['default']['database'] = "feedworld";
			$db['default']['dbdriver'] = 'mysql';
			$db['default']['dbprefix'] = 'fw_';
			$db['default']['pconnect'] = TRUE;
			$db['default']['db_debug'] = TRUE;
			$db['default']['cache_on'] = FALSE;
			$db['default']['cachedir'] = '';
			$db['default']['char_set'] = 'utf8';
			$db['default']['dbcollat'] = 'utf8_general_ci';
			$db['default']['swap_pre'] = '';
			$db['default']['autoinit'] = TRUE;
			$db['default']['stricton'] = FALSE;

		break;

		case STAGING:
		case PRODUCTION:
			$active_group = 'default';
			$services_json = json_decode(getenv("VCAP_SERVICES"),true);
			$mysql_config = $services_json["mysql-5.1"][0]["credentials"];
			
			$db['default']['hostname'] = $mysql_config["hostname"];
			$db['default']['username'] = $mysql_config["username"];
			$db['default']['password'] = $mysql_config["password"];
			$db['default']['database'] = $mysql_config["name"];
			$db['default']['dbdriver'] = 'mysql';
			$db['default']['dbprefix'] = 'fw_';
			$db['default']['active_r'] = TRUE;
			$db['default']['pconnect'] = FALSE;
			$db['default']['db_debug'] = TRUE;
			$db['default']['cache_on'] = FALSE;
			$db['default']['cachedir'] = '';
			$db['default']['char_set'] = 'utf8';
			$db['default']['dbcollat'] = 'utf8_general_ci';
		break;

		default:
			exit('The environment is not set correctly. ENVIRONMENT = '.ENVIRONMENT.'.');
	}


/* End of file database.php */
/* Location: ./application/config/database.php */