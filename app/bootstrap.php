<?php
	// Load Config 
	require_once 'config/config.php';
	
	require_once 'helpers/url_helper.php';

	// Auto Load Core Libraries
	spl_autoload_register(function($className) {
		require "libraries/" . $className . ".php";
	});