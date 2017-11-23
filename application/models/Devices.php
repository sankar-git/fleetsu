<?php
class Devices extends CI_Model {

	public function get_devices($id=''){
		try
		{
			$this->db->select("device_id,device_label,last_reported_date")->from('devices');
			if(!empty($id))
				$this->db->where('id',$id);
			return $this->db->get()->result_array();
		}catch (Exception $e){
			log_message( 'error', $e->getMessage( ) . ' in ' . $e->getFile() . ':' . $e->getLine() );
			return false;
		}
	}
	public function insert_devices($data){
		try{
			$this->db->insert('devices',$data);
			return $this->db->insert_id();
		}catch (Exception $e){
			log_message( 'error', $e->getMessage( ) . ' in ' . $e->getFile() . ':' . $e->getLine() );
			return false;
		}
	}
}
