<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model 
{
	public function getDb() {

		$query = $this->db->get('user');
        return $query->result_array();

	}
	public function deleteUser($id) {
		$this->db->where('id', $id);
		$this->db->delete('user');
	}
}
