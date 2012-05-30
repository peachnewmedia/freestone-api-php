<?php
	/**
	*	This file is an example of how to use the Freestone API by Peach New Media.
	*
	*	This particular example deals with Products. 
	* 	Products are the listings of what is available for purchase. Products belong to topics. 
	*	There is also a special topic labeled as the Full Seminar topic, the products for this 
	*	give the user access to the entire seminar, not just one topic.
	*	
	*	@copyright 2012 Peach New Media
	*/

	// We must include the FreestoneAPI class. This class performs the API calls for us.	
	include("../classes/FreestoneAPI.php")

	// Create a new FreestoneAPI object. We will use this object to call our API functions.
	$api = new FreestoneAPI();

	
	/****************************************************************************************
	* Example 1: Get a specific product's information | (GET /:id)
	****************************************************************************************/
	$productID = 45678;		// sample product ID
	$call = $api->get("products/" . $productID);
	print_r ($call);		// will print out product #45678's information 

	
	
	/****************************************************************************************
	* Example 2: Create a new product | (POST /)
	****************************************************************************************/
	$params = array("topicid" => 12345, "mediumid" => 15, "pricing" => array("full" => 100));
	
	// This call will create a new product in topic #12345 that is type 15 (DVD) with a full price of $100.00
	// The topicid and mediumid are REQUIRED parameters
	$api->post("products", $params);
	
	
	
	/****************************************************************************************
	* Example 3: Updating a product | (PUT /:id)
	****************************************************************************************/
	$productID = 45678;
	$params = array("mediumid" => 2, "pricing" => array("full" => 150, "level1" => 120, "level2" => 100));
	
	// This call will update product #45678 by changing it to type 2 (Audio CD) and updating its pricing levels 
	$api->put("products/" . $productID, $params);

	
	
	/****************************************************************************************
	* Example 4: Deleting a product | (DELETE /:id)
	****************************************************************************************/
	$productID = 45678;
	
	// This call will remove a specific product.
	// Note: this does not actually delete the record, but sets the “deleted” flag which 
	// removes the product from the storefront. You can ‘undelete’ a product by calling the 
	// update method and setting “deleted” to 0.
	$api->delete("products/" . $productID);
	
?>