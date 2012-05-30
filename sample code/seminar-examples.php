<?php
	/**
	*	This file is an example of how to use the Freestone API by Peach New Media.
	*
	*	This particular example deals with Seminars. 
	* 	Seminars are the top level representation of a course.
	*	
	*	@copyright 2012 Peach New Media
	*/

	// We must include the FreestoneAPI class. This class performs the API calls for us.	
	include("../classes/FreestoneAPI.php")

	// Create a new FreestoneAPI object. We will use this object to call our API functions.
	$api = new FreestoneAPI();

	
	/****************************************************************************************
	* Example 1: Seminar Search | (GET /)
	****************************************************************************************/
	$call = $api->get("seminars");
	print_r ($call);		// will print a list of all your seminars

	
	
	/****************************************************************************************
	* Example 2: Get a seminar's details | (GET /:id) | (GET /:id/:associated)
	****************************************************************************************/
	$seminarID = 321;
	
	// This call will return the information for seminar #321
	$call = $api->get("products/" . $seminarID);
	print_r ($call);
	
	// This call will return the information for seminar #321 as well as Topic and Product details
	$call = $api->get("products/" . $seminarID . "/[topics,products]");
	print_r ($call);
	
	
	
?>