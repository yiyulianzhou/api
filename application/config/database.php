<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
	'dsn'	   => 'mysql:host=10.10.10.205;port=3306;dbname=block',
	'hostname' => '10.10.10.205',
	'username' => 'root',
	'password' => 'ccit132456',
	'database' => 'block',
	'dbdriver' => 'pdo',
	'dbprefix' => 'block_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);