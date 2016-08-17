<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {
	var $http_header = array();
	var $base_url;

	public function __construct() {
		parent::__construct();

		$this->http_header = array(
		    "Accept: application/json"
		);

		$this->base_url = "https://quiet-beach-81015.herokuapp.com/";
	}
	
	public function add_client() {
		// In this example the input supposed sent from form post
		// $param = array(
		// 	'name'		=> $this->input->post('name'),
		// 	'gender'	=> $this->input->post('gender'),
		// );

		// Set all data into array, will be sent as post data
		$param = array(
			'name'		=> "Ahmad",
			'gender'	=> "male",
		);
		
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->base_url . "clients/");
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

	public function edit_client($id) {
		// In this example the input supposed sent from form post
		// $param = array(
		// 	'id'		=> $id, 
		// 	'name'		=> $this->input->post('name'),
		// 	'gender'	=> $this->input->post('gender'),
		// );

		// Set all data into array, will be sent as post data
		$param = array(
			'id'		=> $id, 
			'name'		=> "Ahmad Nurwanto",
			'gender'	=> "male",
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->base_url . "clients/" . $id);
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

	public function delete_client($id) {
		$param = array(
			'id'			=> $id, 
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->base_url . "clients/" . $id);
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

	public function get_clients() {
		// File get contents way
		$context = stream_context_create(array(
		    'http' => array(
		        'method' => 'GET',
		        'header' => $this->http_header
		    )
		));
		$data = file_get_contents($this->base_url . "clients/", false, $context);
		debug_var(json_decode($data));
	}

	public function client_histories() {
		// File get contents way
		$context = stream_context_create(array(
		    'http' => array(
		        'method' => 'GET',
		        'header' => $this->http_header
		    )
		));
		$client_id = 1;
		$data = file_get_contents($this->base_url . "histories/client/" . $client_id, false, $context);
		debug_var(json_decode($data));
	}
}
