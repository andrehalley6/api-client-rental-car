<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cars extends CI_Controller {
	var $http_header = array();

	public function __construct() {
		parent::__construct();

		$this->http_header = array(
		    "Accept: application/json"
		);
	}
	
	public function add_car() {
		// In this example the input supposed sent from form post
		// $param = array(
		// 	'brand'	=> $this->input->post('brand'),
		// 	'type'	=> $this->input->post('type'),
		// 	'year'	=> $this->input->post('year'),
		// 	'color'	=> $this->input->post('color'),
		// 	'plate'	=> $this->input->post('plate'),
		// );

		// Set all data into array, will be sent as post data
		$param = array(
			'brand'	=> "Nissan",
			'type'	=> "x-trail",
			'year'	=> "2015", 
			'color' => "Silver", 
			'plate'	=> "D 356 A"
		);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://lippox.restapi.dev/cars/");
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

	public function edit_car($id) {
		// In this example the input supposed sent from form post
		// $param = array(
		// 	'id'		=> $id, 
		// 	'brand'	=> $this->input->post('brand'),
		// 	'type'	=> $this->input->post('type'),
		// 	'year'	=> $this->input->post('year'),
		// 	'color'	=> $this->input->post('color'),
		// 	'plate'	=> $this->input->post('plate'),
		// );

		// Set all data into array, will be sent as post data
		$param = array(
			'id'	=> $id, 
			'brand'	=> "Honda",
			'type'	=> "civic",
			'year'	=> "2014", 
			'color' => "Blue Metallic", 
			'plate'	=> "D 903 HND"
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://lippox.restapi.dev/cars/" . $id);
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

	public function delete_car($id) {
		$param = array(
			'id'			=> $id, 
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "http://lippox.restapi.dev/cars/" . $id);
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

	public function get_cars() {
		// File get contents way
		$context = stream_context_create(array(
		    'http' => array(
		        'method' => 'GET',
		        'header' => $this->http_header
		    )
		));
		$data = file_get_contents("http://lippox.restapi.dev/cars/", false, $context);
		debug_var(json_decode($data));
	}

	public function car_histories() {
		// File get contents way
		$context = stream_context_create(array(
		    'http' => array(
		        'method' => 'GET',
		        'header' => $this->http_header
		    )
		));
		$car_id = 5;
		$data = file_get_contents("http://lippox.restapi.dev/histories/car/" . $car_id . "?month=08-2016", false, $context);
		debug_var(json_decode($data));
	}

	public function car_rented() {
		// File get contents way
		$context = stream_context_create(array(
		    'http' => array(
		        'method' => 'GET',
		        'header' => $this->http_header
		    )
		));
		$data = file_get_contents("http://lippox.restapi.dev/cars/rented?date=17-08-2016", false, $context);
		debug_var(json_decode($data));
	}

	public function car_free() {
		// File get contents way
		$context = stream_context_create(array(
		    'http' => array(
		        'method' => 'GET',
		        'header' => $this->http_header
		    )
		));
		$data = file_get_contents("http://lippox.restapi.dev/cars/free?date=17-08-2016", false, $context);
		debug_var(json_decode($data));
	}
}
