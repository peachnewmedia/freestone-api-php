<?php
	/**
	*	This file is an example of how to use the Freestone API by Peach New Media.
	*
	*	This particular example deals with Topics. 
	* 	Topics are the constituent parts of a Seminar. Topics belong to Seminars. 
	*	There is also a special topic labeled as the Full Seminar topic.
	*	
	*	@copyright 2012 Peach New Media
	*/

	// We must include the FreestoneAPI class. This class performs the API calls for us.	
	include("../classes/FreestoneAPI.php")

	// Create a new FreestoneAPI object. We will use this object to call our API functions.
	$api = new FreestoneAPI();

	
	/****************************************************************************************
	* Example 1: Topic Search | (GET /)
	****************************************************************************************/
	$call = $api->get("topics");
	print_r ($call);		// will print an array of all your topics
	
	
	
	/****************************************************************************************
	* Example 1: Get a specific Topic's information | (GET /:id)
	****************************************************************************************/
	$topicID = 45678;		// sample product ID
	$call = $api->get("topics/" . $topicID);
	print_r ($call);		// will print out topic #45678's information 

	
	
	/****************************************************************************************
	* Example 2: Get Speaker information for a specific Topic | (GET /:id/speakers)
	****************************************************************************************/
	//method 1:
	$topicID = 45678;		// sample product ID
	$call = $api->get("topics/" . $topicID . "/speakers");
	print_r ($call);		// will print out an Array of Speaker Objects that belong to topic #45678 
	
	//method 2:
	$topicID = 45678;
	$call = $api->get("topics/" . $topicID);
	print_r ($call->speakers);
	
	
	
	/****************************************************************************************
	* Example 3: Get Tag information for a specific Topic | (GET /:id/tags
	****************************************************************************************/
	//method 1:
	$topicID = 45678;		// sample product ID
	$call = $api->get("topics/" . $topicID . "/tags");
	print_r ($call);		// will print out an Array of Tag Objects that belong to topic #45678 
	
	//method 2:
	$topicID = 45678;
	$call = $api->get("topics/" . $topicID);
	print_r ($call->tags);

	
?>