<?php
	
	/**
	 * Object that can be used to call the Freestone API, this should be used either directly
	 * or though a simple proxy to grab data out of Freestone
	 *
	 */

	class FreestoneAPI { 

		private $user = "username";		//your user name string here (e.g. "fs-user")
		private $pw = "password";		//your password string here (e.g. "9njduru7uieequbuswFGz5rYgetep5gb")

		private $debug = false;


			// Override default values if they are provided in the constructor
			if ($url) $this->baseUrl = $url;
			if ($user) $this->user = $user;
			if ($pw) $this->pw = $pw;

		}


		public function get($call, $params) {
			return json_decode($this->apiCall("GET", $call, $params));
		}

		public function post($call, $params) {
			return json_decode($this->apiCall("POST", $call, $params));
		}

		public function put($call, $params) {
			return json_decode($this->apiCall("PUT", $call, $params));
		}

		public function delete($call, $params) {
			return json_decode($this->apiCall("DELETE", $call, $params));
		}


		public function apiCall($requestType, $call, $params) {
			//Check to see if the full request url was sent as the call
			if (strpos($call, "http") === 0) {
				$req = $call;
			} else {
				//Build the request URL
				$req = $this->baseUrl . $call;
			}

			//Send request to helper function and get the response
			$response = $this->_sendRequest(strtoupper($requestType), $req, $params);
			
			return $response;
		}
		
		private function _sendRequest($type, $url, $params=array()) {
			$ch = curl_init();
			
			if ($type == "GET") {
				curl_setopt($ch, CURLOPT_GET, 1);
				$url .= "/?" . http_build_query($params);
			}
			
			if ($type == "POST") {
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
				
				curl_setopt ($ch, CURLOPT_HTTPHEADER, Array("Content-Type: text/json"));
			}
			
			if ($type == "PUT") {
				$jsonstring = json_encode($params);

				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
				curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/json", "Content-Length: " . strlen($jsonstring)));
				curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonstring);
			}

			if ($type == "DELETE") {
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
				$url .= "/?" . http_build_query($params);
			}
			
			if ($this->debug) {
				echo "<br>Calling URL ($type): $url<br>";
			}
			
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt ($ch, CURLOPT_USERPWD, $this->user . ":" . $this->pw);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			$response = curl_exec ($ch);
			
			if ($this->debug) {
				echo "<br>Response: $response<br>";
			}

			if ($error = curl_errno($ch)) {
				echo "<br>Curl Error: " . $error . "<br>";
			}

			return $response;
		}
	
	}
	
?>