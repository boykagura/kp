<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pilihan_model extends CI_Model 
{
	public function getPilihan() {

		$query = $this->db->get('tbl_pilihan');
        return $query->result_array();

	}
	public function deletePilihan ($id){

		$this->db->where('id', $id);
		$this->db->delete('tbl_pilihan');
	}
	public function insertData($data, $table)
	{
		$this->db->insert($table, $data);
	}
	public function editPilihan ($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('tbl_pilihan', $data);
	}
}
