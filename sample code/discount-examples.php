<?php
	/**
	*	This file is an example of how to use the Freestone API by Peach New Media.
	*
	*	This particular example deals with Discounts. 
	* 	Discounts can work on many different levels. For example, coupon level discounts
	*	will take a certain amount off of the full seminar price if the customer enters the coupon code.
	* 	Member level discounts (if allowed by the provider) will automatically reduce the price by a certain 
	*	amount for different member levels (i.e. student, government member, etc.)
	*	
	*	@copyright 2012 Peach New Media
	*/

	// We must include the FreestoneAPI class. This class performs the API calls for us.	
	include("../classes/FreestoneAPI.php")

	// Create a new FreestoneAPI object. We will use this object to call our API functions.
	$api = new FreestoneAPI();

	
	/****************************************************************************************
	* Example 1: Get a specific discount's information | (GET /:id)
	****************************************************************************************/
	$discountID = 45678;		// sample discount ID
	$call = $api->get("topicdiscounts/" . $discountID);
	print_r ($call);		// will print out topic discount #45678's information 

	
	
	/****************************************************************************************
	* Example 2: Create a new discount | (POST /seminars/:id/topicdiscounts)
	****************************************************************************************/
	$params = array("discount_id" => 13, "rate" => 15, "code" => "DISCOUNT123", 
					"coupon_name" => "My First Coupon", "discounted_mediums" => array(2, 3, 15));
	
	// This call will create a new discount in seminar #1234 that is type 13 (coupon), at a rate of $15.00,
	// and only applies to mediums 2 (Audio CD), 3 (Audio Cassette), and 14 (streaming).
	// The discount_id and rate are REQUIRED parameters
	$api->post("seminars/1234/topicdiscounts", $params);
	
	
	
	/****************************************************************************************
	* Example 3: Updating a discount | (PUT /:id)
	****************************************************************************************/
	$discountID = 45678;
	$params = array("discount_id" => 13, "rate" => 13, "applyall" => 1);
	
	// This call will update product #45678 by changing its rate to $13.00 and removing all medium specific discounts.
	// This coupon will now apply to every medium.
	$api->put("topicdiscounts/" . $discountID, $params);

	
	
	/****************************************************************************************
	* Example 4: Deleting a discount | (DELETE /:id)
	****************************************************************************************/
	$discountID = 45678;
	
	// This call will remove a specific discount.
	// Note: this does not actually delete the record, but sets the active flag to false which 
	// removes the discount. You can ‘undelete’ a discount by calling the 
	// update method and setting “active” to 1.
	$api->delete("topicdiscounts/" . $discountID);
	
?>