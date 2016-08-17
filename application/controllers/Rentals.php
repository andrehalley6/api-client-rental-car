<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rentals extends CI_Controller {
	var $http_header = array();

	public function __construct() {
		parent::__construct();

		$this->http_header = array(
		    "Accept: application/json"
		);
	}
	
	public function add_rental() {
		// In this example the input supposed sent from form post
		// $param = array(
		// 	'car-id'	=> $this->input->post('car-id'),
		// 	'client-id'	=> $this->input->post('client-id'),
		// 	'date-from'	=> $this->input->post('date-from'),
		// 	'date-to'	=> $this->input->post('date-to')
		// );

		// Set all data into array, will be sent as post data
		$param = array(
			'car-id'	=> "9",
			'client-id'	=> "18",
			'date-from'	=> "2016-08-16", 
			'date-to' => "2016-08-18"
		);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://lippox.restapi.dev/rentals/");
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->http_header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$server_output = curl_exec($ch);
		curl_close($ch);
		
		debug_var(json_decode($server_output));
	}

	public function edit_rental($id) {
		// In this example the input supposed sent from form post
		// $param = array(
		// 	'id'		=> $id, 
		// 	'car-id'	=> $this->input->post('car-id'),
		// 	'client-id'	=> $this->input->post('client-id'),
		// 	'date-from'	=> $this->input->post('date-from'),
		// 	'date-to'	=> $this->input->post('date-to')
		// );

		// Set all data into array, will be sent as post data
		$param = array(
			'id'	=> $id, 
			'car-id'	=> "9",
			'client-id'	=> "18",
			'date-from'	=> "2016-08-20", 
			'date-to' => "2016-08-22"
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://lippox.restapi.dev/rentals/" . $id);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->http_header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		// curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$server_output = curl_exec($ch);
		curl_close($ch);
		
		debug_var(json_decode($server_output));
	}

	public function delete_rental($id) {
		$param = array(
			'id'			=> $id, 
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://lippox.restapi.dev/rentals/" . $id);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->http_header);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		// curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$server_output = curl_exec($ch);
		curl_close($ch);

		debug_var(json_decode($server_output));
	}

	public function get_rentals() {
		// File get contents way
		$context = stream_context_create(array(
		    'http' => array(
		        'method' => 'GET',
		        'header' => $this->http_header
		    )
		));
		$data = file_get_contents("http://lippox.restapi.dev/rentals/", false, $context);
		debug_var(json_decode($data));
	}
}
