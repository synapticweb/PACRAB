<?php

function set_filter() {
	$post_data = Flight::request()->data->getData();
	if(!isset($post_data[FILTER]))
		die("No filter set!");

	session_start();
	if($post_data[FILTER] == REMOVE_FILTERING) 
		unset($_SESSION[FILTER]);
	else	
		$_SESSION[FILTER] = $post_data[FILTER];
	
	header("Location: http://" . $_SERVER['SERVER_NAME'] . "/");
	exit();
}