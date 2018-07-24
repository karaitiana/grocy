<?php

// This is executed inside DatabaseMigrationService class/context

$db = $this->DatabaseService->GetDbConnection();

if (defined('HTTP_USER'))
{
	// Migrate old user defined in config file to database
	$newUserRow = $db->users()->createRow(array(
		'username' => HTTP_USER,
		'password' => password_hash(HTTP_PASSWORD, PASSWORD_DEFAULT)
	));
	$newUserRow->save();
}
else
{
	// Create default user "admin" with password "admin"
	$newUserRow = $db->users()->createRow(array(
		'username' => 'admin',
		'password' => password_hash('admin', PASSWORD_DEFAULT)
	));
	$newUserRow->save();
}