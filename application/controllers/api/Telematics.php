<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Telematics extends REST_Controller {
	protected $timezone="Asia/Calcutta";
	function __construct()
	{
		// Construct the parent class
		parent::__construct();

		// Configure limits on our controller methods
		// Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
		$this->methods['devices_get']['limit'] = 500; // 500 requests per hour per user/key
		$this->methods['devices_post']['limit'] = 100; // 100 requests per hour per user/key
		$this->methods['devices_delete']['limit'] = 50; // 50 requests per hour per user/key
		$this->load->model('devices');
	}

	public function devices_get()
	{
		$id = $this->get('id');
		// If the id parameter doesn't exist return all the devices
		if ($id === NULL)
		{
			$device_array = $this->devices->get_devices();
			// Check if the device data store contains users (in case the database result returns NULL)
			if ($device_array)
			{
				foreach($device_array as $key=>$value){
					date_default_timezone_set('UTC');
					$utc_date = strtotime($value['last_reported_date']);
					date_default_timezone_set($this->timezone);
					$local_date = date("Y-d-m H:i:s", $utc_date);
					$device_array[$key]['last_reported_date']=$local_date;
					$device_array[$key]['status']=	$this->get_status($value['last_reported_date']);

				}

				// Set the response and exit
				$this->response($device_array, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
			}
			else
			{
				// Set the response and exit
				$this->response([
					'status' => FALSE,
					'message' => 'No devices were found'
				], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
			}
		}
		// Find and return a single record for a particular user.

		$id = (int) $id;

		// Validate the id.
		if ($id <= 0)
		{
			// Invalid id, set the response and exit.
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
		}
		// Get the device from the array, using the id as key for retrieval.
		$device_array = $this->devices->get_devices($id);
		if (!empty($device_array))
		{
			$this->set_response($device_array, REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
		}
		else
		{
			$this->set_response([
				'status' => FALSE,
				'message' => 'Device could not be found'
			], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
		}
	}

	public function devices_post()
	{
		$params['device_id'] = $this->input->post('device_id');
		$params['device_label'] = $this->input->post('device_label');
		$params['last_reported_date'] = $this->post('last_reported_date');
		if(empty($params["device_id"]) && empty($params["device_label"]) && empty($params["last_reported_date"]))
		{
			$this->response([
				'status' => FALSE,
				'message' => 'input parameter device_id,device_label,last_reported_date are required'
			], REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
		}
		$id = $this->devices->insert_devices($params);
		if($id>0)
		{
			$this->set_response([
				'status' => TRUE,
				'message' => 'successfully created device'
			], REST_Controller::HTTP_CREATED); // CREATED (201) being the HTTP response code
		}else{
			$this->response([
				'status' => FALSE,
				'message' => 'failed to create a device'
			],REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
		}
	}

	public function devices_delete()
	{
		$id = (int) $this->get('id');

		// Validate the id.
		if ($id <= 0)
		{
			// Set the response and exit
			$this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
		}

		// $this->some_model->delete_something($id);
		$message = [
			'id' => $id,
			'message' => 'Deleted the device'
		];

		$this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
	}
	private function get_status($dbdate){
		date_default_timezone_set('UTC');
		$date = strtotime($dbdate);
		$utc_date = date('Y-m-d h:i:sa',$date);
		date_default_timezone_set($this->timezone);
		$datetime1 = new DateTime(date('Y-m-d h:i:sa'));
		$datetime2 = new DateTime($utc_date);
		$interval = $datetime1->diff($datetime2);
		if($interval->h<24 && $interval->y<=0 && $interval->m<=0 && $interval->d<=0)
			return "OK";
		else
			return "OFFLINE";
	}

}
