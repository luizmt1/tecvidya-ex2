<?php
if ($_SERVER['HTTP_HOST'] = "localhost")
{
	define("DB_HOST", "127.0.0.1");
	define("DB_NAME", "login");
	define("DB_USER", "root");
	define("DB_PASS", "root");
}
else
{
	define ('DB_HOST','us-cdbr-iron-east-03.cleardb.net');
	define ('DB_NAME','heroku_81f74f3c676e26e');
	define ('DB_USER','bc7ca4cf168d8f');
	define ('DB_PASS','086cca4f');
};