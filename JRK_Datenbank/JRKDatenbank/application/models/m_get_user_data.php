<?php
class User_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function get_user($vorname = FALSE)
	{
		if ($vorname === FALSE)
		{
			$query = $this->db->get('User');
			return $query->result_array();
		}
		
		$query = $this->db->get_where('User', array('vorname' => $vorname));
		return $query->row_array();
	}
}