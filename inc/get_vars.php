<?php

//Need to make this run a query to get dev names based on location provided...
if (isset($_POST['qs_town'])) {
	$qs_town = $_POST['qs_town'];
} else {
	$qs_town = null;
}

if (isset($_POST['qs_rooms'])) {
	$qs_rooms = $_POST['qs_rooms'];
} else {
	$qs_rooms = null;
}

// GET SEARCH VARS
if (isset($_GET['devlocation'])) {
	$devlocation = $_GET['devlocation'];
} else {
	$devlocation = null;
}

if (isset($_GET['location'])) {
	$location = $_GET['location'];
} else {
	$location = null;
}

if (isset($_GET['bedrooms'])) {
	$bedrooms = $_GET['bedrooms'];
} else {
	$bedrooms = null;
}

if (isset($_GET['maxprice'])) {
	$maxprice = $_GET['maxprice'];
} else {
	$maxprice = 900000;
}

if (isset($_GET['minprice'])) {
	$minprice = $_GET['minprice'];
} else {
	$minprice = 0;
}